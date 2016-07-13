<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

$lugar = new Lugar();
$rs = $lugar->getLugar();

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gestion Lugares</h3>	
	<?php
	if ($rs->num_rows) {
	?>
		<table>
			<tr>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Direccion</th>
				<th>Descripcion</th>
				<th>Acciones</th>
			</tr>
		<?php
		while ($row = $rs->fetch_assoc()) {
			$idLugar = $row['idLugar'];
			$nombreLugar = $row['nombreLugar'];
			$dirLugar = $row['direccionLugar'];
			$descLugar = $row['descripcion'];			
		?>
			<tr>
				<td><?php echo $idLugar; ?></td>
				<td><?php echo $nombreLugar; ?></td>
				<td><?php echo $dirLugar; ?></td>
				<td><?php echo $descLugar; ?></td>
				<td>
					[<a href="<?php echo $idLugar; ?>" name="itemEditar">Editar</a>]
					[<a href="eliminarLugar.php?lugar=<?php echo $idLugar; ?>" name="itemEliminar">Eliminar</a>]
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
		<a href="configuracion.php"><img src="imagenes/maquetado/folder_previous2.png"
		height="48" width="48" alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		
		<a href="#" id="nuevoLugar"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nueva imagen" alt="Nuevo"></a>
	</p>
	
	<div id="divIngresoPequenios" class="oculto">
		<form action="ingresoLugar.php" method="post" id="fIngLugar">
			<fieldset>
				<legend>Nuevo Lugar</legend>
				<div class="claveValor">
					<label for="nombreLugar">Nombre: </label>
					<input type="text" id="nombreLugar" name="nombreLugar" maxlength="45" class="campoNormal">
				</div>
				
				<div class="claveValor">
					<label for="direccionLugar">Direcci&oacute;n: </label>
					<input type="text" id="direccionLugar" name="direccionLugar" maxlength="75" class="campoMedioNormal">
				</div>
				
				<div class="claveValor">
					<label for="descripcionLugar">Descripci&oacute;n: </label>
					<textarea id="descripcionLugar" name="descripcionLugar" class="campoMedioNormal" wrap="virtual"></textarea>
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