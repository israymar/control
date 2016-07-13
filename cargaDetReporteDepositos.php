<?php
require("autoCarga.php");

@$idDeposito = $_GET['idDeposito'];
@$tipo = $_GET['t'];


switch ($tipo) {
	case "detalleDeposito"	 	:	$detDeposito = new DetalleDeposito();
									$where = "idDeposito = $idDeposito";
									$rs = $detDeposito->getDetalleDeposito2($where);
									break;
	case "detCompraVenta"	: 	$reciboCompra = new ReciboCompra();
									$diaBuscar = $_GET['diaBuscar'];
									$mesBuscar = $_GET['mesBuscar'];
									$yearBuscar = $_GET['yearBuscar'];
									$idProveedor = $_GET['idProveedor'];
									if ($diaBuscar && $mesBuscar && $yearBuscar) {
										$fechaBuscar = mktime(0, 0, 0, $mesBuscar, $diaBuscar, $yearBuscar);
									}
									$where = "fechaReciboCompra = $fechaBuscar AND idProveedor = $idProveedor";
									$rs = $reciboCompra->getReciboCompra($where);
									break;
}

if ($rs->num_rows) {
	$response = "[";
	while ($row = $rs->fetch_assoc()) {
		$response .= "{";
		foreach ($row as $key => $valor) {
			$response .= "\"$key\" : \"$valor\", ";
		}
		$response .= "}, ";
	}
	$response .= "]";
	echo utf8_encode($response);
}
?>