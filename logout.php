<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
include "sessao.php";
session_start();
if(isset($_SESSION['email'])){
	session_destroy();
	header('Location: '.$urlHost.'/login.php');
	exit;
}else{
	header('Location: '.$urlHost.'/login.php');
	exit;
}
?>