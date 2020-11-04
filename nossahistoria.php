<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'config.php';

include 'sessao.php';
//session_save_path($sessionpath);

if(isset($_SESSION['email'])){
	if($row['ativado'] == 0){
        header('Location: '.$urlHost.'/ativacao.php');
        exit;
    }else{
		$loggedin = true;
	}
}else{
    //header('Location: '.$urlHost.'/login.php');
    //exit;
}

if($_GET['perfil']){
	$buscarperfil = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE nomedeusuario = ?");
	$buscarperfil->execute(array($_GET['perfil']));
	$perfil = $buscarperfil->fetch(PDO::FETCH_ASSOC);
	
	$ocorrenciadoperfil = $buscarperfil->rowCount();
	
	if($ocorrenciadoperfil == 0){
		header('Location: '.$urlHost.'/inicio.php');
		exit;
	}
}else{
    header('Location: '.$urlHost.'/inicio.php');
    exit;
}
?>
<!--aqui inicia o html-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include "analytics.inc.php"; ?>
    
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content=""/>
<meta name="keywords" content=""/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" type="text/css" href="css/tabs4.css"/>
	<link rel="stylesheet" type="text/css" href="css/tabs.less"/>
	<link rel="stylesheet" type="text/css" href="css/tabs.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton2.css"/>
	<link rel="stylesheet" type="text/css" href="css/rdbutton3.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes2.css"/>
	<link rel="stylesheet" type="text/css" href="css/coloredcheckboxes3.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap-grid.css">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>#<?php echo $perfil['nomedeusuario']; ?> - Nossa História</title>

<?php include "controlswitch2.inc.php"; ?>
<?php include "estilo.inc.php"; ?>
<?php //include "sharebuttons.inc.php"; ?>
<?php //include "jivochat.inc.php"; ?>
<?php include "fpixels.inc.php"; ?>
</head>

<body>
<!--
<script>
  fbq('track', 'CompleteRegistration');
</script>
-->
<!--
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=496788987840316&autoLogAppEvents=1"></script>
-->

<div class="conteudogeral2 clearfix">
<header>
<?php include "whitetop.inc.php"; ?>
<?php include "maintop.inc.php"; ?>
</header>
<!--new div-->
	
<main>
    <div class="conteudoprincipal2">
		<div class="texthalf2">
			<h2 class="titulodotexto" style="font-family: <?php echo $font; ?>; font-size: <?php echo $size; ?>; color: <?php echo $titlecolor; ?>;">Nossa História</h2>
			<p class="estilotexto" style="text-align: left; font-size: 80%; font-family: <?php echo $font1; ?>; color: <?php echo $textcolor; ?>;"><?php echo $perfil['nossahistoria']; ?></p>
			<br/><br/>
			<center><span style="text-align: center; font-family: 'Heartfelt'; font-size: 220%; color: rgba(<?php echo $rgbcolor1; ?>,1);">j</span></center>
		</div>
		<div class="photohalf2">
			
		</div>
	</div>
</main>
</div>
	
<?php include "menuativo2.inc.php"; ?>

<div class="footerdiv1 clearfix">
<footer>
    <?php include "rodape2.inc.php"; ?>
</footer>
</div>
	
</body>
</html>