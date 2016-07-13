<?php
require("autoCarga.php");

$generales = new Generales();
$pagoEmpleado = new PagoEmpleado();

$idPagoEmpleado = $generales->verificaVariable($_GET['idPagoEmpleado']);

$idEmpleado = $_POST['empleado'];
$mes = $_POST['mes'];
$year = $_POST['year'];
$monto = $_POST['monto'];
$observacion = $_POST['observacion'];
$fechaPago = time();

$periodoLaboral = $mes ." - ".$year;

if ($idPagoEmpleado) {
	$where = "idPagoEmpleado = $idPagoEmpleado";
	$pagoEmpleado->updatePagoEmpleado ($periodoLaboral, $fechaPago, $monto, $observacion, $idEmpleado, $where);	
}
else {
	$pagoEmpleado->insertPagoEmpleado ($periodoLaboral, $fechaPago, $monto, $observacion, $idEmpleado);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>