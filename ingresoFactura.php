<?php
require("autoCarga.php");

$docVenta = new DocVenta();
$igv = new Igv();
$detDocVenta = new DetalleDocVenta();

@$back= $_GET['back'];
@$idDocVentaUpd = $_GET['docVenta'];

@$idDocVenta = $_POST['idDocVenta'];
@$idVenta = $_POST['idVenta'];
@$idCliente = $_POST['cliente'];

@$diaVenta = $_POST['diaVenta'];
@$mesVenta = $_POST['mesVenta'];
@$yearVenta = $_POST['yearVenta'];

@$tipoDocVenta = $_POST['tipoDocVenta'];
@$estadoDocVenta = $_POST['estadoDocVenta'];
@$observacion = $_POST['observacion'];

//Configuracion de la fecha de venta
if (!checkdate($mesVenta, $diaVenta, $yearVenta)) {
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
$fechaDocVenta =  mktime(0, 0, 0, $mesVenta, $diaVenta, $yearVenta);

/*
 *Extraemos el igv
 *Si estamos en una modificacion Sacamos
 *el igv de la factura al momento de su creacin
 */
if (isset($idDocVentaUpd) and strlen(trim($idDocVentaUpd)) > 0) {
	$where = "idDocVenta = '$idDocVentaUpd'";
	$rs = $docVenta->getDocVenta($where);
	$row = $rs->num_rows ? $rs->fetch_assoc() : NULL;
	
	if ($row) {
		$idIgv = $row['idIgv'];
		$whereIgv = "idIgv = $idIgv";
		$rsIgv = $igv->getIgv($whereIgv);
		if ($rsIgv->num_rows) {
			$rowIgv = $rsIgv->fetch_assoc();
			$valorIgv = $rowIgv['valor'];
		}
	}	
//Sino Sacamos el igv actual	
}
else {	
	$whereIgv = "estadoIgv = 1";
	$rsIgv = $igv->getIgv($whereIgv);
	if ($rsIgv->num_rows) {
		$rowIgv = $rsIgv->fetch_assoc();
		$idIgv = $rowIgv['idIgv'];
		$valorIgv = $rowIgv['valor'];
	}
}

//Extraemos ahora el detalle del documento de venta
$array[0] = $_POST['tipoPollo'];
$array[1] = $_POST['cantidadDet'];
$array[2] = $_POST['pesoDet'];
$array[3] = $_POST['precioUnitDet'];
$array[4] = $_POST['precioPeladaDet'];

//Buscamos por valores nulos en el array
$indicesVacios = array();
for ($i = 0; $i < count($array[3]); $i++) {
	if (!$array[3][$i] || strlen(trim($array[3][$i]) == 0)) {
		$indicesVacios[] = $i;
	}
}

//Configuramos un array detalleDocVenta
$detalleDocVenta = array();

for($i = 0; $i < count($array[3]); $i++) {
	for ($j = 0; $j < count($array); $j++) {
		$detalleDocVenta[$i][$j] = $array[$j][$i];
	}
}

//Eliminamos ahora las filas del array vacias
for ($i = 0; $i < count($indicesVacios); $i++) {
	unset($detalleDocVenta[$indicesVacios[$i]]);
}

/*===============================================================
 *REALIZAMOS AHORA LA MODIFICACION O INSERCION SEGUN SEA EL CASO
 *===============================================================
 */
if (isset($idDocVentaUpd) && strlen(trim($idDocVentaUpd)) > 0) {
	$where = "idDocVenta = '$idDocVentaUpd'";
	$docVenta->updateDocVenta($idCliente, $fechaDocVenta, $idVenta, $tipoDocVenta,
							$estadoDocVenta, $observacion, $idIgv, $where);
	
	//Actualizamos ahora el detalle del documento de venta
	$item = 1;
	$subTotalDocVenta = 0;
	$rsDDV = 0;
	
	foreach ($detalleDocVenta as $filaDetalle) {
		$tipoPollo = $filaDetalle[0];
		$cantidad = $filaDetalle[1];
		$peso = $filaDetalle[2];
		$precioUnitario = $filaDetalle[3];
		$precioPelada = $filaDetalle[4];
		$subTotalItem = $peso * $precioUnitario + $precioPelada;
		$subTotalDocVenta += $subTotalItem;
		
		$whereDDV = "idDocVenta = '$idDocVentaUpd' AND item = $item";
		$rsddv = $detDocVenta->getDetDocVenta($whereDDV);
		
		if ($rsddv->num_rows) {
			//Actualizamos el detalle del documento de venta
			$rsDDV += $detDocVenta->updateDetDocVenta($tipoPollo, $cantidad, $peso, $precioUnitario,
													  $precioPelada, $subTotalItem, $whereDDV);
			
		}
		else {
			//Insertamos en el detalle del documento de venta
			$rsDDV += $detDocVenta->insertDetDocVenta($item, $idDocVentaUpd, $tipoPollo, $cantidad,
										$peso, $precioUnitario, $precioPelada, $subTotalItem);
		}
		$item++;
	}
	
}
else {
	//Realizamos la insercin en la BD primero en la tabla documento de venta
	$rsV = $docVenta->insertDocVenta($idDocVenta, $idCliente, $fechaDocVenta, $idVenta,
								  $tipoDocVenta, $estadoDocVenta, $observacion, $idIgv);

	//Ahora insertamos el detalle del documento de venta
	$rsV = $rsV > 0 ? $rsV : 0;
	if ($rsV) {
		$subTotalDocVenta = 0;
		$rsDDV = 0;
		
		for ($i = 0; $i < count($detalleDocVenta); $i++) {
			$tipoPollo = $detalleDocVenta[$i][0];
			$cantidad = $detalleDocVenta[$i][1];
			$peso = $detalleDocVenta[$i][2];
			$precioUnitario = $detalleDocVenta[$i][3];
			$precioPelada = $detalleDocVenta[$i][4];
		
			$subTotalItem = $peso * $precioUnitario + $precioPelada;
			$subTotalDocVenta += $subTotalItem;
			$item = $i+1;
			
			$rsDDV += $detDocVenta->insertDetDocVenta($item, $idDocVenta, $tipoPollo, $cantidad,
												$peso, $precioUnitario, $precioPelada, $subTotalItem);
		}//End for
	}//End if
}//End else

//Actualizamos los datos faltantes del documento de venta (valor Igv, SubTotal, Total)
if ($rsDDV) {
	$subTotalDocVenta = $subTotalDocVenta;
	$igvDocVenta = $subTotalDocVenta * $valorIgv;
	$totalDocVenta = $subTotalDocVenta + $igvDocVenta;
	
	$docVenta->setDocVenta($idDocVenta, $subTotalDocVenta, $igvDocVenta, $totalDocVenta);
}

header("Location: ".$back);

?>