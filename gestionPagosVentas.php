<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 30;

$paginacion = new Paginacion($cantidad, $page);
$pagoVenta = new PagoVenta();

$from = $paginacion->getFrom();

$rsT = $pagoVenta->getPagoVenta();
$totalPagsVenta = $rsT->num_rows;

$where = "1 ORDER BY idPagoVenta DESC LIMIT $from, $cantidad";
$rs = $pagoVenta->getPagoVenta($where);

$docVenta = new DocVenta();
$cliente = new Cliente();
$generales = new Generales();
$numeroCuenta = new CuentaEmpresa();
?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gesti&oacute;n Pagos ventas</h3>
	<?php
	if ($rs->num_rows) {
	?>
	<div class="divListado">
	<table class="zebra">
		<tr>
			<th>C&oacute;digo</th>
			<th>Doc. venta</th>
			<th>Fecha</th>
			<th>Monto Pg</th>
			<th>N&ordm; Cuenta</th>
			<th>Cliente</th>
			<th>Acciones</th>
		</tr>
		<?php
		while ($row = $rs->fetch_assoc()) {
			$idPagoVenta = $row['idPagoVenta'];
			$idDocVenta = $row['idDocVenta'];
			$fecha = date("d-m-Y, H:i", $row['fecha']);
			$monto = $row['monto'];
			$numCuenta = $row['numeroCuenta'] ? $row['numeroCuenta'] : "En Efectivo";
			
			$whereDV = "idDocVenta = '$idDocVenta'";
			$rsDV = $docVenta->getDocVenta($whereDV);
			if ($rsDV->num_rows) {
				$rowDV = $rsDV->fetch_assoc();
				$idCliente = $rowDV['idCliente'];
				$whereC = "idCliente = $idCliente";
				$rsC = $cliente->getCliente($whereC);
				if ($rsC->num_rows) {
					$rowC = $rsC->fetch_assoc();
					$nombresCliente = $generales->configuraNombres($rowC['nombreCliente'], $rowC['apellidosCliente']);
				}
			}
				
				
		?>
		<tr>
			<td><?php echo $idPagoVenta; ?></td>
			<td><?php echo $idDocVenta; ?></td>
			<td><?php echo $fecha; ?></td>
			<td><?php echo $monto; ?></td>
			<td><?php echo $numCuenta; ?></td>
			<td><?php echo $nombresCliente; ?></td>
			<td>
				[<a href="<?php echo $idPagoVenta; ?>" name="itemEditar">Editar</a>]
				[<a href="eliminarPagoVenta.php?pagoVenta=<?php echo $idPagoVenta; ?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
		<?php
		}		
		?>
	</table>
	<div class="paginacion">
	<?php
		$url = "gestionPagosVentas.php?";
		$back = "&laquo;Atras";
		$next = "Siguiente&raquo;";
		//$class = "numPages";
		$paginacion->generaPaginacion($totalPagsVenta, $back, $next, $url);
	?>
	</div>
	
	</div>
	<?php
	}
	?>
	<p class="centrarText">
		 <a href="ventas.php"><img src="imagenes/maquetado/folder_previous2.png"
		height="48" width="48" alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		
		<a href="#" id="nuevoPagoVenta"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nueva imagen" alt="Nuevo" /></a>
	</p>
	
	<div id="divIngreso" class="oculto">
		<form action="ingresoPagoVenta.php" method="post" id="fIngPagoVenta">
			<fieldset>
			<legend>Datos nuevo - Pago de venta</legend>
			<div class="claveValor">
				<label for="docVenta">Documento Venta: </label>
				<select name="docVenta" id="docVenta" class="campoAncho">
					<option value="-1">[N&ordm; Doc Venta] [Fecha Doc Venta] [Cliente]</option>
				<?php
					$whereDV = "1 ORDER BY idDocVenta DESC";
					$rsDV = $docVenta->getDocVenta($whereDV);
					if ($rsDV->num_rows) {
						while($rowDV = $rsDV->fetch_assoc()) {
							$numDV = $rowDV['idDocVenta'];
							$fechaDV = $rowDV['fechaDocVenta'];
							$fechaDV = date("d/m/Y", $fechaDV);
							
							$idCliente = $rowDV['idCliente'];
							$whereC = "idCliente = $idCliente";
							$rsC = $cliente->getCliente($whereC);
							if ($rsC->num_rows) {
								$rowC = $rsC->fetch_assoc();
								$nombresCliente = $generales->configuraNombres($rowC['nombreCliente'], $rowC['apellidosCliente']);
							}
							
							$textOption = "[".$numDV."] [".$fechaDV."] [".$nombresCliente."]";
							
				?>
							<option value="<?php echo $numDV; ?>"><?php echo  $textOption; ?></option>
				<?php
						}
					}
				?>
				</select>
			</div>
			
			<fieldset id="fieldsetMontosActuales" class="oculto fechas">
			<legend>Montos Actuales para este Doc. Venta</legend>
				<div class="claveValor">
					<span id="textTotalVenta">Monto total Venta: </span>&nbsp;&nbsp;&nbsp;&nbsp;---
					&nbsp;&nbsp;&nbsp;&nbsp;<span id="textMontoAcumulado">Monto pagado a la fecha: </span>
				</div>
			</fieldset>
			
			<div class="claveValor">
				<label for="monto">Monto a depositar: </label>
				<input type="text" name="monto" id="monto" class="pequenio" maxlength="8"/>
			</div>
			
			<div class="claveValor">
				<label for="monto">Numero cuenta: </label>
				<select name="numCuenta" id="numCuenta" class="campoNormal">
					<option value="-1" selected="selected">N Cuenta - Opcional-</option>
				<?php
				$rsNC = $numeroCuenta->getCuentaEmpresa();
				if ($rsNC->num_rows) {
					while($rowNC = $rsNC->fetch_assoc()) {
						$numCuenta = $rowNC['numeroCuenta'];
				?>
					<option value="<?php echo $numCuenta; ?>"><?php echo $numCuenta; ?></option>
				<?php
					}
				}
				?>
					
				</select>
			</div>
			
			<hr />
			<p class="parrafoCerrar alineacionDerecha">
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