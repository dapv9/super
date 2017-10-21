// JavaScript Document ajax  /PelisMilo/home/pelicula/java/user.js
function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//GUARDO PELICULAS
function pelicula(){
	divResultado = document.getElementById("mensaje")
	nompeli = document.getElementById("nompeli").value
	duracion = document.getElementById("duracion").value
	ano = document.getElementById("ano").value
	actor1 = document.getElementById("actor1").value
	genero = document.getElementById("genero").value
	director = document.getElementById("director").value
	direct = document.getElementById("direct").value
	sinopsis = document.getElementById("sinopsis").value	
	$("#mensaje").fadeIn("fast");
	ajax = objetoAjax();
	ajax.open("POST","pelicula/guardar_peli.php",true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4)
		{
			if(ajax.responseText==1)
			{
				divResultado.innerHTML = "<strong><font color='#088A29'><img src='imgs/bien.png' width='30' height='30'/> &nbsp;La pelicula se guardo exitosamente  en PelisMilo</font></strong>";
					document.getElementById("nompeli").value="";
					document.getElementById("duracion").value="";
					document.getElementById("ano").value="";
					document.getElementById("actor1").value="";
					document.getElementById("genero").value="";
					document.getElementById("director").value="";
					document.getElementById("sinopsis").value="";	
					$("#mensaje").delay(5000).fadeOut("fast");
			}else if(ajax.responseText==2)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;La pelicula ya se encuentra registrada en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else if(ajax.responseText==3)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;Los campos con (*) son obligatorios</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/error.png' width='30' height='30'/> &nbsp;Error al tratar de guardar la pelicula en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast");
			}
		}else
		{
			divResultado.innerHTML = "<br><center>Cargando ...<br><img src = 'imgs/loadingAnimation.gif''></center>"			
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nompeli="+nompeli+"&duracion="+duracion+"&ano="+ano+"&actor1="+actor1+"&director="+director+"&sinopsis="+sinopsis+"&genero="+genero)
}
//BUSCAR PELICULAS
function buscar_peli(){
	divResultado = document.getElementById('ver');
	nompelib=document.getElementById("nompelib").value;
	generob=document.getElementById("generob").value;
	calificacionb=document.getElementById("calificacionb").value;
	ajax=objetoAjax();
	ajax.open("POST", "pelicula/ver_pelis.php", true);
	ajax.onreadystatechange=function()
	{
		if (ajax.readyState==4) 
		{
			divResultado.innerHTML = ajax.responseText
		}else
		{
			divResultado.innerHTML = "<br><center><img src='imgs/loadingAnimation.gif'></center>"
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nompelib="+nompelib+"&generob="+generob+"&calificacionb="+calificacionb)
}
//SOLICITAR PRESTAMO DE PELICULA DESDE EL BUSCADOR
function solcitarpre(ids){
	divResultado = document.getElementById("msgsolicitud"+ids)
	if( confirm('Esta seguro(a) de realizar la solicitud de prestamo para esta pelicula'))
	{
		ajax=objetoAjax();
		ajax.open("POST", "pelicula/prestamos/solcitarprestamo.php", true);
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				divResultado.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("ids="+ids)
	}
}

//DESPLEGAR EL DETALLE
function ver_descri(id,iddirector)
{
	$("#tbdetalle"+id).show();
	$("#desplegar"+id).hide();
	$("#replegar"+id).show();
	divResultado=document.getElementById("verdetalle"+id)
	ajax = objetoAjax();
	ajax.open("POST", "pelicula/descripcion_pelis.php", true);
	ajax.onreadystatechange=function()
	{
		if(ajax.readyState==4)
		{
			divResultado.innerHTML=ajax.responseText
		}
		else
		{
			divResultado.innerHTML = "<br><center><img src = 'imgs/loadingAnimation.gif'></center>"
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+id+"&iddirector="+iddirector)	
}
//CERRAR EL DETALLE
function cerrar_descri(id)
{
	$("#tbdetalle"+id).fadeOut(100);
	$("#replegar"+id).hide();
	$("#desplegar"+id).show();
}

function cambia_calificacion(idp,num){
	divResultado = document.getElementById('estado_calificacion'+idp);	
	if( confirm('Esta seguro(a) de cambiar el estado de calificacion de  esta pelicula.?\nRecuerda que si realizas este cambio ya no lo podras deshacer '))
	{
		ajax=objetoAjax();
		ajax.open("POST","pelicula/calificacion.php",true);
		ajax.onreadystatechange=function()
		{		
			if (ajax.readyState==4)
			{
				divResultado.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("idp="+idp+"&num="+num)
	}
}

function mensaje(idm){
	divResultado = document.getElementById('mensaje2'+idm);
	$("#mensaje2"+idm).fadeIn("fast");
	divResultado.innerHTML = "<center><strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;Lo sentimos pero esta calificacion ya fue generada por otro usuario y no puedes realizar este cambio.</br> Si su deseo es cambiar esta calificacion, comuniquese con el adminitrador de PelisMilo y solicite reiniciar las votaciones.</font></strong></center>" ; 
	$("#mensaje2"+idm).delay(6000).fadeOut("fast"); 
}