<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
session_start();
//session_save_path($sessionpath);
//Nota: Headers already sent - quando isto acontecer, verifique se o config.php está configurado para utf-8 sem BOM. Verifique também se não há algum espaço antes, entre ou após as tags php, ou algum código html anterior ou mesmo algum código php; quaisquer funções envolvendo "echo" ou "print" que produzam algum tipo de saída ou hipertexto; e verifique também se há mensagens de erros ou avisos. Todas estas causas que citei são as mais comuns que ocasionam esse tipo de problema/erro.
include 'sessao.php';

if(!isset($_SESSION['email'])){
	header('Location: /orangeadex/casamentoemdetalhes/');
	exit;
}else{
	$loggedin = true;
	if($row['credencial'] != 0 && $row['credencial'] != 2){
		$adminpermissions = true; //Creio que esta linha pode ser deletada, pois não fará diferença.
	}elseif($row['credencial'] == 2){
		$adminpermissions = true;
		$superadminpermissions = true;
	}else{
		header('Location: /orangeadex/casamentoemdetalhes/');
		exit;
	}
}/*Este código aqui restringe as páginas controladas por admin que monitoram o que acontece no site.*/

//Este código aqui é como se fosse uma chave que protege todas as páginas que necessitam de login para serem acessadas.
?>