<?php
require("autoCarga.php");
include("header.php");

$idVenta = $_GET['venta'];

$detalleVenta = new DetalleVenta();

$where = "idVenta = $idVenta";

$rs = $detalleVenta->getDetalleVenta($where);

?>
<div id="centralPanel">

<h3 class="centrarText">Detalle de Ingreso N&ordm;<?php echo $idVenta;?></h3>

<?php
if ($rs->num_rows) {
?>
	<table>
		<tr>
			<th colspan="6">Detalle de Ingreso</th>
		</tr>
		<tr>
			<th>Item</th>
			<th>Tipo Cuenta</th>
			<th>Cant.</th>
			<th>Precio</th>
			<th>S. Total</th>		
		</tr>
	<?php
		while($row = $rs->fetch_assoc()) {
			$item = $row['item'];
			$cantidad = $row['cantidad'];
			$Monto = $row['monto'];
			$subTotal = $row['subtotal'];
			//$pesoNeto = $row['pesoNeto'];
			
			$proveedor = new Proveedor();
			$whereP = "idProveedor = $row[proveedor]";
			$rsP = $proveedor->getProveedor($whereP);
			$rowP = $rsP ? $rsP->fetch_assoc() : "";
			$rzProv = $rowP['razonSocial'];
			
			$tipoCuenta = new TipoCuenta();
			$whereTP = "idTipoCuenta = $row[idTipoCuenta]";
			$rsTP = $tipoCuenta->getTipoCuenta($whereTP);
			$rowTP = $rsTP ? $rsTP->fetch_assoc() :"";
			$nombreTP = $rowTP['nombreTipoCuenta'];
			
		?>
		<tr>
			<td><?php echo $item; ?></td>
			<td><?php echo $nombreTP; ?></td>
			<td><?php echo $cantidad; ?></td>
			<td><?php echo $Monto; ?></td>
			<td><?php echo $subTotal; ?></td>
			
		</tr>
		
		<?php
		}	
	?>
	
	</table>
<?php
} 
?>
	<p class="centrarText">
		<a href="gestionVentas.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>
	</p>

</div>
<?php
include("footer.php");
?>