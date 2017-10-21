<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar();

$id=$_POST["id"];
$num=$_POST["num"];

if($num==1){
	$sql="update genero set estado=0 where id_genero=$id";
	$res1=$BD->consultar($sql);
	
	}else{
	$sql="update genero set estado=1 where id_genero=$id";
	$res1=$BD->consultar($sql);
}

$sql = "select * from genero where id_genero=$id";
$genero = $BD->consultar($sql);
?>
        <div id="estado_cambia<?php echo $id;?>">
		<?php 
			 if($genero->fields["estado"]==1) {  
		?>
            <a href = "javascript:cambia_estado(<?php echo $id;?>,1)"><img src="imgs/aprovado.png" title="Activo" style="cursor:pointer" width="25%" height="30%"></a>
		<?php	 
			 }else{
		?>	 
			<a href = "javascript:cambia_estado(<?php echo $id;?>,0)"><img src="imgs/pendiente.png" title="Inactivo" style="cursor:pointer" width="25%" height="30%"></a>
        <?php	 
			 }
				
		?>
        </div>
	

