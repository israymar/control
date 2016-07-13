<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

$igv = new Igv();
$where = "1 ORDER BY idIgv DESC";
$rs = $igv->getIgv($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Geti&oacute;n IGV</h3>	
	<?php
	if ($rs->num_rows) {
	?>
		<table>
			<tr>
				<th>C&oacute;digo</th>
				<th>Valor</th>
				<th>Estado</th>
			</tr>
		<?php
		while ($row = $rs->fetch_assoc()) {
			$idIgv = $row['idIgv'];
			$valorIgv = $row['valor'];
			$estadoIgv = $row['estadoIgv'];
			$estadoIgv = $estadoIgv ? "Vigente" : "Vencido";
		?>
			<tr>
				<td><?php echo $idIgv; ?></td>
				<td><?php echo $valorIgv; ?></td>
				<td><?php echo $estadoIgv; ?></td>
			</tr>
		<?php
		}
		?>
		</table>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="configuracion.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="#" id="nuevoIgv"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	
	<div id="divIngresoPequenios" class="oculto">
		<form action="ingresoIgv.php" method="post" id="fIngIgv">
			<fieldset>
				<legend>Datos - nuevo IGV</legend>
				<div class="claveValor">
					<label for="valorIgv">Valor: </label>
					<input type="text" id="valorIgv" name="valorIgv" maxlength="5" class="campoNormal" />
				</div>
				
				<div class="claveValor">
					<label for="estadoIgv">Estado: </label>
					<select id="estadoIgv" name="estadoIgv" class="campoNormal">
						<option value="1">Vigente</option>
						<option value="0">Vencido</option>
					</select>
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