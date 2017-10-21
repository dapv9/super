<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar(); 

$nomuser = $_POST["nomuser"];
$pass = $_POST["pass"];
if($nomuser=="" || $pass==""){
		echo "2";
}else{
	session_start();		
	$sql = "select * from usuario where nombre='$nomuser' and pasword='$pass'";
	$resul = $BD->consultar($sql);
	if($BD->numreg($resul)>0){
		// declaro sesiones
		$_SESSION["idusuario"] = $resul->fields["id"]; // id de usuario 
  		$_SESSION["user"] = $resul->fields["nombre"]; //usuario
		$_SESSION["pass"] = $resul->fields["pasword"]; // contraseña
		$_SESSION["nomapeuser"] = $resul->fields["nomape"]; // nombres y apellidos de usuario
		$_SESSION["tipouser"] = $resul->fields["tipo"]; // tipos de usuario
		echo "1";
	}else{
		echo "0";
	}
}
?>