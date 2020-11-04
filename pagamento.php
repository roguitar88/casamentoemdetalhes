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
    }
}else{
    header('Location: '.$urlHost.'/login.php');
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
<title>Casamento em Detalhes | Gateway de Pagamento</title>
	
<?php include "controlswitch.inc.php"; ?>
<?php include "estilo.inc.php"; ?>
<?php //include "sharebuttons.inc.php"; ?>
<?php include "jivochat.inc.php"; ?>
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
<?php //include "menulateral.inc.php"; ?>

<div class="conteudogeral clearfix">
<header>
<?php //include "cabecalho.inc.php"; ?>
</header>
<!--new div-->
	
<main>
    <div class="conteudoprincipal" style="margin-top: 0;">
		<!----------- Formulario do PayPal ----------------------------------------------------->
		<?php include "paypalswitch.inc.php"; ?>
		<?php include "pricing.inc.php"; ?>

		<center>
		<br/><br/><br/>
		<img src="images/hearts.png" style="width: 10%; height: auto;" />
		<h1 class="headerbutton"><?php if($env == "SANDBOX"){ echo "Ambiente de Teste - Sandbox"; }else{ echo "Pagamento Real - Live"; } ?></h1>			

		<form action="https://<?php echo $pp_hostname; ?>/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="<?php echo $hosted_button_id; ?>">
		<input type="hidden" name="on0" value="Plano a ser escolhido">Escolha um Plano<br/>
		<select name="os0">
			<option value="Premium" <?php if(isset($_GET['plan'])){ if($_GET['plan'] == 1){ echo "selected"; } } ?>>Premium: R$<?php echo $premiumplan2." ".$currencycode; ?> - mensalmente</option>
			<option value="Gold" <?php if(isset($_GET['plan'])){ if($_GET['plan'] == 2){ echo "selected"; } } ?>>Gold: R$<?php echo $goldplan2." ".$currencycode; ?> - mensalmente</option>
		</select><br/>
		<input type="hidden" name="currency_code" value="<?php echo $currencycode;?>">
		<input type="image" src="https://<?php echo $pp_hostname; ?>/pt_BR/BR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
		<img alt="" border="0" src="<?php if($env == "LIVE"){ ?>https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif<?php }else{ ?>https://<?php echo $pp_hostname; ?>/pt_BR/i/scr/pixel.gif<?php }?>" width="1" height="1">
		</form>

		<!--
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="3R7YMTE7EB38L">
		<table>
		<tr><td><input type="hidden" name="on0" value="Escolha um Plano">Escolha um Plano</td></tr><tr><td><select name="os0">
			<option value="Premium">Premium: R$65,00 BRL - mensalmente</option>
			<option value="Gold">Gold: R$149,00 BRL - mensalmente</option>
		</select> </td></tr>
		</table>
		<input type="hidden" name="currency_code" value="BRL">
		<input type="image" src="https://www.sandbox.paypal.com/pt_BR/BR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
		<img alt="" border="0" src="https://www.sandbox.paypal.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
		</form>
		-->
		</center>
		<!----------- Formulario do PayPal ----------------------------------------------------->
		
		<!--
		<div class="tab">
          <div class="centralizador">
			  <button class="tablinks4" onclick="openCity4(event, 'visaogeral')" id="defaultOpen3">Visão Geral</button>
			  <button class="tablinks4" onclick="openCity4(event, 'configuracoes')">Configurações</button>
			  <button class="tablinks4" onclick="openCity4(event, 'ajuda')">Ajuda</button>
		  </div>
        </div>
		-->
        <!-- Source code: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs_close  -->
	</div>
</main>
</div>
	
<?php //include "menuativo.inc.php"; ?>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
	
</body>
</html>