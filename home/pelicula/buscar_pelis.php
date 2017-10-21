<?php 
 include("../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "SELECT * FROM pelicula ORDER BY nombre ASC";
$pelicula = $BD->consultar($sql); 

$sql = "SELECT * FROM genero where estado=1 ORDER BY nombre ASC";
$genero = $BD->consultar($sql);

?>
<form action="javascript:buscar_peli()" name="frm" method="post">
<table class="tabla">
    <tr>
        <td align="center"  colspan="4" bgcolor="#CCCCCC"><h3>PARAMETROS DE BUSQUEDA </h3> </td>
    </tr>
    <tr>
        <td class="celda"><strong>Nombre Pelicula </strong></td>
        <td>
			<input type="text" name="nompelib" id="nompelib" style="text-transform:uppercase;"  size="50" placeholder="Busqueda por Pelicula...." list="peli"/>	
            <datalist id="peli">
            <?php 
				while(!$pelicula->EOF)
				{
			?>
			    <option label="<?php echo $pelicula->fields["id_pelicula"]?>" value="<?php echo $pelicula->fields["nombre"]?>">
            <?php 
				$pelicula->MoveNext();
				}
			?>    
			</datalist>
        </td>
    	<td class="celda"><strong>Genero : </strong></td>
        <td>
 	    <select name="generob" id="generob"   style="width:320px">
            	<option value=""> Busqueda por genero... </option>
				<?php
				while(!$genero->EOF)
				{
				 ?>
                <option value="<?php echo $genero->fields["id_genero"]?>"><?php echo $genero->fields["nombre"]?></option>
                <?php 
				$genero->MoveNext();
				}
				?>
           </select>	
        </td>
    </tr> 
	<tr>
		<td class="celda">Calificacion o Votacion :</td>
		<td>
		<select name="calificacionb" id="calificacionb" style="width:320px">
				<option value="">Busqueda por calificacion....</option>
				<option value="1">Calificacion Buena..</option>
				<option value="2">Calificacion Regular....</option>
				<option value="3">Calificacion Mala....</option>
		</select>
	</tr>
    <tr>
    	<td align="center" colspan="4">
     	   <input type='submit' class="button" value=" Buscar "/>
        </td>
    </tr>
</table>
</form>
<br>
<div id="ver"></div>