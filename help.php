<?php
 session_start ();

  if (isset($_SESSION["valorUsu"]))
   {

require("autoCarga.php");
require("header.php");
?>
<div id="centralPanel">
	<div class="divHelp centrarText">
	<h3>&copy; Sistema de control de Ingresos y Gastos</h3>
	<h4>2012</h4>
	<h5>Desarrollado por:</h5>
	<h2>inftelperu.net</h2>
	
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