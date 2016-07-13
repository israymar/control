<?php
class Compra
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}

	public function getCompra($where = "1")
	{
		$query = "SELECT * FROM compra WHERE $where";
		return $this->cn->dbExecute($query);
	}
	
	public function getTotalAcumulado($where = "0")
	{
		//Ojo si despues se cambia la forma de ingresar los precios se cambiara esto
		$query = "SELECT (SUM(subTotal) + SUM(valorIgv)) AS totalAcumulado FROM compra WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertCompra($numeroCompra,$tipoDocCompra, $proveedor, $fecha, $cheque, $idIgv)
	{
		$query = "INSERT INTO compra(idCompra, tipoDocCompra, idProveedor, fechaCompra, chequeCompra, idIgv) VALUES
				  ('$numeroCompra','$tipoDocCompra', $proveedor,  $fecha, '$cheque', $idIgv)";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function deleteCompra($where = "0")
	{
		$query = "DELETE FROM compra WHERE $where";
		
		return $this->cn->dbExecute($query);
	}

	
	public function updateCompra($numeroCompra, $tipoDocCompra, $proveedor, $fecha, $cheque, $idIgv, $where = "0")
	{
		$query = "UPDATE compra SET idCompra = '$numeroCompra', tipoDocCompra = '$tipoDocCompra', idProveedor = $proveedor,
									fechaCompra = $fecha, chequeCompra = '$cheque',idIgv = $idIgv
								WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function actualizaCompraIgvSubTotal($numeroCompra, $stotal, $total, $igvAcumulado)
	{
		$query = "UPDATE compra set subTotal = $stotal, total = $total, valorIgv = $igvAcumulado
		         WHERE idCompra = '$numeroCompra'";
				 
		return $this->cn->dbExecute($query);
	}
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}

}



?>
