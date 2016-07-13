<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 20;

$paginacion = new Paginacion($cantidad, $page);
$tipocuenta = new Detalles;

$rsT = $tipocuenta->getTipoCuenta();
$totalDet = $rsT->num_rows;

$from = $paginacion->getFrom();

$where = "1 ORDER BY nombreTipoCuenta LIMIT $from, $cantidad";
$rs = $tipocuenta->getTipoCuenta($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gestion de Cuentas</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="6">Tipos de Cuenta</th>
			</tr>
			<tr>
				<th>Codigo</th>
				<th>Nombres</th>
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$idTipoCuenta = $row['idTipoCuenta'];
			$nombreTipoCuenta = strtoupper($row['nombreTipoCuenta']);			
			
	?>
		<tr>
			<td class="numeros"><?php echo $idTipoCuenta; ?></td>
			<td class="mayusculas"><?php echo $nombreTipoCuenta; ?></td>
			<td>[<a href="<?php echo $idTipoCuenta; ?>" name="itemEditar">Editar</a>]
				[<a href="eliminarDetalles.php?tipocuenta=<?php echo $idTipoCuenta;?>" name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	
	<?php
		}
	?>	
		</table>
		<div class="paginacion">
		<?php
			$url = "gestionDetalles.php?";
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
		<a href="#" id="nuevoTipoCuenta"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nueva imagen" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoPequenios" class="oculto">
		<form action="ingresoDetalles.php" method="post" id="fIngTipoCuenta">
			<fieldset>
			<legend>Datos Tipo Cuenta</legend>
			<div class="claveValor">
				<label for="nombreTipoCuenta">Cuenta: *</label>
				<input class="campoAncho" type="text" name="nombreTipoCuenta" id="nombreTipoCuenta" maxlength="75" />
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