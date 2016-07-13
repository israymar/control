<?php
require("autoCarga.php");

$generales = new Generales();

$idRubro = $generales->verificaVariable($_GET['rubro']);

$rubro = new Rubro();

$where = "idRubro = $idRubro";

$rubro->deleteRubro($where);

header("Location: ".$_SERVER['HTTP_REFERER']);

?>