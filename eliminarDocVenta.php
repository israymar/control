<?php
require("autoCarga.php");

$idDocVenta = $_GET['docVenta'];
$docVenta = new DocVenta();
$detDocVenta = new DetalleDocVenta();
$where = "idDocVenta = '$idDocVenta'";

//Eliminamos primero el detalle del documento de venta
$detDocVenta->deleteDetDocVenta($where);

//Eliminamos ahora el documento de venta
$docVenta->deleteDocVenta($where);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>