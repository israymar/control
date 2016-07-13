<?php
require("autoCarga.php");

$generales = new Generales();
$venta = new Venta();

$idCliente = $generales->verificaVariable($_GET['idCliente']);
$mes = $_GET['mesBuscar'];
$dia = $_GET['diaBuscar'];
$year = $_GET['yearBuscar'];

header("Content-type: text/plain");

$fechaBuscar = mktime(0, 0, 0, $mes, $dia, $year);

$where = "jefeCliente = $idCliente AND fechaVenta = $fechaBuscar";
$rs = $venta->getVentasSubCliente($where);

if ($rs->num_rows) {
	$response = "[";
	while ($row = $rs->fetch_assoc()) {
		$idVenta = $row['idVenta'];
		$nombresCliente = $generales->configuraNombres($row['apellidosCliente'], $row['nombreCliente']);
		$tipoPollo = $row['nombreTipoPollo'];
		$cantidad = $row['cantidad'];
		$peso = round($row['peso'], 2);
		$cam = $row['nombreCamal'];
		
		$response .= "{\"idVenta\" : \"$idVenta\", \"nombresCliente\" : \"$nombresCliente\", \"cam\" : \"$cam\", ";
		$response .= "\"tipoPollo\" : \"$tipoPollo\", \"cantidad\" : \"$cantidad\", \"peso\" : \"$peso\"}, ";
	}
	$response .= "]";
	
	echo utf8_encode($response);
}
?>