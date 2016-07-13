<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");

require("header.php");

$proveedor = new Proveedor;
$where = "1 ORDER BY idProveedor DESC";
$rs = $proveedor->getProveedor($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gestion de proveedores</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<table>
			<tr>
				<th colspan="7">Listado de proveedores</th>
			</tr>
			<tr>
				<th>RUC</th>
				<th>Raz&oacute;n Social</th>
				<th>Ciudad</th>
				<th>Direcci&oacute;n</th>
				<th>Tel&eacute;fono</th>
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idProv = $row['idProveedor'];
			$ruc = $row['RUC'];
			$razonSocial = strtoupper($row['razonSocial']);
			$ciudad = $row['ciudad'];
			$direccion = $row['direccion'];
			$telefono = $row['telefono'];
			$fax = $row['fax'];
			
	?>
		<tr>
			<td class="numeros"><?php echo $ruc; ?></td>
			<td class="mayusculas"><?php echo $razonSocial; ?></td>
			<td class="mayusculas"><?php echo $ciudad ?></td>
			<td class="mayusculas"><?php echo $direccion; ?></td>
			<td class="numeros"><?php echo $telefono; ?></td>
			<td>
				[<a href="<?php echo $idProv; ?>" id="editarProveedor" name="itemEditar">Editar</a>]
				[<a href="eliminarProveedor.php?prov=<?php echo $idProv; ?>" name="itemEliminar">Eliminar</a>]
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
		<a href="#" id="nuevoProveedor"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngreso" class="oculto">
		<form action="ingresoProveedor.php" method="post" id="fIngProv">
			<fieldset>
			<legend>Datos nuevo Proveedor</legend>
			<div class="claveValor">
				<label for="ruc">RUC: *</label>
				<input class="campoNormal" type="text" name="ruc" id="ruc" maxlength="11" />
			</div>
			
			<div class="claveValor">
				<label for="razonSocial">Raz&oacute;n Social: *</label>
				<input class="campoAncho" type="text" name="razonSocial" id="razonSocial" maxlength="75" />
			</div>
			
			<div class="claveValor">
				<label for="ciudad">Ciudad: *</label>
				<input class="campoNormal" type="text" name="ciudad" id="ciudad" maxlength="45" />
			</div>
			
			<div class="claveValor">
				<label for="direccion">Direccion: *</label>
				<input class="campoAncho" type="text" name="direccion" id="direccion" maxlength="75" />
			</div>
			
			<div class="claveValor">
				<label for="telefono">Telefono: *</label>
				<input class="campoNormal" type="text" name="telefono" id="telefono" maxlength="13" />
			</div>
			
			<div class="claveValor">
				<label for="fax">Fax:</label>
				<input class="campoNormal" type="text" name="fax" id="fax" maxlength="13" />
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