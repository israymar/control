<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");
?>
<div id="centralPanel">
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/employee.jpg" width="150px" height="150px" alt="Imagen Empleados" />
		<p><a href="gestionEmpleados.php">Gestion Empleados</a></p>
	</div>
	<div id="itemProveedores" class="centrarText">
		<img src="imagenes/maquetado/pagos.jpg" width="150px" height="150px" alt="Imagen Empleados" />
		<p><a href="gestionPagosEmpleado.php">Pagos Empleado</a></p>
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