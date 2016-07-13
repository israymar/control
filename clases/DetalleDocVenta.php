<?php
class DetalleDocVenta
{
	protected $cn;
	
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getDetDocVenta($where = "0")
	{
		$query = "SELECT * FROM detalledocventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getTotales($where = "0")
	{
		$query = "SELECT SUM(cantidad) AS cantidad, SUM(monto) AS monto FROM detalledocventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertDetDocVenta($item, $idDocVenta, $tipoCuenta, $cantidad,
	                                  $precioUnitario, $subTotal)
	{
		$query = "INSERT INTO detalledocventa (item, idDocVenta, idTipoCuenta, cantidad,
							  precioUnitario, subTotal)
							  VALUES
							  ($item, '$idDocVenta', $tipoCuenta, $cantidad,
	                           $precioUnitario, $subTotal)";
				
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	
	}
	
	public function updateDetDocVenta($tipoCuenta, $cantidad, $precioUnitario,
									 $subTotalItem, $whereDDV)
	{
		$query = "UPDATE detalledocventa SET idTipoCuenta = $tipoCuenta, cantidad = $cantidad, 
											 precioUnitario = $precioUnitario,
											 subTotal = $subTotalItem
										 WHERE $whereDDV";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function deleteDetDocVenta($where = "0")
	{
		$query = "DELETE FROM detalledocventa WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}

}

?>
