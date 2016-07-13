<?php

class Usuario
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getUsuario($where)
	{
		$query = "SELECT * FROM usuario WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertUsuario($userName, $password)
	{
		$query = "INSERT INTO usuario(userName, password)
		          VALUES ('$userName', md5('$password'))";
		
		return $this->cn->dbExecute($query);
	}

}
?>