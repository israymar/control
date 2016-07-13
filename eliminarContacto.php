<?php
require("autoCarga.php");

$generales = new Generales();
$contacto = new Contacto();

$idContacto = $generales->verificaVariable($_GET["contacto"]);

$where = "idContacto = $idContacto";
$contacto->deleteContacto($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>