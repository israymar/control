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
$empleado = new Empleado();
$totalEmpleados = $empleado->getEmpleado()->num_rows;

$where = "1 ORDER BY apellidos LIMIT $from, $cantidad";
$rs = $empleado->getEmpleado($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Registro de&nbsp; Empleados</h3>
	<?php
	if ($rs->num_rows) {
	?>
	<div class="divListado">
			<table class="zebra">
			<tr>
				<th colspan="8">Listado de empleados</th>
			</tr>
			<tr>
				<th>Nombres</th>
				<th>DNI</th>
				<th>Sueldo</th>
				<th>Direcci&oacute;n</th>
				<th>Tel&eacute;fono</th>
				<th>Celular</th>
				<th>RPM</th>
				<th>Acciones</th>			
			</tr>
	<?php
		while ($row = $rs->fetch_assoc()) {
			$idEmpleado = $row['idEmpleado'];
			$nombres = $row['nombres'];
			$dni = $row['dni'];
			$sueldo = $row['sueldo'];
			$direccion = $row['direccion'];
			$telefono = $row['telefono'];
			$movil = $row['movil'];
			$rpm = $row['rpm'];
	?>
			<tr>
				<td class="numeros"><?php echo $nombres; ?></td>
				<td class="numeros"><?php echo $dni; ?></td>
				<td class="numeros"><?php echo $sueldo; ?></td>
				<td class="numeros"><?php echo $direccion; ?></td>
				<td class="numeros"><?php echo $telefono; ?></td>
				<td class="numeros"><?php echo $movil; ?></td>
				<td class="numeros"><?php echo $rpm; ?></td>
				<td>
					[<a href="<?php echo $idEmpleado; ?>" name="itemEditar">Editar</a>]
					[<a href="eliminarEmpleado.php?idEmpleado=<?php echo $idEmpleado; ?>"
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
			$paginacion->generaPaginacion($totalEmpleados, $back, $next, $url);
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
		<a href="#" id="nuevoEmpleado"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoContacto" class="oculto">
		<form action="ingresoEmpleado.php" method="post" id="fIngEmpleado">
			<fieldset>
			<legend>Datos nuevo empleado</legend>
				<div class="claveValor">
					<label for="dni">DNI: *</label>
					<input type="text" name="dni" id="dni" maxlength="8" class="campoNormal" />
				</div>
				<div class="claveValor">
					<label for="nombres">Nombres: *</label>
					<input type="text" name="nombres" id="nombres" maxlength="45" class="campoMedioNormal" />
				</div>
				<div class="claveValor">
					<label for="apellidos">Cargo: *</label>
					<input type="text" name="apellidos" id="apellidos" maxlength="45" class="campoMedioNormal" />
				</div>
				<div class="claveValor">
					<label for="sueldo">Sueldo: *</label>
					<input type="text" name="sueldo" id="sueldo" maxlength="6" class="pequenio" />
				</div>
				<div class="claveValor">
					<label for="direccion">Direcci&oacute;n: </label>
					<input type="text" name="direccion" id="direccion" maxlength="70" class="campoAncho" />
				</div>
				<div class="claveValor">
					<label for="telefono">Tel&eacute;fono: </label>
					<input type="text" name="telefono" id="telefono" maxlength="11" class="campoNormal" />
				</div>
				<div class="claveValor">
					<label for="celular">Celular: </label>
					<input type="text" name="celular" id="celular" maxlength="12" class="campoNormal" />
				</div>
				<div class="claveValor">
					<label for="rpm">RPM: </label>
					<input type="text" name="rpm" id="rpm" maxlength="11" class="campoNormal" />
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