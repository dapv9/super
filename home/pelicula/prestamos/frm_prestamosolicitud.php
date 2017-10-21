<?php 
 include("../../BD.php");
$BD= new BD();
$BD->conectar();
session_start();

$nomsoli = strtoupper($_POST["nomsoli"]);
$idpeli = $_POST["idpeli"];
$fecha_sist = date("Y-m-d");
$idsoliuser = $_POST["idsoliuser"];

?>

<form action="javascript:guarda_prestamo()" name="frm" method="post">
<table class="tabla">
    <tr>
        <td align="center"  colspan="2" bgcolor="#CCCCCC"><h3>PRESTAMO DE PELICULAS</h3> </td>
    </tr>
	    <input type="hidden" name="id_pelicula" id="id_pelicula" value="<?php echo $idpeli; ?>">
	    <input type="hidden" name="prestatario" id="prestatario" value="<?php echo $nomsoli; ?>">
	    <input type="hidden" name="fecha_prestamo" id="fecha_prestamo" value="<?php echo $fecha_sist; ?>">
	    <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $idsoliuser; ?>">
	<tr>
		<td class="celda">
		Seleccione la fecha de devolucion para esta pelicula: <input type="date" name="fecha_devo" id="fecha_devo">(*)
		<br><div id="mensaje"></div>
		</td>
    	<td >
     	   <input type='submit' class="button" value=" Finalizar Solicitud"/>
       </td>
    </tr>
</table>
</form>
