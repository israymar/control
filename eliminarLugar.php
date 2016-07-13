<?php
require("autoCarga.php");

$generales = new Generales();
$lugar = new Lugar();

$idLugar = $generales->verificaVariable($_GET['lugar']);

$where = "idLugar = $idLugar";
$lugar->deleteLugar($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>