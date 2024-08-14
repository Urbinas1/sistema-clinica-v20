<?php
include_once '../../0-includes/0-conn.php';

$ini = $_GET['ini'];
$fin = $_GET['fin'];


$sql = "WITH 
categoria1 AS (
    SELECT f.description AS id,sum(f.cp) tcp ,SUM((f.precioP*f.quantity)-f.cp) AS t1  FROM facturasdetalles AS f  WHERE f.status = 1  GROUP BY f.description
),
categoria2 AS(
    SELECT f.description as id,sum(f.cp) tcp , sum( ( select m.price * f.quantity from medicinas as m where m.id = f.price  )-f.cp ) AS t2 FROM facturasdetalles AS f WHERE f.status = 0 GROUP BY f.description
),
categoria3 AS(
    SELECT f.description as id,sum(f.cp) tcp , sum( ( select m.price * f.quantity from atCliente as m where m.id = f.price  )-f.cp ) AS t3 FROM facturasdetalles AS f WHERE f.status = 3 GROUP BY f.description
),
categoria4 AS(
    SELECT f.description as id,sum(f.cp) tcp , sum( ( select m.price * f.quantity from materiales as m where m.id = f.price  )-f.cp ) AS t4 FROM facturasdetalles AS f WHERE f.status = 4 GROUP BY f.description
),
categoria5 AS (
    SELECT f.description AS id,sum(f.cp) tcp , SUM((f.precioP*f.quantity)-f.cp) AS t5  FROM facturasdetalles AS f  WHERE f.status = 5  GROUP BY f.description
),

subtotales AS (  		
    SELECT 
    fa.id as id,
    COALESCE(cat1.t1, 0)  +  
    COALESCE(cat2.t2, 0)  +  
    COALESCE(cat3.t3, 0)  +  
    COALESCE(cat4.t4, 0)  +  
    COALESCE(cat5.t5, 0)  as total    
    FROM facturas AS fa
    LEFT JOIN categoria1 AS cat1 ON fa.id = cat1.id
    LEFT JOIN categoria2 AS cat2 ON fa.id = cat2.id
    LEFT JOIN categoria3 AS cat3 ON fa.id = cat3.id
    LEFT JOIN categoria4 AS cat4 ON fa.id = cat4.id
    LEFT JOIN categoria5 AS cat5 ON fa.id = cat5.id    
    WHERE DATE(fa.created) BETWEEN '$ini' AND '$fin' AND fa.status = 0 ORDER BY fa.id ASC
),
subtotalesCP AS (  		
    SELECT 
    fa.id as id,
    COALESCE(cp1.tcp, 0)  +  
    COALESCE(cp2.tcp, 0)  +  
    COALESCE(cp3.tcp, 0)  +  
    COALESCE(cp4.tcp, 0)  +  
    COALESCE(cp5.tcp, 0)  as totalCP   
    FROM facturas AS fa
    LEFT JOIN categoria1 AS cp1 ON fa.id = cp1.id
    LEFT JOIN categoria2 AS cp2 ON fa.id = cp2.id
    LEFT JOIN categoria3 AS cp3 ON fa.id = cp3.id
    LEFT JOIN categoria4 AS cp4 ON fa.id = cp4.id
    LEFT JOIN categoria5 AS cp5 ON fa.id = cp5.id    
    WHERE DATE(fa.created) BETWEEN '$ini' AND '$fin' AND fa.status = 0 ORDER BY fa.id ASC
),
descuento1 AS (
	SELECT
    fa.id as id,
    subt.total * (fa.tasaDesc /100) as descu
	FROM facturas AS fa
	LEFT JOIN subtotales AS subt ON fa.id = subt.id
	WHERE DATE(fa.created) BETWEEN '$ini' AND '$fin' AND fa.status = 0 ORDER BY fa.id ASC    
),
total1 AS (
	SELECT
    fa.id as id,
    subt.total - des.descu - fa.descOtros as to1
	FROM facturas AS fa
	LEFT JOIN subtotales AS subt ON fa.id = subt.id
    LEFT JOIN descuento1 AS des ON fa.id = des.id
	WHERE DATE(fa.created) BETWEEN '$ini' AND '$fin' AND fa.status = 0 ORDER BY fa.id ASC    
)


SELECT 

ROW_NUMBER() OVER () as n, 
u.poliza, 
u.certificado, 
fa.id as factura, 
date(fa.created) as fechaA, 
u.description as asegurado,

fa.id AS facID, 
COALESCE(cat1.t1, 0) AS cubreAseg1 ,  
COALESCE(cat2.t2, 0) AS cubreAseg2 ,  
COALESCE(cat3.t3, 0) AS cubreAseg3 ,  
COALESCE(cat4.t4, 0) AS cubreAseg4 ,  
COALESCE(cat5.t5, 0) AS cubreAseg5,
format(subt.total,2) as subTotalCA,
format(fa.tasaDesc,2) as tasaDesc,
format(des.descu,2) as Desc1,
format(fa.descOtros,2) as Desc2,
format(total.to1,2) as total1,
format(fa.copago2,2) as tasaCpgo,
format((total.to1 - fa.deducible) * fa.copago2/100,2) as copago,
format(fa.deducible,2) as deducible,
format(subtCP.totalCP,2) as noElegible,
format(((total.to1 - fa.deducible) * fa.copago2/100)+(fa.deducible)+(subtCP.totalCP),2) as TOTAL,

CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"goToNewUrlWithId(',fa.id,')\"><i class=\"fa fa-edit \">
</i> EDITAR  </button>')  as options
FROM facturas AS fa
LEFT JOIN categoria1 AS cat1 ON fa.id = cat1.id
LEFT JOIN categoria2 AS cat2 ON fa.id = cat2.id
LEFT JOIN categoria3 AS cat3 ON fa.id = cat3.id
LEFT JOIN categoria4 AS cat4 ON fa.id = cat4.id
LEFT JOIN categoria5 AS cat5 ON fa.id = cat5.id
LEFT JOIN subtotales AS subt ON fa.id = subt.id
LEFT JOIN subtotalesCP AS subtCP ON fa.id = subtCP.id
LEFT JOIN descuento1 AS des ON fa.id = des.id
LEFT JOIN total1 AS total ON fa.id = total.id
INNER JOIN usuarios as u ON u.id = fa.clienteId
WHERE DATE(fa.created) BETWEEN '$ini' AND '$fin' AND fa.status = 0 ORDER BY fa.id ASC;";

//echo $sql;


$query = $conn->query($sql);
$query2 = $conn->query($sql);
$row = $query->fetch_assoc();
$array = array();
if (is_null($row)) {
    echo json_encode(['data' => null]);
} else {
    while ($row2 = $query2->fetch_assoc()) {
        $array[] = $row2;
    }
    echo json_encode(['data' => $array]);
}
