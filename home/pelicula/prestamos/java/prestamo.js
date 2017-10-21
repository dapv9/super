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
//GUARDO PRESTAMO
function guarda_prestamo(){
	divResultado = document.getElementById("mensaje")
	nombres = document.getElementById("nombres").value
	pelicula = document.getElementById("pelicula").value
	fechap = document.getElementById("fechap").value
	fechad = document.getElementById("fechad").value
	$("#mensaje").fadeIn("fast");
	ajax = objetoAjax();
	ajax.open("POST","pelicula/prestamos/guardar_prestamo.php",true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4)
		{
			if(ajax.responseText==1)
			{
				divResultado.innerHTML = "<strong><font color='#088A29'><img src='imgs/bien.png' width='30' height='30'/> &nbsp;El registro de prestamo de  pelicula se guardo exitosamente  en PelisMilo</font></strong>";
					document.getElementById("nombres").value=""
					document.getElementById("pelicula").value=""
					document.getElementById("fechap").value=""
					document.getElementById("fechad").value=""
					$("#mensaje").delay(5000).fadeOut("fast");
					ver_prestamo();
			}else if(ajax.responseText==2)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;Los campos con (*) son obligatorios</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else if(ajax.responseText==3)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;La fecha de devolucion es menor o igual a la fecha de prestamo, por favor revisa y vuelve a intentarlo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else if(ajax.responseText==4)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;La pelicula que esta registrando ya se encuentra prestada. por favor verifique y vuelva a intentarlo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				ver_prestamo();
				
			}else
			{
				divResultado.innerHTML = "<strong><font color='#DF0101'><img src='imgs/error.png' width='30' height='30'/> &nbsp;Error al tratar de guardar el registro de prestamo de pelicula en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
			}
		}else
		{
			divResultado.innerHTML = "<br><center>Cargando ...<br><img src = 'imgs/loadingAnimation.gif''></center>"			
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nombres="+nombres+"&pelicula="+pelicula+"&fechap="+fechap+"&fechad="+fechad)
}

//BUSCAR PRESTAMOS
function ver_prestamo(){
	divResultado = document.getElementById('ver');
	ajax=objetoAjax();
	ajax.open("POST", "pelicula/prestamos/ver_prestamos.php", true);
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
	ajax.send()
}

function cambia_estado(id)
{
	//divResultado = document.getElementById('estado_cambia'+id);	
	if( confirm('Esta seguro(a) de realizar la devulucion de esta pelicula?'))
	{
		ajax=objetoAjax();
		ajax.open("POST","pelicula/prestamos/estado_devolucion.php",true);
		ajax.onreadystatechange=function()
		{		
			if (ajax.readyState==4)
			{
				divResultado.innerHTML = ajax.responseText
				ver_prestamo();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("id="+id)
	}
}