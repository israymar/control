<?php
require("autoCarga.php");
$generales = new Generales();

$idProveedor = $generales->verificaVariable($_GET['prov']);

$ruc = $_POST['ruc'];
$razonSocial = $_POST['razonSocial'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fax = $_POST['fax'];

$proveedor = new Proveedor;

if (!$idProveedor) {
	$proveedor->insertProveedor($ruc, $razonSocial, $direccion, $ciudad, $telefono, $fax);
}
else {
	$where = "idProveedor = $idProveedor";
	$proveedor->editarProveedor($ruc, $razonSocial, $direccion, $ciudad, $telefono, $fax, $where);
}

header("Location:". $_SERVER['HTTP_REFERER']);

?>
