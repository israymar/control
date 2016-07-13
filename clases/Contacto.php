<?php
class Contacto
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getContacto($where = 1)
	{
		$query = "SELECT idContacto, nombresContacto, apellidosContacto, dniContacto,
				  direccionContacto, telContacto, movilContacto, rpmContacto, mailContacto, c.idProveedor, razonSocial
				  FROM contactoproveedor AS c INNER JOIN proveedor as p ON c.idProveedor = p.idProveedor WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertContacto($nombres, $apellidos, $dni, $direccion, $telefono, $celular, $rpm, $email, $proveedor)
	{
		$query = "INSERT INTO contactoproveedor(nombresContacto, apellidosContacto, dniContacto, direccionContacto,
				  telContacto, movilContacto, rpmContacto, mailContacto, idProveedor) VALUES
				  ('$nombres', '$apellidos', '$dni', '$direccion', '$telefono', '$celular', '$rpm', '$email', $proveedor)";
		
		return $this->cn->dbExecute($query);
	}
	
	public function editContacto($nombres, $apellidos, $dni, $direccion, $telefono, $celular, $rpm, $email, $proveedor, $where)
	{
		$query = "UPDATE contactoproveedor SET nombresContacto = '$nombres', apellidosContacto = '$apellidos',
				  dniContacto = '$dni', direccionContacto = '$direccion', telContacto = '$telefono',
				  movilContacto = '$celular', rpmContacto = '$rpm', mailContacto = '$email', idProveedor = $proveedor
				  WHERE $where";
				  
		return $this->cn->dbExecute($query);
	}
	
	public function deleteContacto($where = "0")
	{
		$query = "DELETE FROM contactoproveedor WHERE $where";
		
		return $this->cn->dbExecute($query);
	}

}
