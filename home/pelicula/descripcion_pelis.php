<?php 
require("../BD.php");
$BD=new BD();
$BD->conectar();
$id =$_REQUEST["id"];
$iddirector =$_REQUEST["iddirector"];

$sql = "select * from pelicula WHERE id_pelicula = $id LIMIT 0,1";
$respelicula = $BD->consultar($sql);

$sql = "select * from pelicula_actor where id_pelicula = $id";
$respeliactor = $BD->consultar($sql);
$idactor = $respeliactor->fields["id_actor"];

$sql = "select * from actor where id_actor = $idactor";
$resactor = $BD->consultar($sql);

$sql = "select nombre from director where id_director=$iddirector LIMIT 0,1";
$director = $BD->consultar($sql);

?>
<table class="tabla">
	<tr>
		<td><h3>Actor:</h3> <?php echo $resactor->fields["principal"];?></td>
		<td><h3>Director:</h3> <?php echo $director->fields["nombre"];?></td>
		<td><h3>Duracion:</h3> <?php echo $respelicula->fields["duracion"];?></td>
		<td><h3>Año:</h3> <?php echo $respelicula->fields["ano"];?></td>

	</tr>
	<tr>
        <td colspan="4"><h3>Sinopsis:</br></br><h3><h4><?php echo $respelicula->fields["sinopsis"];?></h4> </td>
    </tr>
</table>    
	


