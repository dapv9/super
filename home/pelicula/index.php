<?php 
session_start();
if(!$_SESSION){
	echo "<script type='text/javascript'>
		document.location='../login/login.php';
	</script>";
}

echo "Ingreso no valido";
?>

<!-- ESTE ARCHIVO ES PARA LAS SIGUIENTES FUNCIONES:
	1- EVITAR LA VISTA DE CARPETAS Y ARCHIVOS RAIZ EN SERVIDOR POR MEDIO DE URL SIN INICIO DE SESION.
	2- EVITAR EL INGRESO DE USUARIOS POR MEDIO DE URL A OTRAS CARPETAS Y ARCHIVOS DEL PROGRAMA.
-->