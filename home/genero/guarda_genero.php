<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar(); 
$error = 0;
$genero =  ucfirst($_REQUEST["genero"]);
$descripcion = $_REQUEST["descripcion"];

//Consultas  para verificar que no se duplique un genero

$sql = "select * from genero where nombre like '%$genero%'";
$consulgenero = $BD->consultar($sql);
$nombregenero = $consulgenero->fields["nombre"];

if($genero=="" || $descripcion=="" ){
			echo 3; //el campo, nombre genero o descripcion se encuentran vacios
	} elseif ($genero==$nombregenero ){
			echo 2; //la genero ya existe!
	 } else{

	$sql = "insert into genero(nombre,descripcion,estado)values('$genero','$descripcion',0)";
	$resgenero = $BD->consultar($sql);
	
	if(!$resgenero) // si la consultas no inserta los datos
	$error = 1;
	if($error=1){
		
		echo 1;
	}else{
		
		echo 0;
	}
}
?>