<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");

$generales = new Generales();
$cliente = new Cliente();

$rs = $cliente = $cliente->getJefeCliente(1);

?>
<div id="centralPanel">
	<form>
		<fieldset class="formOpcionesReportes">
			<legend>Opciones de b&uacute;squeda</legend>			
			<div id="buscarPorDia" class="parrafoCerrar">
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
			<label for="cliente">Cliente: </label>
			<select id="cliente" name="cliente" class="campoNormal">
				<?php
				if ($rs->num_rows) {
					while ($row = $rs->fetch_assoc()) {
						$idCliente = $row['idCliente'];
						$nombres = $generales->ConfiguraNombres($row['apellidosCliente'], $row['nombreCliente']);
						
				?>
					<option value="<?php echo $idCliente; ?>"><?php echo $nombres; ?></option>
				<?php
					}
				}
				?>
			</select>
		</fieldset>
	</form>
	<div id="divReportes" class="reportes"></div>

</div>

<?php
require("footer.php");
   }
   else
   {
      header('Location: index.htm');
   }

?>