<?php
include("BD.php");
$BD= new BD();
$BD->conectar(); 
session_start();
$_SESSION["tipouser"];
$nombreusuario = $_SESSION["nomapeuser"];

$texto = 0;

$sql = "SELECT pelicula.nombre AS nompeli, imagen.id_pelicula,imagen.nombre FROM pelicula,imagen WHERE pelicula.id_pelicula=imagen.id_pelicula";
$imagen = $BD->consultar($sql);

if($_SESSION["tipouser"]==1){
 	$sql = "SELECT pelicula.id_pelicula AS idpeli,pelicula.nombre AS nompeli, prestamo.id AS id,prestamo.prestatario AS nom, prestamo.fecha_prestamo AS fp, prestamo.fecha_devolucion AS fd, prestamo.estado AS est FROM pelicula, prestamo WHERE pelicula.id_pelicula = prestamo.id_pelicula AND estado=1";
 	 $texto = 1;
}else{
	 $sql="SELECT pelicula.id_pelicula AS idpeli,pelicula.nombre AS nompeli, prestamo.id AS id,prestamo.prestatario AS nom, prestamo.fecha_prestamo AS fp, prestamo.fecha_devolucion AS fd, prestamo.estado AS est FROM pelicula, prestamo WHERE pelicula.id_pelicula = prestamo.id_pelicula AND estado=1 AND prestamo.prestatario LIKE '%$nombreusuario%'";
	 $texto = 2;
}

$res = $BD->consultar($sql);

$sql = "SELECT * FROM solicitu_prestamo WHERE estado=1";
$ressolicitud = $BD->consultar($sql);

?>
	
<html>
	<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="java/javas.js"></script>
	<script language="JavaScript" type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
		<title></title>
	</head>
	<body>
		<?php 
		
		if($_SESSION["tipouser"]!=1){ //usuario diferente a adminitrador se muetra baner de peliculas
		?>
			<marquee >
			<?php
			while (!$imagen->EOF){		
			?>
				
				<img src="pelicula/subir/pelis/<?php echo $imagen->fields["nombre"]?>" height="260" width="200" title="PelisMilo-<?php echo $imagen->fields["nompeli"]; ?>" alt="PelisMilo-<?php echo $imagen->fields["nompeli"]; ?>" border="1">&nbsp;
			<?php 
			$imagen->MoveNext();
			}
			?>	
			</marquee>
		<?php 
		}	
		if($_SESSION["tipouser"]==1){ // vista para adminitradores asignar prestamo de pelicula
		?>
			<br><br>
			<table class="tabla">
					<tr>
						<td class="celda" colspan="7" align="center">SOLICITUD PRESTAMO DE PELICULAS</td>
					</tr>
				<?php 
				if($BD->numreg($ressolicitud)>0)
				{
				?>
						<tr>
							<td class="celda" align="center"><strong>NRO.SOLICITUD</strong></td>
					       	<td class="celda" align="center"><strong>NOMBRE PELICULA</strong></td>
					    	<td class="celda" align="center"><strong>NOMBRE SOLICITANTE</strong></td>
							<td class="celda" align="center"><strong>FECHA SOLICITUD</strong></td>
							<td class="celda" align="center"><strong>HORA SOLICITUD</strong></td>
							<td class="celda" align="center"><strong>ESTADO SOLICITUD</strong></td>
							<td class="celda" align="center"><strong>&nbsp;</strong></td>
						</tr>
					<?php 
					$arrayestado[1] = "Solcitud en proceso....";
					while (!$ressolicitud->EOF){
					$idsolipeli = $ressolicitud->fields["id"];	
					$idsoliuser = $ressolicitud->fields["id_usuario"];
					$sql = "SELECT nombre,id_pelicula FROM  pelicula WHERE id_pelicula=".$ressolicitud->fields["id_pelicula"];
					$respelicula = $BD->consultar($sql);
					$sql = "SELECT nomape FROM  usuario WHERE id=$idsoliuser";
					$resusuario = $BD->consultar($sql);	
					?>
					<tr tr onmouseover='this.style.background="#E6E6E6"' onmouseout='this.style.background="white"'>
							<td align="center"><?php echo $idsolipeli; ?></td>
					       	<td><?php echo strtoupper($respelicula->fields["nombre"]); ?></td>		
					    	<td><?php echo strtoupper($resusuario->fields["nomape"]); ?></td>
							<td align="center"><?php echo $ressolicitud->fields["fecha"]; ?></td>
							<td align="center"><?php echo $ressolicitud->fields["hora"]; ?></td>
							<td align="center"><?php echo $arrayestado[$ressolicitud->fields["estado"]];?></td>
							<td align="center"> 

								<a href="javascript:desplegarfrmsoli(<?php echo $idsolipeli;?>,<?php echo $ressolicitud->fields["id_pelicula"];?>,'<?php echo $resusuario->fields["nomape"]; ?>',<?php echo $idsoliuser;?>)" id="desplegar<?php echo $idsolipeli;?>" style="cursor:pointer;text-decoration:none;" > <img src="imgs/abajo.png" width="20" height="20" title="Gestionar Solicitud"> </a>
								<a href="javascript:cerrar_frmsoli(<?php echo $idsolipeli;?>,<?php echo $ressolicitud->fields["id_pelicula"];?>,'<?php echo $resusuario->fields["nomape"]; ?>',<?php echo $idsoliuser;?>)" id="replegar<?php echo $idsolipeli;?>" style="display:none;cursor:pointer;text-decoration:none;"> <img src="imgs/arriba.png" width="20" height="20" title="Cerrar Gestor Solicitud"> </a>  
							</td>
					</tr>
					<tr style="display:none" id="tbdetalle<?php echo $idsolipeli; ?>">
						<td colspan="7" ><div id="verdetalle<?php echo $idsolipeli; ?>"></div></td>
					</tr>
					<?php 
					$ressolicitud->MoveNext();
					}
				}else{
					?> 
					<tr>
					<td  colspan="5"><strong><center><font color="#FF0000"><h3>En el momento no se registra solicitud de prestamos </h3></font></center></strong></td>
					</tr>
				<?php	
				}
				?>	
			</table>
		<?php } ?>	
		<br><br>

		<table class="tabla">
				<tr>
					<td class="celda" colspan="4"><center><?php if($texto==1){ echo "PELICULAS PRESTADAS A USUARIOS";}else{ echo "ESTAS PELICULAS FIGURAN PRESTADAS A MI NOMBRE";} ?></center></td>
				</tr>
			<?php	
			if($BD->numreg($res)>0)
			{
			?>
		    	<tr>
			    	<td class="celda" align="center"><strong>NOMBRE DE LA PELICULA</strong></td>
			       	<td class="celda" align="center"><strong>PRESTADA A</strong></td>
			    	<td class="celda" align="center"><strong>FECHA DE PRESTAMO</strong></td>
					<td class="celda" align="center"><strong>FECHA DE DEVOLUCION</strong></td>
		   		 </tr>
				<?php 
				while (!$res->EOF){
					$fecha_sist = date("Y-m-d");
					$id = $res->fields["id"];
					$nomb = $res->fields["nom"];
					$idpeli = $res->fields["idpeli"];
				if($fecha_sist > $res->fields["fd"]){
				?>
					<tr bgcolor="red" title="Fecha de devolucion de pelicula vencida!" >
				<?php		
					}else{
				?>
					<tr title="La pelicula se encuentra entre las fechas establecidas." >
				<?php
					}	
				?>
						<td ><?php echo $res->fields["nompeli"];?></td>
					   	<td ><?php echo $nomb;?></td>
						<td align="center"><?php echo $res->fields["fp"];?></td>
						<td align="center"><?php echo $res->fields["fd"];?></td>
				    </tr>
				<?php
				$res->MoveNext();
				}
			}else{
				?> 
				<tr>
				<td  colspan="4"><strong><center>
					<font color="#FF0000">
						<h3><?php if($texto==1){ echo "En el momento no se registra peliculas prestadas";}else{ echo "Hola! ".$nombreusuario.", en el momento no registras peliculas prestadas a tu nombre";} ?>  </h3>
					</font>
					</center></strong>
					</td>
				</tr>
			<?php	
			}
			?>
		</table>
		
	</body>
</html>