<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar(); 


//$fecha = date("Y-m-d");
//$hora = date("H:i:s"); 
$error = 0;

 $nompeli = strtoupper($_REQUEST["nompeli"]);
$duracion = $_REQUEST["duracion"];
$ano = $_REQUEST["ano"];
$actor1 = strtoupper($_REQUEST["actor1"]);
 $genero = $_REQUEST["genero"];
$director = strtoupper($_REQUEST["director"]);
$sinopsis = strtoupper($_REQUEST["sinopsis"]); 

//Consultas para registros y claves primarias

$sql = "select * from pelicula where nombre like '%$nompeli%'";
$consulpelicula = $BD->consultar($sql);
$nombrepelicula = $consulpelicula->fields["nombre"];



if($nompeli=="" || $genero=="" ||  $director==""){
			echo 3; //el campo, nombre pelicula o genero o director se encuentran vacios
	} elseif ($nompeli==$nombrepelicula ){
			echo 2; //la pelicula ya existe!
	 } else{
//	$BD->consultar("BEGIN");
	$sql = "insert into director(nombre)values('$director')";
	$resdirector = $BD->consultar($sql);
	
	$sql = "select * from director where nombre like '%$director%'";
	$consuldirector = $BD->consultar($sql);
	$nombredirector = $consuldirector->fields["nombre"];
	$iddirector = $consuldirector->fields["id_director"];
	
	$sql = "insert into pelicula(nombre,ano,sinopsis,duracion,id_genero,id_director)values('$nompeli',$ano,'$sinopsis',$duracion,$genero,$iddirector)";
	$respeliculas = $BD->consultar($sql);
	
	$sql = "insert into actor(principal)values('$actor1')";
	$resactor = $BD->consultar($sql);
	
	$sql="select actor.id_actor,pelicula.id_pelicula from actor, pelicula  where actor.principal like '%$actor1%'  and pelicula.nombre like '%$nompeli%'";
	$consulactorpeli= $BD->consultar($sql);
	$idactor = $consulactorpeli->fields["id_actor"];
	$idpelicula = $consulactorpeli->fields["id_pelicula"];
	
	$sql = "insert into pelicula_actor(id_pelicula,id_actor)values($idpelicula,$idactor)";
	$respeliactor = $BD->consultar($sql);
	
	$sql = "insert into imagen(id_pelicula,estado_img)values($idpelicula,0)";
	$resimagen = $BD->consultar($sql);
	
 	if(!$resdirector || !$respeliculas || !$resactor || !$respeliactor || !$resimagen) // si alguna de las consultas no inserta los datos
		$error = 1;
		if($error=1){
			//$BD->consultar("ROLLBACK");
			echo 1;
		}else{
			//$BD->consultar("COMMIT");
			echo 0;
		}
	 

}

 	
?>
