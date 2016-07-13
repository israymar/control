<?php
require("autoCarga.php");

$contacto = new Contacto();
$generales = new Generales();

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$rpm = $_POST['rpm'];
$email = $_POST['email'];
$proveedor = $_POST['proveedor'];

$idContacto = $generales->verificaVariable($_GET['contacto']);

if (!$idContacto) {
	$contacto->insertContacto($nombres, $apellidos, $dni, $direccion, $telefono, $celular, $rpm, $email, $proveedor);
}
elseif ($idContacto > 0) {
	$where = "idContacto = $idContacto";
	$contacto->editContacto($nombres, $apellidos, $dni, $direccion, $telefono, $celular, $rpm, $email, $proveedor, $where);
}

header("Location:". $_SERVER['HTTP_REFERER']);
?>