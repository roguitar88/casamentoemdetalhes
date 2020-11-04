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
	<link rel="stylesheet" type="text/css" href="css/tabs3.css"/>
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
<title>Casamento em Detalhes | Lista de Presentes</title>

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
<?php include "menulateral.inc.php"; ?>

<div class="conteudogeral clearfix">
<header>
<?php include "cabecalho.inc.php"; ?>
</header>
<!--new div-->
	
<main>
    <div class="conteudoprincipal">
		<div class="tab">
          <div class="centralizador2">
			  <button class="tablinks3" onclick="openCity3(event, 'minhalista')">Minha Lista</button>
			  <button class="tablinks3" onclick="openCity3(event, 'editarlista')">Editar Lista</button>
			  <button class="tablinks3" onclick="openCity3(event, 'creditos')" id="defaultOpen2">Créditos Recebidos</button>
			  <button class="tablinks3" onclick="openCity3(event, 'configuracoes')">Configurações</button>
		  </div>
        </div>
        
        <div id="minhalista" class="tabcontent3">
			<?php include "emconstrucao.inc.php"; ?>
		</div>
        
        <div id="editarlista" class="tabcontent3">
			<?php include "emconstrucao.inc.php"; ?>
        </div> 
		
        <div id="creditos" class="tabcontent3">
			<div class="visaogeral">
				<p style="font-weight:bold; font-size: 100%;">Visão Geral</p>
			</div>
			<div class="creditosinformativos">
				<div  class="box1">
					<div class="icon <?php echo $color; ?>">
						<img src="images/pileofcoins.png" width="100%" height="auto"/>
					</div>
					<div class="valor">
						<p class="p1">Total em Presentes</p>
						<p class="p2">R$ 50.000,00</p>
					</div>
				</div>
				<div  class="box1">
					<div class="icon <?php echo $color; ?>">
						<img src="images/clock.png" width="80%" height="auto"/>
					</div>
					<div class="valor">
						<p class="p1">Aguardando o Prazo</p>
						<p class="p2">R$ 25.000,00</p>
					</div>
				</div>
				<div  class="box1">
					<div class="icon <?php echo $color; ?>">
						<img src="images/withdraw.png" width="80%" height="auto"/>
					</div>
					<div class="valor2">
						<p class="p1">Disponível para Saque</p>
						<p class="p2">R$ 18.000,00</p>
					</div>
					<div class="icon2">
						<img src="images/withdraw2.png" width="40%" height="auto"/><br/>
						Solicitar Saque
					</div>
				</div>
			</div>
			<div class="compras">
				<span style="font-weight:bold;">Compras</span> - <span style="font-size:80%;">Confira os últimos presentes recebidos</span>
			</div>
			<div class="box2">
				<table class="tabeladepresentes">
					<tr>
						<th>Presente</th>
						<th>De</th>
						<th>Valor da Compra</th>
						<th>Nº de Cotas</th>
						<th>ID do Pedido</th>
						<th>Data da Compra</th>
						<th>Disponível em</th>
						<th>Recado</th>
					</tr>
					<tr>
						<td>Geladeira 500</td>
						<td>Ana Maria das Graças</td>
						<td>R$ 1.000,00</td>
						<td>10</td>
						<td>#00000000001</td>
						<td>05/12/2019</td>
						<td>10/09/2020</td>
						<td><input class="verrecado <?php echo $color; ?>" type="submit" name="verrecado" value="Ver Recado" /></td>
					</tr>
					<tr>
						<td>Geladeira 500</td>
						<td>Ana Maria das Graças</td>
						<td>R$ 1.000,00</td>
						<td>10</td>
						<td>#00000000001</td>
						<td>05/12/2019</td>
						<td>10/09/2020</td>
						<td><input class="verrecado <?php echo $color; ?>" type="submit" name="verrecado" value="Ver Recado" /></td>
					</tr>
					<tr>
						<td>Geladeira 500</td>
						<td>Ana Maria das Graças</td>
						<td>R$ 1.000,00</td>
						<td>10</td>
						<td>#00000000001</td>
						<td>05/12/2019</td>
						<td>10/09/2020</td>
						<td><input class="verrecado <?php echo $color; ?>" type="submit" name="verrecado" value="Ver Recado" /></td>
					</tr>
					<tr>
						<td>Geladeira 500</td>
						<td>Ana Maria das Graças</td>
						<td>R$ 1.000,00</td>
						<td>10</td>
						<td>#00000000001</td>
						<td>05/12/2019</td>
						<td>10/09/2020</td>
						<td><input class="verrecado <?php echo $color; ?>" type="submit" name="verrecado" value="Ver Recado" /></td>
					</tr>
					<tr>
						<td>Geladeira 500</td>
						<td>Ana Maria das Graças</td>
						<td>R$ 1.000,00</td>
						<td>10</td>
						<td>#00000000001</td>
						<td>05/12/2019</td>
						<td>10/09/2020</td>
						<td><input class="verrecado <?php echo $color; ?>" type="submit" name="verrecado" value="Ver Recado" /></td>
					</tr>
				</table>
			</div>
			<div class="transacoes">
				<span style="font-weight:bold;">Transações</span> - <span style="font-size:80%;">Confira a movimentação do seu dinheiro</span>
			</div>
			<div class="box2">
				<table class="tabeladetransacoes">
					<tr>
						<th>ID da Transação</th>
						<th>Valor do Saque</th>
						<th>Data da Solicitação</th>
						<th>Data da Efetivação</th>
						<th>Status</th>
					</tr>
					<tr>
						<td>#0000000001454</td>
						<td>R$ 14.500,00</td>
						<td>05/08/2019 às 15:37:57</td>
						<td>05/08/2019 às 15:37:57</td>
						<td><input class="status concluido" type="submit" name="status" value="Concluído" /></td>
					</tr>
					<tr>
						<td>#0000000001454</td>
						<td>R$ 14.500,00</td>
						<td>05/08/2019 às 15:37:57</td>
						<td>05/08/2019 às 15:37:57</td>
						<td><input class="status pendente" type="submit" name="status" value="Pendente" /></td>
					</tr>
					<tr>
						<td>#0000000001454</td>
						<td>R$ 14.500,00</td>
						<td>05/08/2019 às 15:37:57</td>
						<td>05/08/2019 às 15:37:57</td>
						<td><input class="status pendente" type="submit" name="status" value="Pendente" /></td>
					</tr>
				</table>
			</div>
		</div>
		
        <div id="configuracoes" class="tabcontent3">
			<?php include "emconstrucao.inc.php"; ?>
		</div>
        <!-- Source code: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs_close  -->
	</div>
</main>
</div>

<script>
function openCity3(evt, cityName3) {
  var i, tabcontent3, tablinks3;
  tabcontent3 = document.getElementsByClassName("tabcontent3");
  for (i = 0; i < tabcontent3.length; i++) {
    tabcontent3[i].style.display = "none";
  }
  tablinks3 = document.getElementsByClassName("tablinks3");
  for (i = 0; i < tablinks3.length; i++) {
    tablinks3[i].className = tablinks3[i].className.replace(" active", "");
  }
  document.getElementById(cityName3).style.display = "block";
  evt.currentTarget.className += " active";
}

// Pega o elemento com a id="defaultOpen" e clica nele
document.getElementById("defaultOpen2").click();
</script>	

<?php include "menuativo.inc.php"; ?>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>

</body>
</html>