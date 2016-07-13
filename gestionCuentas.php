<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");

require("header.php");

$proveedor = new Proveedor;

$cuenta = new Cuenta;
$where = "1 ORDER BY razonSocial";
$rs = $cuenta->getCuenta($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Cuentas Bancarias</h3>
	<?php
	if ($rs->num_rows) {
	?>
		<table>
			<tr>
				<th colspan="5">Listado de Cuentas bancarias de proveedores</th>
			</tr>
			<tr>
				<th>Proveedor</th>
				<th>Numero Cuenta</th>
				<th>Moneda</th>
				<th>Institucion Finac.</th>
				<th>Acciones</th>			
			</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$rSocial = strtoupper($row['razonSocial']);
			$numCuenta = $row['mumeroCuenta'];
			$banco = strtoupper($row['banco']);
			$moneda = $row['monedaCuenta'];
			
	?>
		<tr>
			<td class="mayusculas"><?php echo $rSocial; ?></td>
			<td><?php echo $numCuenta; ?></td>
			<td><?php echo $moneda; ?></td>
			<td class="mayusculas"><?php echo $banco; ?></td>
			<td>[<a href="<?php echo $numCuenta; ?>" name="itemEditar">Editar</a>]
				[<a href="eliminarCuenta.php?cuenta=<?php echo $numCuenta; ?>" name="itemEliminar">Eliminar</a>]</td>
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
		<a href="#" id="nuevaCuenta"><img src="imagenes/maquetado/pages_add.png"
		 width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
	<div id="divIngresoCuenta" class="oculto">
		<form action="ingresoCuenta.php" method="post" id="fIngCuenta">
			<fieldset>
			<legend>Datos nueva Cuenta</legend>
			
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
			
			<div class="claveValor">
				<label for="numeroCuenta">NumCuenta: *</label>
				<input class="campoSemiAncho" type="text" name="numeroCuenta" id="numeroCuenta" maxlength="45" />
			</div>
			
			<div class="claveValor">
				<label for="banco">Banco: *</label>
				<input class="campoSemiAncho" type="text" name="banco" id="banco" />
			</div>
			
			<div class="claveValor">
				<label for="moneda">Moneda: *</label>
				<select id="moneda" name="moneda" class="campoNormal">
					<option value="Nuevos Soles">Nuevos Soles</option>
					<option value="Dolares">Dolares</option>
					<option value="Euros">Euros</option>
				</select>
			</div>
			<div class="claveValor">
				<label for="estadoCuenta">Estado: *</label>
				<select id="estadoCuenta" name="estadoCuenta"  class="campoNormal">
					<option value="1">Vigente</option>
					<option value="0">De baja</option>
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
