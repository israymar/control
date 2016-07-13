<?php
class Proveedor
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}	
	
	public function getProveedor($where = "1")
	{
		$query = "SELECT * FROM proveedor WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertProveedor($ruc, $razonSocial, $direccion, $ciudad, $telefono, $fax)
	{
		$query = "INSERT INTO proveedor (RUC, razonSocial, direccion, ciudad, telefono,  fax)
				  VALUES ('$ruc', '$razonSocial', '$direccion', '$ciudad', '$telefono', '$fax')";
		
		return $this->cn->dbExecute($query);
	}
	
	public function deleteProveedor($where = "0")
	{
		$query = "DELETE FROM proveedor WHERE $where";
		
		$this->cn->dbExecute($query);
		return $this->getAffectedRows();
	}
	
	public function editarProveedor($ruc, $razonSocial, $direccion, $ciudad, $telefono, $fax, $where = 0) {
		$query = "UPDATE proveedor SET RUC = '$ruc',
				  razonSocial = '$razonSocial',
				  direccion = '$direccion',
				  ciudad = '$ciudad',
				  telefono = '$telefono',
				  fax = '$fax'
				  
				  WHERE $where";
				
		return $this->cn->dbExecute($query);
	}
	
	protected function getAffectedRows()
	{
		return $this->cn->getAffectedRows();
	}
	
}

?>
