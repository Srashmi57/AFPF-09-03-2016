<?php
if(!empty($_REQUEST['basedata'])) {
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'cometchat_init.php');
	$_SESSION['basedata']=$_REQUEST['basedata'];
	setcookie($cookiePrefix."data", $_REQUEST['basedata'], 0, "/");
}
$callbackfn='';
if(!empty($_REQUEST['callbackfn'])) {
	$callbackfn = "&callbackfn=".$_REQUEST['callbackfn'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="user-scalable=0,width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<link rel="shortcut icon" type="image/png" href="favicon32.ico">
	<title>CometChat</title>
	<link type="text/css" href="./cometchatcss.php?cc_theme=synergy<?php echo $callbackfn;?>" rel="stylesheet" charset="utf-8">
	<script type="text/javascript" src="./cometchatjs.php?cc_theme=synergy<?php echo $callbackfn;?>" charset="utf-8"></script>
	<script>
		document.addEventListener("dragover",function(e){ 
		   e = e || event; 
		   e.preventDefault();
		},false); 
		document.addEventListener("drop",function(e){ 
			e = e || event; 
			e.preventDefault();
		},false);
	</script>
</head>
<body style="overflow: hidden;">
</body>
</html>