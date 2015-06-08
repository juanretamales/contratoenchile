<?php
if(!isset($_SESSION)){
	session_start();
}
$_SESSION['id']="";
$_SESSION['nombre']="";
$_SESSION['rol']="";
session_destroy();
header("Location: ../index.php");
?>