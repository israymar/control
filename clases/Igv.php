<?php
class Igv
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getIgv($where = "1")
	{
		$query = "SELECT * FROM igv WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertIgv($valorIgv, $estadoIgv)
	{
		$query = "INSERT INTO igv (valor, estadoIgv) VALUES ($valorIgv, '$estadoIgv')";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function setEstadoIgv($where = "0")
	{
		$query = "UPDATE igv SET estadoIgv = '0' WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getInsertedId()
	{
		return $this->cn->getInsertedId();
	}
	
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}

}
?>