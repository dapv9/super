<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "select * from genero";
$genero = $BD->consultar($sql);
$numerorg = $BD->numreg($genero);
?>
<table class="tabla" border="1">
    <tr>
    	<td align="left" colspan="3"><strong>Total Generos: <?php echo $numerorg;?></strong></td>
	<tr>
	<tr>
       	<td class="celda" align="center"><strong>GENERO</strong></td>
    	<td class="celda" align="center"><strong>DESCRIPCION</strong></td>
		<td class="celda" align="center"><strong>ESTADO</strong></td>
    </tr> 
<?php 
while(!$genero->EOF)
{
$id = $genero->fields["id_genero"]
?>	
   <tr onmouseover='this.style.background="#E6E6E6"' onmouseout='this.style.background="white"'>
    	<td><?php echo $genero->fields["nombre"];?></td>
    	<td><?php echo utf8_encode ( $genero->fields["descripcion"]);?></td>
		<td align="center">
        <div id="estado_cambia<?php echo $id;?>">
		<?php 
			 if($genero->fields["estado"]==1) {  
		?>
            <a href = "javascript:cambia_estado(<?php echo $id;?>,1)"><img src="imgs/aprovado.png" title="Activo" style="cursor:pointer" width="25%" height="30%"></a>
		<?php	 
			 }else{
		?>	 
			<a href = "javascript:cambia_estado(<?php echo $id;?>,0)"><img src="imgs/pendiente.png" title="Inactivo" style="cursor:pointer" width="25%" height="30%"></a>
        <?php	 
			 }
				
		?>
        </div>
      </td>
    </tr> 
<?php 
$genero->MoveNext();
}
?>
</table>