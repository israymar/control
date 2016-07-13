<?php
class ReciboCompra
{
	protected $cn;
	
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getReciboCompra($where = "1")
	{
		$query = "SELECT * FROM recibocompra WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getTotalDepositado($where)
	{
		$query = "SELECT SUM(montoReciboCompra) AS montoDepositado FROM recibocompra WHERE $where";
		return $this->cn->dbExecute($query);	
	}
	
	
	
	public function insertReciboCompra($idReciboCompra, $fechaReciboCompra, $montoReciboCompra, $idProveedor)
	{
		$query  = "INSERT INTO recibocompra
		           VALUES
				   ('$idReciboCompra', $fechaReciboCompra, $montoReciboCompra, $idProveedor) ";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function editReciboCompra($idReciboCompra, $fechaReciboCompra, $montoReciboCompra, $idProveedor, $where = "0")
	{
		$query  = "UPDATE recibocompra
		           SET idReciboCompra = '$idReciboCompra',
				   fechaReciboCompra = $fechaReciboCompra,
				   montoReciboCompra = $montoReciboCompra,
				   idProveedor = $idProveedor
				   WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function deleteReciboCompra($where = "0")
	{
		$query = "DELETE FROM recibocompra WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}


}
?>