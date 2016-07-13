<?php
require("autoCarga.php");

$generales = new Generales();

$idTipoCuenta = $generales->verificaVariable($_GET['tipocuenta']);

$tipocuenta = new Detalles();

$where = "idTipoCuenta = $idTipoCuenta";

$tipocuenta->deleteTipoCuenta($where);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>