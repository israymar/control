<?php
require("autoCarga.php");

$idVenta = $_GET['venta'];

$cliente = $_POST['cliente'];
$lugar = $_POST['lugar'];
$diaVenta = $_POST['diaVenta'];
$mesVenta = $_POST['mesVenta'];
$yearVenta = $_POST['yearVenta'];
$notas = $_POST['notas'];
@$tipoDocVenta = $_POST['tipoDocVenta'];
$docVenta = $_POST['idDocVenta'];
if (!checkdate($mesVenta, $diaVenta, $yearVenta)) {
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
$fechaVenta =  mktime(0, 0, 0, $mesVenta, $diaVenta, $yearVenta);


$array[0] = $_POST['tipoCuenta'];
$array[1] = $_POST['detaDet'];
$array[2] = $_POST['cantidadDet'];
$array[3] = $_POST['precioDet'];


//Buscamos por filas con valores nulos
$indicesVacios = array();
for ($i = 0; $i < count($array[2]); $i++) {
	if (!$array[2][$i] || strlen(trim($array[1][$i])) == 0) {
		$indicesVacios[] = $i;
	}
}

//Convertir a array detalleProducto
$detalleProducto = array();

for($i = 0; $i < count($array[2]); $i++) {
	for ($j = 0; $j < count($array); $j++) {
		$detalleProducto[$i][$j] = $array[$j][$i];
	}
}

//Sacamos el igv Actual
$where = "estadoIgv = 1";
$igv = new Igv();
$rs = $igv->getIgv($where);
$row = $rs->fetch_assoc();
$idIgv = $row['idIgv'];
$valorIgv = $row['valor'];

//echo count($detalleProducto)."<br />";
//Eliminamos las filas que tienen valores vacios
foreach ($indicesVacios as $indice) {
	unset($detalleProducto[$indice]);
}

//Procedemos a ingresar la venta
$venta = new Venta();
$detalleVenta = new DetalleVenta();

if (isset($idVenta) && strlen(trim($idVenta)) > 0) {
	//Estamos frente a una actualizaci&#65533;n
	$where = "idVenta = $idVenta";
	$venta->updateVenta($docVenta, $tipoDocVenta, $fechaVenta, $cliente, $lugar, $notas, $idIgv, $where);
	
	//Actualizamos ahora el detalle de la venta
	$item = 1;
	//echo count($detalleProducto)."<br />";
	foreach ($detalleProducto as $filaDetalle) {
		$idTipoCuenta = $filaDetalle[0];
		$detalle = $filaDetalle[1];
		$cantidad = $filaDetalle[2];
		$precio = $filaDetalle[3];
		$subTotal = $cantidad * $precio;
	
		
		$whereDV = "idVenta = $idVenta AND item = $item";
		$rsDV = $detalleVenta->getDetalleVenta($whereDV);
		
		if ($rsDV->num_rows) {
			$detalleVenta->updateDetalleVenta($detalle,$cantidad, $precio,
										  $idTipoCuenta, $subTotal,  $whereDV);
		}
		else {
			$detalleVenta->insertDetalleVenta($idVenta, $item, $detalle, $cantidad, $precio,
											  $idTipoCuenta, $subTotal);
		}
		$item++;
		$Total += $subTotal;

	}
		$IGV = 1.18;
		$sTotal = round($Total/$IGV,2);
		$igvAcumulado = round($sTotal * $valorIgv,2);
			
		$venta->actualizaVentaIgvSubTotal($idVenta, $sTotal, $Total, $igvAcumulado);

	
}
else {
	$rsV = $venta->insertVenta($docVenta, $tipoDocVenta, $fechaVenta, $cliente, $lugar, $notas, $idIgv);
	
	$rsV = $rsV > 0 ? $rsV : 0;
	
	if ($rsV) {
		$idLastInsert = $venta->getInsertedId();	
		
		//Ingresamos ahora el detalle de la Venta	
		$item = 1;
		foreach ($detalleProducto as $filaDetalle) 
		{
			$idTipoCuenta = $filaDetalle[0];
			$detalle = $filaDetalle[1];
			$cantidad = $filaDetalle[2];
			$precio = $filaDetalle[3];
			$subTotal = $cantidad * $precio;
			
			$detalleVenta->insertDetalleVenta($idLastInsert, $item, $detalle, $cantidad, $precio,
											  $idTipoCuenta, $subTotal);
			$item++;
			$Total += $subTotal;
		}
		
		$IGV = 1.18;
		$sTotal = round($Total/$IGV,2);
		$igvAcumulado = round($sTotal * $valorIgv,2);
			
		$venta->actualizaVentaIgvSubTotal($idLastInsert, $sTotal, $Total, $igvAcumulado);
			
	}
}

header("Location: ".$_SERVER['HTTP_REFERER']);
?>