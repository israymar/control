<?php
require("autoCarga.php");

//$generales = new Generales();
$q = $_GET['q'];
$tipo = $_GET['tipo'];

switch($tipo) {
	case "proveedor"	:	$proveedor = new Proveedor();
							$where = "idProveedor = $q";
							$rs = $proveedor->getProveedor($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;							
							break;
							
	case "contacto"		:	$contacto = new Contacto();
							$where = "idContacto = $q";
							$rs = $contacto->getContacto($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "cuenta"		:	$cuenta = new Cuenta();
							$where = "mumeroCuenta = '$q'";
							$rs = $cuenta->getCuenta($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "pagoCompra"	:	$pagoCompra = new ReciboCompra();
							$where = "idReciboCompra = '$q'";
							$rs = $pagoCompra->getReciboCompra($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "cliente"		:	$cliente = new Cliente();
							$where = "idCliente = '$q'";
							$rs = $cliente->getCliente($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "Rubro"		:	$rubro = new Rubro();
							$where = "idRubro = $q";
							$rs = $rubro->getRubro($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;

	case "Detalles"		:	$tipoCuenta = new Detalles();
							$where = "idTipoCuenta = $q";
							$rs = $tipoCuenta->getTipoCuenta($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "lugar"		:	$camal = new Lugar();
							$where = "idCamal = $q";
							$rs = $camal->getCamal($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "pagoVenta"	:	$pagoVenta = new PagoVenta();
							$where = "idPagoVenta = $q";
							$rs = $pagoVenta->getPagoVenta($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "empleado"		:	$empleado = new Empleado();
							$where = "idEmpleado = $q";
							$rs = $empleado->getEmpleado($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
	case "pagoEmpleado"	:	$pagoEmpleado = new PagoEmpleado();
							$where = "idPagoEmpleado = $q";
							$rs = $pagoEmpleado->getPagoEmpleado($where);
							$row = ($rs->num_rows) ? $rs->fetch_assoc() : NULL;
							break;
}

$response = "{";

foreach($row as $key => $value) {
	$response .= "\"$key\" : \"$value\", ";
}
$response = substr($response, 0, strlen($response) - 2);
$response .= "}";

echo utf8_encode($response);
?>