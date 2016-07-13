<?php
require("autoCarga.php");

$generales = new Generales();
$empleado = new Empleado();

$idEmpleado = $generales->verificaVariable($_GET['idEmpleado']);

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$sueldo = $_POST['sueldo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$movil = $_POST['celular'];
$rpm = $_POST['rpm'];


if ($idEmpleado) {
	$where = "idEmpleado = $idEmpleado";
	$empleado->updateEmpleado($nombres, $apellidos, $dni, $sueldo, $direccion, $telefono, $movil, $rpm, $where);
}
else {
	$empleado->insertEmpleado($nombres, $apellidos, $dni, $sueldo, $direccion, $telefono, $movil, $rpm);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>