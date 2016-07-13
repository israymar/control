<?php
require("autoCarga.php");


$numeroCuenta = $_POST['numeroCuenta'];
$proveedor = $_POST['proveedor'];
$banco = $_POST['banco'];
$moneda = $_POST['moneda'];
$estadoCuenta = $_POST['estadoCuenta'];

$numeroCuentaEdit = $_GET['cuenta'];

$cuenta = new Cuenta;


if (!(strlen($numeroCuentaEdit) > 0)) {
	$cuenta->insertCuenta($numeroCuenta, $banco, $moneda, $estadoCuenta, $proveedor);
}
else {
	$where = "mumeroCuenta = '$numeroCuentaEdit'";
	$cuenta->editCuenta($numeroCuenta, $banco, $moneda, $estadoCuenta, $proveedor, $where);
}

header("Location:". $_SERVER['HTTP_REFERER']);
?>
