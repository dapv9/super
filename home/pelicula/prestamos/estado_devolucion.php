<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();
session_start();
$user = $_SESSION["user"];
$error = 0;
$id=$_POST["id"];

$sql = "select id_pelicula,prestatario from prestamo where id=$id";
$respres = $BD->consultar($sql);

$pelicula=$respres->fields["id_pelicula"];
$nombres=$respres->fields["prestatario"];

$fecha_sist = date("Y-m-d");
$hora_sist = date("H:i:s"); 


	$sql="update prestamo set estado=0 where id=$id";
	$res1=$BD->consultar($sql);

	$sql = "insert into audi_prestamos(id_prestamo,id_pelicula,prestatario,estado,hora,fecha,programa,usuario) 
	values($id,$pelicula,'$nombres',0,'$hora_sist','$fecha_sist',1,'$user')";
	$resaudi = $BD->consultar($sql);

	if(!$res1 || !$resaudi) // si alguna de las consultas no inserta los datos
		$error = 1;
		if($error=1){
			
			echo 1;
		}else{
			
			echo 0;
}

?>