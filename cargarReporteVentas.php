<?php
require("autoCarga.php");

header("Content-type: text/plain");

@$diaBuscar = $_GET['diaBuscar'];
@$mesBuscar = $_GET['mesBuscar'];
@$yearBuscar = $_GET['yearBuscar'];

$fechaBuscar =  mktime(0, 0, 0, $mesBuscar, $diaBuscar, $yearBuscar);
$fechaBuscarDiaSig = mktime(0, 0, 0, $mesBuscar, $diaBuscar + 1, $yearBuscar);


$pagoVenta = new PagoVenta();
$generales = new Generales();
$cliente = new Cliente();
$detalleDocVenta = new DetalleDocVenta();
$docVenta = new DocVenta();

//Extraemos la primera parte de la consulta (Usuarios sin jefe)
$where = "fechaDocVenta = $fechaBuscar AND jefeCliente IS NULL ORDER BY apellidosCliente";

$rsDV = $docVenta->getDocVentaReporte($where);

if ($rsDV->num_rows) {
	$response = "[";
	while ($rowDV = $rsDV->fetch_assoc()) {
		$idDocVenta = $rowDV['idDocVenta'];
		$idCliente = $rowDV['idCliente'];
		$totalDV = round($rowDV['total'], 2);
		$nomCliente = $rowDV['nombreCliente'];
		$appCliente = $rowDV['apellidosCliente'];
		
		$nombresCliente = $generales->configuraNombres($appCliente, $nomCliente);
		
		$whereDDV = "idDocVenta = '$idDocVenta'";
		$rsDDV = $detalleDocVenta->getTotales($whereDDV);
		
		if ($rsDDV->num_rows) {
			$rowDDV = $rsDDV->fetch_assoc();
			$cantItem = $rowDDV['cantidad'];
			$pesoItem = round($rowDDV['peso'], 2);
		}
		
		$wherePA = "idCliente = $idCliente AND
				   (pv.fecha > $fechaBuscar AND pv.fecha < $fechaBuscarDiaSig)";//Where pago actual
		$rsPA = $pagoVenta->getMontosTotales2($wherePA);
		if ($rsPA->num_rows) {
			$rowPA = $rsPA->fetch_assoc();
			$pagoActual = $rowPA['montoAcumulado'] ? $rowPA['montoAcumulado'] : 0;//Pago dia de hoy
			$pagoActual = round($pagoActual, 2);
		}
		
		
		$whereSaldoA = "idCliente = $idCliente AND pv.fecha < $fechaBuscar";
		$rsSaldoA = $pagoVenta->getMontosTotales2($whereSaldoA);
		if ($rsSaldoA->num_rows) {
			$rowSaldoA = $rsSaldoA->fetch_assoc();
			$saldoAnt = $rowSaldoA['montoAcumulado'];//Saldo anterior acumulado hasta hoy
		}
		
		$whereDVA = "idCliente = $idCliente AND fechaDocVenta < $fechaBuscar";
		$rsDVA = $docVenta->getVentaAcumulada($whereDVA);
		if ($rsDVA->num_rows) {
			$rowDVA = $rsDVA->fetch_assoc();
			$ventaAcAnt = $rowDVA['ventaAcumulada']; //$ventaAcAnt: venta acumulada anterior
		}
		
		$saldoAnterior = round($ventaAcAnt - $saldoAnt, 2);
		$total = round($totalDV + $saldoAnterior, 2);
		$saldoActual = round($total - $pagoActual, 2);
				
		
		$objeto = "{\"cliente\" : \"$nombresCliente\", \"cantidad\" : \"$cantItem\", ";
		$objeto .= "\"peso\" : \"$pesoItem\", \"totalDV\": \"$totalDV\", \"saldoAnt\" : \"$saldoAnterior\", ";
		$objeto .= "\"total\" : \"$total\", \"pagoActual\" : \"$pagoActual\", \"saldoAct\" : \"$saldoActual\"}";
		
		$response .= $objeto. ", ";
	}
	$response .= "]";
	echo utf8_encode($response);
}
?>