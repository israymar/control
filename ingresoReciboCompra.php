<?php
require("autoCarga.php");

$idReciboCompra = $_POST['idReciboCompra'];
$idProveedor = $_POST['idProveedor'];
$montoReciboCompra = $_POST['montoReciboCompra'];

$diaRecibo = $_POST['diaVenta'];
$mesRecibo = $_POST['mesVenta'];
$yearRecibo = $_POST['yearVenta'];

$idReciboCompra2 = $_GET['reciboCompra'];


if (!checkdate($mesRecibo, $diaRecibo, $yearRecibo)){
	header("Location: ".$_SERVER['HTTP_REFERER']);
}

$fechaRecibo = mktime(0, 0, 0, $mesRecibo, $diaRecibo, $yearRecibo);

$reciboCompra = new ReciboCompra();

if (!strlen($idReciboCompra2)) {
	$reciboCompra->insertReciboCompra($idReciboCompra, $fechaRecibo, $montoReciboCompra, $idProveedor);
}
else {
	$where = "idReciboCompra = '$idReciboCompra2'";
	$reciboCompra->editReciboCompra($idReciboCompra, $fechaRecibo, $montoReciboCompra, $idProveedor, $where);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>