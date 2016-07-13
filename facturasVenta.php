<?php
require("autoCarga.php");
require("header.php");

@$page = $_GET['page'];
$cantidad = 30;

$docVenta = new DocVenta();
$cliente = new Cliente();
$generales = new Generales();

$paginacion = new Paginacion($cantidad, $page);
$from = $paginacion->getFrom();

$rsT = $docVenta->getDocVenta();
$totalFacts = $rsT->num_rows;

$where = "1 ORDER BY idDocVenta DESC LIMIT $from, $cantidad";
$rs = $docVenta->getDocVenta($where);

?>
<div id="divBloqueador"></div>
<div id="centralPanel">
	<h3 class="centrarText">Gesti&oacute;n Facturas Venta</h3>
	
	<?php
		if ($rs->num_rows) {
	?>
		<div class="divListado">
		<table class="zebra">
			<tr>
				<th colspan="8">Listado - documentos de venta</th>
			</tr>
			<tr>
				<th>Numero</th>
				<th>Fecha</th>
				<th>Cliente</th>
				<th>Tipo</th>
				<th>SubTotal</th>
				<th>Igv</th>
				<th>Total</th>
				<th>Acciones</th>
			</tr>
	<?php
		while($row = $rs->fetch_assoc()){
			$idDocVenta = $row['idDocVenta'];
			$fecha = date("d - m - Y",$row['fechaDocVenta']);
			$idCliente = $row['idCliente'];
			
			$whereC = "idCliente = $idCliente";
			$rsC = $cliente->getCliente($whereC);
			$rowC = $rsC->num_rows ? $rsC->fetch_assoc() : NULL;
			
			$nombresCliente = strtoupper($generales->configuraNombres($rowC['nombreCliente'],
																	  $rowC['apellidosCliente']));
			
			switch($row['tipoDocVenta']) {
				case "a"	:	$tipo = "Factura";
								break;
				case "b"	:	$tipo = "Boleta";
								break;
				case "c"	:	$tipo = "Ticket Venta";
								break;
			}
			$subTotal = $row['subtotal'];
			$igv = $row['valorIgv'];
			$total = $row['total'];
		
	?>
		<tr>
			<td class="mayusculas"><?php echo $idDocVenta; ?></td>
			<td class="mayusculas"><?php echo $fecha; ?></td>
			<td class="mayusculas"><?php echo $nombresCliente; ?></td>
			<td><?php echo $tipo; ?></td>
			<td class="mayusculas"><?php echo $subTotal; ?></td>
			<td class="mayusculas"><?php echo $igv; ?></td>
			<td class="mayusculas"><?php echo $total; ?></td>
			<td>
				[<a href="formIngFacturaVenta.php?docVenta=<?php echo $idDocVenta; ?>
				&page=<?php echo $page; ?>" name="itemEditar">Editar</a>]
				
				[<a href="formIngFacturaVenta.php?docVenta=<?php echo $idDocVenta; ?>
				&tipo=detalle&page=<?php echo $page; ?>" name="itemDetalle">Detalle</a>]
				
				[<a href="eliminarDocVenta.php?docVenta=<?php echo $idDocVenta; ?>"
				name="itemEliminar">Eliminar</a>]
			</td>
		</tr>
	<?php
		}//End while
	?>
	</table>
		<div class="paginacion">
		<?php
			$url = "facturasVenta.php?";
			$back = "&laquo;Atras";
			$next = "Siguiente&raquo;";
			//$class = "numPages";
			$paginacion->generaPaginacion($totalFacts, $back, $next, $url);
		?>
		</div>
	</div>
	<?php
		}
	?>
	
	<p class="centrarText">
		<a href="gestionVentas.php">
		<img src="imagenes/maquetado/escribir.jpg" height="48" width="48"
		alt="Ventas" title="Ir a Ventas" /></a>&nbsp;&nbsp;		
		<a href="ventas.php">
		<img src="imagenes/maquetado/folder_previous2.png" height="48" width="48"
		alt="Atras" title="Atras" /></a>&nbsp;&nbsp;
		<a href="formIngFacturaVenta.php?back=facturasVenta.php" id="nuevoDocVenta"><img src="imagenes/maquetado/pages_add.png"
		width="48" height="48" title="Nuevo" alt="Nuevo" /></a>
	</p>
</div>
<?php
require("footer.php");
?>