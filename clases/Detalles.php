<?php
class Detalles
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();	
	}
		
	public function getTipoCuenta($where = "1")
	{
		$query = "SELECT * FROM tipocuenta WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertTipoCuenta($nombreTipoCuenta)
	{
		$query = "INSERT INTO tipocuenta(nombreTipoCuenta)
				  VALUES ('$nombreTipoCuenta')";
				  
		return $this->cn->dbExecute($query);
	}
	
	public function editTipoCuenta($nombreTipoCuenta, $where = "0")
	{
		$query = "UPDATE tipocuenta SET nombreTipoCuenta = '$nombreTipoCuenta' WHERE $where";
		
		return $this->cn->dbExecute($query);
	
	}
	
	
	public function deleteTipoCuenta($where = "0")
	{
		$query = "DELETE FROM tipocuenta WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
		
	
	public function getUltimoClienteIngresado()
	{
		return $this->cn->getInsertedId();
	}
}
?>
