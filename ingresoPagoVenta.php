<?php
require("autoCarga.php");

$docVenta = $_POST['docVenta'];
$monto = $_POST['monto'];
$numCuenta = $_POST['numCuenta'];
$fechaVenta = time();


$pagoVenta = new PagoVenta();

$rsPV = $pagoVenta->insertPagoVenta($docVenta, $fechaVenta, $monto, $numCuenta);

if ($rsPV > 0) {
	//Moficamos el estado de la tabla documentoVenta
	$documentoVenta = new DocVenta();
	$where = "idDocVenta = '$docVenta'";
	$rsDV = $documentoVenta->getDocVenta($where);
	if ($rsDV->num_rows) {
		$rowDV = $rsDV->fetch_assoc();
		$totalDV = $rowDV['total'];
		$minTot = $totalDV * 0.98;
		$maxTot = $totalDV * 1.02;
		
		//Extraemos el monto acululado (Para los pagos que se hancen en varias cuotas)
		$rsMT = $pagoVenta->getMontosTotales($where);
		
		if ($rsMT->num_rows > 0) {
			$rowMT = $rsMT->fetch_assoc();
			$montoA = $rowMT['montoAcumulado'];
		}
		
		if ($montoA > $maxTot) {
			$set = "observacionDocVenta = 'Se depositó más que el monto Total de esta Venta (Pagado: $montoA; Total Doc. Venta: $totalDV)'";
		}
		elseif ($montoA >= $minTot) {
			$set = "estadoDocVenta = '2'";
		}
		elseif($monto > 0 && $monto < $minTot) {
			$set = "estadoDocVenta = '1'";
		}
		$documentoVenta->setEstadoDocVenta($set, $where);
	}
}

header("Location: ".$_SERVER['HTTP_REFERER']);
?>