<?php

 session_start ();


  if (isset($_SESSION["valorUsu"]))
   {


require("header.php");
?>


<div id="centralPanel">
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/prov.jpg" width="150px" height="150px" title="Proveedores" alt="imagen Provedores" />
		<p><a href="proveedores.php">Proveedores</a></p>
	</div>
	
	<div id="itemCompras" class="centrarText">
		<img src="imagenes/maquetado/compras.jpg" width="150" height="150" title="Compras" alt="imagen Compra" />
		<p><a href="gestionCompras.php">Egresos</a></p>
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