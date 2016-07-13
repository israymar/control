<?php
require("autoCarga.php");

$generales = new Generales();

$nombreLugar = $_POST['nombreLugar'];
$dirLugar = $_POST['direccionLugar'];
$descLugar = $_POST['descripcionLugar'];

$idLugar = $generales->verificaVariable($_GET['lugar']);

$lugar = new Lugar();

if ($idLugar) {
	$where = "idLugar = $idLugar";
	$lugar->updateLugar($nombreLugar, $dirLugar, $descLugar, $where);
}
else {
	$lugar->insertLugar($nombreLugar, $dirLugar, $descLugar);
}

header("Location: ".$_SERVER['HTTP_REFERER']);
?>