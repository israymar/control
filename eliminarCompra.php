<?php
require("autoCarga.php");

$generales= new Generales();

$idCompra = $_GET['compra'];

$compra = new Compra();
$detCompra = new DetalleCompra();

$where = "idCompra = '$idCompra'";
$rs = $detCompra->deleteDetalleCompra($where);
$rs = $compra->deleteCompra($where);
//if ($rs) {
	//$compra->deleteCompra($where);
//}

header("Location: ".$_SERVER['HTTP_REFERER']);

?>