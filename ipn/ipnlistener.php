<?php namespace Listener;
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// Set this to true to use the sandbox endpoint during testing:
require "../config.php";
include "../paypalswitch.inc.php";

// Set this to true to send a confirmation email:
$send_confirmation_email = true;
$confirmation_email_address = "rogeriobsoares5@gmail.com";
//$from_email_address = "Rogerio Soares <englishup.civic@gmail.com>";

// Set this to true to save a log file:
$save_log_file = true;
$log_file_dir = __DIR__ . "/logs";

// Here is some information on how to configure sendmail:
// http://php.net/manual/en/function.mail.php#118210

include "../pricing.inc.php";
require('PaypalIPN.php');
use PaypalIPN;
$ipn = new PaypalIPN();
if ($enable_sandbox) {
    $ipn->useSandbox();
}
$verified = $ipn->verifyIPN();

$data_text = "";
foreach ($_POST as $key => $value) {
    $data_text .= $key . " = " . $value . "\r\n";
}

$test_text = "";
if ($_POST["test_ipn"] == 1) {
    $test_text = "NOTE: This is an IPN Notification issued by PayPal systems";
}

// Check the receiver email to see if it matches your list of paypal email addresses
$receiver_email_found = false;
foreach ($my_email_addresses as $a) {
    if (strtolower($_POST["receiver_email"]) == strtolower($a)) {
        $receiver_email_found = true;
        break;
    }
}

date_default_timezone_set("America/Sao_Paulo");
list($year, $month, $day, $hour, $minute, $second, $timezone) = explode(":", date("Y:m:d:H:i:s:T"));
$date = $year . "-" . $month . "-" . $day;
$timestamp = $date . " " . $hour . ":" . $minute . ":" . $second . " " . $timezone;
$dated_log_file_dir = $log_file_dir . "/" . $year . "/" . $month;

$paypal_ipn_status = "VERIFICATION FAILED";
if ($verified) {
    $paypal_ipn_status = "RECEIVER EMAIL MISMATCH";
    if ($receiver_email_found) {
        $paypal_ipn_status = "Completed Successfully";


        // Process IPN
        // A list of variables are available here:
        // https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
		
		//SAVING THOSE DATA TO DATABASE
		//------------------------------------------------------------------------------------//
		
        // This is an example for sending an automated email to the customer when they purchases an item for a specific amount:
        //if ($_POST["item_name"] == "Casamento em Detalhes Magazine" && ($_POST["mc_gross"] == $mpprice OR $_POST["mc_gross"] == $ypprice) && $_POST["mc_currency"] == "BRL" && $_POST["payment_status"] == "Completed") {
        
		/*
		if($_POST["payment_status"] == "Completed"){  //This message can be deleted once I already have the configured PDT system  
			$email_to = $_POST["first_name"] . " " . $_POST["last_name"] . " <" . $_POST["payer_email"] . ">";
            $email_subject = $test_text . "Completed order for: " . $_POST["item_name"];
            $email_body = "Thank you for subscribing to " . $_POST["item_name"] . " - Hired Plan: " . "." . "\r\n" . "\r\n" . "This is an example email only." . "\r\n" . "\r\n" . "Thank you.";
            mail($email_to, $email_subject, $email_body, "From: " . $from_email_address);
		}
		*/
		//}
				
    }
} elseif ($enable_sandbox) {
    if ($_POST["test_ipn"] != 1) {
        $paypal_ipn_status = "RECEIVED FROM LIVE WHILE SANDBOXED";
		
		//SAVING THOSE DATA TO DATABASE
		//------------------------------------------------------------------------------------//		
		
    }
} elseif ($_POST["test_ipn"] == 1) {
    $paypal_ipn_status = "RECEIVED FROM SANDBOX WHILE LIVE";
	
	//SAVING THOSE DATA TO DATABASE
	//------------------------------------------------------------------------------------//	
}

if ($save_log_file) {	
	//SAVING THOSE DATA TO DATABASE
	$payerid = $_POST["payer_id"];
	$paypalemail = $_POST['payer_email'];
	$paypalfirstname = $_POST['first_name'];
	$paypallastname = $_POST['last_name'];
	$itemname = $_POST['item_name']?:
	$_POST['product_name'];
	
	$txn_type = $_POST['txn_type']?:
	"";
	
	$tx_token = $_POST['txn_id']?:
	"";
	
	if(isset($_POST['reason_code'])){
		$reasoncode = $_POST['reason_code'];
	}
	
	$paypaldate = $_POST['payment_date']?:
	$_POST['subscr_date']?:
	$_POST['time_created'];
	
	
	$subscriptionid = $_POST['subscr_id']?:
	$_POST['recurring_payment_id']?:
    "";
	
	
	
	if(isset($_POST['option_selection1'])){
		$chosenplan = $_POST['option_selection1'];
	}elseif(isset($_POST['option_selection2'])){
		$chosenplan = $_POST['option_selection2'];
	}else{
		$chosenplan = "";
	}
	
	
	
	
	
	$paymentstatus = $_POST['payment_status']?:
	"";

	$fee = $_POST['mc_fee']?:
    0;
    
    $currency = $_POST['mc_currency']?:
    "";
    
    $amount = $_POST['mc_gross']?:
    0;
    
	if($_POST['test_ipn'] == 1){
		$paypal_environment = "SANDBOX";
	}else{
		if($_POST['txn_id'] == "TESTER"){
			$paypal_environment = "TESTER";
		}else{
			$paypal_environment = "LIVE";
		}
	}
	
	//IMPORTANT NOTE: PAYPAL DOESN'T SEND ANY IPN MESSAGE FOR SUSPENDED SUBSCRIPTIONS. SUGGESTION: RECORD THE SUBSCRIPTION STATUS AS SUSPENDED WHEN MAKING A SUCCESSFUL ManageRecurringPaymentsProfileStatus REQUEST. EVEN SO, IT'S NOT SO SAFE.
	
	$search = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE payer_id = ?");
	$search->execute(array($payerid));
	
	$srow=$search->fetch();
	//DONT USE fetch(PDO::FETCH_ASSOC). IT DOESN'T WORK WITH THIS. I DONT KNOW WHY
	$suspend = $srow['paypal_suspended'];
	$clientemail = $srow['email'];
	
	//The MESSAGE variable will be defined according to the condition and value of $txn_type. Uncomment the lines below:
	// txn_type (subscr_payment) and payment_status (Completed) are for payments receveid successfully
	// I also recommend using txn_type (subscr_signup) for succesful subscriptions
	
	if($txn_type == "subscr_signup"){          //Signup/Subscription Completed successfully
		$subject = "Upgrade/assinatura realizada com sucesso em Casamento em Detalhes";
		$message = "Assinatura realizada por: Sr. (Sra.) $paypalfirstname $paypallastname ($paypalemail), meus parabéns! Você conseguiu concluir o processo de assinatura via PayPal. Email do PayPal: $paypalemail, item: $itemname, data: $paypaldate. Desse mês em diante será cobrado o pagamento recorrente referente ao plano que foi contratado. Os dados desta e de outras transações estarão disponíveis no seu cartão de crédito ou na sua própria conta do PayPal. Você também poderá cancelar ou suspender a assinatura a qualquer momento e isso é muito fácil. Este é um email de amostra apenas. Não o responda. $test_text.";
	}elseif($txn_type == "subscr_payment"){
		if($paymentstatus == "Completed"){       //Payment/Billing Completed
			if($suspend == 0){
				$subject = "Mensalidade recebida com sucesso - Casamento em Detalhes";
				$message = "Pagamento recebido: Sr. (Sra.) $paypalfirstname $paypallastname ($paypalemail), viemos confirmar que recebemos o pagamento referente à sua assinatura com sucesso processado em $paypaldate. Plano escolhido: $chosenplan. Os referidos valores serão cobrados do seu cartão de crédito adicionado à sua conta do PayPal, ou da sua própria conta do PayPal. É possível que você já tenha recebido algum email referente a esta notificação do PayPal. Para quaisquer dúvidas, fale conosco pelo portal. Para cancelar ou suspender a assinatura, clique aqui.";
			}else{
				$subject = "Mensalidade recebida e ASSINATURA REATIVADA";
				$message = "REATIVAOD: Sr. (Sra.) $paypalfirstname $paypallastname ($paypalemail), a sua assinatura foi reativada com sucesso em $paypaldate. Aconteceu só agora, porque o administrador havia suspendido a assinatura ao invés de você mesmo fazê-lo via o botão de suspensão. Então, da próxima vez, por favor use o botão. O seu cartão de crédito será faturado todo mês a partir de agora. Agora você poderá aproveitar todas as funcionalidades e recursos de nosso sistema novamente.";			
				//This condition here can be deleted, but I decided to leave them here, because of a matter of practicality: its a strategy and alternative of REACTIVATING subscription when a payment complete IPN is fired. NOTE: this is the problem, through this method unfortunately, the client has to wait for the next successful payment in order that the IPN is fired and the data are altered in our database, allowing, this way, his access to our services again. Again: its not an effective method though.

				$updatepaymentstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ? WHERE payer_id = ?");
				$updatepaymentstatus->execute(array(1, 0, $payerid));
			}
			
			//SAVING AFFILIATE FUTURE PAYMENT TO AFFILIATES AS GUARANTEE...
			//-----------------------------------------------------------------------------------------------------------------
			
			//First we have to query the 'usuarios_cadastrados' table to see if there is any affiliate connected to the subscriber (payer): 
			$searchaffiliate = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE paypal_subscriptionid = ?");
			$searchaffiliate->execute(array($subscriptionid));
			$affiliaterow = $searchaffiliate->fetch();
			$subscriberid = $affiliaterow['id'];    //id from usuarios_cadastrados table
			$affiliateid = $affiliaterow['tiedaffiliateid'];     //affiliate id from usuarios_cadastrados table
			$status = "guarantee";
			
			$searchaffemail = $pdo->prepare("SELECT * FROM affiliates WHERE id = ?");
			$searchaffemail->execute(array($affiliateid));
			$fetchemail = $searchaffemail->fetch();
			$affiliateemail = $fetchemail['paypal_email'];
			$affiliatename = $fetchemail['name'];
			$futuredate = date("Y-m-d", strtotime("+ 8 days", time()));
            $amounttoaffiliate = $amount * $commissionpercentage;
            
			//If the current subscriber is already linked to any affiliate, the future payment data will be saved to the DB, and then the Cron Job (affiliatespayment.cron.php) will be incumbent to execute the payment automatically after seven days or so... The data are saved as pending
			if($affiliateid != 0){
				$savetoaffiliatepayments = $pdo->prepare("INSERT INTO affiliatepayments (subscriberid, affiliateid, subscriptionid, transactionid, status, chosenplan, environment, futuredate, amount, date) VALUES (:subscriberid, :affiliateid, :subscriptionid, :transactionid, :status, :chosenplan, :environment, :futuredate, :amount, NOW())");
				$savetoaffiliatepayments->execute(array(':subscriberid' => $subscriberid, ':affiliateid' => $affiliateid, ':subscriptionid' => $subscriptionid, ':transactionid' => $tx_token, ':status' => $status, ':chosenplan' => $chosenplan, ':environment' => $paypal_environment, ':futuredate' => $futuredate, ':amount' => $amounttoaffiliate));
				
				$sub = "Casamento em Detalhes - comissão sobre assinatura de cliente - Programa de Afiliados";
				$mes = "Hello, $affiliatename,
Congratulations! Now you have an affiliate transaction on behalf of you based on a monthy subscription payment by a client who has ordered a subscription, but your payment will be released only past seven days or so, unless the customer requests its refund after canceling the subscription. For more details about it, please read the Terms of affiliation. The payment goes straight to your PayPal account. Please, check your balance within seven days' time. (Your email: $affiliateemail)

Now for further details, please check your dashboard at: /orangeadex/casamentoemdetalhes/affiliatedashboard.php. If you like, copy and paste the link straight into the adress bar in your browser.

Yes, you can earn even more money by promoting more people to subcribe to our magazine.
Thank you very much and welcome!
Casamento em Detalhes - Uniting Peoples and Nations through English

This email was automatically generated. Please, do not respond.";
		
				mail($affiliateemail, $sub, $mes, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
				//-----------------------------------------------------------------------------------------
				//-----------------------------------------------------------------------------------------
			}
		}
	}elseif($txn_type == "subscr_cancel"){     //Canceled
		$subject = "Assinatura cancelada com sucesso";
		$message = "ASSINATURA CANCELADA: Sr. (Sra.) $paypalfirstname $paypallastname, parece-nos que você mesmo cancelou a sua assinatura. Email do PayPal: $paypalemail, item: $itemname, data: $paypaldate (Esta data corresponde ao momento em que esta assinatura foi realizada e não ao cancelamento). As mensalidades de agora em diante não serão mais cobradas. Para adquirir os produtos/serviços novamente, você tem que se dirigir ao site e fazer novamente o pedido da assinatura. Este é um email de amostra apenas. Não o responda. $test_text.";

		$updatepaymentstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ?, paypal_canceled = ? WHERE payer_id = ?");
		$updatepaymentstatus->execute(array(0, 0, 1, $payerid));
	}elseif($txn_type == "recurring_payment_suspended"){      //Suspended. But I'm not sure about this variable
		$subject = "Assinatura temporariamente suspensa";
		$message = "ASSINATURA SUSPENSA: Sr. (Sra.) $paypalfirstname $paypallastname, parece-nos que você mesmo solicitou a suspensão da sua assinatura. Email do PayPal: $paypalemail, item: $itemname, data: $paypaldate (Esta data corresponde ao momento em que esta notificação IPN foi criada e disparada). A mensalidade e seu faturamento de agora em diante não será cobrado, enquanto a assinatura estiver suspensa. Contudo, você ainda pode reativá-la a qualquer momento. Este é um email de amostra apenas. Não o responda. $test_text.";
	
		$updatepaymentstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ? WHERE payer_id = ?");
		$updatepaymentstatus->execute(array(0, 1, $payerid));	
	}elseif($txn_type == "recurring_payment_suspended_due_to_max_failed_payment"){
		$subject = "Assinatura suspensa por várias tentativas de cobrança mal-sucedida";
		$message = "ASSINATURA SUSPENSA POR VÁRIAS FALHAS OU TENTATIVAS FRUSTRADAS DE COBRANÇA: Sr. (Sra.) $paypalfirstname $paypallastname ($paypalemail), me parece que a sua assinatura foi automaticamente suspensa em $paypaldate (Esta data corresponde ao momento em que esta notificação IPN foi criada e disparada). Isso porque provavelmente não há saldo suficiente na sua conta do PayPal, ou por conta de problemas no seu cartão de crédito.";
		//Its possible to suspend a subscription via PayPal and send the IPN, but its impossible to reactivate it and fire the IPN. Thats why I activated the lines above inside this condition. Only alternative: Reactivate through the button I created in the website itself.
	
		$updatepaymentstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ? WHERE payer_id = ?");
		$updatepaymentstatus->execute(array(0, 1, $payerid));
	}elseif(isset($reasoncode) AND isset($paymentstatus)){          
		if($reasoncode == "refund" AND $paymentstatus == "Refunded"){         //This is for Refunds only
			$subject = "Reembolso de mensalidade - Casamento em Detalhes";
			$message = "REEMBOLSO RECENTE: Sr. (Sra.) $paypalfirstname $paypallastname ($paypalemail), você foi reembolsado por Casamento em Detalhes Magazine em $paypaldate. Para maiores detalhes, verifique a quantia reembolsada por meio da sua conta no PayPal.";
		}
	}elseif($txn_type == "web_accept"){        //IPN Simulator - For testing purposes (also for Donations)
        $subject = "Doação enviada com sucesso - quantia ($currency $amount)";
		$message = "TESTE: Esta mensagem é para confirmar que uma doação foi enviada com sucesso para Casamento em Detalhes Magazine por $paypalfirstname $paypallastname ($paypalemail). Esta mensagem é controlada por notificações IPNs do próprio PayPal (quantia doada: $currency $amount). IPN disparado em: $paypaldate";
    }elseif($txn_type == "masspay"){
		$subject = "Notificação de Pagamentos em Massa";
		$message = "Esta mensagem é para confirmar que um pagamento em massa foi executado com sucesso. Para maiores detalhes e funs administrativos, entre em: https://$pp_hostname/br/cgi-bin/webscr?cmd=_display-ipns-history e verifique o histórico de IPNs. IPN disparada em $paypaldate.";
	}else{
		$subject = "Mensagem DEFAULT";
		$message = "DEFAULT: Esta é uma mensagem DEFAULT disparada pelos sistemas do PayPal. Tipo de transação: $txn_type. Email de cliente PayPal (se houver): $paypalemail. Verifique o que aconteceu, entrando com a sua conta comercial e direcionado para a página do histórico de IPNs para detalhes adicionais: https://$pp_hostname/br/cgi-bin/webscr?cmd=_display-ipns-history . IPN disparado em $paypaldate.";
	}
	
	
	
	//The code below is to record data into ipn_notifications. It's a table exclusively to receive IPN messages. These data will be retrieved back to the front-end to be showed to the admin in the form of inbox.
	$saveipn = $pdo->prepare("INSERT INTO ipn_notifications (transactionid, subscriptionid, payer_id, payer_email, subject, message, chosenplan, paypal_environment, txn_type, payment_status, paypal_fee, paypal_amount, currency, paypaldate, datetime) VALUES (:transactionid, :subscriptionid, :payerid, :payeremail, :subject, :message, :chosenplan,  :paypalenvironment, :txntype, :paymentstatus, :paypalfee, :paypalamount, :currency, :paypaldate, NOW())");
	$saveipn->execute(array(':transactionid' => $tx_token, ':subscriptionid' => $subscriptionid, ':payerid' => $payerid, ':payeremail' => $paypalemail, ':subject' => $subject, ':message' => $message, ':chosenplan' => $chosenplan, ':paypalenvironment' => $paypal_environment, ':txntype' => $txn_type, ':paymentstatus' => $paymentstatus, ':paypalfee' => $fee, ':paypalamount' => $amount, ':currency' => $currency, ':paypaldate' => $paypaldate));	


	

		
	//Transaction Type (txn_type), they're all specified below
	//txn_type is the kind of transaction for which the IPN message was sent 
	//IPN VARIABLES for recurring payments:
	//recurring_payment_expired
	//recurring_payment_failed
	//recurring_payment_profile_cancel
	//recurring_payment_profile_created
	//recurring_payment_suspended       //also profile_status=Suspended
	//recurring_payment_suspended_due_to_max_failed_payment
	
	//IPN VARIABLES for subscriptions:
	//subscr_cancel
	//subscr_eot (Subscription Expired)
	//subscr_failed (Subscription Failed)
	//subscr_modify (Subscription modified)
	//subscr_signup (Subscription started)
	//subscr_payment (Subscription Payment Received: when the user subscribes successfully)
	
	//The codes below are to record data into usuarios_cadastrados table by fetching the user by the PayPal payer ID
	//if($txn_type == "subscr_payment"){}    //Completed
	//The condition above was unabled because this command was set to be executed via PDT, but... We can find a way to enable both and make it work.


	//Sending the notification email both to  client and admin
	if($txn_type != "masspay"){            //The notifications on mass pays will be sent only to the admin
        $recipients = array($clientemail, $confirmation_email_address);
        $email_to = implode(',', $recipients);
    }else{
        $email_to = $confirmation_email_address;
    }
    
    mail($email_to, $subject, $message, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
	//END OF SAVING DATA TO DATABASE
	//------------------------------------------------------------------------------------//

	//NOTE: email() function probably is not working because of header()

	
	// Create log file directory. NOTE: Is it really necessary?
    if (!is_dir($dated_log_file_dir)) {
        if (!file_exists($dated_log_file_dir)) {
            mkdir($dated_log_file_dir, 0777, true);
            if (!is_dir($dated_log_file_dir)) {
                $save_log_file = false;
            }
        } else {
            $save_log_file = false;
        }
    }
    // Restrict web access to files in the log file directory. NOTE: This code can be discarded
    $htaccess_body = "RewriteEngine On" . "\r\n" . "RewriteRule .* - [L,R=404]";
    if ($save_log_file && (!is_file($log_file_dir . "/.htaccess") || file_get_contents($log_file_dir . "/.htaccess") !== $htaccess_body)) {
        if (!is_dir($log_file_dir . "/.htaccess")) {
            file_put_contents($log_file_dir . "/.htaccess", $htaccess_body);
            if (!is_file($log_file_dir . "/.htaccess") || file_get_contents($log_file_dir . "/.htaccess") !== $htaccess_body) {
                $save_log_file = false;
            }
        } else {
            $save_log_file = false;
        }
    }
    if ($save_log_file) {
        // Save data to text file... NOTE: Why not saving this into DataBase instead?
        file_put_contents($dated_log_file_dir . "/" . $test_text . "paypal_ipn_" . $date . ".txt", "paypal_ipn_status = " . $paypal_ipn_status . "\r\n" . "paypal_ipn_date = " . $timestamp . "\r\n" . $data_text . "\r\n", FILE_APPEND);
    }
}
if ($send_confirmation_email) {
	//SAVING THOSE DATA TO DATABASE
	//------------------------------------------------------------------------------------//	
	
	// Send confirmation email
	/*
	mail($confirmation_email_address, $test_text . "PayPal IPN : " . $paypal_ipn_status, "paypal_ipn_status = " . $paypal_ipn_status . "\r\n" . "paypal_ipn_date = " . $timestamp . "\r\n" . $data_text, "From: " . $from_email_address);
	*/
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly
header("HTTP/1.1 200 OK");
?>