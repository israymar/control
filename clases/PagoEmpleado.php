<?php
class PagoEmpleado
{
	private $cn;
	public function __construct()
	{
		$this->cn = new Db();
	}
	
	public function getPagoEmpleado($where = 1)
	{
		$query = "SELECT * from pagoempleado WHERE $where";
		
		return $this->cn->dbExecute($query);
	}
	
	public function insertPagoEmpleado ($periodoLaboral, $fechaPago, $monto, $observacion, $idEmpleado)
	{
		$query = "INSERT INTO pagoempleado (periodoLaboral, fechaPago, monto, observacion, idEmpleado)
					     VALUES ('$periodoLaboral', $fechaPago, $monto, '$observacion', $idEmpleado)";
		
		return $this->cn->dbExecute($query);
	}
	
	public function updatePagoEmpleado ($periodoLaboral, $fechaPago, $monto, $observacion, $idEmpleado, $where)
	{
		$query = "UPDATE pagoempleado SET periodoLaboral = '$periodoLaboral', fechaPago = $fechaPago,
										  monto = $monto, observacion = '$observacion',
										  idEmpleado = $idEmpleado
									  WHERE $where";
		return $this->cn->dbExecute($query);
	}
	
	public function deletePagoEmpleado ($where = "0") {
		$query = "DELETE FROM pagoempleado WHERE $where";
		
		return $this->cn->dbExecute($query);
	}



}
?>