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

$current_link = $_SERVER['REQUEST_SCHEME']. '://'. "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

//--------------------------------------------------------------------------
//The following are the lines structuring the PDT code for response and transaction data retrieval and subsequent record into database
include "paypalswitch.inc.php";
include "pricing.inc.php";
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

if(isset($_GET['tx']) AND !is_null($_GET['tx'])){
    $tx_token = $_GET['tx'];
    
	$req .= "&tx=$tx_token&at=$auth_token";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
	//if your server does not bundled with default verisign certificates.
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
	$res = curl_exec($ch);
	curl_close($ch);
	
	if(!$res){
		//HTTP ERROR
		//$error_message = true;
		header('Location: '.$urlHost.'/inicio.php');
		exit;
	}else{
		//Let's fetch the table to see if there's some similar code there already recorded to avoid fraud
		//This is to avoid the code/url to be passed to another user in order to have access to the members' area
        // parse the data
        $lines = explode("\n", trim($res));
        $keyarray = array();
        if (strcmp ($lines[0], "SUCCESS") == 0) {
            for ($i = 1; $i < count($lines); $i++) {
                $temp = explode("=", $lines[$i],2);
                $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
            }
            // check the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment
            $id = $row['id'];
            $firstnamepaypal = $keyarray['first_name'];
            $lastnamepaypal = $keyarray['last_name'];
            $itemname = $keyarray['item_name'];
            //$amount = $keyarray['payment_gross'];
            $paypalemail = $keyarray['payer_email'];
            $chosenplan = $keyarray['option_selection1']?:
            $keyarray['option_selection2'];
            $paypaltransactionfee = $keyarray['mc_fee'];
            //$amount = $keyarray['mc_gross'];
            $paymentstatus = $keyarray['payment_status'];
            $paymentdate = $keyarray['payment_date'];
            //$clientcountry = $keyarray['address_country'];
            $paypalenvironment = $env;
            $subscriptionid = $keyarray['subscr_id'];
            $currency = $keyarray['mc_currency'];
            $payerid = $keyarray['payer_id'];
            
            
            //-------------------------------------------------------------------------
            //Now we're gonna insert/update everything in our DataBase.
            $insertPaypal = $pdo->prepare("UPDATE usuarios_cadastrados SET paypal_firstname = ?, paypal_lastname =?, paypal_chosenplan = ?, paypal_email = ?, paypal_subscriptionid = ?, paypal_transaction_id = ?, paypal_url = ?, paypal_paymentstatus = ?, paypal_paymentdate = ?, paypal_currency = ?, paypal_transactionfee = ?, paypal_env = ?, payer_id = ?, paid = ?, paypal_canceled = ? WHERE id = ?");
            $insertPaypal->execute(array($firstnamepaypal, $lastnamepaypal, $chosenplan, $paypalemail, $subscriptionid, $tx_token, $current_link, $paymentstatus, $paymentdate, $currency, $paypaltransactionfee, $paypalenvironment, $payerid, 1, 0, $id));

            
            //------Check if $payerid is not duplicate in the table-------//
            $checkpayerid = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE payer_id = ? AND desativar = ?");
            $checkpayerid->execute(array($payerid, 0));
            $checkifpayeridalreadyexists = $checkpayerid->rowCount();
            $fetchpayerid = $checkpayerid->fetch(PDO::FETCH_ASSOC);
            
            if($checkifpayeridalreadyexists == 2){
                $updateaspossibleduplicate = $pdo->prepare("UPDATE usuarios_cadastrados SET possible_duplicate = ? WHERE id = ?");
                $updateaspossibleduplicate->execute(array(1, $id));
                
                $sub2 = "Alerta de Segurança - Possível conta duplicada";
                $mes2 = "Olá, $firstnamepaypal,
Nosso sistema detectou recentemente algo fora do comum. É um tanto estranho que você tenha utilizado esta conta para realizar a transação.

Por favor, se a pessoa que efetuou esta transação não foi você, por favor entre em contato conosco. De acordo com os nossos termos, lembre-se que você pode ter somente um único cadastro. Contas duplicadas serão suspensas para sempre. Por favor, informe-nos sobre quaisquer ocorrências estranhas. Você a partir do recebimento desta mensagem terá um prazo de 24 horas para fazê-lo ou sua conta será automaticamente suspensa.

Entre em contato pelo $urlHost/contact.php. É possível que você algum email ou chamada nas próximas horas solicitando que você informe alguns dados por questões de segurança. Obrigado pela atenção e nossa equipe agradece. Tenha um bom dia.

Divirta-se
Casamento em Detalhes

Este email foi gerado automaticamente. Por favor, não o responda.";

                mail($email, $sub2, $mes2, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
            }
            
            // Let's mail the user!
            //$firstname = $row['firstname'];
            /*
            $subject = "Your account in Casamento em Detalhes";
            $message = "Hello, $firstname,
Congratulations!!! Wonderful!!! Marvelous!!

Your first payment via PayPal related to the subscription Casamento em Detalhes Magazine was received and now you can regard yourself a genuine subscriber and can now enjoy a big diversity of content tailor-made just for you.
Want something better than this? I bet you don't.
You can also see the latest trend magazines in our app available for download 24/7 in Google Play Store and App Store.

In case you need any, anything, we have a support team to assist you 24/7/365. We were made to make your life far easier and to unite people worldwide.
Thank you very very much and welcome!
Casamento em Detalhes - Uniting Peoples and Nations through English

This email was automatically generated. Please, do not respond.";

            mail($email, $subject, $message, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
            */
            //I decided to unable the automatic message above, because I already set a message via IPN in /ipn/ipnlistener.php, just to avoid double email.
            
            //if($paymentstatus = "Completed" || $paymentstatus = "Processed"){
                //$retrieved_data = true;
            //}else{
                //header('Location: '.$urlHost.'/termos.php');
                //exit;
            //}
            header('Location: '.$urlHost.'/obrigado.php?tx='.urlencode($tx_token));
            exit;
            
        }else if (strcmp ($lines[0], "FAIL") == 0) {
            // log for manual investigation
            //$invalid = true;
            header('Location: '.$urlHost.'/termos.php');
            exit;
        }
	}
}else{
	header('Location: '.$urlHost.'/privacidade.php');
	exit;
}
?>