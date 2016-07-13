<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 30;

$proveedor = new Proveedor;
$paginacion = new Paginacion($cantidad, $page);
$compra = new Compra;

//Extraemos el numero total de compras
$rsT = $compra->getCompra();
$totalCompras = $rsT->num_rows;
$from = $paginacion->getFrom();

$where = "1 ORDER BY fechaCompra DESC, idCompra DESC LIMIT $from, $cantidad";
$rs = $compra->getCompra($where);


$igv = new Igv();
$whereIgv = "estadoIgv = 1";
$rsIgv = $igv->getIgv($whereIgv);
if ($rsIgv) {
	$rowIgv = $rsIgv->fetch_assoc();
	$valorIgv = $rowIgv['valor'];
}
?>

<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Egresos</h3>
	<?php
	if ($totalCompras) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="7">Listado de Egresos</th>
			</tr>
			<tr>
				<th>N. Doc</th>
				<th>Fecha</th>
				<th>Proveedor</th>
				<th>Total</th>
				<!--<th>Igv</th>
				<th>Total</th> -->
				<th>Acciones</th>			
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$numCompra = $row['idCompra'];
			$fechaCompra = date("d - m - Y", $row['fechaCompra']);
			$subTotal = $row['subTotal'];
			$igv = $row['valorIgv'];
			$total = round($subTotal + $igv, 2);
			$idProveedor = $row['idProveedor'];
			
			$where = "idProveedor = $idProveedor";
			$rsP = $proveedor->getProveedor($where);
			$rowP = $rsP->fetch_assoc();
			$rSocial = strtoupper($rowP['razonSocial']);			
	?>
		<tr>
			<td class="mayusculas"><?php echo $numCompra; ?></td>
			<td class="mayusculas"><?php echo $fechaCompra; ?></td>
			<td class="mayusculas"><?php echo $rSocial; ?></td>
			<td class="mayusculas"><?php echo $subTotal; ?></td>
	<!-- 	<td class="mayusculas"><?php echo $igv; ?></td>
			<td class="mayusculas"><?php echo $total; ?></td>  -->
			
			<td>[<a href="<?php echo $numCompra; ?>" name="itemEditar">Editar</a>]
			[<a href="consultaDetalleCompra.php?compra=<?php echo $numCompra;?>">Detalle</a>]
			[<a href="eliminarCompra.php?compra=<?php echo $numCompra; ?>" name="itemEliminar">Eliminar</a>]</td>
		</tr>
	
	<?php
		}
	
	?>
		</table>
			<div class="paginacion">
		<?php
			$url = "gestionCompras.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalCompras, $back, $next, $url);
		?>
			</div>
		</div>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="compras.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevaCompra"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoCompra" class="oculto">
	
		<form action="ingresoCompra.php" method="post" id="fIngCompra">
			<fieldset>
			<legend>Egresos</legend>
			
			<div id="itemProveedores" class="divLineaDerecha">	
			
		<div class="claveValor">
			<label for="tipoDocCompra">Tipo Docu.:</label>
			<select name="tipoDocCompra" id="tipoDocCompra" class="campoNormal">
				<option value="Factura" <?php echo (@$tipoDocCompra == "Factura") ?
				'selected="selected"' : ""; ?>>Factura</option>
				
				<option value="Boleta" <?php echo (@$tipoDocCompra == "Boleta") ?
				'selected="selected"' : ""; ?>>Boleta</option>
				
				<option value="Recibo" <?php echo (@$tipoDocCompra == "Recibo") ?
				'selected="selected"' : ""; ?>>Recibo</option>
			</select>
		</div>
	
				<div class="claveValor">
					<label for="numeroCompra">Rec/Bol/Fact:</label>
					<input class="campoNormal" type="text" name="numeroCompra" id="numeroCompra" />
				</div>
				
				<div class="claveValor">
				<label for="proveedor">Proveedor: </label>
				
				<select name="proveedor" id="proveedor" class="campoNormal">
				<?php
				$rs = $proveedor->getProveedor();
				if ($rs) {
					while ($row = $rs->fetch_assoc()) {
						$idProv = $row['idProveedor'];
						$rSocial = $row['razonSocial'];
				?>
					<option value="<?php echo $idProv; ?>"><?php echo $rSocial; ?></option>
				<?php
					}
				}
				?>
				</select>
				</div>
			
			<div class="claveValor">
				<fieldset class="fechas">
				<legend>Fecha</legend>
					<span>Dia:</span>
					<select name="diaCompra" id="diaCompra">
					<?php
						$fechaActual = explode(",", date("j,n,Y"));
						
						for ($i = 1; $i < 32; $i++) {
					?>
							<option value="<?php echo $i;?>"
							<?php echo ($i == $fechaActual[0])? 'selected="selected"':"";?>>
							<?php echo $i;?>
							</option>
					<?php
						}
					?>
					</select>
				
					<span>Mes:</span>
					<select name="mesCompra" id="mesCompra">
					<?php
						for ($i = 1; $i < 13; $i++) {
						$generales = new Generales();
						$mes = $generales->getMes($i);
					?>
							<option value="<?php echo $i;?>"
							<?php echo $i== $fechaActual[1] ? 'selected="selected"' : "";?>>
							<?php echo $mes;?>
							</option>
					<?php
						}
					?>
					</select>
				
					<span>A&ntilde;o:</span>
					<select name="yearCompra" id="yearCompra">
					<?php
						$yearNow = $fechaActual[2];
												
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
					<label for="numeroCheque">N. Cheque:</label>
					<input class="campoNormal" type="text" name="numeroCheque" id="numeroCheque" />
				</div>
			
				<input type="hidden" name="valorIgv" id="valorIgv" value="<?php echo $valorIgv; ?>" />			
			
			</div>
			
			<div id="itemDetalles" class="itemVentaDerecha">
				<table id="tablaDetalle">
					<thead>
					<tr>
						<th>Tipo Egreso</th>
						<th>Detalles</th>
						<th>Cant</th>						
						<th>P. Unit</th>
						<th>SubTotal</th>
					</tr>
					</thead>
					<tbody id="bodyTablaDetalle">
					<tr>
						<td><select name="tipoDet[]" id="tipoDet" class="campoNormal">
						<?php
							$tipoCuenta = new TipoCuenta();
							$rsTP = $tipoCuenta->getTipoCuenta();						
							if ($rsTP) {
								while ($rowTP = $rsTP->fetch_assoc()) {
									$idTipoCuenta = $rowTP['idTipoCuenta'];
									$nombreTipoCuenta = $rowTP['nombreTipoCuenta'];
						?>
							<option value="<?php echo $idTipoCuenta; ?>"><?php echo $nombreTipoCuenta; ?></option>
						<?php
								}
							}
						?>
						</select></td>
						<td><input class="campoNormal" type="text" name="detaDet[]" id="detaDet" maxlength="100" /></td>
						<td><input class="masPequenio" type="text" name="pesoDet[]" id="pesoDet" /></td>
						<td><input class="masPequenio" type="text" name="precioUnitarioDet[]" id="precioUnitarioDet" /></td>
						<td><input class="pequenio" type="text" name="subTotalDet[]" id="subTotalDet" disabled="disabled" /></td>
					</tr>
					</tbody>
					<tbody class="resumenVenta">
						<tr>
							<td colspan="4" class="alineacionDerecha">Sub Total: </td>
							<td id="subTotalCompra"></td>
						</tr>
						<tr>
							<td colspan="4" class="alineacionDerecha">I.G.V: </td>
							<td id="igvCompra"></td>
						</tr>
						<tr>
							<td colspan="4" class="alineacionDerecha">Total: </td>
							<td id="totalCompra"></td>
						</tr>
					</tbody>
				</table>
				
			</div>
			
			<hr class="clearFloat" />
			<p class="alineacionDerecha parrafoCerrar">
			<a id="linkCerrar" href="#"><img src="imagenes/maquetado/remove.png"
			width="32" height="32" alt="Cerrar" title="Cerrar"  /></a></p>
			<input type="submit" value="Guardar" />
			<input type="reset" value="Cancelar" />
			
			
			</fieldset>
		</form>
	</div>

</div>
<?php
require("footer.php");
 }
   else
   {
      header('Location: index.htm');
   }

?>
