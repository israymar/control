<?php
class PagoVenta
{
	protected $cn;
	
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getPagoVenta($where = "1")
	{
		$query = "SELECT * FROM pagoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getMontosTotales($where = "0")
	{
		$query = "SELECT SUM(monto) AS montoAcumulado FROM pagoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getMontosTotales2($where = "0")
	{
		$query = "SELECT SUM(monto) AS montoAcumulado
				  FROM pagoventa AS pv INNER JOIN documentoventa as dv
				  ON pv.idDocVenta = dv.idDocVenta
				  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertPagoVenta($docVenta, $fechaVenta, $monto, $numCuenta)
	{
		if ($numCuenta != -1) {
			$query = "INSERT INTO pagoventa (idDocVenta, fecha, monto, numeroCuenta) 
					  VALUES
					  ('$docVenta', $fechaVenta, $monto, '$numCuenta')";
		}
		else {
			$query = "INSERT INTO pagoventa (idDocVenta, fecha, monto) 
					  VALUES
					  ('$docVenta', $fechaVenta, $monto)";		
		}
				  
		$this->cn->dbExecute($query);
		
		return $this->getAffectedRows();
	}
	
	public function deletePagoVenta($where = "0")
	{
		$query = "DELETE FROM pagoventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}
}
?>