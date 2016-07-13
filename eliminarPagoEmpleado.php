<?php
require("autoCarga.php");

$generales = new Generales();
$pagoEmpleado = new PagoEmpleado();

$idPagoEmpleado = $_GET['idPago'];

$where = "idPagoEmpleado = $idPagoEmpleado";

$pagoEmpleado->deletePagoEmpleado($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>