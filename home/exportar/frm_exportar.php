<?php 
 include("../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "SELECT * FROM pelicula ORDER BY nombre ASC";
$pelicula = $BD->consultar($sql); 

$sql = "SELECT * FROM genero where estado=1 ORDER BY nombre ASC";
$genero = $BD->consultar($sql);

?>
<form action="" name="frm" method="GET">
<table class="tabla">
    <tr>
        <td align="center"  colspan="4" bgcolor="#CCCCCC"><h3>PARAMETROS DE BUSQUEDA PARA EXPORTAR ARCHIVO A EXCEL O PDF </h3> </td>
    </tr>
    <tr>
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
     	   <input type='button' class="button" value=" Excel " onclick="javascript:excel()" />&nbsp;&nbsp;
     	   <input type='button' class="button" value=" PDF "   onclick="javascript:pdf()"/>
        </td>
    </tr>
</table>
</form>
<br>
<div id="ver"></div>