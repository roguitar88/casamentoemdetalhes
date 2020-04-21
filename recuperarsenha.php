<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
session_start();
include "sessao.php";

if(isset($_SESSION['email'])){
	header('Location: /orangeadex/casamentoemdetalhes');
}
	
if(isset($_GET['codigo'])){
	$reset_code = $_GET['codigo'];
	//$user_id = $_GET['id'];	
	$stmt2 = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE resetar_codigo_senha = ?");
	$stmt2->execute(array($reset_code));
	$row2 = $stmt2->fetch();
	$count2 = $stmt2->rowCount();
	include "enviar_senha.php";
	if($count2 == 1){
?>
<html lang="pt-br">
   <head>
<?php
include 'analytics.inc.php';
?>
<meta charset="utf-8">
<meta name="description" content="Forgot you senha? Reset it here"/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css" id="pagesheet"/>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Recuperação de Senha | Casamento em Detalhes</title>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
<?php
include "fpixels.inc.php";
?>
</head>
<body>
<?php include "jivochat.inc.php";?>

<header>
<?php //include "header.inc.php";?>
</header>
<main>
<div id="conteudo">
    <center>
    <img src="/images/orangeadex.png" width="20%" height="auto" />
    <br/><br/><br/><br/>
    
    <p style="font-size:15px; font-weight: bold; color:#09F; font-family:Verdana, Geneva, sans-serif;">Now reset your senha by choosing a new one. And repeat it for confirmation.</p><br/>
    <span style="font-size:9px;">*Paswword hint: at least 8 characters - number(s), uppercase and lowercase letter(s)</span></<br>
    <form class="formulario" enctype="multipart/form-data" name="senha" method="post" action="">
        <div class="alinharelementos2">
        <label></label><input class="caixadetexto" name="senha1" type="password" id="senha1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="New senha"><br>
        <label></label><input class="caixadetexto" name="senha2" type="password" id="senha2" placeholder="Digitar a senha novamente"><br>
        <input class="botao" name="send1" type="submit" id="send" value="Save New senha">
        </div>
    </form>
    <br/><br/>
	<?php
		if(isset($validationmessages)){
			if($validationmessages == true){
				echo '<ul class="mensagemdevalidacao">';
				foreach($errsenha as $valuesenha){	      			
					echo '<li>' . $valuesenha . '</li>';
				}
				echo '</ul>';
			}
		}
	//--------SEPARADOR ----------------//
    }else{
        if(!isset($_POST['send1'])){
            header('Location: /orangeadex/casamentoemdetalhes');
            exit;
        }
    }
}else{
    //$reset_code = $_GET['codigo'];
    //$user_id = $_GET['id'];
	include "enviar_senha.php";
    ?>
<html>
   <head lang="pt-br">
<?php
include 'analytics.inc.php';
?>
<meta charset="utf-8">
<meta name="description" content="Forgot you senha? Reset it here"/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css" id="pagesheet"/>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Recuperaçao de Senha | Casamento em Detalhes</title>
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
	<?php
include "fpixels.inc.php";
?>
</head>
<body>
<?php include "jivochat.inc.php";?>

<header>
<?php //include "header.inc.php";?>
</header>
<main>
<div id="conteudo">
<!-- style="padding:4%; margin-left:auto; margin-right:auto; overflow:auto; position:relative; width:80%; height:auto; text-align:center;" -->
    <center>
    <img src="images/hearts.png" width="20%" height="auto" />
    <br/><br/><br/><br/>

    <p style="font-size:15px; font-weight: bold; color:#09F; font-family:Verdana, Geneva, sans-serif;">Caso tenha esquecido de vez sua senha, entre com o seu email cadastrado no campo abaixo. Depois, siga as instruções enviadas para o seu email a fim de resetar a conta.</p><br/>
    <form class="formulario" enctype="multipart/form-data" name="senha" method="post" action="">
        <div class="alinharelementos2">
        <label></label><input class="caixadetexto" name="email2" type="text" id="email" placeholder="Digite seu Email"><br>
        <input class="botao" name="send" type="submit" id="send" value="Resetar Senha">
        </div>
    </form>	
    <br/><br/>
    <ul class="mensagemdevalidacao">
    <?php    
		if(isset($followinstructions)){
			if($followinstructions == true){
				echo '<li>Siga as instruções enviadas para '.$email.' e resete a sua senha.</li>';
	  			//echo $row['senha'];
			}
		}
		
		if(isset($emptyfield)){
			if($emptyfield == true){
				echo '<li>Campo vazio ou inválido. Vamos lá! Digite o seu email por favor.</li>';
			}
		}
		
		if(isset($incorrectemail)){
			if($incorrectemail == true){
				echo '<li>Seu email não corresponde ao cadastrado: ou está incorreto ou não existe.</li>';
			}
		}
		
		
    }
	?>
    </ul>
	</center>
</div>
</main>
	
<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
	
</body>
</html>