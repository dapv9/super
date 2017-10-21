<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();


$sql = "select pelicula.id_pelicula as idpeli,pelicula.nombre as nompeli, prestamo.id as id,prestamo.prestatario as nom, prestamo.fecha_prestamo as fp, prestamo.fecha_devolucion as fd, prestamo.estado as est from pelicula, prestamo where pelicula.id_pelicula = prestamo.id_pelicula and estado=1";
$res = $BD->consultar($sql);
if($BD->numreg($res)>0)
{
?>

<table class="tabla" border="0">
    <tr>
    	<td class="celda" align="center"><strong>NOMBRE PELICULA</strong></td>
       	<td class="celda" align="center"><strong>NOMBRE Y APELLIDOS</strong></td>
    	<td class="celda" align="center"><strong>FECHA PRESTAMO</strong></td>
		<td class="celda" align="center"><strong>FECHA DEVOLUCION</strong></td>
		<td class="celda" align="center">&nbsp;</td>
    </tr>
<?php 
while (!$res->EOF){
	$fecha_sist = date("Y-m-d");
	$id = $res->fields["id"];
	$nomb = $res->fields["nom"];
	$idpeli = $res->fields["idpeli"];


	if($fecha_sist > $res->fields["fd"]){
?>
	<tr bgcolor="red" title="Fecha de devolucion de pelicula vencida!" onmouseover='this.style.background="#E6E6E6"' onmouseout='this.style.background="red"'>
<?php		
	}else{
?>
	<tr title="La pelicula se encuentra entre las fechas establecidas." onmouseover='this.style.background="#E6E6E6"' onmouseout='this.style.background="white"'>
<?php
	}	
?>
		<td ><?php echo $res->fields["nompeli"];?></td>
	   	<td ><?php echo $nomb;?></td>
		<td ><?php echo $res->fields["fp"];?></td>
		<td ><?php echo $res->fields["fd"];?></td>
		<td ><a href = "javascript:cambia_estado(<?php echo $id;?>)"><img src="imgs/devolucion.png" title="Devolver Pelicula" style="cursor:pointer" width="30" height="30"></a>
		</td>
    </tr>
<?php
$res->MoveNext();
}
?>    
</table>
<?php
}
else{?>
<tr>
    <td  colspan="5"><strong><center><font color="#FF0000"><img src='imgs/error.png' width='30' height='30'/> &nbsp;En el momento no se registra peliculas prestadas en  .::PelisMilo::.</font></center></strong></td>
</tr>
<?php
}
?>