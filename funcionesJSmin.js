 function activaTeclasDetalleCompra()
{
var oEvent=arguments[0]||window.event;
var tecla=oEvent.keyCode;var trActual=null;

if (this.name=="precioUnitarioDet[]")
{
if(tecla==9){trActual=this.parentNode.parentNode;
	var nuevoTr=trActual.cloneNode(true);
	var nuevosInput=nuevoTr.getElementsByTagName('input');
	
		for(var i=0;i<nuevosInput.length;i++){nuevosInput[i].value="";}
			nuevosInput[0].onkeyup=activaTeclasDetalleCompra;
			nuevosInput[1].onkeyup=activaTeclasDetalleCompra;
			nuevosInput[2].onkeyup=activaTeclasDetalleCompra;
		var bodyTabla=document.getElementById("bodyTablaDetalle");
			bodyTabla.appendChild(nuevoTr);
}}

if(
(tecla>=48&&tecla<=57)||(tecla>=96&&tecla<=105)||tecla==8||
	tecla==46||tecla==188||tecla==190)
	{
	trActual=this.parentNode.parentNode;
	var peso=trActual.cells[2].firstChild.value*1;
	var precioUnit=trActual.cells[3].firstChild.value*1;
	var campoSubTotalItem=trActual.cells[4].firstChild;
	campoSubTotalItem.value=peso*precioUnit;
	
	///////obtener subtotal igv  y total////////////////////////
	var totalCompra=0;
	var aSubTotales=document.getElementsByName("subTotalDet[]");
		for(var i=0;i<aSubTotales.length;i++){totalCompra+=aSubTotales[i].value*1;}
		
	var valorIgv=document.getElementById("valorIgv").value;
	
	var subTotalCompra=totalCompra/1.18;
	var igvCompra=subTotalCompra*valorIgv;

	var textSubTotal=document.createTextNode(subTotalCompra.toFixed(2));
	var textIgv=document.createTextNode(igvCompra.toFixed(2));
	var textTotal=document.createTextNode(totalCompra.toFixed(2));
	
	////////////////////////////////////////////////////////////////////////////////
	var textSubTotalVenta=document.getElementById("subTotalCompra");
		textSubTotalVenta.innerHTML="";
		textSubTotalVenta.appendChild(textSubTotal);
		
	var textIgvVenta=document.getElementById("igvCompra");
		textIgvVenta.innerHTML="";
		textIgvVenta.appendChild(textIgv);
		
	var textTotalVenta=document.getElementById("totalCompra");
		textTotalVenta.innerHTML="";
		textTotalVenta.appendChild(textTotal);
		
}}
////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

function activaTeclasDetalleVenta()

{var oEvent=arguments[0]||window.event;
var tecla=oEvent.keyCode;var trActual=null;if(this.name=="cantidadDet[]"){
if(tecla==9){trActual=this.parentNode.parentNode;
var nuevoTr=trActual.cloneNode(true);

var nuevosInput=nuevoTr.getElementsByTagName('input');
for(var i=0;i<nuevosInput.length;i++){nuevosInput[i].value="";}
nuevosInput[0].onkeyup=activaTeclasDetalleVenta;
nuevosInput[1].onkeyup=activaTeclasDetalleVenta;
nuevosInput[2].onkeyup=activaTeclasDetalleVenta;
nuevosInput[3].onkeyup=activaTeclasDetalleVenta;
var bodyTabla=document.getElementById("bodyTablaDetalle");
bodyTabla.appendChild(nuevoTr);}}

if((tecla>=48&&tecla<=57)||(tecla>=96&&tecla<=105)||
	tecla==8||tecla==46||tecla==188||tecla==190){
var trActual=this.parentNode.parentNode;
//var detalle=trActual.cells[1].firstChild.value;
var cantidad=trActual.cells[2].firstChild.value;
var precio=trActual.cells[3].firstChild.value;
var campoPromedio=trActual.cells[4].firstChild;

campoPromedio.value=(precio*cantidad).toFixed(2);

		///////////////////obtener el total***************************************************	
				
			var totalIng=0;
			var aSubTotales=document.getElementsByName("subTotalDet[]");
				for(var i=0;i<aSubTotales.length;i++){totalIng+=aSubTotales[i].value*1;}
		
	var valorIgv=document.getElementById("valorIgv").value;
	
	var subTotalIng=totalIng/1.18;
	var igvIng=subTotalIng*valorIgv;

	var textSubTotal=document.createTextNode(subTotalIng.toFixed(2));
	var textIgv=document.createTextNode(igvIng.toFixed(2));
	var textTotal=document.createTextNode(totalIng.toFixed(2));
	
	////////////////////////////////////////////////////////////////////////////////
	var textSubTotalVenta=document.getElementById("subTotalIng");
		textSubTotalVenta.innerHTML="";
		textSubTotalVenta.appendChild(textSubTotal);
		
	var textIgvVenta=document.getElementById("igvIng");
		textIgvVenta.innerHTML="";
		textIgvVenta.appendChild(textIgv);
		
	var textTotalVenta=document.getElementById("totalIng");
		textTotalVenta.innerHTML="";
		textTotalVenta.appendChild(textTotal);


}}
//////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

function activaTeclasDetalleDocVenta(){var oEvent=arguments[0]||window.event;var tecla=oEvent.keyCode;var trActual=null;if(this.name=="precioPeladaDet[]"){if(tecla==9){trActual=this.parentNode.parentNode;var nuevoTr=trActual.cloneNode(true);var nuevosInput=nuevoTr.getElementsByTagName('input');for(var i=0;i<nuevosInput.length;i++){if(i!=3){nuevosInput[i].value="";}
else{nuevosInput[i].value=0;}}
nuevosInput[1].onkeyup=activaTeclasDetalleDocVenta;nuevosInput[2].onkeyup=activaTeclasDetalleDocVenta;nuevosInput[3].onkeyup=activaTeclasDetalleDocVenta;var bodyTabla=document.getElementById("bodyTablaDetalle");bodyTabla.appendChild(nuevoTr);}}
if((tecla>=48&&tecla<=57)||(tecla>=96&&tecla<=105)||tecla==8||tecla==46||tecla==188||tecla==190){trActual=this.parentNode.parentNode;var cantidad=trActual.cells[1].firstChild.value;var peso=trActual.cells[2].firstChild.value;var precioUnit=trActual.cells[3].firstChild.value;var precioPelada=parseFloat(trActual.cells[4].firstChild.value);var subTotal=trActual.cells[5].firstChild;subTotal.value=(peso*precioUnit+precioPelada*cantidad).toFixed(2);
var aSubTotal=document.getElementsByName("subTotalDet[]");
var vSubTotal=0;
for(var i=0;i<aSubTotal.length;i++){vSubTotal+=aSubTotal[i].value?parseFloat(aSubTotal[i].value):0;}
vSubTotal=vSubTotal.toFixed(2)*1;
var vIgv=document.getElementById('igv').value;
var igvAcumulado=vSubTotal*vIgv;igvAcumulado=igvAcumulado.toFixed(2)*1;
var vTotal=vSubTotal+igvAcumulado;vTotal=vTotal.toFixed(2);
var textSubTotal=document.createTextNode(vSubTotal);
var textIgv=document.createTextNode(igvAcumulado);
var textTotal=document.createTextNode(vTotal);
var textSubTotalVenta=document.getElementById("subTotalVenta");
textSubTotalVenta.innerHTML="";textSubTotalVenta.appendChild(textSubTotal);
var textIgvVenta=document.getElementById("igvVenta");textIgvVenta.innerHTML="";
textIgvVenta.appendChild(textIgv);
var textTotalVenta=document.getElementById("totalVenta");textTotalVenta.innerHTML="";
textTotalVenta.appendChild(textTotal);}}

////////////////////////////////////////////////////////////////////////////////
function consolidaVentasSubCliente()
{var diaVenta=document.getElementById("diaVenta").value;
var mesVenta=document.getElementById("mesVenta").value;
var yearVenta=document.getElementById("yearVenta").value;
var idCliente=document.getElementById("cliente").value;
var queryString="?idCliente="+idCliente+"&diaVenta="+diaVenta+"&mesVenta="+mesVenta+"&yearVenta="+yearVenta;
var serverAddress="consolidaVentasSubCliente.php"+queryString;
var cargador=new net.CargadorContenidos(serverAddress,cargaConsolidacionVentas,false,"GET");}

function cargaConsolidacionVentas()
{var text=this.req.responseText;var bodyTable=document.getElementById("bodyTablaDetalle");if(text){var oText=JSON.parse(text);var trO=bodyTable.getElementsByTagName("tr")[0];var newTr=trO.cloneNode(true);bodyTable.innerHTML="";for(var key in oText){var idTipoCuenta=oText[key].idTipoCuenta;var cantidad=oText[key].cantidad
var pesoPesada=oText[key].pesoPesada;var pesoJava=oText[key].pesoJava;var pesoNeto=oText[key].pesoNeto;var promedio=oText[key].promedio;var trInsert=newTr.cloneNode(true);trInsert.cells[0].firstChild.value=idTipoCuenta;var inputs=trInsert.getElementsByTagName("input");inputs[0].value=cantidad;inputs[1].value=pesoPesada;inputs[2].value=pesoJava;inputs[3].value=pesoNeto;inputs[4].value=promedio;inputs[0].onkeyup=activaTeclasDetalleVenta;inputs[1].onkeyup=activaTeclasDetalleVenta;inputs[2].onkeyup=activaTeclasDetalleVenta;bodyTable.appendChild(trInsert);}}
else{}}

function muestraTotalesPagosVenta()
{var valorLista=this.value;var fieldsetValores=document.getElementById("fieldsetMontosActuales");if(valorLista==-1){fieldsetValores.style.display="none";}
else{fieldsetValores.style.display="block";var serverAddress="totalesPagoVenta.php?idDocVenta="+valorLista+"&rand="+Math.random();var cargador=new net.CargadorContenidos(serverAddress,actualizaPagosTotales,false,"GET");}}

function actualizaPagosTotales()
{var text=this.req.responseText;var oTotales=JSON.parse(text);var totalVenta=oTotales.totalVenta;var montoAcumulado=oTotales.montoAcumulado;var oTextTotalVenta=document.getElementById('textTotalVenta');var oTextMontoAcumulado=document.getElementById('textMontoAcumulado');var textTotalVenta=oTextTotalVenta.firstChild.nodeValue;var textMontoAcumulado=oTextMontoAcumulado.firstChild.nodeValue;textTotalVenta=textTotalVenta.substr(0,(textTotalVenta.indexOf(":")+1));textMontoAcumulado=textMontoAcumulado.substr(0,(textMontoAcumulado.indexOf(":")+1));oTextTotalVenta.innerHTML=textTotalVenta+" "+totalVenta;oTextMontoAcumulado.innerHTML=textMontoAcumulado+" "+montoAcumulado;}

function cargaReporteVentas()
{if(this.id=="diaBuscar"||this.id=="mesBuscar"||this.id=="yearBuscar"||this==window){var diaBuscar=document.getElementById("diaBuscar").value;var mesBuscar=document.getElementById("mesBuscar").value;var yearBuscar=document.getElementById("yearBuscar").value;var queryString="?diaBuscar="+diaBuscar+"&mesBuscar="+mesBuscar+"&yearBuscar="+yearBuscar;var serverAddress="cargarReporteVentas.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaReporteVentas,false,"GET",false,false,functionLoading);}
else{var idCliente=document.getElementById("cliente").value;if(idCliente>0){var diaBuscarF=document.getElementById("diaBuscarF").value;var mesBuscarF=document.getElementById("mesBuscarF").value;var yearBuscarF=document.getElementById("yearBuscarF").value;var diaBuscarT=document.getElementById("diaBuscarT").value;var mesBuscarT=document.getElementById("mesBuscarT").value;var yearBuscarT=document.getElementById("yearBuscarT").value;var queryString="?idCliente="+idCliente+"&diaBuscarF="+diaBuscarF+"&mesBuscarF="+mesBuscarF;queryString+="&yearBuscarF="+yearBuscarF+"&diaBuscarT="+diaBuscarT+"&mesBuscarT="+mesBuscarT;queryString+="&yearBuscarT="+yearBuscarT;var serverAddress="cargarReporteVentas2.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaReporteVentas2,false,"GET",false,false,functionLoading);}
else{var mensaje="<p class=\"centrarText\">- - -Porfavor llene los";mensaje+="parámetros adecuados para su B&uacute;queda - - -</p>";document.getElementById("divReportes").innerHTML=mensaje;}}}

function actualizaReporteVentas()
{var text=this.req.responseText;var elementLoading=document.getElementById("divReportes");
if(text){var oText=JSON.parse(text);var tabla="<table class=\"expandida zebra\"><thead><tr>";
tabla+="<th>Cliente</th>";tabla+="<th>Cantidad</th>";tabla+="<th>Peso Tot</th>";
tabla+="<th>P. Venta</th>";tabla+="<th>Saldo Ant</th>";tabla+="<th>C.Total</th>";
tabla+="<th>Pago</th>";tabla+="<th>Saldo Act</th>";tabla+="</tr></thead><tbody>";
var classTr="claro";
var totalCantidad=totalPeso=totalTotalDV=totalSaldoAnt=totalTotal=totalPagoActual=totalSaldoAct=0;
for(key in oText){tabla+="<tr class=\""+classTr+"\">";tabla+="<td>"+oText[key].cliente+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].cantidad+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].peso+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].totalDV+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].saldoAnt+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].total+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].pagoActual+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].saldoAct+"</td>"
tabla+="</tr>";classTr=(classTr=="claro")?"oscuro":"claro";
totalCantidad+=parseFloat(oText[key].cantidad);totalPeso+=parseFloat(oText[key].peso);
totalTotalDV+=parseFloat(oText[key].totalDV);totalSaldoAnt+=parseFloat(oText[key].saldoAnt);
totalTotal+=parseFloat(oText[key].total);totalPagoActual+=parseFloat(oText[key].pagoActual);
totalSaldoAct+=parseFloat(oText[key].saldoAct);}
tabla+="</tbody><tbody class=\"negrita\">";
tabla+="<tr><td>Totales</td>";tabla+="<td class=\"numeros\">"+totalCantidad.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalPeso.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalTotalDV.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalSaldoAnt.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalTotal.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalPagoActual.toFixed(2)+"</td>";
tabla+="<td class=\"numeros\">"+totalSaldoAct.toFixed(2)+"</td>";
tabla+="</tbody></table>";elementLoading.innerHTML=tabla;
var oDiv=document.createElement("div");oDiv.className="centrarText imprimir";
var oPrint=document.createElement("img");oPrint.src="imagenes/maquetado/print.jpg";oPrint.width="32";oPrint.height="32";oPrint.alt="Imprimir";oPrint.title="Imprimir reporte";oPrint.onclick=function(){var diaReporte=document.getElementById("diaBuscar").value;var mesReporte=document.getElementById("mesBuscar").value;var yearReporte=document.getElementById("yearBuscar").value;fechaVenta=diaReporte+"/"+mesReporte+"/"+yearReporte;abrirVentanaImprimir(fechaVenta);}
oDiv.appendChild(oPrint);elementLoading.appendChild(oDiv);}
else{elementLoading.innerHTML="<p class='centrarText'>Disculpe, pero no existen valores para esta fecha...</p>";}}

function abrirVentanaImprimir()
{
	var fechaReporte=arguments[0]
	var cliente=arguments[1]||"";
	var gAutoPrint=true;(function printSpecial(){
if(document.getElementById!=null){
	var html="<HTML><HEAD>";html+='<style type="text/css">';
		html+="table {font-size:0.9em; border-collapse:collapse; margin:0 auto; }";
		html+="table th {background:#006699; color:#FFFFFF; padding:0.1em .5em; border:1px solid #999999; font-size:.9em; }";html+="table td {padding:0.1em .5em; border:1px solid #999999; }";html+=".numeros, table td.mayusculas {font-size:.85em; }";html+="tbody.resumenVenta td { border:none; font-weight:bold; padding-right:1em;}";html+=".tablaRepDeposito { float:left; margin-left:2em; width:45%; }";html+=".zebra tr:hover { background:#B1CEEB; }";html+=".oscuro {background:#E4EBFA;}";html+=".expandida { width:92%;}";html+=".negrita { font-weight:bold; }";html+=".centrarText {text-align:center;}";html+=".imprimir{display : none; }";html+="</style>";html+="</HE"+"AD><BODY>";var printReadyElem=document.getElementById("divReportes");if(printReadyElem!=null){html+="<h3 class=\"centrarText\">Reporte de ventas: "+cliente+" "+fechaReporte+"</h3>";html+=printReadyElem.innerHTML;}
else{alert("No se encuentra el texto a imprimir en el codigo HTML");return;}
		html+="</BO"+"DY></HT"+"ML>";
	var printWin=window.open("","printSpecial","width= 800, height=450, toolbar=no, menubar=yes");
		printWin.document.open();printWin.document.write(html);printWin.document.close();
if(gAutoPrint)
		printWin.print();}
else{alert("Lo sentimos, pero su navegador no soporta esta opción.");}})();}

function actualizaReporteVentas2(){var text=this.req.responseText;var elementLoading=document.getElementById("divReportes");if(text){var oText=JSON.parse(text);var tabla="<table class=\"expandida zebra\"><thead><tr>";tabla+="<th>Fecha</th>";tabla+="<th>Cantidad</th>";tabla+="<th>Peso Tot</th>";tabla+="<th>P. Venta</th>";tabla+="<th>Saldo Ant</th>";tabla+="<th>C.Total</th>";tabla+="<th>Pago</th>";tabla+="<th>Saldo Act</th>";tabla+="</tr></thead><tbody>";var classTr="claro";for(key in oText){tabla+="<tr class=\""+classTr+"\">";tabla+="<td>"+oText[key].fecha+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].cantidad+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].peso+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].totalDV+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].saldoAnt+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].total+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].pagoActual+"</td>"
tabla+="<td class=\"numeros\">"+oText[key].saldoAct+"</td>"
tabla+="</tr>";classTr=(classTr=="claro")?"oscuro":"claro";}
tabla+="</tbody></table>";elementLoading.innerHTML=tabla;}
else{elementLoading.innerHTML="<p class='centrarText'>Disculpe, pero no existen valores para esta fecha...</p>";}}

function cargaReporteCompraVenta()
{var diaF=document.getElementById("diaBuscarF").value;var mesF=document.getElementById("mesBuscarF").value;var yearF=document.getElementById("yearBuscarF").value;var diaT=document.getElementById("diaBuscarT").value;var mesT=document.getElementById("mesBuscarT").value;var yearT=document.getElementById("yearBuscarT").value;var idProveedor=document.getElementById("proveedor").value;var queryString="?idProveedor="+idProveedor+"&diaF="+diaF+"&mesF="+mesF+"&yearF="+yearF;queryString+="&diaT="+diaT+"&mesT="+mesT+"&yearT="+yearT;var serverAddress="cargaRepCompraVenta.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaCompraVenta,false,"GET",false,false,functionLoading);}

function actualizaCompraVenta(){var text=this.req.responseText;var elementLoading=document.getElementById("divReportes");if(text){var oText=JSON.parse(text);var table=document.createElement("table");table.className="expandida zebra";crearThead.call(table,[["Fecha","Saldo Ant","M Deposit","M Compra","Saldo Act","Acciones"]]);var tBody=document.createElement("tbody");tBody.className="numeros";table.appendChild(tBody);var classTr="claro";for(key in oText){var oLinkDetalle=document.createElement("a");oLinkDetalle.href="#";oLinkDetalle.className=oText[key].fecha;oLinkDetalle.onmouseover=cargaDetalleCompraVenta;oLinkDetalle.onmouseout=ocultaDiv;oLinkDetalle.appendChild(document.createTextNode("Detalle"));var rowInsert=[oText[key].fecha,oText[key].saldoAnt,oText[key].mDepositado,oText[key].mCompra,oText[key].saldoActual,oLinkDetalle];insertTr.call(tBody,rowInsert,classTr);classTr=(classTr=="claro")?"oscuro":"claro";}
elementLoading.innerHTML="";elementLoading.appendChild(table);}
else{elementLoading.innerHTML="<p class='centrarText'>Disculpe, pero no existen valores para esta fecha...</p>";}}

function cargaDetalleCompraVenta(){var fechaCompra=this.className.split(" - ");var idProveedor=document.getElementById("proveedor").value;var queryString="?t=detCompraVenta&diaBuscar="+fechaCompra[0]+"&mesBuscar="+fechaCompra[1]+"&yearBuscar="+fechaCompra[2]+"&idProveedor="+idProveedor;var serverAddress="cargaDetReporteDepositos.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaReporteDetCompraVenta,false,"GET",false,false,functionLoading2);var oEvent=arguments[0]||window.event;var divDetalle=document.getElementById("divDetalle");muestraOcultaElemento(divDetalle);var posX=oEvent.clientX;var posY=oEvent.clientY;divDetalle.style.top=posY-170+"px";divDetalle.style.left=posX-420+"px";}

function actualizaReporteDetCompraVenta()
{var text=this.req.responseText;var divDetalle=document.getElementById("divDetalle");if(text){var oText=JSON.parse(text);var table=document.createElement("table");table.className="expandida zebra numeros";crearThead.call(table,[["Depositos relizados este dia"],["num Recibo","Fecha","Monto"]]);classTr="claro";var fechaCV="";var oFecha;for(var key in oText){oFecha=new Date(oText[key].fechaReciboCompra*1000);fechaCV=oFecha.getDate()+" - "+(oFecha.getMonth()+1)+" - "+oFecha.getFullYear();insertTr.call(table,[oText[key].idReciboCompra,fechaCV,oText[key].montoReciboCompra],classTr);classTr=(classTr=="claro")?"oscuro":"claro";}
divDetalle.innerHTML="";divDetalle.appendChild(table);}
else{divDetalle.innerHTML="--- No ser realizaron pagos a este proveedor en esta fecha --";}}

function cargaReporteMovimientos()
{var campo=this.id;if(campo=="diaBuscar"||campo=="mesBuscar"||campo=="yearBuscar"){var diaBuscar=document.getElementById("diaBuscar").value;var mesBuscar=document.getElementById("mesBuscar").value;var yearBuscar=document.getElementById("yearBuscar").value;var queryString="?diaBuscar="+diaBuscar+"&mesBuscar="+mesBuscar+"&yearBuscar="+yearBuscar;}
else{var diaBuscarF=document.getElementById("diaBuscarF").value;var mesBuscarF=document.getElementById("mesBuscarF").value;var yearBuscarF=document.getElementById("yearBuscarF").value;var diaBuscarT=document.getElementById("diaBuscarT").value;var mesBuscarT=document.getElementById("mesBuscarT").value;var yearBuscarT=document.getElementById("yearBuscarT").value;var queryString="?diaBuscarF="+diaBuscarF+"&mesBuscarF="+mesBuscarF+"&yearBuscarF="+
yearBuscarF+"&diaBuscarT="+diaBuscarT+"&mesBuscarT="+mesBuscarT+"&yearBuscarT="+yearBuscarT;}
var serverAddress="cargarReporteDepositos.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaReporteMovimientos,false,"GET",false,false,functionLoading);}

function cargaReporteSubClientes()
{var diaBuscar=document.getElementById("diaBuscar").value;var mesBuscar=document.getElementById("mesBuscar").value;var yearBuscar=document.getElementById("yearBuscar").value;var cliente=document.getElementById("cliente").value;var queryString="?diaBuscar="+diaBuscar+"&mesBuscar="+mesBuscar+"&yearBuscar="+yearBuscar+"&idCliente="+cliente;var serverAddress="cargaReporteSubClientes.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,actualizaReporteSubClientes,false,"GET",false,false,functionLoading);}

function actualizaReporteSubClientes()
{var text=this.req.responseText;elementLoading=document.getElementById("divReportes");if(text){var oText=JSON.parse(text);var table1=document.createElement("table");table1.className="tablaRepDeposito";crearThead.call(table1,[["Cliente","Lugar","TipoCuenta","Cant","Peso"]]);var table2=document.createElement("table");crearThead.call(table2,[["Cliente","Lugar","TipoCuenta","Cant","Peso"]]);table2.className="tablaRepDeposito";var tableInsert="";var numVentaAnt=0;var numVenta=0;var tableAnt=table1;for(var key in oText){numVenta=oText[key].idVenta;numVentaAnt=(key>0)?oText[key-1].idVenta:oText[key].idVenta;if(numVenta==numVentaAnt){tableInsert=(tableAnt==table1)?table1:table2;tableAnt=tableInsert;}
else{tableInsert=(tableAnt==table1)?table2:table1;tableAnt=tableInsert;}
var newTr=[oText[key].nombresCliente,oText[key].cam,oText[key].tipoCuenta,oText[key].cantidad,oText[key].peso];insertTr.call(tableInsert,newTr,"numeros");}
elementLoading.innerHTML="";elementLoading.appendChild(table2);elementLoading.appendChild(table1);var oDiv=document.createElement("div");oDiv.className="clearFloat centrarText imprimir";var oPrint=document.createElement("img");oPrint.src="imagenes/maquetado/print.jpg";oPrint.width="32";oPrint.height="32";oPrint.alt="Imprimir";oPrint.title="Imprimir reporte";oPrint.onclick=function(){var cliente=document.getElementById("cliente");var diaReporte=document.getElementById("diaBuscar").value;var mesReporte=document.getElementById("mesBuscar").value;var yearReporte=document.getElementById("yearBuscar").value;var fechaVenta=diaReporte+"/"+mesReporte+"/"+yearReporte;var nombreCliente=cliente.options[cliente.selectedIndex].text;abrirVentanaImprimir(fechaVenta,nombreCliente);}
oDiv.appendChild(oPrint);elementLoading.appendChild(oDiv);}
else{var msg="Disculpe, pero no existen valores para este cliente en esta fecha...";elementLoading.innerHTML="<p class='centrarText'>"+msg+"</p>";}}

function crearThead(thead)
{if(thead.length){
var numCols=0;
var tHead=document.createElement("thead");
for(var row in thead){numCols=(numCols<thead[row].length)?thead[row].length:numCols;}
for(var row in thead){var trH=document.createElement("tr");
for(var cell in thead[row]){var thH=document.createElement("th");
if(thead[row].length==1){thH.setAttribute("colspan",numCols);}
thH.appendChild(document.createTextNode(thead[row][cell]));trH.appendChild(thH);}
tHead.appendChild(trH);}
this.appendChild(tHead);}
return true;}

function insertTr(tr,classN){
if(tr.length){
var trB=document.createElement("tr");
if(classN){trB.className=classN;}
for(var row in tr){
var tdB=document.createElement("td");
if(typeof(tr[row])=="string"){tdB.appendChild(document.createTextNode(tr[row]));}
else{tdB.appendChild(tr[row]);}
trB.appendChild(tdB);}
this.appendChild(trB);}
return true;}

function actualizaReporteMovimientos()
{var text=this.req.responseText;var elementLoading=document.getElementById("divReportes");if(text){var oText=JSON.parse(text);var tabla=document.createElement("table");tabla.className="tablaRepDeposito";crearThead.call(tabla,[["Salidas"],["Fecha","Cantidad","Peso","Acciones"]]);var tBody=document.createElement("tbody");var classTr="claro";var salidas=oText.salidas;for(var key in salidas){var oLinkDetalle=document.createElement("a");oLinkDetalle.href="#";oLinkDetalle.className=salidas[key].idDeposito;oLinkDetalle.onmouseover=cargaDetalleDeposito;oLinkDetalle.onmouseout=ocultaDiv;oLinkDetalle.appendChild(document.createTextNode("Detalle"));insertTr.call(tBody,[salidas[key].fecha,salidas[key].cantidad,salidas[key].peso,oLinkDetalle],classTr);classTr=(classTr=="claro")?"oscuro":"claro";}
tabla.appendChild(tBody);var tabla2=document.createElement("table");tabla2.className="tablaRepDeposito";crearThead.call(tabla2,[["Ingresos"],["Fecha","Cantidad","Peso","Acciones"]]);var tBody2=document.createElement("tbody");var classTr="claro";var ingresos=oText.ingresos;for(var key in ingresos){var oLinkDetalle2=document.createElement("a");oLinkDetalle2.href="#";oLinkDetalle2.className=ingresos[key].idDeposito;oLinkDetalle2.onmouseover=cargaDetalleDeposito;oLinkDetalle2.onmouseout=ocultaDiv;oLinkDetalle2.appendChild(document.createTextNode("Detalle"));insertTr.call(tBody2,[ingresos[key].fecha,ingresos[key].cantidad,ingresos[key].peso,oLinkDetalle2],classTr);classTr=(classTr=="claro")?"oscuro":"claro";}
tabla2.appendChild(tBody2);elementLoading.innerHTML="";elementLoading.appendChild(tabla);elementLoading.appendChild(tabla2);}
else{elementLoading.innerHTML="<p class='centrarText'>Disculpe, pero no existen valores para esta fecha...</p>";}}

function actualizaDetReporteMovimientos()
{var text=this.req.responseText;if(text){var oText=JSON.parse(text);var table=document.createElement("table");table.className="numeros";crearThead.call(table,[["Detalle Deposito"],["TipoCuenta","Proveedor","Cantidad","P Bruto","P Java","P Neto"]]);var tBody=document.createElement("tbody");var classTr="claro";for(var key in oText){insertTr.call(tBody,[oText[key].nombreTipoCuenta,oText[key].razonSocial,oText[key].cantidad,oText[key].pesoBruto,oText[key].pesoJava,oText[key].pesoNeto],classTr);classTr=(classTr=="claro")?"oscuro":"claro";}
table.appendChild(tBody);var divDetalle=document.getElementById("divDetalle");divDetalle.innerHTML="";divDetalle.appendChild(table);}}

function cargaReporteConsolidados(){var opcion=this.id;if(opcion=="mesBuscar"||opcion=="diaBuscar"||opcion=="yearBuscar"||this==window){var diaBuscar=document.getElementById("diaBuscar").value;var mesBuscar=document.getElementById("mesBuscar").value;var yearBuscar=document.getElementById("yearBuscar").value;var queryString="?diaBuscar="+diaBuscar+"&mesBuscar="+mesBuscar+"&yearBuscar="+yearBuscar;var fHandler=actualizaReporteConsolidados1;}
else{var diaF=document.getElementById("diaBuscarF").value;var mesF=document.getElementById("mesBuscarF").value;var yearF=document.getElementById("yearBuscarF").value;var diaT=document.getElementById("diaBuscarT").value;var mesT=document.getElementById("mesBuscarT").value;var yearT=document.getElementById("yearBuscarT").value;var queryString="?diaF="+diaF+"&mesF="+mesF+"&yearF="+yearF+"&diaT="+diaT+"&mesT="+mesT+"&yearT="+yearT;var fHandler=actualizaReporteConsolidados2;}
var serverAddress="cargaReporteConsolidados.php"+queryString;var cargador=new net.CargadorContenidos(serverAddress,fHandler,false,"GET",false,false,functionLoading);}

function actualizaReporteConsolidados1()
{var text=this.req.responseText;var elementLoading=document.getElementById("divReportes");if(text){var oText=JSON.parse(text);var table=document.createElement("table");table.className="zebra";table.style.width=900+"px";var th=["Proveedor","Tipo Cuenta","Cant Comp","Pes Comp","Cant Vent","Pes Vent","Cant Dep","Pes Dep","Cant Merma","Pes Merma"];crearThead.call(table,[th]);var tBody=document.createElement("tbody");var classTr="claro";for(var key in oText){if(key>0){if(oText[key].proveedor==oText[key-1].proveedor){classTr=(classTr=="claro")?"claro":"oscuro";}
else{classTr=(classTr=="claro")?"oscuro":"claro";}}
insertTr.call(tBody,[oText[key].proveedor,oText[key].tipoCuenta,oText[key].cantidadCompra,oText[key].pesoCompra,oText[key].cantidadVenta,oText[key].pesoVenta,oText[key].cantidadDeposito,oText[key].pesoDeposito,oText[key].cantidadMerma,oText[key].pesoMerma],classTr);}
table.appendChild(tBody);elementLoading.innerHTML="";elementLoading.appendChild(table);}
else{elementLoading.innerHTML="<p class='centrarText'>Disculpe, pero no existen valores para esta fecha...</p>";}}

function ocultaDiv()
{var divDetalle=document.getElementById("divDetalle");
muestraOcultaElemento(divDetalle)}

function cargaEditar(tipo)
{var oLink=this.href;var oQ=oLink.match(/[\d-]+$/);
var queryString="?q="+oQ+"&tipo="+tipo;
var myRand=Math.random();
var serverAddress="cargaModificaciones.php"+queryString+"&myRand="+myRand;
var fHandler=null;switch(tipo){
case"proveedor":fHandler=poblaDatosProv;break;
case"contacto":fHandler=poblaDatosContacto;break;
case"cuenta":fHandler=poblaDatosCuenta;break;
case"pagoCompra":fHandler=poblaPagoCompra;break;
case"cliente":fHandler=poblaDatosCliente;break;
case"Rubro":fHandler=poblaDatosRubro;break;
case"Detalles":fHandler=poblaDatosDetalles;break;
case"lugar":fHandler=poblaDatosLugar;break;
case"pagoVenta":fHandler=poblaPagoVenta;break;
case"compra":fHandler=poblaDatosCompra;
serverAddress="cargaModificaciones2.php"+queryString+"&myRand="+myRand;break;
case"venta":fHandler=poblaDatosVenta; serverAddress="cargaModificaciones2.php"+queryString+"&myRand="+myRand;break;
case"empleado":fHandler=poblaDatosEmpleado;break;
case"pagoEmpleado":fHandler=poblaDatosPagoEmpleado;break;}
var cargador=new net.CargadorContenidos(serverAddress,fHandler,false,"GET");}

function poblaDatosProv()
{
	var text=this.req.responseText;
	var oText=JSON.parse(text);
		document.getElementById("ruc").value=oText.RUC;
		document.getElementById("razonSocial").value=oText.razonSocial;
		document.getElementById("direccion").value=oText.direccion;
		document.getElementById("ciudad").value=oText.ciudad;
		document.getElementById("telefono").value=oText.telefono;
		document.getElementById("fax").value=oText.fax;
	
	var myForm=document.getElementById('fIngProv');
		myForm.action="ingresoProveedor.php?prov="+oText.idProveedor;}

function poblaDatosContacto()
{var text=this.req.responseText;
var oText=JSON.parse(text);
document.getElementById("nombres").value=oText.nombresContacto;
document.getElementById("apellidos").value=oText.apellidosContacto;
document.getElementById("dni").value=oText.dniContacto;
document.getElementById("direccion").value=oText.direccionContacto;
document.getElementById("telefono").value=oText.telContacto;
document.getElementById("celular").value=oText.movilContacto;
document.getElementById("rpm").value=oText.rpmContacto;
document.getElementById("email").value=oText.mailContacto;
document.getElementById("proveedor").value=oText.idProveedor;
var myForm=document.getElementById('fIngContacto');
myForm.action="ingresoContacto.php?contacto="+oText.idContacto;}

function poblaDatosCuenta()
{var text=this.req.responseText;var oText=JSON.parse(text);document.getElementById("proveedor").value=oText.idProveedor;document.getElementById("numeroCuenta").value=oText.mumeroCuenta;document.getElementById("banco").value=oText.banco;document.getElementById("moneda").value=oText.monedaCuenta;document.getElementById("estadoCuenta").value=oText.estadoCuenta;var myForm=document.getElementById('fIngCuenta');myForm.action="ingresoCuenta.php?cuenta="+oText.mumeroCuenta;}

function poblaPagoCompra()
{var text=this.req.responseText;var oText=JSON.parse(text);document.getElementById("idReciboCompra").value=oText.idReciboCompra;document.getElementById("idProveedor").value=oText.idProveedor;document.getElementById("montoReciboCompra").value=oText.montoReciboCompra;var fechaRecCompra=new Date(oText.fechaReciboCompra*1000);document.getElementById("diaVenta").value=fechaRecCompra.getDate();document.getElementById("mesVenta").value=fechaRecCompra.getMonth()+1;document.getElementById("yearVenta").value=fechaRecCompra.getFullYear();var myForm=document.getElementById('fIngRecCompra');myForm.action="ingresoReciboCompra.php?reciboCompra="+oText.idReciboCompra;}

function poblaDatosCliente()
{	var text=this.req.responseText;
	var oText=JSON.parse(text);
		document.getElementById("dni").value=oText.dniCliente;
		document.getElementById("nombres").value=oText.nombreCliente;
		document.getElementById("ciudad").value=oText.ciudadCliente;
		document.getElementById("direccion").value=oText.direccionCliente;
		document.getElementById("email").value=oText.emailCliente;
		document.getElementById("celular").value=oText.telMovilCliente;
		document.getElementById("rpm").value=oText.rpmCliente;
		document.getElementById("fax").value=oText.fax;
	var myForm=document.getElementById('fIngCliente');
		myForm.action="ingresoCliente.php?cliente="+oText.idCliente;}
		
/////////////////////////////////////////////////////////////////////
function poblaDatosRubro()
{	
	var text=this.req.responseText;
	var oText=JSON.parse(text);
		document.getElementById("nomRubro").value=oText.nomRubro;
	var myForm=document.getElementById('fIngRubro');
		myForm.action="ingresoRubro.php?rubro="+oText.idRubro;}

////////////////////////////////////////////////////////////////////

function poblaDatosDetalles()
{	
	var text=this.req.responseText;
	var oText=JSON.parse(text);
		document.getElementById("nombreTipoCuenta").value=oText.nombreTipoCuenta;
	var myForm=document.getElementById('fIngTipoCuenta');
		myForm.action="ingresoDetalles.php?tipocuenta="+oText.idTipoCuenta;}


function poblaDatosLugar()
{var text=this.req.responseText;
var oText=JSON.parse(text);
document.getElementById("nombreLugar").value=oText.nombreLugar;
document.getElementById("direccionLugar").value=oText.direccionLugar;
document.getElementById("descripcionLugar").value=oText.descripcion;
var myForm=document.getElementById('fIngLugar');myForm.action="ingresoLugar.php?lugar="+oText.idLugar;}

function poblaPagoVenta()
{var text=this.req.responseText;var oText=JSON.parse(text);
document.getElementById("docVenta").value=oText.idDocVenta;
document.getElementById("monto").value=oText.monto;
document.getElementById("numCuenta").value=oText.numeroCuenta;
var myForm=document.getElementById('fIngPagoVenta');
myForm.action="ingresoPagoVenta.php?pagoVenta="+oText.idPagoVenta;document.getElementById("docVenta").onchange();}

function poblaDatosCompra()
{
	var text=this.req.responseText;
	var oText=JSON.parse(text);
		document.getElementById("numeroCompra").value=oText.idCompra;
		document.getElementById("proveedor").value=oText.idProveedor;
	var fechaCompra=new Date(oText.fechaCompra*1000);
	
		document.getElementById("diaCompra").value=fechaCompra.getDate();
		document.getElementById("mesCompra").value=fechaCompra.getMonth()+1;
		document.getElementById("yearCompra").value=fechaCompra.getFullYear();
		
		document.getElementById("tipoDocCompra").value=oText.tipoDocCompra;
		document.getElementById("numeroCheque").value=oText.chequeCompra;
		
	var bodyTable=document.getElementById("bodyTablaDetalle");
	var trRaiz=bodyTable.rows[0].cloneNode(true);
	var oDetalle=oText.detalle;bodyTable.innerHTML="";
	for(var row in oDetalle)
{
	var newTr=trRaiz.cloneNode(true);
		newTr.cells[0].firstChild.value=oDetalle[row].idTipoCuenta;
	var nuevosInput=newTr.getElementsByTagName('input');
		nuevosInput[0].value=oDetalle[row].detalle;
		nuevosInput[1].value=oDetalle[row].peso;
		nuevosInput[2].value=oDetalle[row].precioUnitario;
		nuevosInput[3].value=oDetalle[row].subTotal;

		nuevosInput[1].onkeyup=activaTeclasDetalleCompra;
		nuevosInput[2].onkeyup=activaTeclasDetalleCompra;
		nuevosInput[3].onkeyup=activaTeclasDetalleCompra;
		bodyTable.appendChild(newTr);
}
	var subTotal=parseFloat(oText.subTotal);
	var valorIgv=parseFloat(oText.valorIgv);
	var total=subTotal+valorIgv;
		document.getElementById('subTotalCompra').innerHTML=subTotal.toFixed(2);
		document.getElementById('igvCompra').innerHTML=valorIgv.toFixed(2);
		document.getElementById('totalCompra').innerHTML=total.toFixed(2);

	var myForm=document.getElementById('fIngCompra');
		myForm.action="ingresoCompra.php?compra="+oText.idCompra;
}

function poblaDatosVenta()
{
	var text=this.req.responseText;
	var oText=JSON.parse(text);
	var myForm=document.getElementById('fIngVenta');
		myForm.action="ingresoVenta.php?venta="+oText.idVenta;

		document.getElementById("cliente").value=oText.idCliente;
		document.getElementById("lugar").value=oText.idLugar;
	var fechaVenta=new Date(oText.fechaVenta*1000);
	
		document.getElementById("diaVenta").value=fechaVenta.getDate();
		document.getElementById("mesVenta").value=fechaVenta.getMonth()+1;
		document.getElementById("yearVenta").value=fechaVenta.getFullYear();
		////////////////////////
		document.getElementById("idDocVenta").value=oText.idDocVenta;
		document.getElementById("tipoDocVenta").value=oText.tipoDocVenta;
		document.getElementById("notas").value=oText.notas;
		
	var bodyTable=document.getElementById("bodyTablaDetalle");
	var trRaiz=bodyTable.rows[0].cloneNode(true);
	var oDetalle=oText.detalle;bodyTable.innerHTML="";
	
	for(var row in oDetalle)
{
	var newTr=trRaiz.cloneNode(true);
		newTr.cells[0].firstChild.value=oDetalle[row].idTipoCuenta;

	var nuevosInput=newTr.getElementsByTagName('input');
		nuevosInput[0].value=oDetalle[row].detalle;
		nuevosInput[1].value=oDetalle[row].cantidad;
		nuevosInput[2].value=oDetalle[row].monto;
		nuevosInput[3].value=(oDetalle[row].monto*oDetalle[row].cantidad).toFixed(2);

		nuevosInput[0].onkeyup=activaTeclasDetalleVenta;
		nuevosInput[1].onkeyup=activaTeclasDetalleVenta;
		nuevosInput[2].onkeyup=activaTeclasDetalleVenta;
		nuevosInput[3].onkeyup=activaTeclasDetalleVenta;
		bodyTable.appendChild(newTr);
	
}
	var subtotal=parseFloat(oText.subtotal);
	var valorIgv=parseFloat(oText.valorIgv);
	var total=parseFloat(oText.total);

		document.getElementById('subTotalIng').innerHTML=subtotal.toFixed(2);
		document.getElementById('igvIng').innerHTML=valorIgv.toFixed(2);
		document.getElementById('totalIng').innerHTML=total.toFixed(2);

}

function poblaDatosEmpleado()
{var text=this.req.responseText;if(text){var oText=JSON.parse(text);
var myForm=document.getElementById("fIngEmpleado");
myForm.action="ingresoEmpleado.php?idEmpleado="+oText.idEmpleado;
document.getElementById("dni").value=oText.dni;
document.getElementById("nombres").value=oText.nombres;
document.getElementById("apellidos").value=oText.apellidos;
document.getElementById("sueldo").value=oText.sueldo;
document.getElementById("direccion").value=oText.direccion;
document.getElementById("telefono").value=oText.telefono;
document.getElementById("celular").value=oText.movil;
document.getElementById("rpm").value=oText.rpm;}}

function poblaDatosPagoEmpleado()
{var text=this.req.responseText;if(text){var oText=JSON.parse(text);var myForm=document.getElementById("fIngPagoEmpleado");myForm.action="ingresoPagoEmpleado.php?idPagoEmpleado="+oText.idPagoEmpleado;document.getElementById("empleado").value=oText.idEmpleado;var fechaPago=oText.periodoLaboral.split(" - ");document.getElementById("mes").value=fechaPago[0];document.getElementById("year").value=fechaPago[1];document.getElementById("monto").value=oText.monto;document.getElementById("observacion").value=oText.observacion;}}

function resetTablaDetalle()
{for(var i=this.rows.length-1;i>0;i--){this.deleteRow(i);}}

function functionLoading()
{var elementLoading=document.getElementById("divReportes");
var img='<div class="centrarText"><img src="imagenes/maquetado/cargando4.gif"';
img+='width="62px" height="62px" alt="Cargando..." /></div>';
elementLoading.innerHTML=img;}

function functionLoading2()
{var elementLoading=document.getElementById("divDetalle");
var img='<div class="centrarText"><img src="imagenes/maquetado/cargando4.gif"';img+='width="62px" height="62px" alt="Cargando..." /></div>';elementLoading.innerHTML=img;}

function confirmEliminar()
{for(var i=0;i<this.length;
i++){this[i].onclick=function(){
var msg="[ALERTA] ¿Esta seguro que desea eliminar el registro?";
var conf=mensajeConfirm(msg);
if(!conf){var oEvent=arguments[0]||window.event;
if(oEvent.preventDefault){oEvent.preventDefault();}
else{oEvent.returnValue=false;}}}}}

function configuraEditar(tipo,campoFocus,divIngreso,divBloqueador)
{
	var linksEditar=this;
	var tipo=tipo;
	var divBloqueador=divBloqueador||document.getElementById("divBloqueador");
	var divIngreso=divIngreso||document.getElementById("divIngreso");
	var campoFocus=campoFocus||null;
	
		for(var i=0;i<linksEditar.length;i++){linksEditar[i].onclick=function(){
	
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
	
	var oEvent=arguments[0]||window.event;
	
		if(oEvent.preventDefault){oEvent.preventDefault();}
		else{oEvent.returnValue=false;}
		
		cargaEditar.call(this,tipo);
		setFocus.call(document.getElementById(campoFocus));}}}

function configuraValidacion(exceptions)
{
	var myForm=this;
	var camposForm=myForm.getElementsByTagName("input");
for(var key in camposForm){
if(!inArray.call(exceptions,key)){camposForm[key].onblur=function(){
if(checkCampoVacio.call(this)){alert("No puede dejar este campo Vacio \n Por favor ingrese un valor");}}}}
	myForm.onsubmit=function(){
	var oEvent=arguments[0]||window.event;
	var verifyForm=false;
for(var key in camposForm){
if(!inArray.call(exceptions,key)){
if(verifyForm=checkCampoVacio.call(camposForm[key])){break;}}}
if(verifyForm){alert("Debes ingresar valores en todos los campos del formulario \n Que aparecen con un asterisco");
if(oEvent.preventDefault){oEvent.preventDefault();}
else{oEvent.returnValue=false;}}}}

function checkCampoVacio()
{var newString=this.value.trim();
return newString.length==0?true:false;}
String.prototype.trim=function()
{return this.replace(/^\s*|\s*$/g,"");}

function inArray(num){
var encontro=false;for(var key in this){
if(this[key]==num){encontro=true;
return encontro;}}
return encontro;}

function setFocus(){this.focus();}
function muestraOcultaElemento(elemento)
{if(elemento.style.display=="block"){elemento.style.display="none"}
else{elemento.style.display="block";}}

function resetEstilos()
{this.style.background="none";this.style.border="solid 1px #7F9DB9";this.style.color="black";}

function desactivaCampo()
{this.style.background="#ECE9D8";this.style.color="#ACA899";}
function getLeft(elemento)
{iLeft=0;while(elemento.tagName!="BODY"){iLeft+=elemento.offsetLeft;
elemento=elemento.offsetParent;}
return iLeft;}

function mensajeConfirm(msg)
{var mensaje=msg;
var respuesta=confirm(mensaje);
return(respuesta)?true:false;}
window.onload=function(){
var url=window.location.href;

if(url.indexOf("gestionProveedores.php")!==-1){
	var divIngreso=document.getElementById("divIngreso");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevoProveedor").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		
	var myForm=document.getElementById("fIngProv");
		myForm.action="ingresoProveedor.php";
		myForm.reset();
		
		setFocus.call(document.getElementById("ruc"));
	return false;}
	
		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
	return false;}
	
	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
		
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"proveedor","ruc",divIngreso,divBloqueador);
		
	var myForm=document.getElementById("fIngProv");
		configuraValidacion.call(myForm,[5]);}

else if(url.indexOf("gestionContactos.php")!==-1){var divIngreso=document.getElementById("divIngresoContacto");var divBloqueador=document.getElementById("divBloqueador");document.getElementById("nuevoContacto").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);var myForm=document.getElementById("fIngContacto");myForm.action="ingresoContacto.php";myForm.reset();setFocus.call(document.getElementById("nombres"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"contacto","nombres",divIngreso,divBloqueador);var myForm=document.getElementById("fIngContacto");configuraValidacion.call(myForm,[4,6,7]);}

else if(url.indexOf("gestionCuentas.php")!==-1){
	var divIngreso=document.getElementById("divIngresoCuenta");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevaCuenta").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
	var myForm=document.getElementById("fIngCuenta");
		myForm.action="ingresoCuenta.php";
		myForm.reset();setFocus.call(document.getElementById("numeroCuenta"));
	return false;}
		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
	return false;}
	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"cuenta","numeroCuenta",divIngreso,divBloqueador);
	var myForm=document.getElementById("fIngCuenta");
		configuraValidacion.call(myForm,[]);
}

else if(url.indexOf("gestionCompras.php")!==-1){
	var divIngreso=document.getElementById("divIngresoCompra");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevaCompra").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);

	var myForm=document.getElementById("fIngCompra");
		myForm.reset();
		myForm.action="ingresoCompra.php";

		document.getElementById('subTotalCompra').innerHTML="";
		document.getElementById('igvCompra').innerHTML="";
		document.getElementById('totalCompra').innerHTML="";

	var bodyTable=document.getElementById("bodyTablaDetalle");
		resetTablaDetalle.call(bodyTable);

	var campoNumCompra=document.getElementById("numeroCompra");
		resetEstilos.call(campoNumCompra);

		setFocus.call(document.getElementById("numeroCompra"));
		return false;}

		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}
	
	var linksEditar=document.getElementsByName("itemEditar");
	for(
	var i=0;i<linksEditar.length;i++){linksEditar[i].onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
	var oEvent=arguments[0]||window.event;

	if(oEvent.preventDefault){oEvent.preventDefault();}
	else{oEvent.returnValue=false;}
		cargaEditar.call(this,'compra');
		setFocus.call(document.getElementById("proveedor"));
		desactivaCampo.call(document.getElementById("numeroCompra"));}}
		
	var camposdetaDet=document.getElementsByName("detaDet");
	var camposPeso=document.getElementsByName("pesoDet[]");
	var camposPrecioUnit=document.getElementsByName("precioUnitarioDet[]");
	for(var i=0;i<camposPeso.length;i++){
		camposPeso[i].onkeyup=activaTeclasDetalleCompra;
		camposPrecioUnit[i].onkeyup=activaTeclasDetalleCompra;}}
		
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
else if(url.indexOf("gestionClientes.php")!==-1){
	var divIngreso=document.getElementById("divIngresoCliente");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevoCliente").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);

	var myForm=document.getElementById("fIngCliente");
		myForm.action="ingresoCliente.php";
		myForm.reset();
		setFocus.call(document.getElementById("dni"));
		return false;}

		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}

	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"cliente","dni",divIngreso,divBloqueador);
	var myForm=document.getElementById("fIngCliente");
		configuraValidacion.call(myForm,[4,5,6,7,8]);}

///////////////////////////////////////////////////////////////////////
else if(url.indexOf("gestionRubro.php")!==-1){
	var divIngreso=document.getElementById("divIngresoPequenios");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevoRubro").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);

	var myForm=document.getElementById("fIngRubro");
		myForm.action="ingresoRubro.php";
		myForm.reset();
		setFocus.call(document.getElementById("nomRubro"));
		return false;}

		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}

	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
		
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"Rubro","nomRubro",divIngreso,divBloqueador);
		
	var myForm=document.getElementById("fIngRubro");
		configuraValidacion.call(myForm,[]);}


///////////////////////////////////////////////////////////////////////

else if(url.indexOf("gestionDetalles.php")!==-1){
	var divIngreso=document.getElementById("divIngresoPequenios");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevoTipoCuenta").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);

	var myForm=document.getElementById("fIngTipoCuenta");
		myForm.action="ingresoDetalles.php";
		myForm.reset();
		setFocus.call(document.getElementById("nombreTipoCuenta"));
		return false;}

		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}

	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
		
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"Detalles","nombreTipoCuenta",divIngreso,divBloqueador);
		
	var myForm=document.getElementById("fIngTipoCuenta");
		configuraValidacion.call(myForm,[]);}
///////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////

else if(url.indexOf("gestionVentas.php")!==-1)
{
	var divIngreso=document.getElementById("divIngresoVenta");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevaVenta").onclick=function()
{
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		
	var myForm=document.getElementById("fIngVenta");
		myForm.action="ingresoVenta.php";
		myForm.reset();
	
		document.getElementById('subTotalIng').innerHTML="";
		document.getElementById('igvIng').innerHTML="";
		document.getElementById('totalIng').innerHTML="";

	var bodyTable=document.getElementById("bodyTablaDetalle");
		resetTablaDetalle.call(bodyTable);
		setFocus.call(document.getElementById("cliente"))
		;return false;
}
		
		document.getElementById("linkCerrar").onclick=function()
{
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}
		
	var linksEliminar=document.getElementsByName("itemEliminar");
		confirmEliminar.call(linksEliminar);
		
	var linksEditar=document.getElementsByName("itemEditar");
		configuraEditar.call(linksEditar,"venta","cliente",divIngreso,divBloqueador);
		
	var campoCantidadDet=document.getElementById("detaDet");	
	var campoCantidadDet=document.getElementById("cantidadDet");
	var campoPrecioDet=document.getElementById("precioDet");
	
		campoCantidadDet.onkeyup=activaTeclasDetalleVenta;
		campoPrecioDet.onkeyup=activaTeclasDetalleVenta;

		document.getElementById("diaVenta").onchange=consolidaVentasSubCliente;
		document.getElementById("mesVenta").onchange=consolidaVentasSubCliente;
		document.getElementById("yearVenta").onchange=consolidaVentasSubCliente;
		document.getElementById("cliente").onchange=consolidaVentasSubCliente;
}

/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

else if(url.indexOf("formIngFacturaVenta.php")!==-1){
var camposPesoDet=document.getElementsByName("pesoDet[]");
var camposPrecioUnit=document.getElementsByName("precioUnitDet[]");
var camposPrecioPel=document.getElementsByName("precioPeladaDet[]");
for(var i=0;i<camposPesoDet.length;i++){camposPesoDet[i].onkeyup=activaTeclasDetalleDocVenta;
camposPrecioUnit[i].onkeyup=activaTeclasDetalleDocVenta;
camposPrecioPel[i].onkeyup=activaTeclasDetalleDocVenta;}}

else if(url.indexOf("facturasVenta.php")!==-1){var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);}
else if(url.indexOf("gestionDeposito.php")!==-1){var divIngreso=document.getElementById("divIngresoVenta");var divBloqueador=document.getElementById("divBloqueador");document.getElementById("nuevoDeposito").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);var myForm=document.getElementById("fIngDeposito");myForm.reset();myForm.action="ingresoDeposito.php";var bodyTable=document.getElementById("bodyTablaDetalle");resetTablaDetalle.call(bodyTable);setFocus.call(document.getElementById("diaDeposito"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"deposito","diaDeposito",divIngreso,divBloqueador);var linksDetalle=document.getElementsByName("itemDetalle");configuraEditar.call(linksDetalle,"detDeposito",false,divIngreso,divBloqueador);var camposCantidad=document.getElementsByName("cantidadDet[]");var camposPesoPesada=document.getElementsByName("pesoPesadaDet[]");var camposPesoJava=document.getElementsByName("pesoJavaDet[]");for(var i=0;i<camposCantidad.length;i++){camposCantidad[i].onkeyup=activaTeclasDetalleDeposito;camposPesoPesada[i].onkeyup=activaTeclasDetalleDeposito;camposPesoJava[i].onkeyup=activaTeclasDetalleDeposito;}}
else if(url.indexOf("gestionPagosCompras.php")!==-1){var divIngreso=document.getElementById("divIngreso");var divBloqueador=document.getElementById("divBloqueador");document.getElementById("nuevoReciboCompra").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);var myForm=document.getElementById("fIngRecCompra");myForm.reset();myForm.action="ingresoReciboCompra.php";setFocus.call(document.getElementById("idReciboCompra"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"pagoCompra","idReciboCompra",divIngreso,divBloqueador);var myForm=document.getElementById("fIngRecCompra");configuraValidacion.call(myForm,[]);}

///else if(url.indexOf("gestionTipoCuenta.php")!==-1){

//	var divIngreso=document.getElementById("divIngresoPequenios");
//	var divBloqueador=document.getElementById("divBloqueador");
//		document.getElementById("nuevoTipoCuenta").onclick=function(){
//		muestraOcultaElemento(divBloqueador);
//		muestraOcultaElemento(divIngreso);
		
//	var myForm=document.getElementById("fIngTipoCuenta");
//		myForm.reset();myForm.action="ingresoTipoCuenta.php";
//		setFocus.call(document.getElementById("nombreTipoCuenta"));
//		return false;}
		
//		document.getElementById("linkCerrar").onclick=function(){
//		muestraOcultaElemento(divBloqueador);
//		muestraOcultaElemento(divIngreso);return false;}
		
//	var linksEliminar=document.getElementsByName("itemEliminar");
//		confirmEliminar.call(linksEliminar);
		
//	var linksEditar=document.getElementsByName("itemEditar");
//		configuraEditar.call(linksEditar,"tipoCuenta","nombreTipoCuenta",divIngreso,divBloqueador);
		
//	var myForm=document.getElementById("fIngTipoCuenta");
//		configuraValidacion.call(myForm,[]);}
		
///////////////IGV/////////////////////////////////////
/////////////////////////////////////////////////////
else if(url.indexOf("gestionIgv.php")!==-1){
	var divIngreso=document.getElementById("divIngresoPequenios");
	var divBloqueador=document.getElementById("divBloqueador");
		document.getElementById("nuevoIgv").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		
		setFocus.call(document.getElementById("valorIgv"));
		return false;}
		
		document.getElementById("linkCerrar").onclick=function(){
		muestraOcultaElemento(divBloqueador);
		muestraOcultaElemento(divIngreso);
		return false;}
		
	var myForm=document.getElementById("fIngIgv");
		configuraValidacion.call(myForm,[]);}

else if(url.indexOf("lugares.php")!==-1){var divIngreso=document.getElementById("divIngresoPequenios");
var divBloqueador=document.getElementById("divBloqueador");
document.getElementById("nuevoLugar").onclick=function(){muestraOcultaElemento(divBloqueador);
muestraOcultaElemento(divIngreso);var myForm=document.getElementById("fIngLugar");myForm.reset();
myForm.action="ingresoLugar.php";setFocus.call(document.getElementById("nombreLugar"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);
muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");
confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");
configuraEditar.call(linksEditar,"lugar","nombreLugar",divIngreso,divBloqueador);
var myForm=document.getElementById("fIngLugar");configuraValidacion.call(myForm,[]);}

else if(url.indexOf("gestionEmpleados.php")!==-1){var divIngreso=document.getElementById("divIngresoContacto");var divBloqueador=document.getElementById("divBloqueador");var myForm=document.getElementById("fIngEmpleado");document.getElementById("nuevoEmpleado").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);myForm.reset();myForm.action="ingresoEmpleado.php";setFocus.call(document.getElementById("dni"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"empleado","dni",divIngreso,divBloqueador);configuraValidacion.call(myForm,[4,5,6,7]);}

else if(url.indexOf("gestionPagosEmpleado.php")!==-1){var divIngreso=document.getElementById("divIngreso");var divBloqueador=document.getElementById("divBloqueador");var myForm=document.getElementById("fIngPagoEmpleado");document.getElementById("nuevoPago").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);myForm.reset();myForm.action="ingresoPagoEmpleado.php";setFocus.call(document.getElementById("empleado"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"pagoEmpleado","empleado",divIngreso,divBloqueador);configuraValidacion.call(myForm,[]);}

else if(url.indexOf("gestionPagosVentas.php")!==-1){var divIngreso=document.getElementById("divIngreso");var divBloqueador=document.getElementById("divBloqueador");document.getElementById("nuevoPagoVenta").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);var myForm=document.getElementById("fIngPagoVenta");myForm.reset();document.getElementById("fieldsetMontosActuales").style.display="none";myForm.action="ingresoPagoVenta.php";setFocus.call(document.getElementById("docVenta"));return false;}
document.getElementById("linkCerrar").onclick=function(){muestraOcultaElemento(divBloqueador);muestraOcultaElemento(divIngreso);return false;}
document.getElementById("docVenta").onchange=muestraTotalesPagosVenta;var linksEliminar=document.getElementsByName("itemEliminar");confirmEliminar.call(linksEliminar);var linksEditar=document.getElementsByName("itemEditar");configuraEditar.call(linksEditar,"pagoVenta","monto",divIngreso,divBloqueador);var myForm=document.getElementById("fIngPagoVenta");configuraValidacion.call(myForm,[]);}

else if(url.indexOf("gestionReporteVentas.php")!==-1){var divFechas=document.getElementById("buscarPorFechas");var divCliente=document.getElementById("campoCliente");var divIntervalo=document.getElementById("intervaloFechas");document.getElementById("opcionBuscar1").onclick=function(){if(divFechas.style.display=="none"){divFechas.style.display="block";divCliente.style.display="none";divIntervalo.style.display="none";}}
document.getElementById("opcionBuscar2").onclick=function(){divCliente.style.display="block";divIntervalo.style.display="block";divFechas.style.display="none";}
document.getElementById("diaBuscar").onchange=cargaReporteVentas;document.getElementById("mesBuscar").onchange=cargaReporteVentas;document.getElementById("yearBuscar").onchange=cargaReporteVentas;document.getElementById("cliente").onchange=cargaReporteVentas;document.getElementById("diaBuscarF").onchange=cargaReporteVentas;document.getElementById("mesBuscarF").onchange=cargaReporteVentas;document.getElementById("yearBuscarF").onchange=cargaReporteVentas;document.getElementById("diaBuscarT").onchange=cargaReporteVentas;document.getElementById("mesBuscarT").onchange=cargaReporteVentas;document.getElementById("yearBuscarT").onchange=cargaReporteVentas;cargaReporteVentas();}

else if(url.indexOf("gestionCompraVenta.php")!==-1){document.getElementById("diaBuscarF").onchange=cargaReporteCompraVenta;document.getElementById("mesBuscarF").onchange=cargaReporteCompraVenta;document.getElementById("yearBuscarF").onchange=cargaReporteCompraVenta;document.getElementById("diaBuscarT").onchange=cargaReporteCompraVenta;document.getElementById("mesBuscarT").onchange=cargaReporteCompraVenta;document.getElementById("yearBuscarT").onchange=cargaReporteCompraVenta;document.getElementById("proveedor").onchange=cargaReporteCompraVenta;cargaReporteCompraVenta();}

else if(url.indexOf("reporteMovimientos.php")!==-1){var divDia=document.getElementById("buscarPorDia");var divIntervalo=document.getElementById("buscarPorIntervalo");document.getElementById("opcionBuscar1").onclick=function(){if(divDia.style.display=="none"){divDia.style.display="block";divIntervalo.style.display="none";}}
document.getElementById("opcionBuscar2").onclick=function(){divIntervalo.style.display="block";divDia.style.display="none";}
document.getElementById("diaBuscar").onchange=cargaReporteMovimientos;document.getElementById("mesBuscar").onchange=cargaReporteMovimientos;document.getElementById("yearBuscar").onchange=cargaReporteMovimientos;document.getElementById("diaBuscarF").onchange=cargaReporteMovimientos;document.getElementById("mesBuscarF").onchange=cargaReporteMovimientos;document.getElementById("yearBuscarF").onchange=cargaReporteMovimientos;document.getElementById("diaBuscarT").onchange=cargaReporteMovimientos;document.getElementById("mesBuscarT").onchange=cargaReporteMovimientos;document.getElementById("yearBuscarT").onchange=cargaReporteMovimientos;}

else if(url.indexOf("reporteSubclientes.php")!==-1){document.getElementById("cliente").onchange=cargaReporteSubClientes;document.getElementById("diaBuscar").onchange=cargaReporteSubClientes;document.getElementById("mesBuscar").onchange=cargaReporteSubClientes;document.getElementById("yearBuscar").onchange=cargaReporteSubClientes;cargaReporteSubClientes();}

else if(url.indexOf("reporteConsolidadoTotales.php")!==-1){var divGestionNegocio=document.getElementById("gestionNegocio");var divMontosTotales=document.getElementById("montosTotales");document.getElementById("opcionBuscar1").onclick=function(){if(divGestionNegocio.style.display=="none"){divGestionNegocio.style.display="block";divMontosTotales.style.display="none";}}
document.getElementById("opcionBuscar2").onclick=function(){divMontosTotales.style.display="block";divGestionNegocio.style.display="none";}
document.getElementById("diaBuscar").onchange=cargaReporteConsolidados;document.getElementById("mesBuscar").onchange=cargaReporteConsolidados;document.getElementById("yearBuscar").onchange=cargaReporteConsolidados;document.getElementById("diaBuscarF").onchange=cargaReporteConsolidados;document.getElementById("mesBuscarF").onchange=cargaReporteConsolidados;document.getElementById("yearBuscarF").onchange=cargaReporteConsolidados;document.getElementById("diaBuscarT").onchange=cargaReporteConsolidados;document.getElementById("mesBuscarT").onchange=cargaReporteConsolidados;document.getElementById("yearBuscarT").onchange=cargaReporteConsolidados;cargaReporteConsolidados();}}