<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();
session_start();
$idusuario = $_SESSION["idusuario"];
$ids = $_REQUEST["ids"];
//$nume = $_REQUEST["nume"];
$fecha = date("Y-m-d");
$hora = date("H:i:s"); 
$error = 0;

$sql = "SELECT estado FROM solicitu_prestamo WHERE id_pelicula=$ids AND id_usuario=$idusuario";
$resul = $BD->consultar($sql);
$numerorg = $BD->numreg($resul);
$estado = $resul->fields["estado"];

if($BD->numreg($resul)>0){

	 if($estado==1){
		$sql = "UPDATE solicitu_prestamo SET estado=0 WHERE id_pelicula=$ids AND id_usuario=$idusuario";
		$ressoli = $BD->consultar($sql);
	}else{
		$sql = "UPDATE solicitu_prestamo SET estado=1 WHERE id_pelicula=$ids AND id_usuario=$idusuario";
		$ressoli = $BD->consultar($sql);
	}
}else{

	$sql = "INSERT INTO solicitu_prestamo (id_pelicula,id_usuario,fecha,hora,estado) VALUES($ids,$idusuario,'$fecha','$hora',1)";
	$res = $BD->consultar($sql);
}

$sql = "SELECT estado FROM solicitu_prestamo WHERE id_pelicula=$ids AND id_usuario=$idusuario";
$resul2 = $BD->consultar($sql);
?>
<div id="msgsolicitud<?php echo $ids;?>">
<?php if($resul2->fields["estado"]==1){?>
	<a href="javascript:solcitarpre(<?php echo $ids;?>)" style="cursor:pointer"> <img src="imgs/closet.png" width="25" height="25" title="Cancelara solicitud de prestamo de esta pelicula"></a>
<?php }else{?>	
	<a href="javascript:solcitarpre(<?php echo $ids;?>)" style="cursor:pointer"> <img src="imgs/prestamo.png" width="25" height="25" title="Solicitar prestamo de esta pelicula "></a>
<?php } ?>
</div>