<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
if(isset($_POST['salvartemplate'])){
	session_start();
	require "config.php"; 
	include 'sessao.php';

	$templateescolhido = filter_input(INPUT_POST, 'templates');
	
	$err = array();
	
	if(empty($templateescolhido)){
		$err[] = "Por favor, selecione um template.";
	}
	
	if(!$err){
		$salvartemplate = $pdo->prepare("UPDATE usuarios_cadastrados SET template = ? WHERE id = ?");
		$salvartemplate->execute(array($templateescolhido, $row['id']));

		header('Location: '.$urlHost.'/site.php');
		exit;
	}else{
		//$campovazio = true;
		echo '<script>alert("Por favor, selecione um template."); location.href = "'.$urlHost.'/site.php";</script>';
	}
}
?>