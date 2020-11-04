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
    }elseif($row['credencial'] == 0){
		$loggedin = true;
	}else{
		
	}
}else{
    header('Location: '.$urlHost.'/login.php');
    exit;
}

include "paypalswitch.inc.php";

if(isset($_GET['tx']) AND !is_null($_GET['tx'])){
    $tx_token = $_GET['tx'];
    
    $verifytxtoken = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE paypal_transaction_id = ? AND id = ?");
    $verifytxtoken->execute(array($tx_token, $row['id']));
    $fetchpaypaldata = $verifytxtoken->fetch();
    $noofequalities = $verifytxtoken->rowCount();
    
    if($noofequalities == 1/* AND $fetchpaypaldata['read1'] == 0*/){
        $firstnamepaypal = $fetchpaypaldata['paypal_firstname'];
        $lastnamepaypal = $fetchpaypaldata['paypal_lastname'];
        //$amount = $_GET['amount'];
        $paypalemail = $fetchpaypaldata['paypal_email'];
        $chosenplan = $fetchpaypaldata['paypal_chosenplan'];
        $paypaltransactionfee = $fetchpaypaldata['paypal_transactionfee'];
        $currency = $fetchpaypaldata['paypal_currency'];
        $paymentstatus = $fetchpaypaldata['paypal_paymentstatus'];
        $paymentdate = $fetchpaypaldata['paypal_paymentdate'];
        $clientcountry = $fetchpaypaldata['paypal_clientcountry'];
        $paypalenvironment = $fetchpaypaldata['paypal_env'];
        $subscriptionid = $fetchpaypaldata['paypal_subscriptionid'];
        $payerid = $fetchpaypaldata['payer_id'];
        $retrieved_data = true;
        
        //$updateread = $pdo->prepare("UPDATE registered_users SET read1 = ? WHERE id = ?");
        //$updateread->execute(array(1, $row['id']));
    }else{
        header('Location: '.$urlHost.'/privacidade.php');
        exit;
    }
    
}else{
	header('Location: '.$urlHost.'/termos.php');
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
<title>Casamento em Detalhes | Parabéns! Seja Bem-vindo como Conta <?php echo $chosenplan?></title>
	
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
    <div class="conteudoprincipal" style="margin-top: 0; width:80%;">
		<br/><br/><br/>
		<center><img src="images/hearts.png" style="width:10%; height:auto;" /></center>
		<h1 class="headerstyle">Teste do <?php echo $paypalenvironment; ?>: Página de agradecimento - PayPal <?php echo $paypalenvironment; ?> 😇</h1>
        <p class="paragraph1"><strong>Etapa Final</strong> - Parabéns! Considere-se um sortudo!! Você agora é <strong><?php echo $chosenplan; ?></strong>, <?php echo $row['nomeprincipal'];?></strong>! As informações básicas sobre esta transação estão logo abaixo. Se quiser, você pode checar o seu email ou a sua conta do PayPal. Além disso, para ver as notificações e detalhes de pagamento, clique no botão (PDT), o qual lhe mostrará numa nova aba todos os dados básicos passados via curl. Ok, agora considere-se um membro vitalício. Curta o que temos de melhor em conteúdo e aproveite para gozar das demais funcionalidades disponíveis para o seu site de casamento. O código da transação é "<?php if(isset($retrieved_data)){ echo $tx_token; } ?>". Agora, vamos nessa!!!</p>
        
        <?php

		?>
        <br/><br/>
        <?php		
		if(isset($retrieved_data)){
			if($retrieved_data == true){
			?>
                <center>
                <p><h3>Obrigado pela assinatura!</h3></p>
                 
                <b>Detalhes da Transação</b><br/><br>
                <div class="tag-cloud">
                    <ul>
                        <li><a href="javascript:void(0);"><span></span>Nome: <?php echo $firstnamepaypal . " " . $lastnamepaypal; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>Plano escolhido: <?php if(isset($chosenplan)){ echo ("$chosenplan</li>\n"); }
                        //if(!empty($yearlyplan)){ echo ("$yearlyplan</li>\n"); }
                        ?></a>
                        </li>
                        <li><a href="javascript:void(0);"><span></span>Email do PayPal: <?php echo $paypalemail; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>ID de Pagador: <?php echo $payerid; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>ID da Transação: <?php echo $tx_token; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>ID da Assinatura: <?php echo $subscriptionid; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>Status de Pagamento: <?php echo $paymentstatus; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>Data do Pagamento: <?php echo $paymentdate; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>País: <?php echo $clientcountry; ?></a></li>
                        <li><a href="javascript:void(0);"><span></span>Taxa do PayPal: <?php echo $currency . " " . $paypaltransactionfee; ?></a></li>
                        <!--<li><a href="javascript:void(0);"><span></span>All subcription data retrieved: <?php //print_r($res); ?></a></li>-->
                    </ul>
                </div>
        <?php
            }
        }
        ?>
        
        <br/><br/>
        <form method="post" target="_blank" action="https://<?php echo $pp_hostname; ?>/cgi-bin/webscr">
          <input type="hidden" name="cmd" value="_notify-synch">
          <input type="hidden" name="tx" value="<?php if(isset($_GET['tx'])){ echo $tx_token; } ?>">
          <input type="hidden" name="at" value="<?php echo $auth_token; ?>">
          <input class="button88" type="submit" value="PDT">
        </form><br/><br/>
        
        <form action="<?php echo $urlHost; ?>">
        	<input class="button88" style="background: #0F0;" type="submit" value="Volta pra HOME"/>
        </form> 
        </center>
        <br/><br/><br/><br/>     
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