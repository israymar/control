<?php
require("autoCarga.php");

$nomRubro = $_POST['nomRubro'];

$idRubro = $_GET['rubro'];

$rubro = new Rubro();

if ($idRubro) {
	$where = "idRubro = $idRubro";
	$rubro->editRubro($nomRubro, $where);
}
else {
	$rubro->insertRubro($nomRubro);	
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>