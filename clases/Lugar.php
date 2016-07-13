<?php
class Lugar
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getLugar($where = "1")
	{
		$query = "SELECT * FROM lugar WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertLugar($nombreLugar, $direccionLugar, $descripcionLugar)
	{
		$query = "INSERT INTO lugar(nombreLugar, direccionLugar, descripcion)
		          VALUES ('$nombreLugar', '$direccionLugar', '$descripcionLugar')";
		
		return $this->cn->dbExecute($query);
	}
	
	public function updateLugar($nombreLugar, $direccionLugar, $descripcionLugar, $where="0")
	{
		$query = "UPDATE lugar SET nombreLugar = '$nombreLugar',
						direccionLugar = '$direccionLugar',
						descripcion = '$descripcionLugar'
				  WHERE $where";
		return $this->cn->dbExecute($query);
	}
	
	public function deleteLugar($where = 0)
	{
		$query = "DELETE FROM lugar WHERE $where";
		
		return $this->cn->dbExecute($query);
	}

}
?>