<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
include "sessao.php";
session_start();
if(isset($_SESSION['email'])){
	session_destroy();
	header('Location: /orangeadex/casamentoemdetalhes/login.php');
	exit;
}else{
	header('Location: /orangeadex/casamentoemdetalhes/login.php');
	exit;
}
?>