<?php
require("autoCarga.php");
$generales = new Generales();

$nombreTipoCuenta = $_POST['nombreTipoCuenta'];

$idTipoCuenta = $generales->verificaVariable($_GET['tipoCuenta']);

$tipoCuenta = new TipoCuenta();

if ($idTipoCuenta) {
	$where = "idTipoCuenta = $idTipoCuenta";
	$tipoCuenta->updateTipoCuenta($nombreTipoCuenta,$where);
}
else {
	$tipoCuenta->insertTipoCuenta($nombreTipoCuenta);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>