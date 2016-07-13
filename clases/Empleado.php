<?php
class Empleado
{
	private $cn;
	
	
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getEmpleado($where = 1)
	{
		$query = "SELECT * FROM empleado WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertEmpleado($nombres, $apellidos, $dni, $sueldo, $direccion, $telefono, $movil, $rpm)
	{
		$query = "INSERT INTO empleado (nombres, apellidos, dni, sueldo, direccion, telefono, movil, rpm)
				  VALUES
				  ('$nombres', '$apellidos', '$dni', $sueldo, '$direccion', '$telefono', '$movil', '$rpm')";
				  
		return $this->cn->dbExecute($query);
	}
	
	public function updateEmpleado($nombres, $apellidos, $dni, $sueldo, $direccion, $telefono, $movil, $rpm, $where = 0)
	{
		$query = "UPDATE empleado SET nombres = '$nombres', apellidos = '$apellidos',
								  dni = '$dni', sueldo = $sueldo, direccion = '$direccion',
								  telefono = '$telefono', movil = '$movil', rpm = '$rpm'
								  WHERE $where";
								  
		return $this->cn->dbExecute($query);
	}
	
	public function deleteEmpleado($where = 0)
	{
		$query = "DELETE FROM empleado WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
}
?>