<?php 
include("../../BD.php");
$BD= new BD();
$BD->conectar();

$sql = "SELECT pelicula.nombre as nom,imagen.id_pelicula as idpeli,imagen.estado_img as estado FROM pelicula, imagen WHERE pelicula.id_pelicula = imagen.id_pelicula and imagen.estado_img = 0";
$resimagen = $BD->consultar($sql);

?>


<!DOCTYPE html>
<html>
<head>
	<title>.::Subir Imagenes PelisMilo::.</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="java/user.js"></script>
<style type="text/css">
/*--------- CLASES DE LAS TABLAS ------------ */
.tabla{ 
    background-color:ffffff; 
    border-style:solid; 
    border-color:#666; 
    border-width:1px;
    width:100%;
     
}   
td { 
    font-family:verdana,arial; 
    font-size:8pt; 
} 

.celda{ 
    background-color:#F2F2F2; 
    color:#000; 
    font-weight:bold; 
    font-size:10pt; 
} 
/* botones  */

.btn{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #555555;
  border-right:1px solid #555555; 
  border-top:0px; 
  border-left:0px; 
  font-size: 9px;
  color:black; 
  background-image: url(imgs/btns.png);
  padding-left: 20px; 
  background-repeat: no-repeat; 
  cursor:hand; 
  cursor:pointer;
  margin-left:5px; 
  margin-right:5px; 
  outline-width:0px;
}

.btn:hover{
  height: 23px; 
  background-color: #f5f5f0; 
  border-bottom: 1px solid #AAAAAA;
  border-right:1px solid #AAAAAA; 
  border-top:0px; 
  border-left:0px;
  font-size: 9px; 
  color:black;
  padding-left: 20px; 
  background-repeat: no-repeat;
  cursor:hand; 
  cursor:pointer; 
  margin-left:5px; 
  margin-right:5px;
  outline-width:0px;
  background-image: url(imgs/btns_act.png);
  
}
.btnadd{ background-position: 0px -92px; }    /*añadir*/
.btnfind{ background-position: 0px -115px; }  /*buscar*/
.btnprint{ background-position: 0px -69px; }  /*imprimir*/
.btnmail{ background-position: 0px -138px; }  /*enviar por email*/
.btnsave{ background-position: 0px 0px;}      /*guardar*/   
.btndelete{ background-position: 0px -46px; } /*eliminar*/
.btncancel{ background-position: 0px -23px; } /*cancelar*/
.btncopy{ background-position: 0px -161px; }  /*copiar*/
.btnnonuser{ background-position: 0px -322px; }/*un usuario*/
.btnuser{ background-position: 0px -276px; } /*otro usuario*/
.btnadmin{ background-position: 0px -299px; } /*un administrador*/
.btncheck{ background-position: 0px -207px; } /*marcar todos*/
.btnuncheck{ background-position: 0px -230px; } /*desmarcar todos*/
.btnrefresh{  background-position: 0px -345px;  } /*refrescar*/
.btnlogout{ background-position: 0px -368px; } /*desconectar*/
.btnapply{ background-position: 0px -184px; } /*aplicar modificacion*/

.button{
    cursor:pointer;
    display: inline-block;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0 0 1px #117ED2;
    -moz-box-shadow: 0 0 1px #117ED2;
    -ms-box-shadow: 0 0 1px #117ED2;
    box-shadow: 0 0 1px #117ED2;    
    background: -webkit-linear-gradient(top, #52a8e7 5%,#2b70c3 100%);
    background: -moz-linear-gradient(top, #52a8e7 5%,#2b70c3 100%); 
    filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='#52a8e7', EndColorStr='#2b70c3'); /* IE6,IE7, IE8,IE9 */ 
    background: -ms-linear-gradient(top, #52a8e7 5%,#2b70c3 100%);
    background: linear-gradient(top, #52a8e7 5%,#2b70c3 100%);
    border:1px solid #117ED2;
    color: rgb(255, 255, 255);
    font-family: 'Lucida Grande', 'Lucida Sans Unicode', Helvetica, Arial, Verdana, sans-serif;
    padding: 0px 20px 0px 20px;
    text-shadow: rgba(0, 0, 0, 0.6) 0px -1px 0px;
    height: 26px;
}

    .messages{
        float: left;
        font-family: sans-serif;
        display: none;
    }
    .info{
        padding: 10px;
        border-radius: 10px;
        background: orange;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .before{
        padding: 10px;
        border-radius: 10px;
        background: blue;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .success{
        padding: 10px;
        border-radius: 10px;
        background: green;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
    .error{
        padding: 10px;
        border-radius: 10px;
        background: red;
        color: #fff;
        font-size: 18px;
        text-align: center;
    }
</style>
</head>
<body>
 <!--el enctype debe soportar subida de archivos con multipart/form-data-->
<form enctype="multipart/form-data" class="formulario" >
    <table class="tabla">
        <tr>
            <td align="center" colspan="2" bgcolor="#CCCCCC"><h2>SUBIR IMAGENE DE PELICULA </h2></br><h3>Importante solo se admite archivos de imagenes JPG, JPEG, PNG, GIF </h3></td>
        </tr>
        <tr>
            <td class="celda">Peliculas sin imagenes:</td>    
            <td>
                <select name="pelisnom" id="pelisnom" style="width:150px" onchange="activar(this.value);">
                <option value="" >Seleccione pelicula.....</option>
                <?php
                while(!$resimagen->EOF)
                {
                 ?>
                <option value="<?php echo $resimagen->fields["idpeli"]?>"><?php echo $resimagen->fields["nom"]?></option>
                <?php 
                $resimagen->MoveNext();
                }
                ?>
                </select>
            </td>
        </tr>
       
            <tr>
                <td class="celda">Imagen:</td>    
                <td><input name="archivo" type="file" id="imagen" disabled="disabled"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center"> <input type="button" value="Subir imagen" class="button" id="boton"  disabled="disabled"/> </td>
            </tr>
    </table>
</form>
</br>
    <!--div para visualizar mensajes-->
    <div class="messages"></div><br /><br />
    <!--div para visualizar en el caso de imagen-->
    <div class="showImage"></div>

</body>
</html>