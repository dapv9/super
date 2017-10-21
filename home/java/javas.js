// JavaScript Document
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

function abrirVentana(url) {
    window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=800");
}

function desplegarfrmsoli(idsolipeli,idpeli,nomsoli,idsoliuser)
{
	$("#tbdetalle"+idsolipeli).show();
	$("#desplegar"+idsolipeli).hide();
	$("#replegar"+idsolipeli).show();
	divResultado=document.getElementById("verdetalle"+idsolipeli)
	ajax = objetoAjax();
	ajax.open("POST", "pelicula/prestamos/frm_prestamosolicitud.php", true);
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
	ajax.send("idpeli="+idpeli+"&nomsoli="+nomsoli+"&idsoliuser="+idsoliuser)	

}

//CERRAR EL DETALLE
function cerrar_frmsoli(idsolipeli,idpeli,nomsoli,idsoliuser)
{
	$("#tbdetalle"+idsolipeli).fadeOut(100);
	$("#replegar"+idsolipeli).hide();
	$("#desplegar"+idsolipeli).show();
}

function guarda_prestamo(){
	divResultado = document.getElementById("mensaje")
	id_pelicula = document.getElementById("id_pelicula").value
	prestatario = document.getElementById("prestatario").value
	fecha_prestamo = document.getElementById("fecha_prestamo").value
	fecha_devo = document.getElementById("fecha_devo").value
	id_usuario = document.getElementById("id_usuario").value
	$("#mensaje").fadeIn("fast");
	ajax = objetoAjax();
	ajax.open("POST","pelicula/prestamos/guardar_prestamo_soltud.php",true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4)
		{
			if(ajax.responseText==1)
			{
				divResultado.innerHTML = "<strong><font color='#088A29'><img src='imgs/bien.png' width='30' height='30'/> &nbsp;El registro de prestamo de  pelicula se guardo exitosamente  en PelisMilo</font></strong>";
				$("#mensaje").delay(5000).fadeOut("fast");
				location.reload();
				
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
								
			}else
			{
				divResultado.innerHTML = ajax.responseText;"<strong><font color='#DF0101'><img src='imgs/error.png' width='30' height='30'/> &nbsp;Error al tratar de guardar el registro de prestamo de pelicula en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
			}
		}else
		{
			divResultado.innerHTML = "<br><center>Cargando ...<br><img src = 'imgs/loadingAnimation.gif''></center>"			
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id_pelicula="+id_pelicula+"&prestatario="+prestatario+"&fecha_prestamo="+fecha_prestamo+"&fecha_devo="+fecha_devo+"&id_usuario="+id_usuario)
}


