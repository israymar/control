<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");

require("header.php");

$proveedor = new Proveedor;

$contacto = new Contacto;
$where = "1 ORDER BY apellidosContacto";
$rs = $contacto->getContacto($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gesti&oacute;n de contactos</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<table>
			<tr>
				<th colspan="6">Listado de Contactos</th>
			</tr>
			<tr>
				<th>DNI</th>
				<th>Nombres</th>
				<th>Direcci&oacute;n</th>
				<th>Tel&eacute;fonos</th>
				<th>Proveedor</th>
				<th>Acciones</th>			
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idContacto = $row['idContacto'];
			$dni = $row['dniContacto'];
			$nombres = ucwords($row['apellidosContacto']." ".$row['nombresContacto']);
			$direccion = $row['direccionContacto'];
			$telefonos = $row['telContacto']." ".$row['movilContacto']." ".$row['rpmContacto'];
			$mail = $row['mailContacto'];
			$razonSocProv = strtoupper($row['razonSocial']);
			
	?>
		<tr>
			<td class="numeros"><?php echo $dni; ?></td>
			<td><?php echo $nombres; ?></td>
			<td><?php echo $direccion; ?></td>
			<td class="numeros"><?php echo $telefonos; ?></td>
			<td class="mayusculas"><?php echo $razonSocProv; ?></td>
			<td>
				[<a href="<?php echo $idContacto;?>" name="itemEditar">Editar</a>]
				[<a href="eliminarContacto.php?contacto=<?php echo $idContacto;?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	
	<?php
		}
	
	?>	
		</table>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="proveedores.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoContacto"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoContacto" class="oculto">
		<form action="ingresoContacto.php" method="post" id="fIngContacto">
			<fieldset>
			<legend>Datos nuevo Contacto</legend>
			<div class="claveValor">
				<label for="nombres">Nombres: *</label>
				<input class="campoMedioNormal" type="text" name="nombres" id="nombres" maxlength="45" />
			</div>
			
			<div class="claveValor">
				<label for="apellidos">Apellidos: *</label>
				<input class="campoMedioNormal" type="text" name="apellidos" id="apellidos" maxlength="75" />
			</div>
			
			<div class="claveValor">
				<label for="dni">DNI: *</label>
				<input class="campoNormal" type="text" name="dni" id="dni" maxlength="8" />
			</div>
			
			<div class="claveValor">
				<label for="direccion">Direccion: *</label>
				<input class="campoAncho" type="text" name="direccion" id="direccion" maxlength="75" />
			</div>
			
			<div class="claveValor">
				<label for="telefono">Telefono:</label>
				<input class="campoNormal" type="text" name="telefono" id="telefono" maxlength="12" />
			</div>
			
			<div class="claveValor">
				<label for="celular">Celular: *</label>
				<input class="campoNormal" type="text" name="celular" id="celular" maxlength="12" />
			</div>
			
			<div class="claveValor">
				<label for="rpm">RPM:</label>
				<input class="campoNormal" type="text" name="rpm" id="rpm" maxlength="10" />
			</div>
			
			<div class="claveValor">
				<label for="email">Correo Electr&oacute;nico:</label>
				<input class="campoMedioNormal" type="text" name="email" id="email" maxlength="45" />
			</div>
			
			
			<div class="claveValor">
				<label for="proveedor">Proveedor: *</label>
				
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
