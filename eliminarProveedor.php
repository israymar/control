<?php
require("autoCarga.php");
$generales = new Generales();

$idProveedor = $generales->verificaVariable($_GET['prov']);

$proveedor = new Proveedor();
$contacto = new Contacto();

//Eliminamos primero el contacto de este proveedor
$where = "idProveedor = $idProveedor";

$contacto->deleteContacto($where);

//Luego entonces eliminamos el proveedor
$rs = $proveedor->deleteProveedor($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>