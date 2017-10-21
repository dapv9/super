<?php 


if (isset($_GET['generob'])) {
$generob = $_GET['generob'];
} else {
$generob = "";
}

if (isset($_GET['calificacionb'])) {
$calificacionb = $_GET['calificacionb'];
} else {
$calificacionb = "";
}

//Exportar datos de php a Excel
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=PelisMilo-Listado.xls");

include("../BD.php");
$BD= new BD();
$BD->conectar();

$contador = 0;
$sql = "select * from pelicula where";
$con=0;

if($generob!=""){
   if ($con > 0){
	 $sql.=" and id_genero = $generob";
   }
   else{
	 $sql.="  id_genero = $generob";
   }
   $con=1;
}

if($calificacionb!=""){
   if ($con > 0){
	 $sql.=" and calificacion = $calificacionb";
   }
   else{
	 $sql.="  calificacion = $calificacionb";
   }
   $con=1;
}

if($con==0){
$sql="SELECT * FROM pelicula";
}

$sql.=" order by nombre ASC ";
$respelicula = $BD->consultar($sql);
$numerorg = $BD->numreg($respelicula);



?>
<table class="tabla" border="1">
    <tr>
    	<td align="center"><strong>#</strong></td>
    	<td align="center"><strong>NOMBRE PELICULA</strong></td>
       	<td align="center"><strong>GENERO</strong></td>
    	<td align="center"><strong>DIRECTOR</strong></td>
    	<td align="center"><strong>SIPNOPSIS</strong></td>
    	<td align="center"><strong>FORMATO</strong></td>
		<td align="center"><strong>DURACION</strong></td>
		<td align="center"><strong>ANO</strong></td>
		<td align="center"><strong>CALIFICACION</strong></td>
    </tr>
    
<?php
$arraycalificacion[0] = "NO CALIFICADA";
$arraycalificacion[1] = "BUENA";
$arraycalificacion[2] = "REGULAR";
$arraycalificacion[3] = "MALA";
while (!$respelicula->EOF) {
		$contador++;
		$id = $respelicula->fields["id_pelicula"];
		$idgenero = $respelicula->fields["id_genero"];
		$iddirector = $respelicula->fields["id_director"];

		$sql ="select nombre from genero where id_genero=$idgenero LIMIT 0,1";
		$genero = $BD->consultar($sql);

		$sql = "select nombre from director where id_director=$iddirector LIMIT 0,1";
		$director = $BD->consultar($sql);
	printf ("<tr>
		<td>".$contador."</td>
		<td>".$respelicula->fields["nombre"]."</td>
		<td>".$genero->fields["nombre"]."</td>
		<td>".$director->fields["nombre"]."</td>
		<td>".$respelicula->fields["sinopsis"]."</td>
		<td>".$respelicula->fields["formato"]."</td>
		<td>".$respelicula->fields["duracion"]."-Min</td>
		<td>".$respelicula->fields["ano"]."</td>
		<td>".$arraycalificacion[$respelicula->fields["calificacion"]]."</td>
   </tr>");
   $respelicula->MoveNext();
}   