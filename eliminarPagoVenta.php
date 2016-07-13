<?php
require("autoCarga.php");

$generales = new Generales();

$idPagoVenta = $generales->verificaVariable($_GET['pagoVenta']);

$pagoVenta = new PagoVenta();

$where = "idPagoVenta = $idPagoVenta";
$pagoVenta->deletePagoVenta($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>