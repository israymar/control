<?php
class DocVenta
{
	protected $cn;
	
	public function __construct()
	{
		$this->cn = new Db();
	}
		
	public function getDocVenta($where = "1")
	{
		$query = "SELECT * FROM documentoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getDocVentaReporte($where = "1")
	{
		$query = "SELECT idDocVenta, dv.idCliente, total, nombreCliente, apellidosCliente
				  FROM documentoventa AS  dv INNER JOIN cliente AS c
				  ON dv.idCliente = c.idCliente
				  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getVentaAcumulada($where = "0")
	{
		$query = "SELECT SUM(total) AS ventaAcumulada FROM documentoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertDocVenta($idDocVenta, $idCliente, $fechaDocVenta, $idVenta,
							       $tipoDocVenta, $estadoDocVenta, $observacion, $idIgv)
	{
		$query = "INSERT INTO documentoventa(idDocVenta, idCliente, fechaDocVenta, idVenta,
							  tipoDocVenta, estadoDocVenta, observacionDocVenta, idIgv)
							  VALUES
							  ('$idDocVenta', $idCliente, $fechaDocVenta, $idVenta,
							  '$tipoDocVenta', '$estadoDocVenta', '$observacion', $idIgv)";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows(); 
	}
	
	public function setDocVenta($idDocVenta, $subTotalDocVenta, $igvDocVenta, $totalDocVenta)
	{
		$query = "UPDATE documentoventa SET subtotal = $subTotalDocVenta,
				  valorIgv = $igvDocVenta, total = $totalDocVenta
				  WHERE idDocVenta = '$idDocVenta'";
		
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function updateDocVenta($idCliente, $fechaDocVenta, $idVenta, $tipoDocVenta,
							$estadoDocVenta, $observacion, $idIgv, $where)
	{
		$query = "UPDATE documentoventa SET idCliente = $idCliente, fechaDocVenta = $fechaDocVenta,
										idVenta = $idVenta, tipoDocVenta = '$tipoDocVenta',
										estadoDocVenta = '$estadoDocVenta', observacionDocVenta = '$observacion',
										idIgv = $idIgv
									WHERE $where";
									
		return $this->cn->dbExecute($query);
	
	}
	
	public function setEstadoDocVenta($set = "", $where = "0")
	{
		$query ="UPDATE documentoventa SET $set WHERE $where";
		
		return $this->cn->dbExecute($query);
	
	}
	
	public function deleteDocVenta($where = "0")
	{
		$query = "DELETE FROM documentoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}
}
?>