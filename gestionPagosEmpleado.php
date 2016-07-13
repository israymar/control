<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {
require("autoCarga.php");
require("header.php");

$page = $_GET['page'];
$cantidad = 15;
$paginacion = new Paginacion($cantidad, $page);
$from = $paginacion->getFrom();

$generales = new Generales();
$pagoEmpleado = new PagoEmpleado();
$empleado = new Empleado();

$totalPagos = $pagoEmpleado->getPagoEmpleado()->num_rows;

$where = "1 ORDER BY idPagoEmpleado DESC LIMIT $from, $cantidad";
$rs = $pagoEmpleado->getPagoEmpleado($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Registro de&nbsp; pagos - empleado</h3>
	<?php
	if ($rs->num_rows) {
	?>
	<div class="divListado">
			<table class="zebra">
			<tr>
				<th colspan="6">Listado pagos empleado</th>
			</tr>
			<tr>
				<th>Periodo Laboral</th>
				<th>Empleado</th>
				<th>Fecha Pago</th>
				<th>Monto</th>
				<th>Observaci&oacute;n</th>
				<th>Acciones</th>			
			</tr>
	<?php
		while ($row = $rs->fetch_assoc()) {
			$idPago = $row['idPagoEmpleado'];
			
			$periodoLaboral = explode(" - ", $row['periodoLaboral']);
			$mesLaboral = $generales->getMes($periodoLaboral[0]);
			$periodoLaboral = $mesLaboral." - ".$periodoLaboral[1];
			
			
			$monto = round($row['monto'], 2);
			$fecha = date("d - m - Y", $row['fechaPago']);
			$observacion = $row['observacion'] ? $row['observacion'] : "-----";
			
			$idEmpleado = $row['idEmpleado'];
			$whereE = "idEmpleado = $idEmpleado";
			$rsE = $empleado->getEmpleado($whereE);
			$rowE = $rsE->num_rows ? $rsE->fetch_assoc() : NULL;
			$nombresEmpleado = $rowE ? $generales->configuraNombres($rowE['apellidos'], $rowE['nombres']) : NULL;
			
	?>
			<tr>
				<td class="numeros"><?php echo $periodoLaboral; ?></td>
				<td class="numeros"><?php echo $nombresEmpleado; ?></td>
				<td class="numeros"><?php echo $fecha; ?></td>
				<td class="numeros"><?php echo $monto; ?></td>
				<td class="numeros"><?php echo $observacion; ?></td>
				<td>
					[<a href="<?php echo $idPago; ?>" name="itemEditar">Editar</a>]
					[<a href="eliminarPagoEmpleado.php?idPago=<?php echo $idPago; ?>"
					name="itemEliminar">Eliminar</a>]
				</td>
			</tr>
	<?php
		}//End While
	?>
		</table>
		<div class="paginacion">
		<?php
			$url = "gestionEmpleados.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			$paginacion->generaPaginacion($totalPagos, $back, $next, $url);
		?>
		</div>
	</div>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="empleados.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoPago"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngreso" class="oculto">
		<form action="ingresoPagoEmpleado.php" method="post" id="fIngPagoEmpleado">
			<fieldset>
			<legend>Datos pago empleado</legend>
				<div class="claveValor">
					<label for="empleado">Empleado: *</label>
					<select name="empleado" id="empleado" class="campoMedioNormal">
					<?php
						$rsE = $empleado->getEmpleado();
						if ($rsE->num_rows) {
							while ($rowE = $rsE->fetch_assoc()) {
								$idEmpleado = $rowE['idEmpleado'];
								$nombres = $generales->configuraNombres($rowE['apellidos'], $rowE['nombres']);
					?>
						<option value="<?php echo $idEmpleado; ?>"><?php echo $nombres; ?></option>
					<?php
							}
						}
					?>
					</select>
				</div>
				<div class="claveValor">
					<fieldset class="fechas">
						<legend>Periodo Laboral *</legend>
						<span>Mes: </span>
						<select name="mes" id="mes">
						<?php
							$fechaActual = explode(",", date("j,n,Y"));
							for ($i = 1; $i < 13; $i++) {
							$mes = $generales->getMes($i);
						?>
								<option value="<?php echo $i;?>"
								<?php echo $i== $fechaActual[1] - 1 ? 'selected="selected"' : "";?>>
								<?php echo $mes;?>
								</option>
						<?php
							}
						?>
						</select>
				
						<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&ntilde;o: </span>
						<select name="year" id="year">
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
					<label for="monto">Monto: *</label>
					<input class="pequenio" type="text" name="monto" id="monto" maxlength="7" />
				</div>
				<div class="claveValor">
					<label for="observacion">Observaci&oacute;n: </label>
					<textarea id="observacion" name="observacion" class="campoAncho"></textarea>
				</div>
				
				<hr />
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