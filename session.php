<?php
require("autoCarga.php");

$nick=$_POST['username'];
$contrasena=$_POST ['password'];

$usuario = new Usuario;

$where = "userName = '$nick' AND password = md5('$contrasena')";

$consulta = $usuario->getUsuario($where);


if ($consulta->num_rows) {

session_start();

$rowUsu = $consulta->fetch_assoc();
$valorUsu = $rowUsu['userName'];
$valorPass = md5($rowUsu['password']);

$_SESSION["valorUsu"] = $valorUsu;

header('Location: control.php');

}

else
{          
      print ("<BR><BR>\n");
      print ("<P ALIGN='CENTER'>Acceso no autorizado</P>\n");
      print ("<P ALIGN='CENTER'>[ <A HREF='index.htm'>Conectar</A> ]</P>\n");

//}
//mysql_close($Conexion);    
}
//else    
//{    
//}    
?> 