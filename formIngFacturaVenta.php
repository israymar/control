<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de venta Cuentas.</title>
<script type="text/javascript" src="funcionesJS.js"></script>
<link rel="stylesheet" href="hojaEstilos.css" media="all" />
<style type="text/css">
body{
	background-color:#000000;	
}
</style>
</head>

<body>
<?php
require("autoCarga.php");

echo date("j,n,Y")."<br />";
echo date_default_timezone_get();

$generales = new Generales();
$cliente = new Cliente();
$tipoCuenta = new TipoCuenta();

@$idVenta = $generales->verificaVariable($_GET['venta']);
@$idDocVenta = $_GET['docVenta'];
@$tipoVista = $_GET['tipo'];
@$page = $generales->verificaVariable($_GET['page']);

$whereCli = "1";
if (isset($idDocVenta) && strlen(trim($idDocVenta)) > 0) {
	$docVenta = new DocVenta();
	$whereDV = "idDocVenta = '$idDocVenta'";
	$rsDV = $docVenta->getDocVenta($whereDV);
	$rowDV = ($rsDV->num_rows) ? $rsDV->fetch_assoc() : NULL;
	
	if ($rowDV) {
		$idVenta = $rowDV['idVenta'];
		$idCliente = $rowDV['idCliente'];
		$whereCli = "idCliente = $idCliente";
		
		$fecha = explode(",", date("j,n,Y", $rowDV['fechaDocVenta']));
		$diaDocVenta = date("d", $rowDV['fechaDocVenta']);
		$mesDocVenta = date("m", $rowDV['fechaDocVenta']);
		$yearDocVenta = date("Y", $rowDV['fechaDocVenta']);
		
		$tipoDocVenta = $rowDV['tipoDocVenta'];
		$estadoDocVenta = $rowDV['estadoDocVenta'];
		$obsDocVenta = $rowDV['observacionDocVenta'];
		$idIgv = $rowDV['idIgv'];
		$subTotal = round($rowDV['subtotal'], 2);
		$valorIgvDV = round($rowDV['valorIgv'], 2);
		$total = round($rowDV['total'], 2);
	}
}

if (!isset($idDocVenta) || strlen(trim($idDocVenta)) == 0) {
	$venta = new Venta();
	$where = "idVenta = $idVenta";
	$rsV = $venta->getVenta($where);
	if ($rsV->num_rows) {
		$rowV = $rsV->fetch_assoc();
		$whereCli = "idCliente = $rowV[idCliente]";
	}
}
$igv = new Igv();
$whereIgv = "estadoIgv = 1";
$rsIgv = $igv->getIgv($whereIgv);
if ($rsIgv) {
	$rowIgv = $rsIgv->fetch_assoc();
	$valorIgv = $rowIgv['valor'];
}

$rsCli = $cliente->getCliente($whereCli);

//Configuramos la pagina de retorno
if ($idDocVenta) {
	$pagAnterior = "facturasVenta.php?page=$page";
}
else {
	$pagAnterior = "gestionVentas.php?page=$page";
}

$actionForm = ($tipoVista == "detalle") ? "#" : "ingresoFactura.php?back=$pagAnterior";
$actionForm .= ($idDocVenta) ? "&docVenta=$idDocVenta" : "";

?>
<div id="divBloqueador" style="display:block;"></div>
<div id="centralPanel">
<div id="divIngresoVenta">
	
	<form action="<?php echo $actionForm; ?>" method="post">
	<fieldset>
	<legend>Datos nuevo Documento de venta</legend>
	
	<div id="itemProveedores"  class="divLineaDerecha itemVentaIzquierda">
		<div class="claveValor">
			<label for="idDocVenta">N&ordm; Doc. Venta:</label>
			<input type="text" class="campoNormal" name="idDocVenta" id="idDocVenta"
			value="<?php echo $idDocVenta; ?>" />
		</div>
		
		<div class="claveValor">
			<label for="idVenta">Cod. Venta:</label>
			<input type="text" name="idVenta" id="idVenta" class="pequenio" value="<?php echo $idVenta; ?>"/>
		</div>
			
		<div class="claveValor">
			<label for="cliente">Cliente: </label>
			
			<select name="cliente" id="cliente" class="campoNormal">
			<?php
				if ($rsCli) {
					while ($rowCli = $rsCli->fetch_assoc()) {
						$idCliente = $rowCli['idCliente'];
						$nombresCliente = $rowCli['nombreCliente']." ".$rowCli['apellidosCliente'];
			?>
				<option value="<?php echo $idCliente; ?>"><?php echo $nombresCliente; ?></option>
			<?php
					}
				}
			?>
			</select>
		</div>
		
		<div class="claveValor">
			<fieldset class="fechas">
			<legend>Fecha de Emision</legend>
				<span>Dia:</span>
				<select name="diaVenta" id="diaVenta">
				<?php
					if (!$fecha) {
						$fecha = explode(",", date("j,n,Y"));
					}
					
					for ($i = 1; $i < 32; $i++) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo ($i == $fecha[0])? 'selected="selected"':"";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
				
				<span>Mes:</span>
				<select name="mesVenta" id="mesVenta">
				<?php
					for ($i = 1; $i < 13; $i++) {
						$generales = new Generales();
						$mes = $generales->getMes($i);
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i== $fecha[1] ? 'selected="selected"' : "";?>>
						<?php echo $mes;?>
						</option>
				<?php
					}
				?>
				</select>
				
				<span>A&ntilde;o:</span>
				<select name="yearVenta" id="yearVenta">
				<?php
					$yearNow = $fecha[2];
											
					for ($i = ($yearNow - 1); $i < ($yearNow + 1); $i++) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i==$yearNow ? 'selected="selected"' : "";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
			</fieldset>
		</div>
		
		
		<div class="claveValor">
			<label for="tipoDocVenta">Tipo Documento:</label>
			<select name="tipoDocVenta" id="tipoDocVenta" class="campoNormal">
				<option value="a" <?php echo (@$tipoDocVenta == "a") ?
				'selected="selected"' : ""; ?>>Factura</option>
				<option value="b" <?php echo (@$tipoDocVenta == "b") ?
				'selected="selected"' : ""; ?>>Boleta</option>
				<option value="c" <?php echo (@$tipoDocVenta == "c") ?
				'selected="selected"' : ""; ?>>Ticket de Venta</option>
			</select>
		</div>
		
		<div class="claveValor">
			<label for="estadoDocVenta">Estado:</label>
			<select name="estadoDocVenta" id="estadoDocVenta" class="campoNormal">
				<option value="0" <?php echo (@$estadoDocVenta == "0") ?
				'selected="selected"' : ""; ?>>Pendiente</option>
				<option value="1" <?php echo (@$estadoDocVenta == "1") ?
				'selected="selected"' : ""; ?>>Pagado Parcialmente</option>
				<option value="2" <?php echo (@$estadoDocVenta == "2") ?
				'selected="selected"' : ""; ?>>Pagado</option>
			</select>
		</div>
		
		<div class="claveValor">
			<label for="observacion">Observacion:</label>
			<textarea name="observacion" id="observacion" class="campoAncho"
			wrap="virtual"><?php echo @$obsDocVenta; ?></textarea>
		</div>
		
		
		<input name="igv" type="hidden" id="igv" value="<?php echo $valorIgv; ?>" />
						
	</div><!--End div#itemProveedores-->
	
	<div id="itemProveedores" class="itemVentaDerecha">
		<table id="tablaDetalle">
			<thead>
				<tr>
					<th>Tipo Cuenta</th>
					<th>Cantidad</th>
					<th>P</th>
					<th>Precio</th>
					<th>Precio p </th>
					<th>Sub Total</th>
				</tr>
			</thead>
			
			<tbody id="bodyTablaDetalle">
				<!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
				<!-- Si no se viene de una venta entoces mostramos el formularo detalle en blanco-->
				<?php
				if (@!$_GET['venta'] && @!$_GET['docVenta']) {				
				?>
				<tr>
					<td><select name="tipoCuenta[]" id="tipoCuenta">
					<?php
						$rsTCuenta = $tipoCuenta->getTipoCuenta();
						if ($rsTCuenta->num_rows) {
							while ($rowTCuenta = $rsTCuenta->fetch_assoc()) {
					?>
							<option value="<?php echo $rowTCuenta['idTipoCuenta']; ?>">
							<?php echo $rowTCuenta['nombreTipoCuenta']?>
							</option>
					<?php
							}
						}
					?>
					</select>
					</td>					
					<td><input class="masPequenio" type="text" name="cantidadDet[]" id="cantidadDet" /></td>
					<td><input class="masPequenio" type="text" name="pesoDet[]" id="pesoDet" /></td>
					<td><input class="masPequenio" type="text" name="precioUnitDet[]" id="precioUnitDet" /></td>
					<td><input class="masPequenio" type="text" name="precioPeladaDet[]" id="precioPeladaDet" value="0" /></td>
					<td><input class="pequenio" type="text" name="subTotalDet[]" id="subTotalDet" disabled="disabled" /></td>
				</tr>
				<!-- :::::::::::::::::::::::::::::::::::::::::::::::: -->
				<!-- Caso contrario LLenamos con los datos del pedido -->				
				<?php
				}
				elseif (@$_GET['venta']) {
					$detalleVenta = new DetalleVenta();
					$whereDV = "idVenta = $idVenta";
					$rsDV = $detalleVenta->getDetalleVentaResumen($whereDV);
					
					if ($rsDV->num_rows) {
					
						while ($rowDV = $rsDV->fetch_assoc()) {
							$idTipoCuenta = $rowDV['idTipoCuenta'];
							//$nombreTipoCuenta = $rowDV['nombreTipoCuenta'];
							$cantidadTipoCuenta = $rowDV['cantidad'];
							$pesoNetoTipoCuenta = $rowDV['pesoNeto'];
				?>
					<tr>
						<td><select name="tipoCuenta[]" id="tipoCuenta">
						<?php
							$rsTCuenta = $tipoCuenta->getTipoCuenta();
							if ($rsTCuenta->num_rows) {
								while ($rowTCuenta = $rsTCuenta->fetch_assoc()) {
						?>
								<option value="<?php echo $rowTCuenta['idTipoCuenta']; ?>"
								<?php echo $rowTCuenta['idTipoCuenta'] == $idTipoCuenta ? 'selected="selected"' : ""; ?>>
								<?php echo $rowTCuenta['nombreTipoCuenta']?>
								</option>
						<?php
								}
							}
						?>
						</select>
						</td>						
						<td><input class="masPequenio" type="text" name="cantidadDet[]"
						id="cantidadDet" value="<?php echo $cantidadTipoCuenta; ?>" />
						</td>
						
						<td><input class="masPequenio" type="text" name="pesoDet[]"
						id="pesoDet" value="<?php echo $pesoNetoTipoCuenta; ?>" />
						</td>
						
						<td><input class="masPequenio" type="text" name="precioUnitDet[]" id="precioUnitDet" /></td>
						<td><input class="masPequenio" type="text" name="precioPeladaDet[]" id="precioPeladaDet" value="0" /></td>
						<td><input class="pequenio" type="text" name="subTotalDet[]" id="subTotalDet" disabled="disabled" /></td>
					</tr>
				<?php
						}//End while
					}//End if
				}//End elseif
				else {
					$detDocVenta = new DetalleDocVenta();
					$whereDDV = "idDocVenta = '$idDocVenta'";
					$rsDDV = $detDocVenta->getDetDocVenta($whereDDV);
					if ($rsDDV->num_rows) {
						while ($rowDDV = $rsDDV->fetch_assoc()) {
							$idTipoCuenta = $rowDDV['idTipoCuenta'];
							$cantidadTipoCuenta = $rowDDV['cantidad'];
							$pesoTipoCuenta = $rowDDV['peso'];
							$precioUnitario = $rowDDV['precioUnitario'];
							$precioPelada = $rowDDV['precioUnitPelada'];
							$subTotalDDV = $rowDDV['subTotal'];
					?>
					<tr>
						<td><select name="tipoCuenta[]" id="tipoCuenta">
						<?php
							$rsTCuenta = $tipoCuenta->getTipoCuenta();
							if ($rsTCuenta->num_rows) {
								while ($rowTCuenta = $rsTCuenta->fetch_assoc()) {
									$idTCuenta = $rowTCuenta['idTipoCuenta'];
									$nombreTCuenta = $rowTCuenta['nombreTipoCuenta'];
						?>
								<option value="<?php echo $idTCuenta; ?>"
								<?php echo $idTCuenta == $idTipoCuenta ? 'selected="selected"' : ""; ?>>
								<?php echo $nombreTCuenta; ?>
								</option>
						<?php
								}
							}
						?>
							</select>
						</td>
						<td><input class="masPequenio" type="text" name="cantidadDet[]"
						id="cantidadDet" value="<?php echo $cantidadTipoCuenta; ?>" />
						</td>
						<td><input class="masPequenio" type="text" name="pesoDet[]"
						id="pesoDet" value="<?php echo $pesoTipoCuenta; ?>" />
						</td>
						<td><input class="masPequenio" type="text" name="precioUnitDet[]"
						id="precioUnitDet" value="<?php echo $precioUnitario; ?>"/>
						</td>
						<td><input class="masPequenio" type="text" name="precioPeladaDet[]"
						id="precioPeladaDet" value="<?php echo ($precioPelada) ? $precioPelada : 0; ?>" />
						</td>
						<td><input class="pequenio" type="text" name="subTotalDet[]"
						id="subTotalDet" value="<?php echo $subTotalDDV; ?>" disabled="disabled" />
						</td>				
					</tr>
					<?php
						}//End while					
					}//End if
				}//End else
				?>
				
			</tbody>
			
			<tbody class="resumenVenta alineacionDerecha">
				<tr>
					<td colspan="5">Sub Total: </td>
					<td id="subTotalVenta"><?php echo @$subTotal; ?></td>
				</tr>
				<tr>
					<td colspan="5">I.G.V: </td>
					<td id="igvVenta"><?php echo @$valorIgvDV; ?></td>
				</tr>
				<tr>
					<td colspan="5">Total: </td>
					<td id="totalVenta"><?php echo @$total; ?></td>
				</tr>
			</tbody>
		</table>
				
	</div>


	<hr class="clearFloat" />
	<p class="alineacionDerecha parrafoCerrar">
		<a id="linkCerrar" href="<?php echo $pagAnterior; ?>">
		<img src="imagenes/maquetado/remove.png" width="32" height="32" alt="Cerrar" title="Cerrar" /></a>
	</p>
	<div class="<?php echo ($tipoVista == "detalle") ? "oculto" : "visibleInline"; ?>">
		<input type="submit" value="Guardar" />
		<input type="reset" value="Cancelar" />
	</div>
	</fieldset>
	</form>
</div>
</div>

</body>
</html>
