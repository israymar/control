<?PHP
   session_start ();

   if (isset($_SESSION["valorUsu"]))
   {
  
      session_destroy ();
  //    print ("<BR><BR><P ALIGN='CENTER'>Conexion finalizada</P>\n");
     // print ("<P ALIGN='CENTER'>[ <A HREF='index.htm'>Conectar</A> ]</P>\n");
      
	 header('Location:http://www.inftelperu.net');

   }
   else
   {
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>No existe una conexion activa</P>\n");
      print ("<P ALIGN='CENTER'>[ <A HREF='index.htm'>Conectar</A> ]</P>\n");
   }
?>

