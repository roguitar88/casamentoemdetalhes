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
	$loggedin = true;
}else{
    header('Location: '.$urlHost.'/login.php');
    exit;
}

include "timeago.inc.php";
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
<title>Casamento em Detalhes | Início</title>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Mês', 'Visitas'],
	  ['Jan',  0],
	  ['Fev',  50],
	  ['Mar',  70],
	  ['Abr',  48],
	  ['Mai',  80],
	  ['Jun',  87],
	  ['Jul',  68],
	  ['Ago',  53],
	  ['Set',  77],
	  ['Out',  93],
	  ['Nov',  127],
	  ['Dez',  75]
	]);

	var options = {
	  title: '',
	  hAxis: {title: 'Meses',  titleTextStyle: {color: '#333'}},
	  vAxis: {minValue: 0}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
	chart.draw(data, options);
  }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Mês', 'Visitas'],
	  ['Jan',  0],
	  ['Fev',  50],
	  ['Mar',  70],
	  ['Abr',  48],
	  ['Mai',  80],
	  ['Jun',  87],
	  ['Jul',  68],
	  ['Ago',  53],
	  ['Set',  77],
	  ['Out',  93],
	  ['Nov',  127],
	  ['Dez',  75]
	]);

	var options = {
	  title: '',
	  hAxis: {title: 'Meses',  titleTextStyle: {color: '#333'}},
	  vAxis: {minValue: 0}
	};

	var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
	chart.draw(data, options);
  }
</script>
	
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
          <div class="centralizador">
			  <button class="tablinks4" onclick="openCity4(event, 'visaogeral')" id="defaultOpen3">Visão Geral</button>
			  <button class="tablinks4" onclick="openCity4(event, 'configuracoes')">Configurações</button>
			  <button class="tablinks4" onclick="openCity4(event, 'ajuda')">Ajuda</button>
		  </div>
        </div>
        
        <div id="visaogeral" class="tabcontent4">
			<div class="visaogeral">
				<p style="font-weight:bold; font-size: 100%;">Visão Geral</p>
			</div>
			<div class="creditosinformativos">
				<div  class="box1">
					<div class="icon3 <?php echo $color; ?>">
						<img src="images/guests.png" width="70%" height="auto"/>
					</div>
					<div class="valor3">
						<p class="p1">Convidados</p>
						<p class="p2">142</p>
						<p style="font-size: 80%;"><img style="width:5%; height:auto;" src="images/like2.png"q>52 &nbsp;&nbsp;&nbsp;<img style="width:5%; height:auto;" src="images/dislike2.png" />10</p>
					</div>
				</div>
				<div  class="box3" style="background: none;">
					<div class="countdownstyle" style="color: rgb(<?php echo $rgbcolor1; ?>); width:100%; height:auto; text-align:center; padding-top: 5px;">
						<?php
						if($row['datadocasamento'] != "0000-00-00 00:00:00"){
						?>
						<p id="counter"></p>
						<?php
						}else{
						?>
						<p>?d ?h ?m ?s</p>
						<?php
						}
						?>
					</div>
					<div style="width:90%; height:auto; margin:auto;">
						<div style="width:24%; height:auto; float:left; position:relative;">
							<img style="width:100%; height:auto;" src="images/groom.png" />
						</div>
						<div style="width:50%; height:auto; text-align:center; float:left; position:relative;">
							<svg class="heart" viewBox="0 0 32 29.6">
  								<path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2
c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
							</svg>
						</div>
						<div style="width:24%; height:auto; float:right; position:relative;">
							<img style="width:100%; height:auto;" src="images/bride.png" />
						</div>
					</div>
				</div>
				<div  class="box1">
					<div class="icon3 <?php echo $color; ?>">
						<img src="images/budget.png" width="70%" height="auto"/>
					</div>
					<div class="valor3">
						<p class="p1">Orçamento do Casamento</p>
						<p class="p2">R$ 50.000,00</p>
						<p class="p1">24% usado (R$ 12.000,00)</p>
					</div>
				</div>
			</div>
			<div style="width:100%;margin:auto; height:auto; position:relative; display:flex; flex:1; justify-content: space-between;">
				<div style="width:48.5%; height:auto; position:relative;border:0px solid #ccc;">
					<div class="visaogeral">
						<p style="font-weight:bold; font-size: 100%;">Visitas no Site</p>
					</div>
					<div class="box4">
						<div style="width:100%; margin:auto; flex:1; display:inline-flex; justify-content: space-between; position:relative;text-align:center; color:rgba(36,2,49,1.00);">
							<div style="width:24.5%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Total de Visitas</p>
								<p style="font-size:120%; font-weight:bolder;">3850</p>
							</div>
							<div style="width:24.5%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Visita Hoje</p>
								<p style="font-size:120%; font-weight:bolder;">84</p>
							</div>
							<div style="width:24.5%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Essa semana</p>
								<p style="font-size:120%; font-weight:bolder;">187</p>
							</div>
							<div style="width:24.5%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Mês Atual</p>
								<p style="font-size:120%; font-weight:bolder;">437</p>
							</div>
						</div>
						<div id="chart_div" style="width: 100%; height: 250px;"></div>
					</div>
				</div>
				<div style="width:48.5%; height:auto; position:relative; border:0px solid #ccc;">
					<div class="visaogeral">
						<p style="font-weight:bold; font-size: 100%;">Presentes</p>
					</div>
					<div class="box4">
						<div style="width:100%; margin:auto; flex:1; display:inline-flex; justify-content: space-between; position:relative;text-align:center; color:rgba(36,2,49,1.00);">
							<div style="width:45%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Total Recebido</p>
								<p style="font-size:120%; font-weight:bolder;">R$ 18.894,00</p>
							</div>
							<div style="width:45%; border:0px solid #ccc;">
								<p style="font-size:90%; margin-bottom:10px;">Mês Atual</p>
								<p style="font-size:120%; font-weight:bolder;">R$ 5.154,00</p>
							</div>
						</div>
						<div id="chart_div2" style="width: 100%; height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
        
        <div id="configuracoes" class="tabcontent4">
			<?php //include "emconstrucao.inc.php"; ?>
			<!-- O botão abaixo é para a parte do reembolso. Mas eu sinceramente acho que seria melhor ocultá-los dos clientes. Isso deixo a cargo da decisão da administração. -->
			<?php
			if(isset($loggedin)){    
				if($row['paypal_canceled'] == 1){
					$payerid = $pdo->prepare("SELECT * FROM ipn_notifications WHERE payer_id = ? AND txn_type = ? ORDER BY datetime DESC LIMIT 1");
					$payerid->execute(array($row['payer_id'], "subscr_payment"));

					$fetchtransid = $payerid->fetch(PDO::FETCH_ASSOC);
					$time_ago = $fetchtransid['datetime'];
					$dayselapsed = timeAgo($time_ago);
					$paymentstatus2 = $fetchtransid['payment_status'];

					if($dayselapsed <= 7 AND $paymentstatus2 == "Completed"){
			?>
			<h3>Pedir reembolso da última mensalidade</h3>
			<br/>
			Você pode solicitar seu dinheiro de volta referente ao seu último pagamento. Mas isso dentro do período de garantia mensal que é de 7 dias a contar da data do pagamento/cobrança da última mensalidade.
			<form enctype="multipart/form-data" method="post" action="refundpayment.php?tx=<?php echo urlencode($fetchtransid['transactionid']); ?>&cp=<?php echo urlencode($fetchtransid['chosenplan']); ?>">
				<input type="submit" value="Request Refund" name="refund" />
			</form>
			<br/><br/><br/>
			<?php
					}
				}
			}
			?>

			<?php
			if(isset($loggedin)){
				if($row['free'] == 1){
					//Display nothing
				}else{
					if(($row['paid'] == 1 OR $row['paid'] == 0) AND $row['paypal_canceled'] == 0 AND !is_null($row['paypal_subscriptionid']) AND $row['paypal_paymentstatus'] == "Completed"){
			?>

			<!--
			<strong>Cancelar Assinatura - Ambiente Sandbox</strong>
			<br/>
			<a href="https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=6MVQSRK88TGQS"><img src="https://www.sandbox.paypal.com/en_US/i/btn/btn_unsubscribe_LG.gif" border="0"></a>      
			<br/><br/><br/>

			<strong>Cancelar Assinatura - Ambiente Live</strong>
			<br/>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=VFE6VD3355S8Y"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_unsubscribe_LG.gif" border="0"></a>		
			<br/><br/><br/>
			-->


			<strong>Método de cancelamento/suspensão de assinatura via API</strong>
			<br/>
			<!-- The form below was created to manage the subscription -->
			Aqui nesta página, você, meu caro, minha cara, tem total controle sobre a sua própria assinatura. O que você deseja fazer neste momento?<br/>
			<form enctype="multipart/form-data" method="post" action="managesubscription.php?si=<?php echo urlencode($row['paypal_subscriptionid']); ?>&id=<?php echo urlencode($row['id']); ?>">
				<select name="paypalaction">
					<option selected disabled>Selecione uma das ações a seguir</option>
					<?php if($row['paypal_suspended'] == 0){ ?><option value="Suspend">Suspender Assinatura</option><?php } ?>
					<?php if($row['paypal_suspended'] == 1){ ?><option value="Reactivate">Reativar Assinatura</option><?php } ?>
					<option value="Cancel">Cancelar Assinatura</option>
				</select>
				<input type="submit" value="Executar" name="paypal" />
			</form>
			<br/><br/><br/>

			<!--
			<strong>Vamos ver os detalhes da assinatura?</strong>
			<br/>
			-->
			<!-- O formulário abaixo foi criado para ver e verificar os detalhes da assinatura. O problema é que este método não funciona com assinaturas, mas somente com pagamentos recorrentes. É por isso que o acho inútil e algo que até pode ser deletado. -->
			<!--
			<form enctype="multipart/form-data" method="post" action="getsubscriptiondetails.php?si=<?php //echo urlencode($row['paypal_subscriptionid']); ?>">
				<input type="submit" value="Ver Detalhes" name="seedetails" />
			</form>
			<br/><br/><br/>
			-->

			<!--
			<strong>Desabilitar assinante</strong>
			<br/>
			<span class="validation_message">*Esta opção aqui tornar o assinante um não-assinante novamente. Desta forma, podemos simular outra(s) transação(ões) via PayPal</span>

			<?php
					/*
					if(isset($_POST['unablebuyer'])){
						$unablebuyer = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ? WHERE id = ?");
						$unablebuyer->execute(array(0, $row['id']));

						echo '<script>alert("Buyer converted to non-buyer successfully"); location.href = "'.$urlHost.'/subscribe_via_paypal.php";</script>';
					}
					*/
			?>

			<form action="" method="post" enctype="multipart/form-data">
				<input value="Unable buyer" class="button88" style="background:red;" name="unablebuyer" type="submit" />
			</form>
			<br/><br/>
			*/

			<?php
					}
				}
				if(!empty($row['paypal_transactionid']) OR !empty($row['payer_id'])){
			?>

			<h3>Histórico de eventos da assinatura</h3>
			<br/>
			<?php
					$selectsubscriptions = $pdo->prepare("SELECT * FROM ipn_notifications WHERE payer_id = ? ORDER BY datetime DESC");
					$selectsubscriptions->execute(array($row['payer_id']));
					while($fetchipn = $selectsubscriptions->fetch(PDO::FETCH_ASSOC)){
						if($fetchipn['txn_type'] == "subscr_signup"){
							echo "<mark>";
						}
						echo "* " . $fetchipn['subject'] . " | Date and Time: " . $fetchipn['paypaldate'] . " | IPN date: " . $fetchipn['datetime']. "<br/><br/>";
						if($fetchipn['txn_type'] == "subscr_signup"){
							echo "</mark>";
						}
					}
					echo "<br/>";
				}
			}
			?>
			<!--https://www.angelleye.com/test-paypal-ipn/-->
			<form action="<?php echo $urlHost; ?>/ipn/ipnlistener.php" method="POST">
				<input name="mc_gross" type="hidden" value="500.00" />
				<input name="custom" type="hidden" value="some custom data" />
				<input name="address_status" type="hidden" value="confirmed" />
				<input name="item_number1" type="hidden" value="6" />
				<input name="item_number2" type="hidden" value="4" />
				<input name="payer_id" type="hidden" value="FW5W7ZUC3T4KL" />
				<input name="tax" type="hidden" value="0.00" />
				<input name="address_street" type="hidden" value="1234 Rock Road" />
				<input name="payment_date" type="hidden" value="14:55 15 Jan 07 2005 PST" />
				<input name="payment_status" type="hidden" value="Completed" />
				<input name="address_zip" type="hidden" value="12345" />
				<input name="mc_shipping" type="hidden" value="0.00" />
				<input name="mc_handling" type="hidden" value="0.00" />
				<input name="first_name" type="hidden" value="Jason" />
				<input name="last_name" type="hidden" value="Anderson" />
				<input name="mc_fee" type="hidden" value="0.02" />
				<input name="address_name" type="hidden" value="Jason Anderson" />
				<input name="notify_version" type="hidden" value="1.6" />
				<input name="payer_status" type="hidden" value="verified" />
				<input name="business" type="hidden" value="paypal@emailaddress.com" />
				<input name="address_country" type="hidden" value="United States" />
				<input name="num_cart_items" type="hidden" value="2" />
				<input name="mc_handling1" type="hidden" value="0.00" />
				<input name="mc_handling2" type="hidden" value="0.00" />
				<input name="address_city" type="hidden" value="Los Angeles" />
				<input name="verify_sign" type="hidden" value="AlUbUcinRR5pIo2KwP4xjo9OxxHMAi6.s6AES.4Z6C65yv1Ob2eNqrHm" />
				<input name="mc_shipping1" type="hidden" value="0.00" />
				<input name="mc_shipping2" type="hidden" value="0.00" />
				<input name="tax1" type="hidden" value="0.00" />
				<input name="tax2" type="hidden" value="0.00" />
				<input name="txn_id" type="hidden" value="TESTER" />
				<input name="payment_type" type="hidden" value="instant" />
				<input name="last_name=Borduin" type="hidden" />
				<input name="payer_email" type="hidden" value="test@domain.com" />
				<input name="item_name1" type="hidden" value="Rubber+clog" />
				<input name="address_state" type="hidden" value="CA" />
				<input name="payment_fee" type="hidden" value="0.02" />
				<input name="item_name2" type="hidden" value="Roman sandal" />
				<input name="invoice" type="hidden" value="123456" />
				<input name="quantity" type="hidden" value="1" />
				<input name="quantity1" type="hidden" value="1" />
				<input name="receiver_id" type="hidden" value="5HRS8SCK9NSJ2" />
				<input name="quantity2" type="hidden" value="1" />
				<input name="txn_type" type="hidden" value="web_accept" />
				<input name="mc_gross_1" type="hidden" value="0.01" />
				<input name="mc_currency" type="hidden" value="USD" />
				<input name="mc_gross_2" type="hidden" value="0.01" />
				<input name="payment_gross" type="hidden" value="0.02" />
				<input name="subscr_id" type="hidden" value="PP-1234" />
				<input name="test" type="submit" value="IPN test" />
			</form>
        </div> 
		
        <div id="ajuda" class="tabcontent4">
			<?php include "emconstrucao.inc.php"; ?>
		</div>
        <!-- Source code: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs_close  -->
	</div>
</main>
</div>

<script>
function openCity4(evt, cityName4) {
  var i, tabcontent4, tablinks4;
  tabcontent4 = document.getElementsByClassName("tabcontent4");
  for (i = 0; i < tabcontent4.length; i++) {
    tabcontent4[i].style.display = "none";
  }
  tablinks4 = document.getElementsByClassName("tablinks4");
  for (i = 0; i < tablinks4.length; i++) {
    tablinks4[i].className = tablinks4[i].className.replace(" active", "");
  }
  document.getElementById(cityName4).style.display = "block";
  evt.currentTarget.className += " active";
}

// Pega o elemento com a id="defaultOpen" e clica nele
document.getElementById("defaultOpen3").click();
</script>	

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo date("F j, Y H:i:s", strtotime($row['datadocasamento'])); ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="counter"
  document.getElementById("counter").innerHTML = "Faltam <span class=\"bold\">" + days + "</span>d <span class=\"bold\">" + hours + "</span>h <span class=\"bold\">" + minutes + "</span>m <span class=\"bold\">" + seconds + "</span>s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("counter").innerHTML = "JUST MARRIED";
  }
}, 1000);
</script>
	
<?php include "menuativo.inc.php"; ?>

<div class="footerdiv clearfix">
<footer>
    <?php include "rodape.inc.php"; ?>
</footer>
</div>
	
</body>
</html>