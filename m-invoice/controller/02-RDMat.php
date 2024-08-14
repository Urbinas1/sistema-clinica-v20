<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$ultimoId = $_GET['ultimoId'] == 0 ? "(SELECT id FROM facturas WHERE status = 1)" : $_GET['ultimoId'];

$sql = "SELECT 
        f.id, 
        c.description as atencion, 
        f.quantity, 
        FORMAT(f.quantity * c.price, 2) as total,            
           CONCAT('<button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"btnCP',f.id,'\" onclick=\"updateCP(',f.id,')\">', FORMAT( f.cp, 2)  ,'</button>') as cubreP ,
        FORMAT(f.quantity * c.price - f.cp, 2) as cubreA,
        CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"plusMed(', f.id, ',', f.quantity, ')\"><i class=\"fa fa-plus \"></i></button>') as btnPlus,
        CONCAT('<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"minusMed(', f.id, ',', f.quantity, ')\"><i class=\"fa fa-minus \"></i></button>') as btnMinus,
        CONCAT('<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteMed(', f.id, ')\"><i class=\"fa fa-trash \"></i></button>') as options
    FROM 
        $table as f 
    INNER JOIN 
        materiales as c 
    ON 
        c.id = f.price 
    WHERE 
        f.description = $ultimoId 
        AND f.status = 4;
    ";

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

