<?php
class CuentaEmpresa
{
	protected $cn;
	
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getCuentaEmpresa($where="1")
	{
		$query = "SELECT * FROM cuentaEmpresa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertCuentaEmpresa()
	{
		$query = "";
		
		return $this->cn->dbExecute();
	}





}

?>