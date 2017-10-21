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

function valida_login() {
	divResultado = document.getElementById("mensaje")
	nomuser = document.getElementById("nomuser").value
	pass = document.getElementById("pass").value
	$("#mensaje").fadeIn("fast");
	ajax = objetoAjax();
	ajax.open("POST","validalogin.php",true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4){
			if(ajax.responseText==1){
				document.location="../../home/index.php";
			}else if(ajax.responseText==2){
				divResultado.innerHTML = "<strong><font color='#DF0101'><img src='../imgs/alto.png' width='20' height='20'/> &nbsp Ambos campos son obligatorios</font></strong>" ; 
				$("#mensaje").delay(5000).fadeOut("fast"); 		
			}else{
				divResultado.innerHTML = "<strong><font color='#DF0101'><img src='../imgs/error.png' width='20' height='20'/> &nbsp Usuario o contraseña no validos</font></strong>" ; 
				document.getElementById("nomuser").value=""
				document.getElementById("pass").value=""
				$("#mensaje").delay(5000).fadeOut("fast"); 
			}
		}else{
			divResultado.innerHTML = "<br><center>Cargando ...<br><img src = '../imgs/loadingAnimation.gif''></center>"			
		}
		
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("nomuser="+nomuser+"&pass="+pass)
}
	
