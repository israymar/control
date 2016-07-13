<?php
 session_start ();


  if (isset($_SESSION["valorUsu"]))
   {

require("header.php");
?>
<div id="centralPanel">
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/clientes.jpg" width="150px" height="150px" title="Clientes" alt="Imagen Clientes" />
		<p><a href="gestionClientes.php">Clientes</a></p>
	</div>
	
	<div id="itemCompras" class="centrarText">
		<img src="imagenes/maquetado/compras.jpg" width="150" height="150" title="Ventas" alt="imagen Venta" />
		<p><a href="gestionVentas.php">Ingresos</a></p>
	</div>
	<div class="clearFloat"></div>

</div>
<?php
require("footer.php");
   }
   else
   {
      header('Location: index.htm');
   }

?>
