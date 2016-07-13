<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 20;

$paginacion = new Paginacion($cantidad, $page);
$cliente = new Cliente;

$rsT = $cliente->getCliente();
$totalCli = $rsT->num_rows;

$from = $paginacion->getFrom();

$where = "1 ORDER BY nombreCliente LIMIT $from, $cantidad";
$rs = $cliente->getCliente($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gesti&oacute;n de Clientes</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="6">Listado de Clientes</th>
			</tr>
			<tr>
				<th>RUC</th>
				<th>Nombres</th>
				<th>Direcci&oacute;n</th>
				<th>Email</th>
				<th>Telefono</th>
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idCliente = $row['idCliente'];
			$dni = $row['dniCliente'];
			$nombres = strtoupper($row['nombreCliente']);			
			$direccion = $row['direccionCliente'];
			$telefono = $row['telMovilCliente'];
			$email = $row['emailCliente'];
			
	?>
		<tr>
			<td class="numeros"><?php echo $dni; ?></td>
			<td class="mayusculas"><?php echo $nombres; ?></td>
			<td class="numeros"><?php echo $direccion ?></td>
			<td class="numeros"><?php echo $email; ?></td>
			<td class="numeros"><?php echo $telefono; ?></td>
			<td>[<a href="<?php echo $idCliente; ?>" name="itemEditar">Editar</a>]
				[<a href="eliminarCliente.php?cliente=<?php echo $idCliente;?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	
	<?php
		}
	?>	
		</table>
		<div class="paginacion">
		<?php
			$url = "gestionClientes.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalCli, $back, $next, $url);
		?>
		</div>
		</div>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="ventas.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoCliente"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nueva imagen" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoCliente" class="oculto">
		<form action="ingresoCliente.php" method="post" id="fIngCliente">
			<fieldset>
			<legend>Datos Cliente</legend>
			<div class="claveValor">
				<label for="dni">DNI/RUC: *</label>
				<input class="campoNormal" type="text" name="dni" id="dni" maxlength="11" />
			</div>
			
			<div class="claveValor">
				<label for="nombres">Nomb/razon Social: *</label>
				<input class="campoMedioNormal" type="text" name="nombres" id="nombres" maxlength="45" />
			</div>
						
			<div class="claveValor">
				<label for="ciudad">Ciudad: *</label>
				<input class="campoNormal" type="text" name="ciudad" id="ciudad" maxlength="25" />
			</div>
			
			<div class="claveValor">
				<label for="direccion">Direccion:</label>
				<input class="campoMedioNormal" type="text" name="direccion" id="direccion" maxlength="75" />
			</div>
			
			<div class="claveValor">
				<label for="direccion">Email:</label>
				<input class="campoMedioNormal" type="text" name="email" id="email" maxlength="45" />
			</div>
			
			<div class="claveValor">
				<label for="celular">T. Celular (T. Fijo):</label>
				<input class="campoNormal" type="text" name="celular" id="celular" maxlength="11" />
			</div>
			
			<div class="claveValor">
				<label for="rpm">RPM:</label>
				<input class="campoNormal" type="text" name="rpm" id="rpm" maxlength="11" />
			</div>
			
			<div class="claveValor">
				<label for="fax">Fax:</label>
				<input class="campoNormal" type="text" name="fax" id="fax" maxlength="11" />
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