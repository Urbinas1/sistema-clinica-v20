<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$id = $_GET['id'];
//$sql =

    "SELECT sum(monto) FROM (
    (
        SELECT  
ROW_NUMBER() OVER () as n, 
u.poliza,
u.certificado,
fa.id as factura,
date(fa.created) as fechaA,
u.description as asegurado,
(select (
    (SELECT sum(f.quantity * c.price) as total1 FROM $table1 as f inner join categorias as c on c.id = f.price WHERE f.description = fa.id AND f.status=1) + (SELECT sum(f.quantity * m.price) as total1 FROM $table1 as f inner join medicinas as m on m.id = f.price WHERE f.description = fa.id AND f.status=0)    
) ) as monto1,

IF(fa.copago>0, 
     ((SELECT sum(f.quantity * c.price) as total1 FROM $table1 as f inner join categorias as c on c.id = f.price WHERE f.description = fa.id AND f.status=1) + (SELECT sum(f.quantity * m.price) as total1 FROM $table1 as f inner join medicinas as m on m.id = f.price WHERE f.description = fa.id AND f.status=0)    
) * 0.20,0) as pcopago,   
( select (
    (SELECT sum(f.quantity * c.price) as total1 FROM $table1 as f inner join categorias as c on c.id = f.price WHERE f.description = fa.id AND f.status=1) + (SELECT sum(f.quantity * m.price) as total1 FROM $table1 as f inner join medicinas as m on m.id = f.price WHERE f.description = fa.id AND f.status=0)    
) * 1.20 ) 
as monto  
    
FROM $table fa
INNER JOIN usuarios as u ON u.id = fa.clienteId
WHERE date(fa.created) BETWEEN $ini AND $fin;

    )

)

";

//echo $sql;

$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);
