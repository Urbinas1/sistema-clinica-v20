<?php
require('fpdf/fpdf.php');
include_once '../0-includes/0-conn.php';

$facturaId = $_GET['idfact'];
$tabla1 = "facturas";
$tabla2 = "facturasdetalles";
$valorAjuste = 10;

date_default_timezone_set('America/Tegucigalpa');
$locale = 'es_ES';
$dateFormatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::NONE);


$infoFact = "SELECT u1.description AS cliente,
u1.docId AS docId,
u1.certificado AS certificado,
u1.poliza AS poliza,
u1.seguro AS seguro,
u1.rtn AS rtn,
u2.description AS doctor1,

u3.description AS doctor2,
CASE f.tipoFactura WHEN 1 THEN 'CRÉDITO' ELSE 'CONTADO' END AS tipoFactura,
f.created ,
FORMAT(f.tasaDesc,2) as tasaDesc,
FORMAT(f.descOtros,2)as descOtros,
FORMAT(f.copago,2)AS copago,
FORMAT(f.copago2,2) as copago2,
FORMAT(f.deducible,2) as deducible
FROM facturas f
LEFT JOIN usuarios u1 ON u1.id = f.clienteId
LEFT JOIN usuarios u2 ON u2.id = f.doctor1id
LEFT JOIN usuarios u3 ON u3.id = f.doctor2id
WHERE f.id = $facturaId;";


$servicios = "SELECT f.id, c.description as atencion, 
FORMAT(f.quantity * f.precioP,2) as total, f.cp as cubreP, 
FORMAT((f.quantity * f.precioP) - (IFNULL(f.cp,0)) ,2) as cubreA 
FROM $tabla2 as f 
INNER JOIN categorias as c on c.id = f.price 
WHERE f.description = $facturaId and f.status = 1"; //1 atencion en la emergencia

$medicamentos = "SELECT f.id, c.description as atencion, f.quantity, 
FORMAT(f.quantity * c.price,2) as total, f.cp as cubreP, 
FORMAT((f.quantity * c.price) - (IFNULL(f.cp,0)) ,2) as cubreA
FROM $tabla2 as f 
inner join medicinas as c on c.id = f.price 
where f.description = $facturaId and f.status = 0"; //0=2 medicinas y suministros

$atclientes = "SELECT f.id, c.description as atencion, f.quantity, 
FORMAT(f.quantity * c.price,2) as total, f.cp as cubreP, 
FORMAT((f.quantity * c.price) - (IFNULL(f.cp,0)) ,2) as cubreA
FROM $tabla2 as f 
inner join atCliente as c on c.id = f.price 
where f.description = $facturaId and f.status = 3"; //3 atencion al cliente

$materiales = "SELECT f.id, c.description as atencion, f.quantity, 
FORMAT(f.quantity * c.price,2) as total, f.cp as cubreP, 
FORMAT((f.quantity * c.price) - (IFNULL(f.cp,0)) ,2) as cubreA
FROM $tabla2 as f 
inner join materiales as c on c.id = f.price 
where f.description = $facturaId and f.status = 4"; //4 materiales

$hospitalizacion = "SELECT f.id, c.description as atencion, 
FORMAT(f.quantity * f.precioP,2) as total, f.cp as cubreP, 
FORMAT((f.quantity * f.precioP) - (IFNULL(f.cp,0)) ,2) as cubreA 
FROM $tabla2 as f 
INNER JOIN hospitalizacion as c on c.id = f.price 
WHERE f.description = $facturaId and f.status = 5"; //5 hospitalizacion



$totalServicios = "SELECT 
FORMAT(sum((f.quantity * f.precioP)),2) as total1, 
FORMAT(sum((f.cp)) ,2) as total2, 
FORMAT(sum((f.quantity * f.precioP)) - sum((f.cp)) ,2) as total3
FROM facturasdetalles as f
inner join categorias as c on c.id = f.price 
WHERE f.description = $facturaId AND f.status=1"; //1 atencion en la emergencia

$totalMedicamentos = "SELECT 
FORMAT(sum(f.quantity * m.price),2) as total1 ,
FORMAT(sum((f.cp)) ,2) as total2, 
FORMAT(sum((f.quantity * m.price)) - sum((f.cp)) ,2) as total3
FROM facturasdetalles as f inner join medicinas as m on m.id = f.price 
WHERE f.description = $facturaId AND f.status=0;"; //0=2 medicamentos

$totalAtencionClientes = "SELECT 
FORMAT(sum(f.quantity * m.price),2) as total1, 
FORMAT(sum((f.cp)) ,2) as total2, 
FORMAT(sum((f.quantity * m.price)) - sum((f.cp)) ,2) as total3
FROM facturasdetalles as f inner join atCliente as m on m.id = f.price 
WHERE f.description = $facturaId AND f.status=3;"; //3 atencion al cliente

$totalMateriales = "SELECT 
FORMAT(sum(f.quantity * m.price),2) as total1, 
FORMAT(sum((f.cp)) ,2) as total2, 
FORMAT(sum((f.quantity * m.price)) - sum((f.cp)) ,2) as total3
FROM facturasdetalles as f inner join materiales as m on m.id = f.price 
WHERE f.description = $facturaId AND f.status=4;"; //4 materiales

$totalHospitalizacion = "SELECT 
FORMAT(sum((f.quantity * f.precioP)),2) as total1, 
FORMAT(sum((f.cp)) ,2) as total2, 
FORMAT(sum((f.quantity * f.precioP)) - sum((f.cp)) ,2) as total3
FROM facturasdetalles as f inner join hospitalizacion as c on c.id = f.price 
WHERE f.description = $facturaId AND f.status=5"; //5 es la categoria





$totalR = "SELECT 
    COALESCE(FORMAT(SUM(CASE WHEN f.status = 1 THEN (f.quantity * f.precioP)-f.cp ELSE 0 END), 2), 0) AS tAteEmer,
    COALESCE(FORMAT(SUM(CASE WHEN f.status = 0 THEN (f.quantity * m.price)-f.cp ELSE 0 END), 2), 0) AS tMedSum,
    COALESCE(FORMAT(SUM(CASE WHEN f.status = 3 THEN (f.quantity * a.price)-f.cp ELSE 0 END), 2), 0) AS tAteClient,
    COALESCE(FORMAT(SUM(CASE WHEN f.status = 4 THEN (f.quantity * mt.price)-f.cp ELSE 0 END), 2), 0) AS tMater,
    COALESCE(FORMAT(SUM(CASE WHEN f.status = 5 THEN (f.quantity * f.precioP)-f.cp ELSE 0 END), 2), 0) AS tHospit,
    COALESCE(
        FORMAT(        
        (
            SUM(CASE WHEN f.status = 1 THEN f.quantity * f.precioP ELSE 0 END) +
            SUM(CASE WHEN f.status = 0 THEN f.quantity * m.price ELSE 0 END) + 
            SUM(CASE WHEN f.status = 3 THEN f.quantity * a.price ELSE 0 END) + 
            SUM(CASE WHEN f.status = 4 THEN f.quantity * mt.price ELSE 0 END) +
            SUM(CASE WHEN f.status = 5 THEN f.quantity * f.precioP ELSE 0 END)  
        )
            -
        (    
            SUM(CASE WHEN f.status = 1 THEN f.cp ELSE 0 END) +
            SUM(CASE WHEN f.status = 0 THEN f.cp ELSE 0 END) + 
            SUM(CASE WHEN f.status = 3 THEN f.cp ELSE 0 END) + 
            SUM(CASE WHEN f.status = 4 THEN f.cp ELSE 0 END) +
            SUM(CASE WHEN f.status = 5 THEN f.cp ELSE 0 END)  
        )

            ,    2   ),
        0
    ) AS totalR,

(    
            SUM(CASE WHEN f.status = 1 THEN f.cp ELSE 0 END) +
            SUM(CASE WHEN f.status = 0 THEN f.cp ELSE 0 END) + 
            SUM(CASE WHEN f.status = 3 THEN f.cp ELSE 0 END) + 
            SUM(CASE WHEN f.status = 4 THEN f.cp ELSE 0 END) +
            SUM(CASE WHEN f.status = 5 THEN f.cp ELSE 0 END)  
        ) AS totalCP_
FROM 
    facturasdetalles AS f
LEFT JOIN categorias AS c ON c.id = f.price
LEFT JOIN medicinas AS m ON m.id = f.price
LEFT JOIN atCliente AS a ON a.id = f.price
LEFT JOIN materiales AS mt ON mt.id = f.price
LEFT JOIN hospitalizacion AS h ON h.id = f.price
WHERE     f.description = '$facturaId'";
//f.price es el id del producto, medicina, ate cliente

$queryInfoFact = $conn->query($infoFact);

$queryServicios = $conn->query($servicios);
$queryMedicamentos = $conn->query($medicamentos);
$queryMateriales = $conn->query($materiales);
$queryHospitalizacion = $conn->query($hospitalizacion);
$queryAtClientes = $conn->query($atclientes);

$queryTotalServicios = $conn->query($totalServicios);
$queryTotalMedicamentos = $conn->query($totalMedicamentos);
$queryTotalAtencionClientes = $conn->query($totalAtencionClientes);
$queryTotalMateriales = $conn->query($totalMateriales);
$queryTotalHospitalizacion = $conn->query($totalHospitalizacion);

$queryTotalR = $conn->query($totalR);

$conn->close();


$responseInfoFact = $queryInfoFact->fetch_assoc();

$responseTotalServicios = $queryTotalServicios->fetch_assoc();
$responseTotalMedicamentos = $queryTotalMedicamentos->fetch_assoc();
$responseTotalAtencionClientes = $queryTotalAtencionClientes->fetch_assoc();
$responseTotalMateriales = $queryTotalMateriales->fetch_assoc();
$responseTotalHospitalizacion = $queryTotalHospitalizacion->fetch_assoc();

$responseTotalR = $queryTotalR->fetch_assoc();

$fecha2 = "";
//$fecha = mb_convert_encoding($dateFormatter->format($responseInfoFact['created']), 'ISO-8859-1', 'UTF-8');
$fecha = mb_convert_encoding($dateFormatter->format(new DateTime($responseInfoFact['created'])), 'ISO-8859-1', 'UTF-8');



$azul =         "#2f75b5";
$azulDark =     "#002060";
$celeste =      "#9BC2E6";
$blanco =       "#FFFFFF";
$negro =        "#000000";
$gris =         "#808080";

$appName =      'POLICLINICA SAN RAFAEL';
$appAddress =   'Calle Vicente Williams, Salida a Marcovia';
$appRegion =    'Choluteca,Honduras, C.A.';
$rtnE =          '17071981004960';
$telefonoE =     '2782-0261';
$telfAndRuc =   'Teléfono: +(504) ' . $telefonoE . ' / RTN: ' . $rtnE;


$tAteEmer = $responseTotalR['tAteEmer'];
$tMedSum = $responseTotalR['tMedSum']; //total registro medicamentos
$tAteClient = $responseTotalR['tAteClient'];

$tMater = $responseTotalR['tMater']; //total materiales
$tHospit = $responseTotalR['tHospit']; //total hospitalizacion

$totalR = $responseTotalR['totalR'];


$client =       $responseInfoFact['cliente'];
$doctorName =   $responseInfoFact['doctor1'];
$doctorName2 =   $responseInfoFact['doctor2'];
$poliza =     $responseInfoFact['poliza'];
$typeOper =     $responseInfoFact['tipoFactura'];
$aseguradora =  $responseInfoFact['seguro'];

$tasaDesc = $responseInfoFact['tasaDesc'];
$descOtros = $responseInfoFact['descOtros'];
$copago = $responseInfoFact['copago'];

$tasaCopago2 = $responseInfoFact['copago2'];
$deducible = $responseInfoFact['deducible'];

$rtn =     $responseInfoFact['rtn'];
$descrip1 =     'ATENCIÓN EN LA EMERGENCIA';
$subtotal1 =    'SUB TOTAL';
$descrip2 =     'MEDICINAS Y SUMINISTROS';
$subtotal2 =    'SUB TOTAL';

$descrip3 =     'ATENCION AL CLIENTE';

$descrip4 =     'MATERIALES QUIRURGICOS';
$descrip5 =     'HOSPITALIZACION';

$subtotal3 =    'SUB TOTAL';
$email =        'email:segurospsr@psrhn.com';

$totalRows1 =       25;
$totalRows2 =       18;
$totalRowsFooter =  10;

function stringToFloat($string)
{
    $number = str_replace(',', '', $string);
    $floatValue = (float) $number;
    return $floatValue;
}


$b = stringToFloat($totalR);
$t = stringToFloat($tasaDesc) / 100;
$p = $b * $t;

$totalCP_ = stringToFloat($responseTotalR['totalCP_']);

$descOtros = stringToFloat($descOtros) ? floatval($descOtros) : 0;
$totalPagar = $b - $p - $descOtros;

$deducible2 = stringToFloat($deducible);

$copagoMonto = 0;
if (stringToFloat($tasaCopago2) > 0) {
    $copagoMonto = ($totalPagar - $deducible2) * (stringToFloat($tasaCopago2) / 100);
}

$nuevoTotal = $totalCP_ + $deducible2 + $copagoMonto;


class PDF extends FPDF
{
    function Header() {}
    function Footer() {}
}
function colorCelda($r, $g = null, $b = null)
{
    if ($g === null && $b === null) {
        sscanf($r, "#%02x%02x%02x", $r, $g, $b);
    }
    $GLOBALS['pdf']->SetDrawColor($r, $g, $b);
    $GLOBALS['pdf']->SetFillColor($r, $g, $b);
}
function colorTexto($r, $g = null, $b = null)
{
    if ($g === null && $b === null) {
        sscanf($r, "#%02x%02x%02x", $r, $g, $b);
    }
    $GLOBALS['pdf']->SetTextColor($r, $g, $b);
}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);
$pdf->Image('../recursos/img/logo2.png', 123, 8, 48);
$pdf->setXY(20, 12);
$pdf->SetTextColor(1, 85, 170);

$pdf->Cell(3, 10, mb_convert_encoding($appName, 'ISO-8859-1', 'UTF-8'), 0, 1);

$pdf->SetFont('Arial', 'b', 8);
colorTexto($negro);
$pdf->Cell(0, 8, mb_convert_encoding($appAddress, 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 8, mb_convert_encoding($appRegion, 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(0, 8, mb_convert_encoding($telfAndRuc, 'ISO-8859-1', 'UTF-8'), 0, 0);

colorCelda($azul);

$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 9);
colorTexto($blanco);
$pdf->Cell(100, 6, 'FECHA', 0, 1, 'C', 1);

$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(100, 8,  $fecha, 0, 1, 'C');

colorTexto($blanco);
$pdf->Cell(80, 6, '   FACTURAR A', 0, 0, 'L', 1);

colorCelda($azul);
$pdf->setX(100);
$pdf->SetFont('Arial', '', 8);
colorTexto($blanco);
$pdf->Cell(60, 6, 'POLIZA', 0, 0, 'C', 1);

colorCelda($azul);
$pdf->setX(160);
$pdf->SetFont('Arial', '', 8);
colorTexto($blanco);
$pdf->Cell(40, 6, mb_convert_encoding('TÉRMINOS', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', 1);

$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(90, 6, $client, 0, 0, 'L');

$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(60, 6, $poliza, 0, 0, 'C');

$pdf->setX(160);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(40, 6, mb_convert_encoding($typeOper, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(90, 8,  '', 0, 0, 'C');

$pdf->Ln(5.8);

colorCelda($azul);
$pdf->setX(100);
$pdf->SetFont('Arial', '', 8);
colorTexto($blanco);
$pdf->Cell(60, 6, 'ASEGURADORA', 0, 0, 'C', 1);

colorCelda($azul);
$pdf->setX(160);
$pdf->SetFont('Arial', '', 8);
colorTexto($blanco);
$pdf->Cell(40, 6, mb_convert_encoding('RTN', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', 1);

colorTexto($blanco);
$pdf->Cell(80, 5.7, mb_convert_encoding('   MÉDICO TRATANTE', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 1);

$pdf->Ln(0.3);
$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(60, 6,  mb_convert_encoding($aseguradora, 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

$pdf->setX(160);
$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(40, 6, mb_convert_encoding($rtn, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
colorTexto($negro);
$pdf->Cell(90, 5, $doctorName, 0, 1, 'L');

if (is_null($doctorName2)) {
} else {
    $pdf->SetFont('Arial', 'B', 8);
    colorTexto($negro);
    $pdf->Cell(90, 5, $doctorName2, 0, 1, 'L');
}


$pdf->Ln(1.5);

$pdf->SetFont('Arial', 'B', 8);
colorTexto($blanco);
colorCelda($azul);
$pdf->Cell(90, 5, '', 1, 0, 'L', 1);
$pdf->Cell(25, 5, 'CANTIDAD', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'TOTAL', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'CUBRE PACIENTE', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'CUBRE', 1, 1, 'C', 1);
$pdf->Cell(175, 5, '', 1, 0, 'C', 1);

$pdf->setX(175);
$pdf->Cell(25, 5, 'ASEGURADORA', 1, 1, 'C', 1);

colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', 'b', 9);

$filaExtraRelleno = 0;


//INI TABLA ATENCION MEDICA

if ($tAteEmer > 0) {
    $pdf->Cell(90, 7, mb_convert_encoding($descrip1, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 1, 'R');
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}


colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$totalRowsServicios = $queryServicios->num_rows;

if (is_null($doctorName2)) {
    $totalRowsServicios = $totalRowsServicios + 1;
} else {
    $totalRowsServicios = $totalRowsServicios + 2;
}
$tituloC1 = 1;
$totalRowsServicios = $totalRowsServicios + $tituloC1;

while ($servicio = $queryServicios->fetch_assoc()) {
    $pdf->Cell(90, 7, mb_convert_encoding($servicio['atencion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'L');
    $pdf->Cell(25, 7, $servicio['total'], 1, 0, 'R');
    $pdf->Cell(25, 7, $servicio['cubreP'], 1, 0, 'R');
    $pdf->Cell(25, 7, $servicio['cubreA'], 1, 1, 'R');
}

if ($tAteEmer > 0) {
    colorCelda($celeste);
    $pdf->setX(10);
    $pdf->Cell(20, 7, $subtotal1, 0, 0, 'R', 1);
    $pdf->Cell(115, 7, '', 0, 0, 'R', 1);

    $pdf->setX(125);
    $pdf->SetFont('Arial', 'B', 9);
    colorTexto($negro);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalServicios['total1'], 0, 0, 'R', 1);

    $pdf->setX(150);
    //$pdf->Cell(25, 7, ' -', 0, 0, 'R', 1);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalServicios['total2'], 0, 0, 'R', 1);

    $pdf->setX(175);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalServicios['total3'], 0, 1, 'R', 1);
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}


//FIN TABLA ATENCION MEDICA




//INI TABLA HOSPITALIZACION


if ($tHospit > 0) {
    colorTexto($negro);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'b', 9);
    $pdf->Cell(90, 7, mb_convert_encoding($descrip5, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 1, 'R');
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}
colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$totalRowsHospitalizacion = $queryHospitalizacion->num_rows;
$totalRowsHospitalizacion = $totalRowsHospitalizacion + 1;

while ($hospitalizacion = $queryHospitalizacion->fetch_assoc()) {
    $pdf->Cell(90, 7, mb_convert_encoding($hospitalizacion['atencion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'L');
    $pdf->Cell(25, 7, $hospitalizacion['total'], 1, 0, 'R');
    $pdf->Cell(25, 7, $hospitalizacion['cubreP'], 1, 0, 'R');
    $pdf->Cell(25, 7, $hospitalizacion['cubreA'], 1, 1, 'R');
}



if ($tHospit > 0) {
    colorCelda($celeste);
    $pdf->setX(10);
    $pdf->Cell(20, 7, $subtotal2, 0, 0, 'R', 1);
    $pdf->Cell(115, 7, '', 0, 0, 'R', 1);

    $pdf->setX(125);
    $pdf->SetFont('Arial', 'B', 9);
    colorTexto($negro);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalHospitalizacion['total1'], 0, 0, 'R', 1);

    $pdf->setX(150);
    //$pdf->Cell(25, 7, ' -', 0, 0, 'R', 1);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalHospitalizacion['total2'], 0, 0, 'R', 1);

    $pdf->setX(175);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalHospitalizacion['total3'], 0, 1, 'R', 1);
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorCelda($negro);
$filasCompletar = 0;
$totalFilas = $totalRowsServicios + $totalRowsHospitalizacion;


//FIN TABLA HOSPITALIZACION


//MEDICAMENTOS INI
if ($tMedSum > 0) {
    colorTexto($negro);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'b', 9);
    $pdf->Cell(90, 7, mb_convert_encoding($descrip2, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 1, 'R');
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$totalRowsMedicamentos = $queryMedicamentos->num_rows;
$totalRowsMedicamentos = $totalRowsMedicamentos + 1;

while ($medicamento = $queryMedicamentos->fetch_assoc()) {
    $pdf->Cell(90, 7, mb_convert_encoding($medicamento['atencion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, $medicamento['quantity'], 1, 0, 'R');
    $pdf->Cell(25, 7, $medicamento['total'], 1, 0, 'R');
    $pdf->Cell(25, 7, $medicamento['cubreP'], 1, 0, 'R');
    $pdf->Cell(25, 7, $medicamento['cubreA'], 1, 1, 'R');
}



if ($tMedSum > 0) {
    colorCelda($celeste);
    $pdf->setX(10);
    $pdf->Cell(20, 7, $subtotal2, 0, 0, 'R', 1);
    $pdf->Cell(115, 7, '', 0, 0, 'R', 1);

    $pdf->setX(125);
    $pdf->SetFont('Arial', 'B', 9);
    colorTexto($negro);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMedicamentos['total1'], 0, 0, 'R', 1);

    $pdf->setX(150);
    //$pdf->Cell(25, 7, ' -', 0, 0, 'R', 1);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMedicamentos['total2'], 0, 0, 'R', 1);

    $pdf->setX(175);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMedicamentos['total3'], 0, 1, 'R', 1);
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorCelda($negro);
$filasCompletar = 0;
$totalFilas = $totalRowsServicios + $totalRowsMedicamentos;

//MEDICAMENTOS FIN



//MATERIALES INI
if ($tMater > 0) {
    colorTexto($negro);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'b', 9);
    $pdf->Cell(90, 7, mb_convert_encoding($descrip4, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 1, 'R');
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}
colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$totalRowsMateriales = $queryMateriales->num_rows;
$totalRowsMateriales = $totalRowsMateriales + 1;

while ($material = $queryMateriales->fetch_assoc()) {
    $pdf->Cell(90, 7, mb_convert_encoding($material['atencion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, $material['quantity'], 1, 0, 'R');
    $pdf->Cell(25, 7, $material['total'], 1, 0, 'R');
    $pdf->Cell(25, 7, $material['cubreP'], 1, 0, 'R');
    $pdf->Cell(25, 7, $material['cubreA'], 1, 1, 'R');
}



if ($tMater > 0) {
    colorCelda($celeste);
    $pdf->setX(10);
    $pdf->Cell(20, 7, $subtotal2, 0, 0, 'R', 1);
    $pdf->Cell(115, 7, '', 0, 0, 'R', 1);

    $pdf->setX(125);
    $pdf->SetFont('Arial', 'B', 9);
    colorTexto($negro);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMateriales['total1'], 0, 0, 'R', 1);

    $pdf->setX(150);
    //$pdf->Cell(25, 7, ' -', 0, 0, 'R', 1);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMateriales['total2'], 0, 0, 'R', 1);

    $pdf->setX(175);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalMateriales['total3'], 0, 1, 'R', 1);
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorCelda($negro);
$filasCompletar = 0;
$totalFilas = $totalRowsServicios + $totalRowsMateriales;

//MATERIALES FIN




// INI TODO ESTE BLOQUE SE OCUPA PARA LA TABLA


if ($tAteClient > 0) {
    colorTexto($negro);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'b', 9);
    $pdf->Cell(90, 7, mb_convert_encoding($descrip3, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 0, 'R');
    $pdf->Cell(25, 7, '', 1, 1, 'R');
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorTexto($negro);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

$totalRowsAtClientes = $queryAtClientes->num_rows;
$totalRowsAtClientes = $totalRowsAtClientes + 1;

while ($atCliente = $queryAtClientes->fetch_assoc()) {
    $pdf->Cell(90, 7, mb_convert_encoding($atCliente['atencion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
    $pdf->Cell(25, 7, $atCliente['quantity'], 1, 0, 'R');
    $pdf->Cell(25, 7, $atCliente['total'], 1, 0, 'R');
    $pdf->Cell(25, 7, $atCliente['cubreP'], 1, 0, 'R');
    $pdf->Cell(25, 7, $atCliente['cubreA'], 1, 1, 'R');
}



if ($tMedSum > 0) {
    colorCelda($celeste);
    $pdf->setX(10);
    $pdf->Cell(20, 7, $subtotal3, 0, 0, 'R', 1);
    $pdf->Cell(115, 7, '', 0, 0, 'R', 1);

    $pdf->setX(125);
    $pdf->SetFont('Arial', 'B', 9);
    colorTexto($negro);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalAtencionClientes['total1'], 0, 0, 'R', 1);

    $pdf->setX(150);
    //$pdf->Cell(25, 7, ' -', 0, 0, 'R', 1);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalAtencionClientes['total2'], 0, 0, 'R', 1);

    $pdf->setX(175);
    $pdf->Cell(25, 7, 'L   ' . $responseTotalAtencionClientes['total3'], 0, 1, 'R', 1);
} else {
    $filaExtraRelleno = $filaExtraRelleno + 1;
}



colorCelda($negro);
$filasCompletar = 0;
$totalFilas = $totalRowsServicios + $totalRowsMedicamentos + $totalRowsAtClientes;



// FIN TODO ESTE BLOQUE SE OCUPA PARA LA TABLA




if ($totalFilas < 18) {
    $filasCompletar = 18 - $totalFilas;
}



if (($totalFilas > 18) and ($totalFilas <= 25)) {
    $filasCompletar = 25 - $totalFilas;
}


if (($totalFilas > 26) and ($totalFilas < 30)) {
    $filasCompletar = 57 - $totalFilas;
}








$totalFilas = ($filasCompletar + $filaExtraRelleno) - $valorAjuste;

if ($totalFilas > 0) {
    for ($i = 0; $i < $totalFilas - 1; $i++) {
        $pdf->Cell(90, 7, '', 1, 0, 'L');
        $pdf->Cell(25, 7, '', 1, 0, 'L');
        $pdf->Cell(25, 7, '', 1, 0, 'L');
        $pdf->Cell(25, 7, '', 1, 0, 'L');
        $pdf->Cell(25, 7, '', 1, 1, 'R');
    }
}

colorCelda($gris);

$pdf->setX(125);
$pdf->SetFont('Arial', '', 9);
colorTexto($blanco);

$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);




colorCelda($azul);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);

$pdf->setX(125);
$pdf->SetFont('Arial', '', 9);
colorTexto($blanco);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);

$pdf->setX(150);
$pdf->Cell(25, 6, 'SUBTOTAL ASEGURADORA', 0, 0, 'R', 1);

//inicia la fila
$pdf->SetFont('Arial', 'B', 9);
colorTexto($blanco);


$pdf->setX(175);
$pdf->Cell(25, 6, $responseTotalR['totalR'], 0, 1, 'R', 1);

$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);

$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);



$pdf->setX(150);
$pdf->Cell(25, 6, 'DESCUENTO DEL ' . $tasaDesc . '%', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $p, 0, 1, 'R', 1);
//termina la fila
//inicia fila
colorTexto($blanco);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'L', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'L', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'OTROS DESCUENTOS', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $descOtros, 0, 1, 'R', 1);
//fin fila

//inicia fila
colorTexto($blanco);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'TOTAL', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $totalPagar, 0, 1, 'R', 1);
//fin fila

//FILA EN BLANCO




$pdf->SetFont('Arial', '', 9);

//FILA EN BLANCO

//inicia fila
colorTexto($blanco);
colorCelda($azul);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'COPAGO ' . $tasaCopago2 . '%', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $copagoMonto, 0, 1, 'R', 1);
//fin fila


//FILA NO ELEGIBLE:	
colorTexto($blanco);
colorCelda($azul);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'NO ELEGIBLE', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $totalCP_, 0, 1, 'R', 1);
//FILA NO ELEGIBLE:	


//DEDUCIBLE
colorTexto($blanco);
colorCelda($azul);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'DEDUCIBLE', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $deducible, 0, 1, 'R', 1);
//DEDUCIBLE


//TOTAL A PAGAR
colorTexto($blanco);
colorCelda($azul);
$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);
$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);
$pdf->setX(150);
$pdf->Cell(25, 6, 'TOTAL A PAGAR', 0, 0, 'R', 1);
$pdf->setX(175);
$pdf->Cell(25, 6,  $nuevoTotal, 0, 1, 'R', 1);
//TOTAL A PAGAR



//inicia fila

colorCelda($blanco);
colorTexto($negro);

$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);

$pdf->setX(125);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);

$pdf->setX(150);
$pdf->Cell(25, 6, '', 0, 0, 'R', 1);

$pdf->setX(175);
$pdf->Cell(25, 6, '', 0, 1, 'R', 1);
//fin fila





colorCelda($gris);
colorTexto($blanco);

$pdf->setX(10);
$pdf->Cell(115, 6, '', 0, 0, 'R', 1);

$pdf->setX(10);
$pdf->SetFont('Arial', '', 9);
colorTexto($blanco);
$pdf->Cell(190.04, 6, $email, 0, 1, 'C', 1);

$pdf->Output();
