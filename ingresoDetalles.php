<?php
require("autoCarga.php");

$nombreTipoCuenta = $_POST['nombreTipoCuenta'];

$idTipoCuenta = $_GET['tipocuenta'];

$tipocuenta = new Detalles();

if ($idTipoCuenta) {
	$where = "idTipoCuenta = $idTipoCuenta";
	$tipocuenta->editTipoCuenta($nombreTipoCuenta, $where);
}
else {
	$tipocuenta->insertTipoCuenta($nombreTipoCuenta);	
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>