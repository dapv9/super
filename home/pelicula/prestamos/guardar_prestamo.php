<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();
session_start();
$user = $_SESSION["user"];

$fecha_sist = date("Y-m-d");
$hora_sist = date("H:i:s"); 
$error = 0;
$nombres = strtoupper($_REQUEST["nombres"]);
$pelicula = $_REQUEST["pelicula"];
$fechap = $_REQUEST["fechap"];
$fechad = $_REQUEST["fechad"];

$sql = "select * from prestamo where id_pelicula=$pelicula AND estado=1";
$consulprestamo = $BD->consultar($sql);
$idpelicula = $consulprestamo->fields["id_pelicula"];


if($nombres=="" || $pelicula=="" || $fechap=="" || $fechad==""){
	echo "2";

}else if ($fechap >= $fechad) {
	echo "3";
}else if ($pelicula == $idpelicula){
	echo "4";
}else{
	$sql = "insert into prestamo(id_pelicula,prestatario,fecha_prestamo,fecha_devolucion,estado) values($pelicula,'$nombres','$fechap','$fechad',1)";
	$res = $BD->consultar($sql);

	$sql = "select MAX(id) AS id from prestamo";//obtengo el id maximo de la ultima insercion en prestamo
	$res2 = $BD->consultar($sql);
	 $id = $res2->fields["id"];

	$sql = "insert into audi_prestamos(id_prestamo,id_pelicula,prestatario,estado,hora,fecha,programa,usuario) values($id,$pelicula,'$nombres',1,'$hora_sist','$fecha_sist',1,'$user')";
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