<?php
class DetalleVenta
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getDetalleVenta($where = "0")
	{
		$query = "SELECT * FROM detalleventa WHERE $where";

		return $this->cn->dbExecute($query);
	}
	
	public function getDetalleVentaResumen($where = "0")
	{
		$query = "SELECT dv.idTipoCuenta, nombreTipoCuenta, sum( cantidad ) as cantidad , sum( monto ) as monto
				  FROM detalleventa AS dv INNER JOIN tipocuenta AS tp
				  ON dv.idTipoCuenta = tp.idTipoCuenta
				  WHERE $where
				  GROUP BY dv.idTipoCuenta, nombreTipoCuenta";
		
		return $this->cn->dbExecute($query);
	
	}
	public function getDetalleVentaResumen2($where = "0")
	{
		$query = "SELECT proveedor, dv.idTipoCuenta, razonSocial, nombreTipoCuenta,
				  SUM(cantidad) AS cantidadVenta
				  FROM detalleventa AS dv 
				  LEFT OUTER JOIN venta AS v ON dv.idVenta = v.idVenta  
				  INNER JOIN tipocuenta AS tp ON dv.idTipoCuenta = tp.idTipoCuenta  
				  INNER JOIN proveedor AS p ON dv.proveedor = p.idProveedor
				  INNER JOIN cliente AS c ON v.idCliente = c.idCliente
				  WHERE c.idCliente NOT IN (SELECT distinct j.idCliente
			  								FROM cliente AS c
			  								INNER JOIN cliente AS j ON c.jefeCliente = j.idCliente)
				        AND $where
				  GROUP BY razonSocial, nombreTipoCuenta 
				  ORDER BY razonSocial, nombreTipoCuenta";
				  
		return $this->cn->dbExecute($query);
	
	}
	
	public function insertDetalleVenta($idVenta, $item, $detalle, $cantidad,
					$Precio, $idTipoCuenta, $subTotal)
	{
		$query = "INSERT INTO detalleventa(idVenta, item, detalle, cantidad, monto,
				   idTipoCuenta, subtotal) VALUES
				  ($idVenta, $item, '$detalle', $cantidad, $Precio, $idTipoCuenta, $subTotal)";
		
		return $this->cn->dbExecute($query);
	}
	
	public function updateDetalleVenta($detalle, $cantidad, $Precio, 
	$idTipoCuenta, $subTotal, $where = "0")
	{
		$query = "UPDATE detalleventa SET detalle = '$detalle', cantidad = $cantidad, monto = $Precio,
										  idTipoCuenta = $idTipoCuenta, subtotal = $subTotal
										  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function deleteDetalleVenta($where = 0)
	{
		$query = "DELETE FROM detalleventa WHERE $where";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}
}
?>