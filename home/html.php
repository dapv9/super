<?php 
session_start();
if(!$_SESSION){
	echo "<script type='text/javascript'>
		document.location='login/login.php';
	</script>";
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
	<title>.:: PelisMilo V1.0::.</title>
	<link rel="icon" type="image/ico" href="imgs/PelisMiloIco.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <script type="text/javascript" src="java/htmlhttprequest.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="css/menu.css" type="text/css" />
    <script language="JavaScript" type="text/javascript" src="java/javas.js"></script>
    <script language="JavaScript" type="text/javascript" src="java/scw.js"></script>
    <script type="text/javascript" src="pelicula/java/user.js"></script>
    <script language="javascript">
		//-----------------------
		var docClickLoader = new RemoteFileLoader('docClickLoader');
		function loadInto(src, destId, evt){
				var ok = docClickLoader.loadInto(src.href || src.getAttribute('href'), destId);
					if (ok) cancelEvent(evt);
		}
		function toggleInto(src, destId, evt){
			var dest = document.getElementById(destId);
			if (!dest.contentLoaded)
				{
					var ok = docClickLoader.loadInto(src.href || src.getAttribute('href'), destId);
					if (ok) dest.contentLoaded = true;
				}
			cancelEvent(evt);
			if (!dest.toggleState){
				src.innerHTML = 'Close: ' + src.innerHTML;
				dest.style.display = 'block';
				dest.toggleState = 1;
			}else{
				src.innerHTML = src.innerHTML.replace(/^Close: /, '');
				dest.style.display = 'none';
				dest.toggleState = 0;
			}
		};
		addEvent(document, 'click', function(evt){
				evt = evt || window.event;
		// Sólo procesar clics izquierdos.
			if (evt.which > 1 || evt.button > 1) return;
				var src = evt.target || evt.srcElement;
				if (src.nodeType && src.nodeType != 1) src = src.parentNode;
		// Loop en el árbol DOM analizar todos los elementos para encontrar una coincidencia.
			while (src){
				var srcName = (src.nodeName||src.tagName||'').toLowerCase();
				if (srcName == 'a' && src.className && src.className.match(/^(load|toggle)into-(.+)$/)){
		// Llama a nuestros manipuladores de carga, si tenemos un partido, sino que va a cancelar la acción normal.
					if (RegExp.$1 == 'load') return loadInto(src, RegExp.$2, evt);
						if (RegExp.$1 == 'toggle') return toggleInto(src, RegExp.$2, evt);
				}
				src = src.parentNode;
			}
		}, 1);
	</script>
</head>
<body>
    <div align="center">
        <div id="cabecera">
            <div id="titulocabec" align="left"><br><br><br><font color="black"><img src="imgs/user.png" width="30" height="30"/>Usuario: <?php echo $_SESSION["nomapeuser"]; ?></font> </div>
                <div align="left" class="links_menu" id="menu">
                    <ul class="dropdown dropdown-horizontal">
                        <li><a class="loadinto-targetArea" href="pginicio.php"><img src="imgs/inicio.png" width="20" height="20"/>Inicio</a></li>
                        <li>
								<a href="#"><img src="imgs/menu.png" width="20" height="20"/>Admin General<img src="imgs/down.png" width="20" height="10"/> </a>
								<ul>
										<li class="divider"><a href="#"><img src="imgs/pelicula.png" width="20" height="20"/>Peliculas <img src="imgs/right.png" width="20" height="10"/></a>
											<ul>
											<?php if($_SESSION["tipouser"]==1){ ?>
												 <li><a class="loadinto-targetArea" href="pelicula/frm_crearpeli.php" ><img src="imgs/Crear.png" width="20" height="20"/>Crear.. </a></li>
												 <li><a href="#" onClick="abrirVentana('pelicula/subir/frm_subirimg.php')" ><img src="imgs/subir.png" width="20" height="20"/>Subir Imagen..</a></li>
												 <li><a class="loadinto-targetArea" href="pelicula/prestamos/frm_prestamo.php"><img src="imgs/prestamo.png" width="25" height="25"/>Prestar pelicula..</a></li>
												 <li><a class="loadinto-targetArea" href="pelicula/buscar_pelis.php" ><img src="imgs/buscar.png" width="20" height="20"/>Buscar..</a></li>
											<?php }else{ ?>
												<li><a class="loadinto-targetArea" href="pelicula/buscar_pelis.php" ><img src="imgs/buscar.png" width="20" height="20"/>Buscar..</a></li>	
											<?php } ?>	 
											 </ul>
										</li>			
									   <li class="divider"><a href="#"><img src="imgs/genero.png" width="20" height="20"/>Generos <img src="imgs/right.png" width="20" height="10"/></a>
											<ul>
											<?php if($_SESSION["tipouser"]==1){ ?>
												 <li><a class="loadinto-targetArea" href="genero/frm_genero.php" ><img src="imgs/Crear.png" width="20" height="20"/>Crear.. </a></li>
												 <li><a class="loadinto-targetArea" href="genero/ver_genero.php" ><img src="imgs/buscar.png" width="20" height="20"/>Buscar..</a></li>
											<?php }else{ ?>	
												<li><a class="loadinto-targetArea" href="genero/ver_genero.php" ><img src="imgs/buscar.png" width="20" height="20"/>Buscar..</a></li>
											<?php } ?>	 

											 </ul>  		
									   </li><a class="loadinto-targetArea" href="exportar/frm_exportar.php" ><img src="imgs/exportar.png" width="20" height="20"/>Exportar...</a>
								</ul>	
						</li>	
						<li><a  href="login/cerrarlogin.php"><img src="imgs/cerrar.png" width="20" height="20"/>Cerrar Sesion </a></li>	
          	  </div>
        </div>
        
			<div id="contenedor"><br />
					<div id="targetArea"><center><iframe src="baner.php" width="1020" height="600"> </iframe></center></div>      
			</div>
        
			<div class="piepage">
			PelisMilo&copy; <?php echo date("Y");?>
			By: <a href="https://twitter.com/datorres008" target="blank" style="text-decoration:none; color:white;">Datorres008<img src="imgs/twitter.png" width="20" height="20"/></a>
			</div>
	</div>

</body>
</html>
