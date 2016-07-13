<?php
require("autoCarga.php");

$valorIgv = $_POST['valorIgv'];
$estadoIgv = $_POST['estadoIgv'];

$igv = new Igv();

$rs = $igv->insertIgv($valorIgv, $estadoIgv);

$rs = $rs > 0 ? $rs : 0;

if ($rs) {
	$idIgvInserted = $igv->getInsertedId();
	
	$where = "idIgv != $idIgvInserted";
	
	$igv->setEstadoIgv($where);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>