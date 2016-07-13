<?php
require("autoCarga.php");

$generales = new Generales();

header("Content-type: text/plain");

$idCliente = $generales->verificaVariable($_GET['idCliente']);
$diaVenta = $_GET['diaVenta'];
$mesVenta = $_GET['mesVenta'];
$yearVenta = $_GET['yearVenta'];

$fechaVenta =  mktime(0, 0, 0, $mesVenta, $diaVenta, $yearVenta);

$venta = new Venta();

$where = "j.idCliente = $idCliente AND fechaVenta = $fechaVenta GROUP BY idTipoPollo";

$rs = $venta->getConsVentasSubCliente($where);

if ($rs->num_rows) {
	$response = "[";
	while ($row = $rs->fetch_assoc()) {
		$tipoPollo = $row['idTipoPollo'];
		$cantidad = $row['cantidad'];
		$pesoPesada = round($row['pesoPesada'], 2);
		$pesoJava = round($row['pesoJava'], 2);
		$pesoNeto = round($row['pesoNeto'], 2);
		$promedio = round($pesoNeto/$cantidad, 2);
		
		$response .= "{\"idTipoPollo\" : \"$tipoPollo\", \"cantidad\" : \"$cantidad\", \"pesoPesada\" : \"$pesoPesada\", ";
		$response .= "\"pesoJava\" : \"$pesoJava\", \"pesoNeto\" : \"$pesoNeto\", \"promedio\" : \"$promedio\"}, ";
	}
	$response .= "]";
	
	echo utf8_encode($response);
}
?>