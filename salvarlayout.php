<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
if(isset($_POST['salvar'])){
	session_start();
	require "config.php"; 
	include 'sessao.php';

	$paleta = filter_input(INPUT_POST, 'paleta');  //cores dos backgrounds, cabeçalhos, botões, etc.
	$textoestilo = filter_input(INPUT_POST, 'textoestilo');  //fonte dos títulos
	$cordotitulo = filter_input(INPUT_POST, 'cordotitulo');  //cor dos títulos
	$divisor = filter_input(INPUT_POST, 'divisor');  //divisores
	$fontetexto = filter_input(INPUT_POST, 'fontetexto');  //fonte dos textos
	$cordotexto = filter_input(INPUT_POST, 'cordotexto');  //cor dos textos
	
	$salvarlayout = $pdo->prepare("UPDATE usuarios_cadastrados SET paleta = ?, textoestilo = ?, cordotitulo = ?, divisor = ?, fontetexto = ?, cordotexto = ? WHERE id = ?");
	$salvarlayout->execute(array($paleta, $textoestilo, $cordotitulo, $divisor, $fontetexto, $cordotexto, $row['id']));
	
	header('Location: '.$urlHost.'/site.php');
	exit;
}
?>