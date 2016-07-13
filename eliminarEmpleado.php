<?php
require("autoCarga.php");

$generales = new Generales();
$empleado = new Empleado();

$idEmpleado = $generales->verificaVariable($_GET['idEmpleado']);

$where = "idEmpleado = $idEmpleado";
$empleado->deleteEmpleado($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>