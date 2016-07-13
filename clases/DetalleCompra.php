<?php
class DetalleCompra
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getDetalleCompra($where = "0")
	{
		$query = "SELECT * FROM detallecompra WHERE $where";

		return $this->cn->dbExecute($query);
	}
	
	public function getResumenDetalleCompra($where = "0")
	{
		$query = "SELECT idTipoCuenta, SUM(dc.peso) AS pesoCompra
				  FROM detallecompra as dc
				  INNER JOIN compra as c ON dc.idCompra = c.idCompra
				  WHERE $where
				  GROUP BY idTipoCuenta";
		
		return $this->cn->dbExecute($query);
	}
	
	
	public function insertDetalleCompra($item, $numeroCompra, $idTipoCuenta, $detalle,
										$peso, $precioUnitario, $subTotal)
	{
		$query = "INSERT INTO detallecompra(item, idCompra, idTipoCuenta, detalle,
							  peso, precioUnitario, subTotal)
							  VALUES
				  			  ($item, '$numeroCompra', $idTipoCuenta, '$detalle', $peso, $precioUnitario, $subTotal)";
		
		return $this->cn->dbExecute($query);
	}
	
	public function deleteDetalleCompra($where = "0")
	{
		$query = "DELETE FROM detallecompra WHERE $where";
		
		$this->cn->dbExecute($query);
		//return $this->getAffectedRows();
	}

	
	public function updateDetalleCompra($numeroCompra, $idTipoCuenta, $detalle,
										$peso, $precioUnitario, $subTotal, $where = "0")
	{
		$query = "UPDATE detallecompra SET idCompra = '$numeroCompra', idTipoCuenta = $idTipoCuenta,
									   detalle = '$detalle', peso = $peso, precioUnitario = $precioUnitario, 
									   subTotal = $subTotal WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
}
?>