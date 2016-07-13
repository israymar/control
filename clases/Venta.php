<?php
class Venta
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getVenta($where = "1")
	{
		$query = "SELECT * FROM venta WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getConsVentasSubCliente($where = "0")
	{
		$query = "SELECT idTipoPollo, SUM(cantidad) AS cantidad, SUM(monto) AS pesoPesada
				  FROM detalleventa AS dv 
				  INNER JOIN venta AS v ON dv.idVenta = v.idVenta 
				  INNER JOIN cliente AS c ON v.idCliente = c.idCliente 
				  INNER JOIN cliente AS j ON c.jefeCliente = j.idCliente 
				  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function getVentasSubCliente($where = "0")
	{
		$query = "SELECT v.idVenta, nombreLugar, nombreCliente, apellidosCliente,
				  nombreTipoPollo,SUM(cantidad) AS cantidad
				  FROM cliente AS c INNER JOIN venta AS v ON c.idCliente = v.idCliente
				  INNER JOIN detalleventa AS dv ON v.idVenta = dv.idVenta
				  INNER JOIN tipocuenta AS tp ON dv.idTipoCuenta = tp.idTipoCuenta
				  INNER JOIN lugar as cam ON v.idLugar = cam.idLugar
				  WHERE $where
				  GROUP BY nombreCliente, apellidosCliente, nombreTipoCuenta
				  ORDER BY apellidosCliente";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertVenta($docVenta, $tipoDocVenta, $fechaVenta, $cliente, $lugar, $notas, $idIgv)
	{
		$query = "INSERT INTO venta(idDocVenta, tipoDocVenta, fechaVenta, idCliente, idLugar, notas, idIgv) VALUES
				  ('$docVenta', '$tipoDocVenta', $fechaVenta, $cliente, $lugar, '$notas', $idIgv)";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function updateVenta($docVenta, $tipoDocVenta, $fechaVenta, $cliente, $lugar, $notas, $idIgv, $where = "0")
	{
		$query = "UPDATE venta SET idDocVenta = '$docVenta', tipoDocVenta = '$tipoDocVenta', fechaVenta = $fechaVenta, idCliente = $cliente,
									idLugar = $lugar, notas = '$notas', idIgv = $idIgv  WHERE $where";
							   
		
		return $this->cn->dbExecute($query);
	}
	
	public function deleteVenta($where = 0)
	{
		$query = "DELETE FROM venta WHERE $where";
		
		return $this->cn->dbExecute($query);
	}

	public function actualizaVentaIgvSubTotal($idVenta, $sTotal, $Total, $igvAcumulado)
	{
		$query = "UPDATE venta set subtotal = $sTotal, total = $Total, valorIgv = $igvAcumulado
		         WHERE idVenta = $idVenta";
				 
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
