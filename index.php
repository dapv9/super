<?php 
session_start();
if(!$_SESSION){
	echo "<script type='text/javascript'>
		document.location='login/login.php';
	</script>";
}
?>
<html>
<head>
<title>.:: PelisMilo V1.0::.</title>
</head>
<body>
<script language="javascript">
    
var device = navigator.userAgent

if (device.match(/Iphone/i)|| device.match(/Ipod/i)|| device.match(/Android/i)|| device.match(/J2ME/i)|| device.match(/BlackBerry/i)|| device.match(/iPhone|iPad|iPod/i)|| device.match(/Opera Mini/i)|| device.match(/IEMobile/i)|| device.match(/Mobile/i)|| device.match(/Windows Phone/i)|| device.match(/windows mobile/i)|| device.match(/windows ce/i)|| device.match(/webOS/i)|| device.match(/palm/i)|| device.match(/bada/i)|| device.match(/series60/i)|| device.match(/nokia/i)|| device.match(/symbian/i)|| device.match(/HTC/i)){ 

   alert("Ingreso con celular");
 
}else{
    document.location="home/login/login.php";
}
h
    

</script>
</body>
</html>
