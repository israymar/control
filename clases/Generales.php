<?php
class Generales
{
	public function getMes($idMes)
	{
		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
		         "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		
		return $meses[$idMes - 1];
	}
	
	public function configuraNombres($nombres, $apellidos = "")
	{
		$aNombres = explode(" ", $nombres);
		$aApellidos = explode(" ", $apellidos);
		return $aNombres[0] ." ".$aApellidos[0]; 
	}
	
	public function verificaVariable($var)
	{
		settype($var, "integer");
		$var = $var > 0 ? $var : 0;
		return $var;
	}


}

?>
