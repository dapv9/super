<?php session_start();

if (isset($_SESSION['usuario'])) {

} else {
 header('location:login.php');
}

$errores ='';
$enviado ='' ;
if (isset($_POST['submit'])) {
 $nombre = $_POST['nombre'];
 $correo = $_POST['correo'];
 $telefono = $_POST['telefono'];
 $mensaje = $_POST['mensaje'];


      if (empty($nombre)) {
      $errores .=  "Por Favor ingrese Un nombre <br>"; 
      } else {
            $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
      }
      if (!empty($correo)) {
    $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);

    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
      $errores .= 'Por favor ingresa un correo valido <br />';
    }
  } else {
    $errores .= 'Por favor ingresa un correo <br />';
  }
       if (empty($telefono)) {
      $errores .=  "Por Favor ingrese Un telefono <br>"; 
      } else {
            $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
      }
       if (empty($mensaje)) {
      $errores .=  "Por Favor ingrese Un mensaje <br>"; 
      } else {
            $mensaje = filter_var($mensaje, FILTER_SANITIZE_STRING);
      }
      if(!$errores){
    $enviar_a = 'tunombre@tuempresa.com';
    $asunto = 'Correo enviado desde miPagina.com';
    $mensaje_preparado = "De: $nombre \n";
    $mensaje_preparado .= "Correo: $correo \n";
    $mensaje_preparado .= "Mensaje: " . $mensaje;

    //mail($enviar_a, $asunto, $mensaje_preparado);
    $enviado = 'true';
  }
      

} 












require 'views/contacto.view.php';
 ?>