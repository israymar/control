<?php
class Cuenta
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getCuenta($where = "1")
	{
		$query = "SELECT c.idProveedor, razonSocial, mumeroCuenta, banco, monedaCuenta, estadoCuenta
				  FROM cuentaproveedor AS c INNER JOIN proveedor AS p ON c.idProveedor = p.idProveedor
				  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertCuenta($numeroCuenta, $banco, $moneda, $estadoCuenta, $proveedor)
	{
		$query = "INSERT INTO cuentaproveedor (mumeroCuenta, banco, monedaCuenta, estadoCuenta, idProveedor)
				  VALUES ('$numeroCuenta', '$banco', '$moneda', '$estadoCuenta', $proveedor)";
		
		return $this->cn->dbExecute($query);	
	}
	
	public function deleteCuenta($where = "0")
	{
		$query = "DELETE FROM cuentaproveedor WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function editCuenta($numeroCuenta, $banco, $moneda, $estadoCuenta, $proveedor, $where = "0")
	{
		$query = "UPDATE cuentaproveedor SET mumeroCuenta = '$numeroCuenta',
				  banco='$banco', monedaCuenta='$moneda', estadoCuenta='$estadoCuenta',
				  idProveedor = $proveedor WHERE $where";
		
		return $this->cn->dbExecute($query);
	}

}

?>
