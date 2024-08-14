<?php
include_once '../../0-includes/0-conn.php';

//$factIdQuery = "SELECT id FROM facturas WHERE description LIKE '1' AND status = 1";
//$factIdResult = $conn->query($factIdQuery);
//$factIdRow = $factIdResult->fetch_assoc();

//$factId = $factIdRow['id'];
$factId = $_GET['id'] == 0 ? "(SELECT id FROM facturas WHERE status = 1)" : $_GET['id'];





$sql = "SELECT 
IFNULL(f3.id, 0)            AS factId,

FORMAT(

(IFNULL(f1.total1, 0) + 
IFNULL(f2.total1, 0) + 
IFNULL(fa.total1, 0) + 
IFNULL(fm.total1, 0) + 
IFNULL(f5.total1, 0) 
)
- 
(
IFNULL(f1cp.totalCP, 0) +
IFNULL(f2cp.totalCP, 0) +
IFNULL(facp.totalCP, 0) +
IFNULL(fmcp.totalCP, 0) +
IFNULL(f5cp.totalCP, 0)
)
 , 2) AS colTOTAL,



IFNULL(f3.tasaDesc, 0)      AS colTASDE,

FORMAT( (

(IFNULL(f1.total1, 0) + 
IFNULL(f2.total1, 0) + 
IFNULL(fa.total1, 0) + 
IFNULL(fm.total1, 0) + 
IFNULL(f5.total1, 0) 
)
- 
(
IFNULL(f1cp.totalCP, 0) +
IFNULL(f2cp.totalCP, 0) +
IFNULL(facp.totalCP, 0) +
IFNULL(fmcp.totalCP, 0) +
IFNULL(f5cp.totalCP, 0)
)     

  ) * (IFNULL(f3.tasaDesc, 0) / 100), 2) AS colDESCU,

IFNULL(f3.descOtros, 0)   AS colOTROD,


FORMAT(
    ( 
        (
        IFNULL(f1.total1, 0) +
        IFNULL(f2.total1, 0) +
        IFNULL(fa.total1, 0) +
        IFNULL(fm.total1, 0) + 
        IFNULL(f5.total1, 0)  
        )
    -
        (
        IFNULL(f1cp.totalCP, 0) +
        IFNULL(f2cp.totalCP, 0) +
        IFNULL(facp.totalCP, 0) +
        IFNULL(fmcp.totalCP, 0) +
        IFNULL(f5cp.totalCP, 0) 
        )
    
    ) 

-  
 ( 
        (
            (
        IFNULL(f1.total1, 0) +
        IFNULL(f2.total1, 0) +
        IFNULL(fa.total1, 0) +
        IFNULL(fm.total1, 0) + 
        IFNULL(f5.total1, 0)  
        )
    -
        (
        IFNULL(f1cp.totalCP, 0) +
        IFNULL(f2cp.totalCP, 0) +
        IFNULL(facp.totalCP, 0) +
        IFNULL(fmcp.totalCP, 0) +
        IFNULL(f5cp.totalCP, 0) 
        )
        ) 
        * 
        (IFNULL(f3.tasaDesc, 0) / 100) 
    ) 

-   ( IFNULL(f3.descOtros, 0)  

), 2) AS colSUBTO,





IFNULL(f3.copago2, 0)       AS colTASAC,


FORMAT (
    (
        (
            (
                (
                    IFNULL (f1.total1, 0) + IFNULL (f2.total1, 0) + IFNULL (fa.total1, 0) + IFNULL (fm.total1, 0) + IFNULL (f5.total1, 0)
                ) - (
                    IFNULL (f1cp.totalCP, 0) + IFNULL (f2cp.totalCP, 0) + IFNULL (facp.totalCP, 0) + IFNULL (fmcp.totalCP, 0) + IFNULL (f5cp.totalCP, 0)
                )
            ) - (
                (
                    (
                        IFNULL (f1.total1, 0) + IFNULL (f2.total1, 0) + IFNULL (fa.total1, 0) + IFNULL (fm.total1, 0) + IFNULL (f5.total1, 0)
                    ) - (
                        IFNULL (f1cp.totalCP, 0) + IFNULL (f2cp.totalCP, 0) + IFNULL (facp.totalCP, 0) + IFNULL (fmcp.totalCP, 0) + IFNULL (f5cp.totalCP, 0)
                    )
                ) * (IFNULL (f3.tasaDesc, 0) / 100)
            ) - (IFNULL (f3.descOtros, 0))
        ) - (IFNULL (f3.deducible, 0))
    ) * (IFNULL (f3.copago2, 0) / 100),
    2
) AS colCOPA2,


FORMAT(
IFNULL(f1cp.totalCP, 0) +
IFNULL(f2cp.totalCP, 0) +
IFNULL(facp.totalCP, 0) +
IFNULL(fmcp.totalCP, 0) +
IFNULL(f5cp.totalCP, 0) 
, 2) AS colNOELE,

FORMAT(IFNULL(f3.deducible, 0),2)     AS colDEDUC,

FORMAT(  

IFNULL(
        (
            (
                (
                    IFNULL(f1.total1, 0) + 
                    IFNULL(f2.total1, 0) + 
                    IFNULL(fa.total1, 0) + 
                    IFNULL(fm.total1, 0) + 
                    IFNULL(f5.total1, 0) - 
                    IFNULL(f1cp.totalCP, 0) +
                    IFNULL(f2cp.totalCP, 0) -
                    IFNULL(facp.totalCP, 0) -
                    IFNULL(fmcp.totalCP, 0) -
                    IFNULL(f5cp.totalCP, 0)
                ) - 
                (
                    (
                        IFNULL(f1.total1, 0) + 
                        IFNULL(f2.total1, 0) + 
                        IFNULL(fa.total1, 0) + 
                        IFNULL(fm.total1, 0) + 
                        IFNULL(f5.total1, 0)
                    ) * 
                    (IFNULL(f3.tasaDesc, 0) / 100)
                ) - 
                IFNULL(f3.descOtros, 0)
            ) - 
            IFNULL(f3.deducible, 0)
        ) * IFNULL(f3.copago2, 0) / 100, 
    0)


 +

IFNULL(f1cp.totalCP, 0) +
IFNULL(f2cp.totalCP, 0) +
IFNULL(facp.totalCP, 0) +
IFNULL(fmcp.totalCP, 0) +
IFNULL(f5cp.totalCP, 0)+IFNULL(f3.deducible, 0),2 ) 
                            AS colTOPAG,


FORMAT(IFNULL(f1.total1, 0), 2) AS tAte, 
FORMAT(IFNULL(f2.total1, 0), 2) AS tMed,
FORMAT(IFNULL(fa.total1, 0), 2) AS tAtCliente,
FORMAT(IFNULL(fm.total1, 0), 2) AS tMat,
FORMAT(IFNULL(f5.total1, 0), 2) AS tHospitalizacion,




FORMAT(IFNULL(f1.total1, 0) - IFNULL(f1cp.totalCP, 0), 2) as totalCA_1,
FORMAT(IFNULL(f2.total1, 0) - IFNULL(f2cp.totalCP, 0), 2) as totalCA_2,
FORMAT(IFNULL(fa.total1, 0) - IFNULL(facp.totalCP, 0), 2) as totalCA_3,
FORMAT(IFNULL(fm.total1, 0) - IFNULL(fmcp.totalCP, 0), 2) as totalCA_4,
FORMAT(IFNULL(f5.total1, 0) - IFNULL(f5cp.totalCP, 0), 2) as totalCA_5,





IFNULL(f3.copago, 0) AS copago,
IF(f3.copago = 1, FORMAT(((IFNULL(f1.total1, 0) + IFNULL(f2.total1, 0)  + IFNULL(fa.total1, 0) + IFNULL(fm.total1, 0)   + IFNULL(f5.total1, 0)) - ((IFNULL(f1.total1, 0) + IFNULL(f2.total1, 0)  + IFNULL(fa.total1, 0) + IFNULL(fm.total1, 0)   + IFNULL(f5.total1, 0)) * (IFNULL(f3.tasaDesc, 0) / 100)) - IFNULL(f3.descOtros, 0)) * 0.20, 2), 0) AS copagoP
FROM 

(SELECT IFNULL(SUM(f.quantity * f.precioP), 0) as total1
FROM facturasdetalles AS f
INNER JOIN categorias AS c ON c.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 1) AS f1,
(SELECT IFNULL(SUM(f.cp), 0) as totalCP 
FROM facturasdetalles AS f
INNER JOIN categorias AS c ON c.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 1) AS f1cp,

(SELECT IFNULL(SUM(f.quantity * m.price), 0) as total1
FROM facturasdetalles AS f
INNER JOIN medicinas AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 0) AS f2,
(SELECT IFNULL(SUM(f.cp), 0) as totalCP 
FROM facturasdetalles AS f
INNER JOIN medicinas AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 0) AS f2cp,

(SELECT IFNULL(SUM(f.quantity * m.price), 0) as total1 
FROM facturasdetalles AS f 
INNER JOIN atCliente AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 3) AS fa, 
(SELECT IFNULL(SUM(f.cp), 0) as totalCP 
FROM facturasdetalles AS f 
INNER JOIN atCliente AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 3) AS facp, 

(SELECT IFNULL(SUM(f.quantity * m.price), 0) as total1 
FROM facturasdetalles AS f 
INNER JOIN materiales AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 4) AS fm, 
(SELECT IFNULL(SUM(f.cp), 0) as totalCP 
FROM facturasdetalles AS f 
INNER JOIN materiales AS m ON m.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 4) AS fmcp, 


(SELECT IFNULL(SUM(f.quantity * f.precioP), 0) as total1
FROM facturasdetalles AS f
INNER JOIN hospitalizacion AS c ON c.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 5) AS f5, 
(SELECT IFNULL(SUM(f.cp), 0) as totalCP
FROM facturasdetalles AS f
INNER JOIN hospitalizacion AS c ON c.id = f.price 
WHERE f.description = ($factId) 
AND f.status = 5) AS f5cp, 


(SELECT * FROM facturas WHERE id = $factId) AS f3;
";



$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);
