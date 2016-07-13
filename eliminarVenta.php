<?php
require("autoCarga.php");

$generales= new Generales();

$idVenta = $generales->verificaVariable($_GET['venta']);

$venta = new Venta();
$detVenta = new DetalleVenta();

$where = "idVenta = $idVenta";
$rs = $detVenta->deleteDetalleVenta($where);

if ($rs) {
	$venta->deleteVenta($where);
}

header("Location: ".$_SERVER['HTTP_REFERER']);

?>