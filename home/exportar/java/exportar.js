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


//BUSCAR PELICULAS
function excel(){
	var generob=document.getElementById("generob").value;
	var calificacionb=document.getElementById("calificacionb").value;	   
	var myWindow = window.open("exportar/excel.php?generob="+generob+"&calificacionb="+calificacionb, "PelisMilo", "width=800,height=400");
   // myWindow.document.write("<p>This is 'MsgWindow'. I am 200px wide and 100px tall!</p>");

}
function pdf(){
	divResultado = document.getElementById('ver');
	generob=document.getElementById("generob").value;
	calificacionb=document.getElementById("calificacionb").value;
	ajax=objetoAjax();
	ajax.open("POST", "exportar/pdf.php", true);
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
	ajax.send("generob="+generob+"&calificacionb="+calificacionb)

}