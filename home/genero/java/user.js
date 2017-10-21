// JavaScript Document ajax /PelisMilo/home/genero/java/user.js
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

//GUARDO GENERO
function guardagenero(){
	divResultado = document.getElementById("mensaje")
	genero = document.getElementById("genero").value
	descripcion = document.getElementById("descripcion").value
	$("#mensaje").fadeIn("fast");
	ajax = objetoAjax();
	ajax.open("POST","genero/guarda_genero.php",true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4)
		{
			if(ajax.responseText==1)
			{
				divResultado.innerHTML = "<strong><font color='#088A29'><img src='imgs/bien.png' width='30' height='30'/> &nbsp;El genero se guardo exitosamente  en PelisMilo</font></strong>";
					document.getElementById("genero").value=""
					document.getElementById("descripcion").value=""
					$("#mensaje").delay(5000).fadeOut("fast");
			}else if(ajax.responseText==2)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;El genero ya se encuentra registrado en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else if(ajax.responseText==3)
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/alto.png' width='30' height='30'/> &nbsp;Los campos con (*) son obligatorios</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
				
			}else
			{
				divResultado.innerHTML =  "<strong><font color='#DF0101'><img src='imgs/error.png' width='30' height='30'/> &nbsp;Error al tratar de guardar el genero en PelisMilo</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 
			}
		}else
		{
			divResultado.innerHTML = "<br><center>Cargando ...<br><img src = 'imgs/loadingAnimation.gif''></center>"			
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("genero="+genero+"&descripcion="+descripcion)
}


function cambia_estado(id,num)
{
	divResultado = document.getElementById('estado_cambia'+id);	
	if( confirm('Esta seguro(a) de cambiar el estado de este genero?'))
	{
		ajax=objetoAjax();
		ajax.open("POST","genero/estado_genero.php",true);
		ajax.onreadystatechange=function()
		{		
			if (ajax.readyState==4)
			{
				divResultado.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("id="+id+"&num="+num)
	}
}


