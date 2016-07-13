<?php
require("autoCarga.php");

header("Content-type: text/plain");

$idProveedor = $_GET['idProveedor'];
$diaBuscarF = $_GET['diaF'];
$mesBuscarF = $_GET['mesF'];
$yearBuscarF = $_GET['yearF'];

$diaBuscarT = $_GET['diaT'];
$mesBuscarT = $_GET['mesT'];
$yearBuscarT = $_GET['yearT'];

$fechaBF = mktime(0,0,0, $mesBuscarF, $diaBuscarF, $yearBuscarF);
$fechaBT = mktime(0,0,0, $mesBuscarT, $diaBuscarT, $yearBuscarT);

$reciboCompra = new ReciboCompra();
$compra = new Compra();

$whereC = "idProveedor = $idProveedor AND (fechaCompra >= $fechaBF AND fechaCompra < $fechaBT) ORDER BY fechaCompra";
$rsC = $compra->getCompra($whereC);
if ($rsC->num_rows) {

	$response = "[";
	
	while ($rowC = $rsC->fetch_assoc()) {
		
		$idCompra = $rowC['idCompra'];
		$fechaCompra = $rowC['fechaCompra'];
		$subTotal = $rowC['subTotal'];
		$valorIgv = $rowC['valorIgv'];
		$totalCompra = $subTotal + $valorIgv;
		
		//Extraemos lo que se ha depositado hasta ayer		
		$whereRCA = "idProveedor = $idProveedor AND fechaReciboCompra < $fechaCompra";
		$rsRCA = $reciboCompra->getTotalDepositado($whereRCA);
		
		if ($rsRCA->num_rows) {
			$rowRCA = $rsRCA->fetch_assoc();
			$montoDepA = $rowRCA['montoDepositado']; //Monto dep Acumulado hasta ayer
		}
		
		//Extraemos el monto acumulado de las compras hasta ayer
		$whereCA = "idProveedor = $idProveedor AND fechaCompra < $fechaCompra";
		$rsCA = $compra->getTotalAcumulado($whereCA);
		if ($rsCA->num_rows) {
			$rowCA = $rsCA->fetch_assoc();
			$compraA = $rowCA['totalAcumulado']; //Total de compras acumuladas hasta ayer
		}
				
		//Extraemos lo que hemos depositado el dia de hoy
		$whereRC = "idProveedor = $idProveedor AND fechaReciboCompra = $fechaCompra";
		$rsRC = $reciboCompra->getTotalDepositado($whereRC);
		
		if ($rsRC->num_rows) {
			$rowRC = $rsRC->fetch_assoc();
			$montoDep = round($rowRC['montoDepositado'], 2);
		}
		
		$saldoAnterior = $montoDepA - $compraA;
		$fechaCompra = date("d - m - Y", $fechaCompra);
		$saldoActual = round($saldoAnterior + $montoDep - $totalCompra, 2) ;
		
		$saldoAnterior = round($saldoAnterior, 2);
		
		$objeto = "{\"fecha\" : \"$fechaCompra\", \"saldoAnt\" : \"$saldoAnterior\", \"mDepositado\" : \"$montoDep\", ";
		$objeto .= "\"mCompra\" : \"$totalCompra\", \"saldoActual\": \"$saldoActual\"}";
		
		$response .= $objeto. ", ";
		
	}
	$response = substr($response, 0, strlen($response) - 2);
	$response .= "]";
	
	echo utf8_encode($response);
}
?>