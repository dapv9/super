<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "SELECT * FROM pelicula ORDER BY nombre ASC";
$pelicula = $BD->consultar($sql); 

?>
<div id="mensaje"></div>
<form action="javascript:guarda_prestamo()" name="frm" method="post">
<table class="tabla">
    <tr>
        <td align="center"  colspan="4" bgcolor="#CCCCCC"><h3>PRESTAMO DE PELICULAS</h3> </td>
    </tr>
    <tr>
        <td class="celda"><strong>Nombres y apellidos </strong></td>
        <td>
			<input type="text" name="nombres" id="nombres" style="text-transform:uppercase;"  size="50" placeholder="quien solicita el prestamo" />(*)	
     	</td>
     </tr>
     <tr>	
    	<td class="celda"><strong>Pelicula a prestar : </strong></td>
        <td>
 	    <select name="pelicula" id="pelicula"   style="width:320px">
            	<option value="0"> Seleccione pelicula... </option>
				<?php
				while(!$pelicula->EOF)
				{
				 ?>
                <option value="<?php echo $pelicula->fields["id_pelicula"]?>"><?php echo $pelicula->fields["nombre"]?></option>
                <?php 
				$pelicula->MoveNext();
				}
				?>
           </select>(*)		
        </td>
    </tr> 
	<tr>
		<td class="celda">Fecha de prestamo :</td>
		<td>
			<input type="date" name="fechap" id="fechap" >(*)	
		</td>
		<td class="celda">Fecha de Devolucion :</td>
		<td>
			<input type="date" name="fechad" id="fechad">(*)	
		</td>
	</tr>
    <tr>
    	<td align="center" colspan="4">
     	   <input type='submit' class="button" value=" Guardar "/>
     	   <input type='button' class="button" value=" Ver peliculas Prestadas " onclick="javascript:ver_prestamo()" />
        </td>
    </tr>
</table>
</form>
<br>
<div id="ver"></div>