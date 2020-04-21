<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/
if(isset($_POST['salvarhistoria'])){
	session_start();
	require "config.php"; 
	include 'sessao.php';

	$historia = filter_input(INPUT_POST, 'historia');
	
	$err = array();
	
	if(empty($historia)){
		$err[] = "Campo vazio. Você tem que digitar alguma coisa.";
	}
	
	if(!$err){
		$salvarhistoria = $pdo->prepare("UPDATE usuarios_cadastrados SET nossahistoria = ? WHERE id = ?");
		$salvarhistoria->execute(array($historia, $row['id']));

		header('Location: /orangeadex/casamentoemdetalhes/site.php');
		exit;
	}else{
		//$campovazio = true;
		echo '<script>alert("Campo Vazio. Você deve digitar sua história."); location.href = "/orangeadex/casamentoemdetalhes/site.php";</script>';
	}
}
?>