<?php
require("autoCarga.php");

$idPagoCompra = $_GET['pagoCompra'];

if (strlen($idPagoCompra) > 0) {
	$pagoCompra = new ReciboCompra();
	
	$where = "idReciboCompra = '$idPagoCompra'";
	$pagoCompra->deleteReciboCompra($where);	
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>