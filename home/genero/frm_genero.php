<?php
session_start();
if(!$_SESSION){
	echo "<script type='text/javascript'>
		document.location='../login/login.php';
	</script>";
}
?>

<html>
	<head>
		<title></title>
	</head>
	<body>
<form action="javascript:guardagenero()" name="frm_genero" method="post">	
<div id="mensaje"></div>
	<table class="tabla">
	<tr>
    	<td align="center" colspan="2" bgcolor="#CCCCCC"><h3>CREAR GENERO NUEVO </h3> </td>
    </tr>
	<tr>
    	<td class="celda"><strong>Nombre genero</strong></td>
        <td><input name="genero" type="text"   id="genero" size="70" autofocus="autofocus"  title="(*)Obligatorio"/> (*)</td>
	</tr>
	<tr>
		<td class="celda"><strong>Discripcion </strong></td>
        <td >
        <textarea name="descripcion" id="descripcion" rows="4" cols="100" placeholder="Escribe una descripción del genero nuevo........"></textarea>
         </td>
	</tr>
	<tr>
    	<td align="center" colspan="2">
     	   <input type='submit' class='button' value=' Guardar genero '>
        </td>
    </tr>
	</table>
</frm>	
	</body>
</html>