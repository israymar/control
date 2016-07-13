<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 30;

$reciboCompra = new ReciboCompra();
$paginacion = new Paginacion($cantidad, $page);

$rsT = $reciboCompra->getReciboCompra();
$totalRCompras = $rsT->num_rows;
$from = $paginacion->getFrom();

$whereRC = "1 ORDER BY idReciboCompra DESC LIMIT $from, $cantidad";
$rsRC = $reciboCompra->getReciboCompra($whereRC);

$proveedor = new Proveedor();
?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gesti&oacute;n - Pagos por Compras</h3>

	<?php
	if ($rsRC->num_rows) {
	?>
	<div class="divListado">
	<table class="zebra">
		<tr>
			<th>Codigo</th>
			<th>Proveedor</th>
			<th>Fecha</th>
			<th>Monto</th>
			<th>Acciones</th>
		</tr>
	<?php
		while ($rowRC = $rsRC->fetch_assoc()) {
			$idRecCompra = $rowRC['idReciboCompra'];
			$idProveedor = $rowRC['idProveedor'];
			$fechaRecCompra = date("d - m - Y", $rowRC['fechaReciboCompra']);
			$montoRecCompra = $rowRC['montoReciboCompra'];
			
			$whereP = "idProveedor = $idProveedor";
			$rsP = $proveedor->getProveedor($whereP);		
			if ($rsP->num_rows) {
				$rowP = $rsP->fetch_assoc();
				$rzProveedor = $rowP['razonSocial'];
			} //End if
		
	?>
		<tr>
			<td><?php echo $idRecCompra; ?></td>
			<td><?php echo $rzProveedor; ?></td>
			<td><?php echo $fechaRecCompra; ?></td>
			<td><?php echo $montoRecCompra; ?></td>
			<td>[<a href="<?php echo $idRecCompra; ?>" name="itemEditar">Editar</a>]
				[<a href="eliminarPagoCompra.php?pagoCompra=<?php echo $idRecCompra; ?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	<?php
		}//End While
	?>
	</table>
		<div class="paginacion">
		<?php
			$url = "gestionPagosCompras.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalRCompras, $back, $next, $url);
		?>
		</div>
	
	</div>
	<?php
	}//End if
	?>
	
	<p class="centrarText">
		<a href="compras.php"><img src="imagenes/maquetado/folder_previous2.png"
		height="48" width="48" alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoReciboCompra"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngreso" class="oculto">
		<form action="ingresoReciboCompra.php" method="post" id="fIngRecCompra">
			<fieldset>
			<legend>Datos - Nuevo recibo por compra</legend>
				<div class="claveValor">
					<label for="idReciboCompra">Numero Recibo: </label>
					<input type="text" name="idReciboCompra" id="idReciboCompra" maxlength="11" class="campoNormal" />
				</div>
				
				<div class="claveValor">
					<label for="idProveedor">Proveedor: </label>
					<select name="idProveedor" id="idProveedor" class="campoNormal">
					<?php
						$rsPF = $proveedor->getProveedor();
						if ($rsPF->num_rows) {
						
							while ($rowPF = $rsPF->fetch_assoc()) {
								$idProveedor = $rowPF['idProveedor'];
								$rzProveedor = $rowPF['razonSocial'];
					?>
							<option value="<?php echo $idProveedor; ?>"><?php echo $rzProveedor; ?></option>
					<?php
							}
						}
					?>
					</select>
				</div>
				
				<div class="claveValor">
					<label for="montoReciboCompra">Monto depositado: </label>
					<input type="text" name="montoReciboCompra" id="montoReciboCompra" maxlength="11" class="campoNormal" />
				</div>
				
				<div class="claveValor">
				<fieldset class="fechas">
					<legend>Fecha de Emision</legend>
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
			
			<hr />
			<p class="alineacionDerecha parrafoCerrar">
			<a id="linkCerrar" href="#"><img src="imagenes/maquetado/remove.png"
			width="32" height="32" alt="Cerrar" title="Cerrar"  /></a>
			</p>
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