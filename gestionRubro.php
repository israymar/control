<?php
require("autoCarga.php");

require("header.php");

@$page = $_GET['page'];
$cantidad = 20;

$paginacion = new Paginacion($cantidad, $page);
$rubro = new Rubro;

$rsT = $rubro->getRubro();
$totalDet = $rsT->num_rows;

$from = $paginacion->getFrom();

$where = "1 ORDER BY nomRubro LIMIT $from, $cantidad";
$rs = $rubro->getRubro($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gestion de Rubros</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="6">Rubros</th>
			</tr>
			<tr>
				<th>Codigo</th>
				<th>Nombres</th>
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idRubro = $row['idRubro'];
			$nomRubro = strtoupper($row['nomRubro']);			
			
	?>
		<tr>
			<td class="numeros"><?php echo $idRubro; ?></td>
			<td class="mayusculas"><?php echo $nomRubro; ?></td>
			<td>[<a href="<?php echo $idRubro;?>" name="itemEditar">Editar</a>]
				[<a href="eliminarRubro.php?rubro=<?php echo $idRubro;?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	
	<?php
		}
	?>	
		</table>
		<div class="paginacion">
		<?php
			$url = "gestionRubro.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalDet, $back, $next, $url);
		?>
		</div>
		</div>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="configuracion.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoRubro"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nueva imagen" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoPequenios" class="oculto">
		<form action="ingresoRubro.php" method="post" id="fIngRubro">
			<fieldset>
			<legend>Rubros</legend>
			<div class="claveValor">
				<label for="nomRubro">Nombre: *</label>
				<input class="campoAncho" type="text" name="nomRubro" id="nomRubro" maxlength="75" />
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
?>