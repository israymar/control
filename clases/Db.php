<?php
class db
{
	private $cn;
	private $rs;
		
	public function __construct($serverName = "localhost", $user = "root", $pass = "root", $db = "control")
	{
		$this->cn = new mysqli($serverName, $user, $pass, $db);
	}
	
	public function dbExecute($query) {
		$this->rs = $this->cn->query($query);	
		return $this->rs;
	}
	
	public function getInsertedId()
	{
		return $this->cn->insert_id;
	}
	
	public function getAffectedRows()
	{
		return $this->cn->affected_rows;
	}
	
}
?>