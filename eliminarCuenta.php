<?php
require("autoCarga.php");

$numCuenta = $_GET[cuenta];

$cuenta = new Cuenta();

$where = "mumeroCuenta = '$numCuenta'";
$cuenta->deleteCuenta($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>