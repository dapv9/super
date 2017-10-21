<?php 
include("../BD.php");
$BD= new BD();
$BD->conectar(); 
session_start();

if($_SESSION["user"]){
	session_destroy();
	echo "<script type='text/javascript'>
		document.location='login.php';
	</script>";
}else{
	echo "<script type='text/javascript'>
		document.location='login.php';
	</script>";
}

?>