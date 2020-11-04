<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
session_start();
//session_save_path($sessionpath);
//Nota: Headers already sent - quando isto acontecer, verifique se o config.php está configurado para utf-8 sem BOM. Verifique também se não há algum espaço antes, entre ou após as tags php, ou algum código html anterior ou mesmo algum código php; quaisquer funções envolvendo "echo" ou "print" que produzam algum tipo de saída ou hipertexto; e verifique também se há mensagens de erros ou avisos. Todas estas causas que citei são as mais comuns que ocasionam esse tipo de problema/erro.
include 'sessao.php';

if(!isset($_SESSION['email'])){
	header('Location: '.$urlHost.'/');
	exit;
}else{
	if($row['ativado'] == 0){
		header('Location: '.$urlHost.'/');
		exit;
		//Caso não tenha sido confirmada a sua conta via email, isso significa dizer que o cliente estará impossibilitado de executar qualquer tarefa atual, incluindo o upload de fotos.	
	}	
	if($row['credencial'] != 0){
		$adminpermissions = true;
	}
	$loggedin = true;
}
//Tal código é como se fosse uma chave que protege todas as páginas que necessitam de login para serem acessadas.
?>