<?php
require("autoCarga.php");

require("header.php");

$idCompra = $_GET['compra'];

$detalleCompra = new DetalleCompra;
$whereC = "idCompra = '$idCompra' ORDER BY item";
$rsC = $detalleCompra->getDetalleCompra($whereC);

?>
<div id="centralPanel">
	<h3 class="centrarText">Detalle de Compra N&ordm; <?php echo $idCompra; ?></h3>
	<?php
	if ($rsC->num_rows) {
	?>
		<table>
			<tr>
				<th colspan="6">Detalle de Egresos</th>
			</tr>
			<tr>
				<th>Item</th>
				<th>Tipo Egreso</th>
				<th>Cant.</th>
				<th>Precio</th>
				<th>Sub Total</th>
			</tr>
	<?php
		while($rowC = $rsC->fetch_assoc()) {
			$item = $rowC['item'];
			$idTipoCuenta = $rowC['idTipoCuenta'];
			$peso = $rowC['peso'];
			$precioUnitario = $rowC['precioUnitario'];
			$subTotal = $rowC['subTotal'];
			
			$tipoCuenta = new TipoCuenta();
			$whereTP = "idTipoCuenta = $idTipoCuenta  ";
			$rsTP = $tipoCuenta->getTipoCuenta($whereTP);
			if ($rsTP->num_rows) {
				$rowTP = $rsTP->fetch_assoc();
				$nombreTipoCuenta = $rowTP['nombreTipoCuenta'];
			}
	?>
		<tr>
			<td class="mayusculas"><?php echo $item; ?></td>
			<td><?php echo $nombreTipoCuenta; ?></td>
			<td class="mayusculas"><?php echo $peso; ?></td>
			<td class="mayusculas"><?php echo $precioUnitario; ?></td>
			<td class="mayusculas"><?php echo $subTotal; ?></td>
		</tr>	
	<?php
		}
	?>	
		</table>
	<?php
	}
	?>
	<p class="centrarText">
		<a href="gestionCompras.php"><img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Img Atras" title="Atras" /></a>	
	</p>
</div>
<?php
require("footer.php");
?>