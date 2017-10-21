<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "SELECT * FROM genero  where estado=1  ORDER BY nombre ASC";
$genero = $BD->consultar($sql);

$sql = "SELECT * FROM director  ORDER BY nombre ASC";
$director = $BD->consultar($sql);
	
?>
  
<form action="javascript:pelicula()" name="frm_pelicula" method="post" enctype="multipart/form-data">
<div id="mensaje"></div>
<table class="tabla">
	<tr>
    	<td align="center" colspan="2" bgcolor="#CCCCCC"><h3>CREAR PELICULA NUEVA </h3> </td>
    </tr>
	<tr>
    	<td class="celda"><strong>Nombre de la pelicula </strong></td>
        <td colspan="2"><input name="nompeli" type="text"  style="text-transform:uppercase;" id="nompeli" size="70" autofocus="autofocus"  title="(*)Obligatorio"/> (*)</td>
    </tr>
    <tr>
    	<td class="celda"><strong>Duracion </strong></td>
        <td>
           <select name="duracion" size="1" id="duracion" style="width:100px">
            	<option value=""> --- </option>
                <?php 
				for($min=1;$min<=200;$min++)
				{
				?>
                    <option value="<?php echo $min;?>"> <?php echo $min;?> Minuto </option>
                <?php 
				}
				?>
            </select> 
        </td>
    </tr>
    <tr>    
		<td class="celda"><strong>Año Pelicula </strong></td>
		<td>
		   <select name="ano" size="1" id="ano" style="width:100px">
            	<option value=""> --- </option>
                <?php 
				for($ano=1910;$ano<=2017;$ano++)
				{
				?>
                    <option value="<?php echo $ano;?>"> <?php echo $ano;?>  </option>
                <?php 
				}
				?>
            </select> 
		</td>
    </tr>
	<tr>
		<td class="celda"><strong>Nombre Actor Principal </strong></td>
		<td>
			<input name="actor1" type="text" style="text-transform:uppercase;" id="actor1"  size="35"  />
		</td>
	</tr>
	<tr>
		<td class="celda"><strong>Tipo de Genero : </strong></td>
        <td colspan="4">
        	<select name="genero" id="genero" "  title="(*)Obligatorio"(*) style="width:320px">
            	<option value=""> Seleccione un genero... </option>
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
				(*)		   
	        </td>
	</tr>
		<td class="celda"><strong>Director </strong></td>
		<td colspan="4"><input name="director" type="text" style="text-transform:uppercase;" id="director"  size="35"  autofocus="autofocus" list="direct" />
			<datalist id="direct">
	            <?php 
					while(!$director->EOF)
					{
				?>
				    <option label="<?php echo $director->fields["id_director"]?>" value="<?php echo $director->fields["nombre"]?>">
	            <?php 
					$director->MoveNext();
					}
				?>    
		   </datalist>
		</td>
	</tr>
    	<td class="celda"><strong>Sinopsis </strong></td>
        <td colspan="4">
        <textarea name="sinopsis" id="sinopsis" rows="4" cols="100" placeholder="Escribe una descripción de la pelicula"></textarea>
         </td>
    </tr>
</form>	

    <tr>
    	<td align="center" colspan="4">
     	   <input type='submit' class='button' value=' Guardar pelicula '>
        </td>
    </tr>
</table>
</form>	
