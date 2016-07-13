<?php
require("autoCarga.php");

$generales = new Generales();

$idCliente = $generales->verificaVariable($_GET['cliente']);

$cliente = new Cliente();

$where = "idCliente = $idCliente";

$cliente->deleteCliente($where);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>