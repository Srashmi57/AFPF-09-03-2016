<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google OpenID authentication in PHP | 91 Web Lessons</title>
<link rel="stylesheet" type="text/css" href="css/style.css" /> 
</head>
<body>
<div id="container">
    <!--top section start-->
   
    
    <div id="wrapper">
			<?php
			if (isset($_SESSION['UNAME']) && !(empty($_SESSION['UNAME']))){
				echo '<a href="logout.php"><b><u>Logout</u></b></a><br/><br/>';
				echo "Name:-".$_SESSION['UNAME']."<br/><br/>";
				echo "Email:-".$_SESSION['UEMAIL'];
			}else{
				echo '<a href="login_process.php">Login With Gmail</a>';
			}
			?>
			<div id="flash"></div>
    </div>

    <!--fotter section start-->
    
</div>

</body>
</html>
