<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

$proveedor = new Proveedor();
$generales = new Generales();

$rsP = $proveedor->getProveedor();
?>
<div id="divDetalle" class="divDetalle2 oculto"></div>
<div id="centralPanel">
	<form>
		<fieldset class="formOpcionesReportes">
			<legend>Seleccionar Proveedor</legend>
			<div class="claveValor">
				<label for="proveedor">Proveedor: </label>
				<select name="proveedor" id="proveedor" class="campoNormal">
					<?php
					if ($rsP->num_rows) {
						while ($rowP = $rsP->fetch_assoc()) {
							$idProveedor = $rowP['idProveedor'];
							$rzProveedor = $rowP['razonSocial'];
					?>
							<option value="<?php echo $idProveedor; ?>"><?php echo $rzProveedor; ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			<hr />
			<div class="parrafoCerrar">
				<label for="diaBuscarF" class="labelFecha">Dia:</label>
				<select name="diaBuscarF" id="diaBuscarF">
				<?php
					$fechaActual = explode(",", date("j,n,Y"));
					
					for ($i = 1; $i < 32; $i++) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo ($i == $fechaActual[0])? 'selected="selected"':"";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
			
				<label for="mesBuscarF" class="labelFecha"> Mes:</label>
				<select name="mesBuscarF" id="mesBuscarF">
				<?php
					for ($i = 1; $i < 13; $i++) {
					$generales = new Generales();
					$mes = $generales->getMes($i);
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i== $fechaActual[1] ? 'selected="selected"' : "";?>>
						<?php echo $mes;?>
						</option>
				<?php
					}
				?>
				</select>
			
				<label for="yearBuscarF" class="labelFecha"> A&ntilde;o:</label>
				<select name="yearBuscarF" id="yearBuscarF">
				<?php
					$yearNow = $fechaActual[2];
											
					for ($i = ($yearNow); $i > ($yearNow - 5); $i--) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i==$yearNow ? 'selected="selected"' : "";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
				<label for="diaBuscarT" class="labelFecha">/&nbsp;&nbsp;Dia:</label>
				<select name="diaBuscarT" id="diaBuscarT">
				<?php
					$fechaActual = explode(",", date("j,n,Y"));
					
					for ($i = 1; $i < 32; $i++) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo ($i == $fechaActual[0])? 'selected="selected"':"";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
			
				<label for="mesBuscarT" class="labelFecha"> Mes:</label>
				<select name="mesBuscarT" id="mesBuscarT">
				<?php
					for ($i = 1; $i < 13; $i++) {
					$generales = new Generales();
					$mes = $generales->getMes($i);
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i== $fechaActual[1] ? 'selected="selected"' : "";?>>
						<?php echo $mes;?>
						</option>
				<?php
					}
				?>
				</select>
			
				<label for="yearBuscarT" class="labelFecha"> A&ntilde;o:</label>
				<select name="yearBuscarT" id="yearBuscarT">
				<?php
					$yearNow = $fechaActual[2];
											
					for ($i = ($yearNow); $i > ($yearNow - 5); $i--) {
				?>
						<option value="<?php echo $i;?>"
						<?php echo $i==$yearNow ? 'selected="selected"' : "";?>>
						<?php echo $i;?>
						</option>
				<?php
					}
				?>
				</select>
				
			</div>
		</fieldset>
	</form>
	
	<div class="reportes2" id="divReportes">
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