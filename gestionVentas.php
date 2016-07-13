<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 10;

$cliente = new Cliente();
$lugar = new Lugar();
$usuario = new Usuario();
$proveedor = new Proveedor();
$tipoCuenta = new TipoCuenta();

$venta = new Venta();
$docVenta = new DocVenta();

$paginacion = new Paginacion($cantidad, $page);
$from = $paginacion->getFrom();

$rsT = $venta->getVenta();
$totalVentas = $rsT->num_rows;

$where = "1 ORDER BY fechaVenta DESC, idVenta DESC LIMIT $from, $cantidad";
$rs = $venta->getVenta($where);

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
	<h3 class="centrarText">Gestion de Ingresos</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="5">Listado de total de Ingresos</th>
			</tr>
			<tr>
				<th>Cod</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Lugar</th>
				<!--<th>Usuario</th>-->
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idVenta = $row['idVenta'];
			$fechaVenta = date("d - m - Y", $row['fechaVenta']);
			$subTotal = $row['subTotal'];
			$igv = $row['valorIgv'];
			$total = round($subTotal + $igv, 2);

			
			$idUsuario = $row['idUsuario'];
			$idCliente = $row['idCliente'];
			$idLugar = $row['idLugar'];
			
			
			$whereC = "idCliente = $idCliente";
			$rsC = $cliente->getCliente($whereC);
			$rowC = $rsC->fetch_assoc();
			$nombresC = strtoupper($rowC['nombreCliente']." ".$rowC['apellidosCliente']);
			$jefe = $rowC['jefeCliente'];
			
			$whereCa = "idLugar = $idLugar";
			$rsCa = $lugar->getLugar($whereCa);
			$rowCa = $rsCa->fetch_assoc();
			$nombreLugar = strtoupper($rowCa['nombreLugar']);
			
			/*$whereU = "idUsuario = $idUsuario";
			$rsU = $usuario->getUsuario($whereU);
			if ($rsU->num_rows) {
				$rowU = $rsU->fetch_assoc();
				$userName = $row['userName'];
			}
			*/
			$whereDV = "idVenta = $idVenta";
			$rsDDV = $docVenta->getDocVenta($whereDV);
			
	?>
		<tr>
			<td class="mayusculas" style="height: 20px"><?php echo $idVenta; ?></td>
			<td class="mayusculas" style="height: 20px"><?php echo $fechaVenta; ?></td>
			<td class="mayusculas" style="height: 20px"><?php echo $nombresC; ?></td>
			<td class="mayusculas" style="height: 20px"><?php echo $nombreLugar; ?></td>
			<!--<td class="mayusculas"><?php //echo $userName; ?></td>-->
			
			<td style="height: 20px">
			[<a href="<?php echo $idVenta; ?>" name="itemEditar">Editar</a>]
			[<a href="consultaDetalleVenta.php?venta=<?php echo $idVenta; ?>">Detalle</a>]
			[<a href="eliminarVenta.php?venta=<?php echo $idVenta; ?>" name="itemEliminar">Eliminar</a>]
			<?php
				if (!$rsDDV->num_rows && !$jefe) {
			?>
				<!--[<a href="formIngFacturaVenta.php?venta=<?php echo $idVenta; ?>
				&page=<?php echo $page; ?>">Factura</a>]-->
			<?php
				}
			?>
			</td>
		</tr>
	
	<?php
		}
	
	?>	
		</table>
		<div class="paginacion">
		<?php
			$url = "gestionVentas.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalVentas, $back, $next, $url);
		?>
		</div>
		</div>
	<?php
	}
	?>
	<p class="centrarText">
		<!--<a href="facturasVenta.php">
		<img src="imagenes/maquetado/hojaCalculo.jpg" height="48" width="48"
		alt="Docs Venta" title="Ir a Documentos de Venta" /></a>&nbsp;&nbsp; -->
		<a href="ventas.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		
		<a href="#" id="nuevaVenta"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nueva Venta" alt="Nuevo" /></a>		
	</p>
	<div id="divIngresoVenta" class="oculto">
	
	<!-- FORMULARIO-->
	
		<form action="ingresoVenta.php" method="post" id="fIngVenta">
			<fieldset>
			<legend>Nuevo Ingreso</legend>
			
			<div id="itemProveedores"  class="divLineaDerecha itemVentaIzquierda">				
				
			<div class="claveValor">
			<label for="idDocVenta">Num. Docu:</label>
			<input type="text" class="campoChico" name="idDocVenta" id="idDocVenta" maxlength="12"/>
			</div>

				<div class="claveValor">
				<label for="cliente">Cliente: </label>
				
				<select name="cliente" id="cliente" class="campoNormal">
				<?php
				$rs = $cliente->getCliente();
				if ($rs) {
					while ($row = $rs->fetch_assoc()) {
						$idCliente = $row['idCliente'];
						$nombresCliente = $row['nombreCliente']." ".$row['apellidosCliente'];
				?>
					<option value="<?php echo $idCliente; ?>"><?php echo $nombresCliente; ?></option>
				<?php
					}
				}
				?>
				</select>
				</div>
				
				<div class="claveValor">
				<label for="lugar">Lugar: </label>
				
				<select name="lugar" id="lugar" class="campoNormal">
				<?php
				$rs = $lugar->getLugar();
				if ($rs) {
					while ($row = $rs->fetch_assoc()) {
						$idLugar = $row['idLugar'];
						$nombreLugar = $row['nombreLugar'];
				?>
					<option value="<?php echo $idLugar; ?>"><?php echo $nombreLugar; ?></option>
				<?php
					}
				}
				?>
				</select>
				</div>
			
			<div class="claveValor">
				<fieldset class="fechas">
				<legend>Fecha Ingreso</legend>
					<span>Dia:</span>
					<select name="diaVenta" id="diaVenta">
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
					<select name="mesVenta" id="mesVenta">
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
					<select name="yearVenta" id="yearVenta">
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
			<label for="tipoDocVenta">Tipo Docu.:</label>
			<select name="tipoDocVenta" id="tipoDocVenta" class="campoNormal">
				<option value="Factura" <?php echo (@$tipoDocVenta == "Factura") ?
				'selected="selected"' : ""; ?>>Factura</option>
				
				<option value="Boleta" <?php echo (@$tipoDocVenta == "Boleta") ?
				'selected="selected"' : ""; ?>>Boleta</option>
				
				<option value="Recibo" <?php echo (@$tipoDocVenta == "Recibo") ?
				'selected="selected"' : ""; ?>>Recibo</option>
			</select>
		</div>
			
		
				<div class="claveValor">
				<label for="notas">Observaciones:</label>
				<textarea rows="3" name="notas" id="notas" cols="35"></textarea>
				</div>
				
				<input type="hidden" name="valorIgv" id="valorIgv" value="<?php echo $valorIgv; ?>" />
			

			
			</div><!--End div#itemProveedores-->
						
			<div id="itemProveedores" class="itemVentaDerecha">
				<table id="tablaDetalle">
					<thead>
					<tr>
						<th>T. Cuenta</th>
						<th>Detalles</th>
						<th>Cant</th>
						<th>Monto</th>
						<th>Sub Total</th>
					</tr>
					</thead>
					<tbody id="bodyTablaDetalle">
					<tr>
						<td><select name="tipoCuenta[]" id="tipoCuenta" class="campoNormal">
						<?php
							$rs = $tipoCuenta->getTipoCuenta();						
							if ($rs) {
								while ($row = $rs->fetch_assoc()) {
						?>
							<option value="<?php echo $row['idTipoCuenta']; ?>"><?php echo $row['nombreTipoCuenta']?></option>
						<?php
								}
							}
						?>
						</select>
						</td>
						<td><input class="campoNormal" type="text" name="detaDet[]" id="detaDet" maxlength="100" /></td>
						<td><input class="masPequenio" type="text" name="cantidadDet[]" id="cantidadDet" maxlength="3" /></td>
						<td><input class="masPequenio" type="text" name="precioDet[]" id="precioDet" maxlength="6" /></td>
						<td><input class="mediano" type="text" name="subTotalDet[]" id="subTotalDet" disabled="disabled" /></td					
						</tr>
					</tbody>
					<tbody class="resumenVenta">
					<tr>
							<td colspan="4" class="alineacionDerecha">Sub Total: </td>
							<td id="subTotalIng"></td>
					</tr>
					<tr>
							<td colspan="4" class="alineacionDerecha">IGV</td>
							<td id="igvIng">&nbsp;</td>
					</tr>
					<tr>
							<td colspan="4" class="alineacionDerecha">Total</td>
							<td id="totalIng">&nbsp;</td>
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
