<?php
include_once '../../0-includes/0-conn.php';

$table = $_GET['table'];
$ini = $_GET['ini'];
$fin = $_GET['fin'];

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT 
    ROW_NUMBER() OVER () AS n, 
    u.poliza, 
    u.certificado, 
    fa.id AS factura, 
    DATE(fa.created) AS fechaA, 
    u.description AS asegurado,
    ROUND(
        COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
        COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0), 2
    ) AS monto1,
    CONCAT(
        ROUND(
            (
                COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
                COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0)
            ) * (fa.tasaDesc / 100), 2
        ), ' (', fa.tasaDesc, '%)'
    ) AS desc1,
    fa.descOtros AS desc2,
    ROUND(
        (
            COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
            COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0) - 
            (
                (
                    COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
                    COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0)
                ) * (fa.tasaDesc / 100)
            ) - fa.descOtros
        ), 2
    ) AS totalM,
    ROUND(
        (
            (
                COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
                COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0) - 
                (
                    (
                        COALESCE(SUM(CASE WHEN f.status = 1 THEN f.quantity * c.price ELSE 0 END), 0) +
                        COALESCE(SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END), 0)
                    ) * (fa.tasaDesc / 100)
                ) - fa.descOtros
            ) * 0.20, 2
        ) AS pcopago,
    CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"goToNewUrlWithId(', fa.id, ')\"><i class=\"fa fa-edit \"></i> EDITAR  </button>') AS options
FROM $table fa
INNER JOIN usuarios AS u ON u.id = fa.clienteId
LEFT JOIN facturasdetalles AS f ON f.description = fa.id
LEFT JOIN categorias AS c ON c.id = f.price
LEFT JOIN medicinas AS m ON m.id = f.price
WHERE DATE(fa.created) BETWEEN ? AND ? AND fa.status = 0
GROUP BY fa.id, u.poliza, u.certificado, fa.created, u.description, fa.tasaDesc, fa.descOtros
ORDER BY fa.id");

$stmt->bind_param('ss', $ini, $fin);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(['data' => $data]);

$stmt->close();
$conn->close();

