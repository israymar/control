<?php
require("autoCarga.php");

@$diaBuscar = $_GET['diaBuscar'];
@$mesBuscar = $_GET['mesBuscar'];
@$yearBuscar = $_GET['yearBuscar'];

@$diaF = $_GET['diaF'];
@$mesF = $_GET['mesF'];
@$yearF = $_GET['yearF'];

@$diaT = $_GET['diaT'];
@$mesT = $_GET['mesT'];
@$yearT = $_GET['yearT'];

//header("Content-type: text/plain");
if ($diaBuscar && $mesBuscar && $yearBuscar) {
	$detalleVenta = new DetalleVenta();
	$detalleCompra = new DetalleCompra();
	$detalleDeposito = new DetalleDeposito();
	
	$fechaBuscar = mktime(0, 0, 0, $mesBuscar, $diaBuscar, $yearBuscar);
	$where = "fechaVenta = $fechaBuscar";
	$rs = $detalleVenta->getDetalleVentaResumen2($where);
	
	if ($rs->num_rows) {
	
	$response = "[";
		while ($row = $rs->fetch_assoc()) {
			$idTipoPollo = $row['idTipoPollo'];
			$idProveedor = $row['proveedor'];
			$razonSocial = $row['razonSocial'];
			$nombrePollo = $row['nombreTipoPollo'];
			$cantidadVenta = $row['cantidadVenta'];
			$pesoVenta = $row['pesoVenta'];
			
			$whereDC = "fechaCompra = $fechaBuscar AND idProveedor = $idProveedor AND idTipoPollo = $idTipoPollo";
			
			$rsDC = $detalleCompra->getResumenDetalleCompra($whereDC);
			if ($rsDC->num_rows) {
				$rowDC = $rsDC->fetch_assoc();
				$cantidadCompra = $rowDC['cantidadCompra'];
				$pesoCompra = $rowDC['pesoCompra'];
			}
			
			$whereDD = "fecha = $fechaBuscar AND idProveedor = $idProveedor AND idTipoPollo = $idTipoPollo AND tipo = 'i'";
			$rsDD = $detalleDeposito->getResumenDetDeposito($whereDD);
			$cantidadDeposito = 0;
			$pesoDeposito = 0;
			if ($rsDD->num_rows) {
				$rowDD = $rsDD->fetch_assoc();
				$cantidadDeposito = $rowDD['cantidad'];
				$pesoDeposito = $rowDD['peso'];
			}
			
			$cantidadMerma = $cantidadCompra - ($cantidadVenta + $cantidadDeposito);
			$pesoMerma = $pesoCompra - ($pesoVenta + $pesoDeposito);
			
			$response .= "{\"proveedor\" : \"$razonSocial\", \"tipoPollo\" : \"$nombrePollo\",";
			$response .=  "\"cantidadCompra\" : \"$cantidadCompra\", \"pesoCompra\" : \"$pesoCompra\",";
			$response .=  "\"cantidadVenta\" : \"$cantidadVenta\", \"pesoVenta\" : \"$pesoVenta\",";
			$response .=  "\"cantidadDeposito\" : \"$cantidadDeposito\", \"pesoDeposito\" : \"$pesoDeposito\",";
			$response .=  "\"cantidadMerma\" : \"$cantidadMerma\", \"pesoMerma\" : \"$pesoMerma\"}, ";
		}
		$response .= "]";
		
		echo utf8_encode($response);
	}	
}
else {
	
	
}

?>