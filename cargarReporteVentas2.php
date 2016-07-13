<?php
require("autoCarga.php");

header("Content-type: text/plain");

$idCliente = $_GET['idCliente'];
$diaF = $_GET['diaBuscarF'];
$mesF = $_GET['mesBuscarF'];
$yearF = $_GET['yearBuscarF'];

$diaT = $_GET['diaBuscarT'];
$mesT = $_GET['mesBuscarT'];
$yearT = $_GET['yearBuscarT'];

$fechaF = mktime(0, 0, 0, $mesF, $diaF, $yearF);
$fechaT = mktime(0, 0, 0, $mesT, $diaT, $yearT);

$docVenta = new DocVenta();
$detDocVenta = new DetalleDocVenta();
$pagoVenta = new PagoVenta();

$whereDV = "idCliente = $idCliente AND fechaDocVenta >= $fechaF AND fechaDocVenta < $fechaT";
$rsDV = $docVenta->getDocVenta($whereDV);

if ($rsDV->num_rows) {

	$response = "[";
	
	while ($rowDV = $rsDV->fetch_assoc()) {
		$idDocVenta = $rowDV['idDocVenta'];
		$totalDocVenta = $rowDV['total'];
		$fechaDocVenta = $rowDV['fechaDocVenta'];
		$fechaDiaSig = $fechaDocVenta + 24*60*60;
		
		
		$whereDDV = "idDocVenta = '$idDocVenta'";
		$rsDDV = $detDocVenta->getTotales($whereDDV);
		if ($rsDDV->num_rows) {
			$rowDDV = $rsDDV->fetch_assoc();
			$cantTot = $rowDDV['cantidad'];
			$pesoTot = round($rowDDV['peso'], 2);
		}
		
		//Extraemos la venta acumulada hasta el dia de Ayer
		$whereDVA = "idCliente = $idCliente AND fechaDocVenta < $fechaDocVenta";
		$rsDVA = $docVenta->getVentaAcumulada($whereDVA);
		if ($rsDVA->num_rows) {
			$rowDVA = $rsDVA->fetch_assoc();
			$ventaAcAnt = $rowDVA['ventaAcumulada']; //$ventaAcAnt: venta acumulada anterior
		}
		
		//Extraemos el pago acumulado hasta el dias de Ayer
		$wherePagoA = "idCliente = $idCliente AND pv.fecha < $fechaDocVenta";
		$rsPagoA = $pagoVenta->getMontosTotales2($wherePagoA);
		if ($rsPagoA->num_rows) {
			$rowPagoA = $rsPagoA->fetch_assoc();
			$pagoAnt = $rowPagoA['montoAcumulado'];//Pago anterior acumulado hasta Ayer
		}
		
		//Extraemos ahora el pago que realizo el cliente el dia de hoy
		$wherePA = "idCliente = $idCliente AND
				   (pv.fecha > $fechaDocVenta AND pv.fecha < $fechaDiaSig)";//Where pago actual
		$rsPA = $pagoVenta->getMontosTotales2($wherePA);
		if ($rsPA->num_rows) {
			$rowPA = $rsPA->fetch_assoc();
			$pagoActual = $rowPA['montoAcumulado'] ? $rowPA['montoAcumulado'] : 0;//Pago dia de hoy
			$pagoActual = $pagoActual;
		}
		
		$fechaDV = date("d - m - Y", $fechaDocVenta);
		$saldoAnterior = round($ventaAcAnt - $pagoAnt, 2);
		$total = round($totalDocVenta + $saldoAnterior, 2);
		$saldoActual = round($total - $pagoActual, 2);
		$totalDV = round($totalDocVenta, 2);
		$pagoActual = round($pagoActual, 2);
		
		$objeto = "{\"fecha\" : \"$fechaDV\", \"cantidad\" : \"$cantTot\", ";
		$objeto .= "\"peso\" : \"$pesoTot\", \"totalDV\": \"$totalDV\", \"saldoAnt\" : \"$saldoAnterior\", ";
		$objeto .= "\"total\" : \"$total\", \"pagoActual\" : \"$pagoActual\", \"saldoAct\" : \"$saldoActual\"}";
		
		$response .= $objeto. ", ";
		
	}
	$response = substr($response, 0, strlen($response) - 2);
	$response .= "]";
	
	echo $response;
}

?>