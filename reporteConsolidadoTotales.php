<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

$cliente = new Cliente();
$generales = new Generales();
$where = "jefeCliente IS NULL";
$rsC = $cliente->getCliente($where);
?>
<div id="centralPanel">
	<form>
		<fieldset class="formOpcionesReportes">
			<legend>Opciones de B&uacute;squeda</legend>
			<input type="radio" id="opcionBuscar1" name="opcionBuscar" checked="checked" value="1" />Gesti&oacute;n Negocio
			<input type="radio" id="opcionBuscar2" name="opcionBuscar" value="2" />Resumen Totales
			<hr />
			<div id="gestionNegocio" class="parrafoCerrar">
				<label for="diaBuscar" class="labelFecha">Dia:</label>
				<select name="diaBuscar" id="diaBuscar">
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
			
				<label for="mesBuscar" class="labelFecha"> Mes:</label>
				<select name="mesBuscar" id="mesBuscar">
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
			
				<label for="yearBuscar" class="labelFecha"> A&ntilde;o:</label>
				<select name="yearBuscar" id="yearBuscar">
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
			<div class="parrafoCerrar oculto" id="montosTotales">
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
