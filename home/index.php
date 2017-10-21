<?php 
include("html.php");
?>
<link rel="stylesheet" href="css/style.css" type="text/css" />
 <script type="text/javascript" src="java/htmlhttprequest.js"></script>
<script language="JavaScript" type="text/javascript" src="java/scw.js"></script>
<script language="JavaScript" type="text/javascript" src="jquery/jquery-1.4.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="pelicula/java/user.js"></script>
<script language="JavaScript" type="text/javascript" src="genero/java/user.js"></script>
<script language="JavaScript" type="text/javascript" src="exportar/java/exportar.js"></script>
<script language="JavaScript" type="text/javascript" src="pelicula/prestamos/java/prestamo.js"></script>





<script language="javascript">
function validar_numeros(evt){
	if(window.event){
		keynum = evt.keyCode;
		}else{
		keynum = evt.which;
	}		
	if((keynum>47 && keynum<58) || (keynum==13) ) {
			return true;
		}else{
			return false;
		}
}

</script>
