<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");
?>
<div id="centralPanel">

	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/rubro.jpg" width="150px" height="120px" alt="Tipo de Ingresos y Egresos" />
		<p><a href="gestionDetalles.php">Tipos de Ingresos y Egresos</a></p>
	</div>
	
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/igv.jpg" width="120px" height="120px" alt="Imagen inpuestos (IGV)" />
		<p><a href="gestionIgv.php">IGV</a></p>
	</div>
	
	
	<div id="itemPagos" class="centrarText">
		<img src="imagenes/maquetado/migrate.jpg" width="150px" height="150px" alt="Imagen Camales" />
		<p><a href="lugares.php">Lugares</a></p>
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