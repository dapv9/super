<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();
session_start();
$user = $_SESSION["user"];

$fecha_sist = date("Y-m-d");
$hora_sist = date("H:i:s"); 
$error = 0;
$prestatario = strtoupper($_REQUEST["prestatario"]);
$id_pelicula = $_REQUEST["id_pelicula"];
$fecha_prestamo = $_REQUEST["fecha_prestamo"];
$fecha_devo = $_REQUEST["fecha_devo"];
$id_usuario = $_REQUEST["id_usuario"];

$sql = "select * from prestamo where id_pelicula=$id_pelicula AND estado=1";
$consulprestamo = $BD->consultar($sql);
$idpelicula = $consulprestamo->fields["id_pelicula"];


if($prestatario=="" || $id_pelicula=="" || $fecha_prestamo=="" || $fecha_devo==""){
	echo "2";

}else if ($fecha_prestamo >= $fecha_devo) {
	echo "3";
}else if ($id_pelicula == $idpelicula){
	echo "4";
}else{
	$sql = "INSERT INTO prestamo(id_pelicula,prestatario,fecha_prestamo,fecha_devolucion,estado) VALUES($id_pelicula,'$prestatario','$fecha_prestamo','$fecha_devo',1)";
	$res = $BD->consultar($sql);

	$sql = "SELECT MAX(id) AS id FROM prestamo";//obtengo el id maximo de la ultima insercion en prestamo
	$res2 = $BD->consultar($sql);
	$id = $res2->fields["id"];

	$sql = "UPDATE solicitu_prestamo SET estado=2 WHERE id_pelicula=$id_pelicula AND id_usuario=$id_usuario";
	$ressoli = $BD->consultar($sql);

	$sql = "INSERT INTO audi_prestamos(id_prestamo,id_pelicula,prestatario,estado,hora,fecha,programa,usuario) VALUES($id,$id_pelicula,'$prestatario',1,'$hora_sist','$fecha_sist',1,'$user')";
	$resaudi = $BD->consultar($sql);


 	if(!$res || !$resaudi) // si alguna de las consultas no inserta los datos
	$error = 1;
	if($error=1){
		
		echo 1;
	}else{
		
		echo 0;
	}
	 
}


?>