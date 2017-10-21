<?php 
include("../../BD.php");
$BD= new BD();
$BD->conectar();

//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
    //obtenemos id de la pelicula
    $id_pelicula = $_POST["pelisnom"];
    //obtenemos el archivo a subir
    $file = $_FILES['archivo']['name'];

    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("pelis/")) 
        mkdir("pelis/", 0777); 
     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"pelis/".$file))
    {
       sleep(3);//retrasamos la petición 3 segundos
       echo $file;//devolvemos el nombre del archivo para pintar la imagen

        $sql = "update imagen set estado_img=1,nombre='$file'where id_pelicula=$id_pelicula";
        $resimagen = $BD->consultar($sql);
    }
}else{
    throw new Exception("Error Processing Request", 1);   
}

 
?>