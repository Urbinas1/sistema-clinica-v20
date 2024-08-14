<?php 

$sql ="WITH atencionEmergencia AS (
    SELECT SUM(f.precioP * f.quantity) - ifnull(SUM(f.cp),0) AS t,
    ifnull(SUM(f.cp),0) as cpt
    FROM facturasdetalles as f WHERE f.description IN ($idFact) and f.status = 1
),
hospitalizacion AS (
    SELECT SUM(f.precioP * f.quantity) - ifnull(SUM(f.cp),0) AS t,
    ifnull(SUM(f.cp),0) as cpt
    FROM facturasdetalles as f WHERE f.description IN ($idFact) and f.status = 5
),
medicinas AS (
    select ifnull(sum(
    (select c.price * f.quantity from medicinas as c where c.id = f.price)   ) ,0) - ifnull(SUM(f.cp),0) AS t,
    ifnull(SUM(f.cp),0) as cpt
    FROM facturasdetalles as f WHERE f.description = $idFact and f.status = 0
),
atencionCliente AS (
    select ifnull(sum(
    (select c.price * f.quantity from atCliente as c where c.id = f.price)   ) ,0) - ifnull(SUM(f.cp),0) AS t,
    ifnull(SUM(f.cp),0) as cpt
    FROM facturasdetalles as f WHERE f.description = $idFact and f.status = 3
),
materiales AS (
    select ifnull(sum(
    (select c.price * f.quantity from materiales as c where c.id = f.price)   ),0)  - ifnull(SUM(f.cp),0) AS t,
    ifnull(SUM(f.cp),0) as cpt
    FROM facturasdetalles as f WHERE f.description = $idFact and f.status = 4
),
factura as (
    select * from facturas as f where f.id = $idFact
)
SELECT 
    tc1.t , tc1.cpt ,
    tc2.t , tc2.cpt ,
    tc3.t , tc3.cpt ,
    tc4.t , tc4.cpt ,
    tc5.t , tc5.cpt ,

    tc1.t + tc2.t + tc3.t + tc4.t + tc5.t as subtotal,
concat(format(f.tasaDesc,2),'%') as tasaDesc, 
format((f.tasaDesc/100) * (tc1.t + tc2.t + tc3.t + tc4.t + tc5.t),2) as descuento,
 f.descOtros, 
format ( (tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) - ( (f.tasaDesc/100) * (tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) ) - (f.descOtros),2) as total,
 f.copago2 as tasaCopago,

format(
((((tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) - ( (f.tasaDesc/100) * (tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) ) - (f.descOtros))-(tc1.cpt + tc2.cpt + tc3.cpt + tc4.cpt + tc5.cpt)) * (copago2/100) ) 
,2) as copago,

  format(tc1.cpt + tc2.cpt + tc3.cpt + tc4.cpt + tc5.cpt,2) as noelegible,
  format(f.deducible,2) as deducible,

format( ( 

    (((((tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) - ( (f.tasaDesc/100) * (tc1.t + tc2.t + tc3.t + tc4.t + tc5.t) ) - (f.descOtros))-(tc1.cpt + tc2.cpt + tc3.cpt + tc4.cpt + tc5.cpt)) * (copago2/100) ) )+
    (tc1.cpt + tc2.cpt + tc3.cpt + tc4.cpt + tc5.cpt)+
    (f.deducible)  
    
    ) ,2)as totalapagar,


CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"goToNewUrlWithId(',fa.id,')\"><i class=\"fa fa-edit \">
</i> EDITAR  </button>')  as options
    
FROM facturas fa



FROM atencionEmergencia tc1,
    hospitalizacion tc2,
    medicinas tc3,
    atencionCliente tc4,
    materiales tc5,
    factura fa
    INNER JOIN usuarios as u ON u.id = fa.clienteId
WHERE date(fa.created) BETWEEN '$ini' AND '$fin' and fa.status = 0;";