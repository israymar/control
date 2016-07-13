<?php
require("autoCarga.php");

//$firephp = FirePHP::getInstance(true);

$q = $_GET['q'];
$tipo = $_GET['tipo'];

switch($tipo) {
	case "compra"		:	$compra = new Compra();
							$where = "idCompra = '$q'";
							$rs = $compra->getCompra($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							
							$detalleCompra = new DetalleCompra();
							$rsD = $detalleCompra->getDetalleCompra($where);
							break;
								
	case "venta"		:	$venta = new Venta();
							$where = "idVenta = $q";
							$rs = $venta->getVenta($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							
							$detalleVenta = new DetalleVenta();
							$rsD = $detalleVenta->getDetalleVenta($where);
							break;
						
}

$response = "{";

foreach($row as $key => $value) {
	$response .= "\"$key\" : \"$value\", ";
}

//Generamos el detalle para cada clase
$detalle = "";
while ($rowD = $rsD->fetch_assoc()) {
	
	$detalle .= "{";
	
	foreach ($rowD as $keyD => $valueD) {
		$detalle .= "\"$keyD\" : \"$valueD\", ";
	}
	
	$detalle = substr($detalle, 0, strlen($detalle) - 2);
	$detalle .= "}, ";
}
$detalle = substr($detalle, 0, strlen($detalle) - 2);

$response .= "\"detalle\" : [$detalle]";

$response .= "}";

echo utf8_encode($response);
?>