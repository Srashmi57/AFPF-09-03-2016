<?php
session_start();
session_destroy();
$arrURLToGO = explode("?",$_SERVER['HTTP_REFERER']);
//echo $_SERVER['HTTP_REFERER'];
header('Location: '.$arrURLToGO[0]);
?>