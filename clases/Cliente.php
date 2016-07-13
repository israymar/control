<?php
class Cliente
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();	
	}
	
	
	public function getCliente($where = "1")
	{
		$query = "SELECT * FROM cliente WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertCliente($dni, $nombres, $ciudad, $direccion,
								  $email, $celular, $rpm, $fax)
	{
		$query = "INSERT INTO cliente(nombreCliente, dniCliente, ciudadCliente,
				  direccionCliente, rpmCliente, telMovilCliente, fax, emailCliente)
				  VALUES ('$nombres', '$dni', '$ciudad', '$direccion', '$rpm',
				  '$celular', '$fax', '$email')";
				  
		return $this->cn->dbExecute($query);
	}
	
	public function editCliente($dni, $nombres, $ciudad, $direccion,
								$email, $celular, $rpm, $fax, $where = "0")
	{
		$query = "UPDATE cliente SET nombreCliente = '$nombres',
						 dniCliente = '$dni', ciudadCliente = '$ciudad', direccionCliente = '$direccion',
						 rpmCliente = '$rpm', telMovilCliente = '$celular', fax = '$fax',
						 emailCliente = '$email' WHERE $where";
		
		return $this->cn->dbExecute($query);
	
	}
	
	
	public function deleteCliente($where = "0")
	{
		$query = "DELETE FROM cliente WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	
public function getJefeCliente($where = "0")
	{
		$query = "SELECT DISTINCT j.idCliente, j.nombreCliente, j.apellidosCliente
				  FROM cliente as c INNER JOIN cliente as j on c.jefeCliente = j.idCliente
				  WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	
	public function setJefe($cliente, $jefe)
	{
		$jefe = ($jefe == 0) ? 'NULL' : $jefe;
		$query = "UPDATE cliente SET jefeCliente = $jefe WHERE idCliente = $cliente";
		
		//echo $query;
		return $this->cn->dbExecute($query);
	}
	
	
	public function getUltimoClienteIngresado()
	{
		return $this->cn->getInsertedId();
	}
}
?>
