<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/

try {
	//Host Local
	$dsn = 'mysql:host=localhost;dbname=orange77_casamentoemdetalhes';
	$usuario = 'root';
	$senha = '';
	$sessionpath = 'C:/xampp/tmp';
	$pdo = new PDO($dsn, $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8, NAMES utf8"));
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {  //$e
	//echo 'Error: '.$e->getMessage();
	if(!isset($pdo) || $pdo == false){
		try{	
			//Host Remoto
			$dsn = 'mysql:host=ricky.heliohost.org;dbname=orange77_casamentoemdetalhes';
			$usuario = 'jecatatu';
			$senha = 'bobao';
			$sessionpath = '/home/orange77/tmp';
			$pdo = new PDO($dsn, $usuario, $senha);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e) {
			echo 'Error: '.$e->getMessage();
		}
	}	
}
/*
In Xampp:
1. Abra o index.php que se encontra dentro da pasta htdocs
2. No arquivo aberto, edite e substitua a palavra 'dashboard' pelo diretório ou pasta do site que vocÊ quer que apareça automaticamente como default (padrão) ao digitar no browser localhost/
3. Reinicie o servidor e pronto!

Dicas de importação de banco de dados:
1. Crie um banco de dados em localhost phpMyAdmin, e utilize o mesmo nome
2. Exporte o banco de dados do servidor remoto usando o formato SQL (Salve no seu PC).
3. Agora importe esse arquivo SQL para o localhost, dentro da base de dados anteriormente criada.
*/
?>