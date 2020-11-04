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
	<link href="css/home/reset.css" rel="stylesheet">
	<link href="css/home/bootstrap.min.css" rel="stylesheet">
	<link href="css/home/home.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap-grid.css">-->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <!--[if lt IE 9]>
    	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="scripts/html5shiv-printshiv"></script>
    <![endif]-->
<title>Casamento em Detalhes | Faça um Upgrade Agora!</title>
	
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

<div class="conteudogeral clearfix" style="width:100%;">
<header>
<?php //include "cabecalho.inc.php"; ?>
</header>
<!--new div-->
	
<main>
    <div class="conteudoprincipal" style="margin-top: 0;">
		<!--
		<div class="tab">
          <div class="centralizador">
			  <button class="tablinks4" onclick="openCity4(event, 'visaogeral')" id="defaultOpen3">Visão Geral</button>
			  <button class="tablinks4" onclick="openCity4(event, 'configuracoes')">Configurações</button>
			  <button class="tablinks4" onclick="openCity4(event, 'ajuda')">Ajuda</button>
		  </div>
        </div>
		-->
        <div class="tabcontent5">
			<center>
				<img src="images/hearts.png" style="width: 10%; height: auto;" />
				<h1 style="font-size: 200%; color: brown; font-weight: bold; font-style: italic;">Escolha já um plano!</h1>
			</center>
			<div class="row mt-5 pt-3 pb-3">
				<div class="col borda-marrom-grossa" style="height:auto; margin-top: 20px;">
					<div class="row">
						<div class="col text-center">
							<h2 class="bold" style="margin-top:4%; font-size:250%;">BASIC</h2>
						</div>
					</div>
					<ol class="list_home">
						<li>
							RSVP receptivo
						</li>
						<li>
							Lista de presentes (de loja e virtual)
						</li>
						<li>
							Email automático para agradecimento de presentes
						</li>
						<li>
							Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
						</li>
						<li>
							Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
						</li>
						<li>
							Hashtag do casal
						</li>
						<li>
							Criação do site com: 5 opções de layout para criação de site / inclusão de 3 músicas / inclusão de 5 fotos
						</li>
						<div class="row" style="margin-top:60%;">
							<div class="col text-center">
								<a class="bt bt-marrom" style="font-size:180%;" href="inicio.php">GRATUITO</a>
							</div>
						</div>
					</ol>
				</div>
				<div class="col borda-marrom-grossa ml-3 mr-3 pt-3 pb-3">
				   <div class="row">
					   <div class="col text-center">
						   <h2 class="bold" style="font-size:300%;">GOLD</h2>
					   </div>
				   </div>
					<ol class="list_home">
						<li>
							RSVP receptivo
						</li>
						<li>
							Lista de presentes (de loja e virtual)
						</li>
						<li>
							Email automático para agradecimento de presentes
						</li>
						<li>
							Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
						</li>
						<li>
							Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
						</li>
						<li>
							Hashtag do casal
						</li>
						<li>
							Criação do site com: Todas as opções disponíveis de lyout para criação de site / inclusão de 10 músicas / inclusão de fotos ilimitadas
						</li>
						<li>
							Lista em cotas de lua-de-mel (os itens de presentes serão em passeios e coisas para a lua de mel)
						</li>
						<li>
							Lista de casamento personalizada (os itens de presentes serão..)
						</li>
					</ol>
					<div class="row">
						<div class="col text-center">
							<a class="bt bt-marrom" style="font-size:180%;" href="pagamento.php?plan=2">R$ 149,00/mês</a>
						</div>
					</div>
				</div>
				<div class="col borda-marrom-grossa ml-3 mr-3 pt-3 pb-3" style="margin-top:20px;">
				   <div class="row">
					   <div class="col text-center">
						   <h2 class="bold" style="font-size:250%;">PREMIUM</h2>
					   </div>
				   </div>
					<ol class="list_home">
						<li>
							RSVP receptivo
						</li>
						<li>
							Lista de presentes (de loja e virtual)
						</li>
						<li>
							Email automático para agradecimento de presentes
						</li>
						<li>
							Opção de casamento colaborativo (os itens de presentes serão em fornecedores para o casamento)
						</li>
						<li>
							Controle o seu casamento: Planejador financeiro, input de informações e fornecedores e agenda de tarefas
						</li>
						<li>
							Hashtag do casal
						</li>
						<li>
							Criação do site com: Todas as opções disponíveis de layout para criação de site / inclusão de 6 músicas / inclusão de 10 fotos
						</li>
					</ol>
					<div class="row">
						<div class="col text-center" style="margin-top:50%;">
							<a class="bt bt-marrom" style="font-size:180%;" href="pagamento.php?plan=1">R$ 65,00/mês</a>
						</div>
					</div>
				</div>
			</div>
			<center>Não, obrigado. <a href="#" onclick="goBack()">Continuar no Basic...</a></center>
		</div>
        <!-- Source code: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs_close  -->
	</div>
</main>
</div>

<script>
function goBack() {
  window.history.back();
}
</script>
	
<?php include "menuativo.inc.php"; ?>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
	
</body>
</html>