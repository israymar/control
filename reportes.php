<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {
require("autoCarga.php");
require("header.php");

?>
<div id="centralPanel">
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/reportes3.jpg" width="150px" height="150px" alt="Imagen reporte Ventas " title="Reporte de Ventas" />
		<p><a href="gestionReporteVentas.php">Reporte de Ingresos</a></p>
	</div>
	
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/reportes2.jpg" width="150px" height="150px" alt="Imagen reporte Compras" title="Reporte de compras" />
		<p><a href="gestionCompraVenta.php">Egresos</a></p>
	</div>
	
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/subclientes.jpg" width="150px" height="150px" alt="Reporte Subclientes" title="Reporte Subclientes" />
		<p><a href="reporteSubclientes.php">Reporte Clientes</a></p>
	</div>
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/migrate.jpg" width="150px" height="150px" alt="Cons Totales" title="Totales" />
		<p><a href="reporteConsolidadoTotales.php">Estado de cuenta</a></p>
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