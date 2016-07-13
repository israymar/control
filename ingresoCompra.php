<?php
require("autoCarga.php");

$numCompraUpdate = $_GET['compra'];

$numeroCompra = $_POST['numeroCompra'];
$proveedor = $_POST['proveedor'];
$diaCompra = $_POST['diaCompra'];
$mesCompra = $_POST['mesCompra'];
$yearCompra = $_POST['yearCompra'];
@$tipoDocCompra = $_POST['tipoDocCompra'];
$cheque = $_POST['numeroCheque'];

if (!checkdate($mesCompra, $diaCompra, $yearCompra)) {
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
$fechaCompra =  mktime(0, 0, 0, $mesCompra, $diaCompra, $yearCompra);

$array[0] = $_POST['tipoDet'];
$array[1] = $_POST['detaDet'];
$array[2] = $_POST['pesoDet'];
$array[3] = $_POST['precioUnitarioDet'];

//Convertir a array detalleProducto
$detalleProducto = array();

//Sacamos el igv Actual
$where = "estadoIgv = 1";
$igv = new Igv();
$rs = $igv->getIgv($where);
$row = $rs->fetch_assoc();
$idIgv = $row['idIgv'];
$valorIgv = $row['valor'];

//Buscamos por filas que tienen valores vacios
$indicesVacios = array();
foreach ($array[2] as $key => $value) {
	if (!$array[2][$key] || strlen(trim($array[2][$key])) == 0) {
		$indicesVacios[] = $key;
	}
}

for($i = 0; $i < count($array[2]); $i++) {
	for ($j = 0; $j < count($array); $j++) {
		$detalleProducto[$i][$j] = $array[$j][$i];
	}
}

//Eliminamos las filas que presentan valores nulos
foreach ($indicesVacios as $value) {
	unset($detalleProducto[$value]);
}


$compra = new Compra();
$detalleCompra = new DetalleCompra();

/*
 *Verificamos si estamos frente a un ingreso o a una actualizaci&#65533;n
 */
if (isset($numCompraUpdate) && strlen(trim($numCompraUpdate)) > 0) {
	$where = "idCompra = '$numCompraUpdate'";
	$rsC = $compra->updateCompra($numeroCompra, $tipoDocCompra, $proveedor, $fechaCompra, $cheque, $idIgv, $where);
	
	//Actualizamos ahora el detalle de la compra
	$total = 0;
	foreach ($detalleProducto as $key => $filaDetalle) {
		$item = $key + 1;
		$idTipoCuenta = $filaDetalle[0];
		$detalle = $filaDetalle[1];
		$peso = $filaDetalle[2];
		$precioUnitario = $filaDetalle[3];		
		$subTotal = $peso * $precioUnitario;
		
		//Verificamos si existe el item en la tabla detalle
		//Si es asi actualizamos sino Insertamos
		$whereDC = "idCompra = '$numCompraUpdate' AND item = $item";
		$rsDC = $detalleCompra->getDetalleCompra($whereDC);
		
		if ($rsDC->num_rows) {
			//Estamos frente a una actualizaci&#65533;n
			$detalleCompra->updateDetalleCompra($numeroCompra, $idTipoCuenta, $detalle,
												$peso, $precioUnitario, $subTotal, $whereDC);
		}
		else {
			//Estamos frente a una insercion
			$detalleCompra->insertDetalleCompra($item, $numeroCompra, $idTipoCuenta, $detalle,
												$peso, $precioUnitario, $subTotal);
		}
		$total += $subTotal;
	}
	
		$IGV = 1.18;
		$sTotal = round($total/$IGV,2);
		$igvAcumulado = round($sTotal * $valorIgv,2);	
		$compra->actualizaCompraIgvSubTotal($numeroCompra, $sTotal, $total, $igvAcumulado);
}
else {
	$rsC = $compra->insertCompra($numeroCompra, $tipoDocCompra, $proveedor, $fechaCompra, $cheque, $idIgv);

	//Ingresamos ahora el detalle de la Compra
	$rsC = $rsC > 0 ? $rsC : 0;
	
	if ($rsC) {
		
		$total = 0;
		foreach ($detalleProducto as $key => $filaDetalle) 
		{
			$item = $key + 1;
			$idTipoCuenta = $filaDetalle[0];
			$detalle = $filaDetalle[1];
			$peso = $filaDetalle[2];
			$precioUnitario = $filaDetalle[3];		
			$subTotal = $peso * $precioUnitario;
			
			$detalleCompra->insertDetalleCompra($item, $numeroCompra, $idTipoCuenta, $detalle,
												$peso, $precioUnitario, $subTotal);
			$total += $subTotal;
		}
		$IGV = 1.18;
		$sTotal = round($total/$IGV,2);
		$igvAcumulado = round($sTotal * $valorIgv,2);	
		$compra->actualizaCompraIgvSubTotal($numeroCompra, $sTotal, $total, $igvAcumulado);
	}//End if

}//End else

header("Location: ".$_SERVER['HTTP_REFERER']);
?>