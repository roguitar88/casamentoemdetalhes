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
<title>#<?php echo $perfil['nomedeusuario']; ?> - Nossas Fotos</title>

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
		<div style="width:100%; height:auto; padding:2%; margin:auto; overflow: auto;"><h2 class="titulodotexto" style="font-family: <?php echo $font; ?>; font-size: <?php echo $size; ?>; color: <?php echo $titlecolor; ?>; margin-bottom: 0;">Fotos</h2></div>
		<div class="flexfotos">
		<?php
		$selecionarfotos = $pdo->prepare("SELECT * FROM fotos WHERE iddocasal = ? ORDER BY data DESC");
		$selecionarfotos->execute(array($perfil['id']));
		$contadordefotos = $selecionarfotos->rowCount();

		if($contadordefotos == 0){
			echo "<br/><br/><br/><br/><br/><center><h2 style=\"color:#CCCCCC;\">Album vazio</h2></center>";
		}else{	
			while($buscarfoto = $selecionarfotos->fetch(PDO::FETCH_ASSOC)){
				$id = $buscarfoto['id'];
		?>
			<div class="photo" style="background:url(fotos/album/<?php echo $buscarfoto['nomediretorio']; ?>); background-size:cover; background-position:center; background-repeat: no-repeat;">
				<!--
				<form action="deletarfoto.php?id=<?php echo urlencode($id); ?>" enctype="multipart/form-data" method="post">
					<input class="lixeirinha" onClick="return confirm('Tem certeza? Deseja apagar realmente a foto?')" type="image" src="images/trash.png" value="Apagar foto" name="deletepic">
				</form>
				-->
				<!--<p class="lixeirinha"><img src="images/trash.png" width="8%" height="auto" /></p>-->
			</div>
		<?php
			}
		}
		?>
		</div>
		<div id="spacer" style="width:100%; height:40px; overflow:auto; margin:auto;"></div>
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