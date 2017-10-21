<?php 

include("../BD.php");
$BD= new BD();
$BD->conectar();

$idp=$_POST["idp"];
$num=$_POST["num"];


if($num==1){
	 $sql="update pelicula set calificacion=1 where id_pelicula=$idp";
	$res = $BD->consultar($sql);
	}else if($num==2){
		$sql="update pelicula set calificacion=2 where id_pelicula=$idp";
		$res = $BD->consultar($sql);
}else{
	$sql="update pelicula set calificacion=3 where id_pelicula=$idp";
	$res = $BD->consultar($sql);
}

$sql = "select * from pelicula where id_pelicula=$idp";
$pelicula = $BD->consultar($sql);

?>
        <div id="estado_calificacion<?php echo $idp;?>">
		<?php 
			 if($pelicula->fields["calificacion"]==0){  
		?> 
					<a href = "javascript:cambia_calificacion(<?php echo $idp;?>,1)"><img src="imgs/uno.png" title="Buena" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
					<a href = "javascript:cambia_calificacion(<?php echo $idp;?>,2)"><img src="imgs/dos.png" title="Regular" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
					<a href = "javascript:cambia_calificacion(<?php echo $idp;?>,3)"><img src="imgs/tres.png" title="Mala" style="cursor:pointer" width="15%" height="15%"></a>&nbsp;
			<?php	 
					}else if($pelicula->fields["calificacion"]==1){
			?>	 
					<a href = "javascript:mensaje(<?php echo $idp;?>)"><img src="imgs/uno.png" title="Buena" style="cursor:pointer" width="15%" height="15%"></a>
			<?php	 
						} else if($pelicula->fields["calificacion"]==2){
					
			?>
						<a href = "javascript:mensaje(<?php echo $idp;?>)"><img src="imgs/dos.png" title="Regular" style="cursor:pointer" width="15%" height="15%"></a>
		<?php 
			}else{
		?>	
			<a href = "javascript:mensaje(<?php echo $idp;?>)"><img src="imgs/tres.png" title="Mala" style="cursor:pointer" width="15%" height="15%"></a>
		<?php	
			}
		?>
        </div>