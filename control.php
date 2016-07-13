<?php
 session_start ();


  if (isset($_SESSION["valorUsu"]))
   {
   
   require("header.php");
?>


<div id="centralPanel">
	<h2 class="centrarText">InftelPeru SAC</h2>
	<div class="centrarText">
	<img src="imagenes/maquetado/torre.jpg" width=396 height=335 title="una imagen de la empresa" alt="imagen de la empresa" />
	</div>
</div>

<?php
require("footer.php");

   }
   else
   {
      //print ("<BR><BR>\n");
      //print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      //print ("<P ALIGN='CENTER'>[ <A HREF='index.htm' TARGET='_top'>Conectar</A> ]</P>\n");
      header('Location: index.htm');
   }

?>