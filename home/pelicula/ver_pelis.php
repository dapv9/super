<?php
include("../BD.php");
$BD= new BD();
$BD->conectar();
session_start();
$idusuario = $_SESSION["idusuario"];

$nompelib =  strtoupper($_REQUEST["nompelib"]);
$generob = strtoupper($_REQUEST["generob"]);
$calificacionb = strtoupper($_REQUEST["calificacionb"]);
$contador = 0;
$sql = "SELECT * FROM pelicula WHERE";
$con=0;
if($nompelib!=""){
	$sql.=" nombre LIKE BINARY '$nompelib' ";
	$con=1;
}
if($generob!=""){
   if ($con > 0){
	 $sql.=" AND id_genero = $generob";
   }
   else{
	 $sql.="  id_genero = $generob";
   }
   $con=1;
}

if($calificacionb!=""){
   if ($con > 0){
	 $sql.=" AND calificacion = $calificacionb";
   }
   else{
	 $sql.="  calificacion = $calificacionb";
   }
   $con=1;
}

if($con==0){
$sql="SELECT * FROM pelicula";
}

$sql.=" ORDER BY nombre ASC ";
$respelicula = $BD->consultar($sql);
$numerorg = $BD->numreg($respelicula);
if($BD->numreg($respelicula)>0)
{
?>

<table class="tabla" border="0">
    <tr>
    	<td class="celda" align="center"><strong>Total Peliculas: <?php echo $numerorg;?></strong></td>
    	<td class="celda" align="center"><strong>NOMBRE PELICULA</strong></td>
       	<td class="celda" align="center"><strong>GENERO</strong></td>
    	<td class="celda" align="center"><strong>SOLICITAR<BR>PRESTAMO</strong></td>
		<td class="celda" align="center"><strong>CALIFICACION</strong></td>
    </tr>
	<?php

		while(!$respelicula->EOF){
		$contador++;
		$id = $respelicula->fields["id_pelicula"];
		$idgenero = $respelicula->fields["id_genero"];
		$iddirector = $respelicula->fields["id_director"];

		 $sql = "SELECT imagen.id_pelicula,imagen.nombre, imagen.estado_img FROM pelicula,imagen WHERE imagen.id_pelicula=$id  LIMIT 0,1";
		$imagen = $BD->consultar($sql);

		$sql ="SELECT nombre FROM genero WHERE id_genero=$idgenero LIMIT 0,1";
		$genero = $BD->consultar($sql);

		$sql = "SELECT estado FROM prestamo WHERE id_pelicula=$id AND estado=1";
		$prestamo = $BD->consultar($sql);

		$sql = "SELECT estado FROM solicitu_prestamo WHERE id_pelicula=$id AND id_usuario=$idusuario";
		$soliprestamo = $BD->consultar($sql);	
		

	?>
	<tr onmouseover='this.style.background="#E6E6E6"' onmouseout='this.style.background="white"'>
		<?php if ($imagen->fields["estado_img"]==1){ ?>
			<td  align="center"><img src="pelicula/subir/pelis/<?php echo $imagen->fields["nombre"]; ?>" height="110" width="90" title="PelisMilo-" alt="PelisMilo-" border="1">&nbsp;</td>
		<?php }else{ ?>
		<td  align="center"><img src="#" height="110" width="90" title="PelisMilo-Imagen no subida..." alt="PelisMilo-Imagen no subida..." border="1">&nbsp;</td>
		<?php } ?>
		<td>
			<a href="javascript:ver_descri(<?php echo $id; ?>,<?php echo $iddirector; ?>)" id="desplegar<?php echo $id;?>" style="cursor:pointer;text-decoration:none;" title="Ver Sinopsis" ><img src="imgs/abajo.png" width="10" height="10">&nbsp;<?php echo strtoupper($respelicula->fields["nombre"]);?></a>
			<a href="javascript:cerrar_descri(<?php echo $id; ?>,<?php echo $iddirector; ?>)" id="replegar<?php echo $id;?>" style="display:none;cursor:pointer;text-decoration:none;" title="Cerrar Sinopsis"><img src="imgs/arriba.png" width="10" height="10"> &nbsp;<?php echo strtoupper($respelicula->fields["nombre"]);?></a>
		</td>
		<td align="center"><?php echo strtoupper($genero->fields["nombre"]);?></td>
		
		<?php if($prestamo->fields["estado"]==0){ ?>
			<td align="center"> 

			    <div id="msgsolicitud<?php echo $id;?>">

			    	<?php if($soliprestamo->fields["estado"]==1){?>

						<a href="javascript:solcitarpre(<?php echo $id;?>)" style="cursor:pointer"> <img src="imgs/closet.png" width="25" height="25" title="Cancelara solicitud de prestamo de esta pelicula"></a>
					
					<?php }else{?>

						<a href="javascript:solcitarpre(<?php echo $id;?>)" style="cursor:pointer"> <img src="imgs/prestamo.png" width="25" height="25" title="Solicitar prestamo de esta pelicula"></a>
					<?php } ?>

				</div>
			
			</td>
		<?php }else { ?>	
			<td align="center"> <font color="red"><h3>Prestada!</h3></font> </td>
		<?php } ?>
		</td>
		<td align="center">
        <div id="estado_calificacion<?php echo $id;?>">
			<?php
			 if($respelicula->fields["calificacion"]==0) {
			?>
            <a href = "javascript:cambia_calificacion(<?php echo $id;?>,1)"><img src="imgs/uno.png" title="Buena" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
			<a href = "javascript:cambia_calificacion(<?php echo $id;?>,2)"><img src="imgs/dos.png" title="Regular" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
			<a href = "javascript:cambia_calificacion(<?php echo $id;?>,3)"><img src="imgs/tres.png" title="Mala" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
			<?php
					}else if($respelicula->fields["calificacion"]==1){
			?>
					<a href = "javascript:mensaje(<?php echo $id;?>)"><img src="imgs/uno.png" title="Buena" style="cursor:pointer" width="15%" height="15%"></a>
			<?php
						} else if($respelicula->fields["calificacion"]==2){
			?>
						<a href = "javascript:mensaje(<?php echo $id;?>)"><img src="imgs/dos.png" title="Regular" style="cursor:pointer" width="15%" height="15%"></a>
			<?php
			}else{
			?>
			<a href = "javascript:mensaje(<?php echo $id;?>)"><img src="imgs/tres.png" title="Mala" style="cursor:pointer" width="15%" height="15%"></a>
			<?php
			}
			?>
        </div>
		</td>
	</tr>
	</tr>
	<tr>
		<td colspan="5" align="center"> <div id="mensaje2<?php echo $id; ?>"> </div></div></td>
	</tr>
	<tr style="display:none" id="tbdetalle<?php echo $id; ?>">
		<td colspan="5" ><div id="verdetalle<?php echo $id; ?>"></div></td>
	</tr>
     <?php
		$respelicula->MoveNext();
		}
	?>
</table>
<?php
}else{?>
<tr>
    <td  colspan="5"><strong><center><font color="#FF0000"><img src='imgs/error.png' width='30' height='30'/> &nbsp;No se encontraron resgistros con los parámetros de búsqueda ingresados en PelisMilo</font></center></strong></td>
</tr>
<?php
}
?>








