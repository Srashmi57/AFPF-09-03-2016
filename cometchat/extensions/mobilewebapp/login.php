<?php

include_once(dirname(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR."cometchat_init.php");

if(!empty($_REQUEST['username']) && !empty($_REQUEST['password']) && $_REQUEST['password']!= '' && $_REQUEST['username']!= '' ) {
	$username = mysqli_real_escape_string($GLOBALS['dbh'],$_REQUEST['username']);
	$password = mysqli_real_escape_string($GLOBALS['dbh'],$_REQUEST['password']);
	echo chatLogin($username,$password);
}

?>