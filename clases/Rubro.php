<?php
class Rubro
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();	
	}
		
	public function getRubro($where = "1")
	{
		$query = "SELECT * FROM rubro WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertRubro($nomRubro)
	{
		$query = "INSERT INTO rubro(nomRubro)
				  VALUES ('$nomRubro')";
				  
		return $this->cn->dbExecute($query);
	}
	
	public function editRubro($nomRubro, $where = "0")
	{
		$query = "UPDATE rubro SET nomRubro = '$nomRubro' WHERE $where";
		
		return $this->cn->dbExecute($query);
	
	}
	
	
	public function deleteTipoCuenta($where = "0")
	{
		$query = "DELETE FROM rubro WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
		
}
?>
