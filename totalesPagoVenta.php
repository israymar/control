<?php

require("autoCarga.php");

header("Content-type: text/plain");

$idDocVenta = $_GET['idDocVenta'];

$pagoVenta = new PagoVenta();
$docVenta = new DocVenta();

$whereDV = "idDocVenta = '$idDocVenta'";
$rsDV = $docVenta->getDocVenta($whereDV);

if ($rsDV->num_rows) {
	$rowDV = $rsDV->fetch_assoc();
	$totalDV = round($rowDV['total'], 2);
}

$rsPV = $pagoVenta->getMontosTotales($whereDV);
if ($rsPV->num_rows) {
	$rowPV = $rsPV->fetch_assoc();
	$montoAcumulado = round($rowPV['montoAcumulado'], 2);
}

$oResponse = "{\"totalVenta\" : \"$totalDV\", \"montoAcumulado\" : \"$montoAcumulado\"}";
echo $oResponse;
?>