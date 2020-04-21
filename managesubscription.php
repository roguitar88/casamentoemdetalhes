<?php
//if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/
include "key.inc.php";
/**
 * Performs an Express Checkout NVP API operation as passed in $action.
 *
 * Although the PayPal Standard API provides no facility for cancelling a subscription, the PayPal
 * Express Checkout  NVP API can be used.
 */
function change_subscription_status( $profile_id, $action, $parameter, $method, $pdo, $id, $paypal_environment, $payerid, $firstname, $clientemail, $subscriptionid, $api_username, $api_signature, $api_password, $api_url ) {
	//Using SANDBOX or LIVE PayPal data: 
    $api_request = 'USER=' . urlencode( $api_username ) //API Username
				.  '&PWD=' . urlencode( $api_password )  //API Password
				.  '&SIGNATURE=' . urlencode( $api_signature )   //API Signature
				.  '&VERSION=76.0'
				.  '&METHOD=' . $method     //'&METHOD=ManageRecurringPaymentsProfileStatus'
				.  '&PROFILEID=' . urlencode( $profile_id )
				.  '&ACTION=' . urlencode( $action )
				.  '&NOTE=' . urlencode( 'Subscription altered in the website' );
 
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $api_url ); // Check include paypalswitch.inc.php for switching between the live and the sandbox API urls
	curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
 
	// Uncomment these to turn off server and peer verification
	//curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
	//curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_POST, 1 );
 
	// Set the API parameters for this transaction
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
 
	// Request response from PayPal
	$response = curl_exec( $ch );
 	
	if($response){
		// parse the data
		//$lines = explode("\n", trim($response));
		//$parameter = 'TIMESTAMP';
		//if (strcmp ($lines[0], "Failure") == 1) { //This if (condition) can be deleted
			parse_str($response, $parsed_response);
			$output = array($parameter);
			foreach ($parsed_response as $key => $value) {
				if (in_array($key, $output)){
					//echo "$key: $value\n";
					if($value == "Success"){
						if($action == 'Cancel'){
							
							//ENABLE THE TWO LINES BELOW, IN CASE IPN MESSAGES ARE TAKING TOO LONG...
							$changesubscriptionstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ?, paypal_canceled = ?  WHERE id = ?");
							$changesubscriptionstatus->execute(array(0, 0, 1, $id));
							//----------------------------------------------------------------------------------------------
							
							//The lines below were unabled just to avoid double messages
							//$txn_type = "subscr_cancel";
							
							//$subject = "Your subscription was canceled";
							
							//$message = "SUBSCRIPTION CANCELED: Mr. (Mrs.) $firstname, it seems to me that the subscription has been CANCELED by yourself via our website, by clicking that button. The recurring payment won't be charged any longer. To acquire the products/services again you have to go to the website and reorder subscription. This is an example email only.";
							//mail($clientemail, $subject, $message, "From: Orangeade X<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
							echo "A assinatura agora foi cancelada com sucesso
                            <a href=\"/orangeadex/casamentoemdetalhes\">Voltar pra Home</a>";

						}elseif($action == 'Suspend'){
							//ENABLE THE TWO LINES BELOW, IN CASE IPN MESSAGES ARE TAKING TOO LONG...
							$changesubscriptionstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ? WHERE id = ?");
							$changesubscriptionstatus->execute(array(0, 1, $id));
							//----------------------------------------------------------------------------------------------
							
                            /*
                            if(isset($affiliatepaymentid)){
                                $updateaffiliatepayments = $pdo->prepare("UPDATE affiliatepayments SET status = ? WHERE status = ? AND id = ?");
                                $updateaffiliatepayments->execute(array("refunded", "guarantee", $affiliatepaymentid));
                            }
                            */
							//The lines below were unabled just to avoid double messages
							//$txn_type = "recurring_payment_suspended";
							
							//$subject = "Your subscription was suspended";
							
							//$message = "SUBSCRIPTION SUSPENDED: Mr. (Mrs.) firstname lastname, it seems to me that you yourself have suspended your own subscription. The recurring payment won't be charged, while your subscription is suspended, but you can reactivate its charging at any time you want. This is an example email only.";
							
							//mail($clientemail, $subject, $message, "From: Orangeade X<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
							
							echo "Agora a sua assinatura se encontra suspensa
                            <a href=\"/orangeadex/casamentoemdetalhes\">Voltar pra Home</a>";
						}else{
							if($action == 'Reactivate'){
								$changesubscriptionstatus = $pdo->prepare("UPDATE usuarios_cadastrados SET paid = ?, paypal_suspended = ? WHERE id = ?");			
								$changesubscriptionstatus->execute(array(1, 0, $id));
								
								$txn_type = "subscr_reactivate";     //This variable doesnt exist in reality. It was created by me
								
								$subject = "Sua assinatura agora foi reativada";
								$message = "ASSINATURA REATIVADA: Sr. $firstname, a sua conta agora em Casamento em Detalhes se encontra ativa  novamente. A sua assinatura se encontrava suspensa e agora foi reativada com sucesso. De agora em diante, os pagamentos recorrentes (mensalidades) serão automaticamente cobrados na sua conta PayPal. Se houver algum cartão de crédito vinculado a tal conta e você permitiu toda e qualquer cobrança via o mesmo, as cobranças aparecerão na fatura do mesmo. E se você ainda quiser, você poderá cancelar ou suspender a assinatura novamente a qualquer momento e isto é muito simples. Este é um email de amostra apenas.";
								//Lets send the email but also saving as if it were an IPN message to our database
								$saveipn = $pdo->prepare("INSERT INTO ipn_notifications (subscriptionid, payer_id, subject, message, paypal_environment, txn_type, datetime) VALUES (:subscriptionid, :payerid, :subject, :message, :paypalenvironment, :txntype, NOW())");
								$saveipn->execute(array(':subscriptionid' => $subscriptionid, ':payerid' => $payerid, ':subject' => $subject, ':message' => $message, ':paypalenvironment' => $paypal_environment, ':txntype' => $txn_type));	
								
								mail($clientemail, $subject, $message, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
								
								echo "A assinatura foi reativada
                                <a href=\"/orangeadex/casamentoemdetalhes\">Voltar pra Home</a>";
							}
						}
					}else{
						echo "Erro. Não foi possível executar este comando. Entre em contato com a equipe do suporte.
                        <a href=\"/orangeadex/casamentoemdetalhes\">Voltar pra Home</a>";
					}
				}
			}
			return $parsed_response;
		//}else if (strcmp ($lines[0], "Success") == 0) {
			//return "Houston, we have a problem";
		//}
	}else{
		$errormessagefrompaypal = 'Chamada do PayPal para o comando change_subscription_status falhou: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')';
		die($errormessagefrompaypal);
		curl_close( $ch );
		//NOTE: This error message can be stored in our database (Managing Notifications)
	}
	
	// If no response was received from PayPal there is no point parsing the response
	//if( !$response )//{
		//echo "<br/>Error";
	//}else{
		// An associative array is more usable than a parameter string
		//echo "<br/>No Error";
	//}	
}

if(isset($_GET['si']) AND isset($_GET['id']) AND isset($_POST['paypal'])){
    include "paypalswitch.inc.php";
    $id = $_GET['id'];
	$profile_id = $_GET['si'];      	//si = Subscription ID (as a substitute for "Profile ID")
	$action = $_POST['paypalaction']; 	//Actions = 'Cancel', 'Suspend' and 'Reactivate'
	$parameter = 'ACK';        //CORRELATIONID, TIMESTAMP, ACK, VERSION, BUILD, L_ERRORCODE0, L_SHORTMESSAGE0, L_LONGMESSAGE0, L_SEVERITYCODE0
	$method = 'ManageRecurringPaymentsProfileStatus';
	$paypal_environment = $env;

	//GetRecurringPaymentsProfileDetails
	
	$search = $pdo->prepare("SELECT * FROM usuarios_cadastrados WHERE id = ?");
	$search->execute(array($id));
	$fetch = $search->fetch();
	
	$payerid = $fetch['payer_id'];
	$firstname = $fetch['nomeprincipal'];
	$email_to = $fetch['email'];
	$subscriptionid = $fetch['paypal_subscriptionid'];
	
	$confirmation_email_address = "rogeriobsoares5@gmail.com";
	$recipients = array($email_to, $confirmation_email_address);
	$clientemail = implode(',', $recipients);
    
    //----ROGERIO ----This part is to update the affiliate payments that have been refunded to the subscribers
    /*
    $currentdate = date("Y-m-d");
	$searchlatesttransactionid = $pdo->prepare("SELECT * FROM affiliatepayments WHERE futuredate >= ? AND id = ? ORDER BY date DESC LIMIT 1");
    $searchlatesttransactionid->execute(array($currentdate, $id));
    
    $fetchlatesttransactionid = $searchlatesttransactionid->fetch();
    $affiliatepaymentid = $fetchlatesttransactionid['id'];
	*/
    /*
	if($action == 'Cancel'){
	}elseif($action == 'Suspend'){
	}else{
		if($action == 'Reactivate'){
		}
	}
	*/
	
	$data = change_subscription_status( $profile_id, $action, $parameter, $method, $pdo, $id, $paypal_environment, $payerid, $firstname, $clientemail, $subscriptionid, $api_username, $api_signature, $api_password, $api_url );
	
	print "<pre>";
	print_r($data);
	print "</pre>";
	
	//change_subscription_status( $profile_id, $action, $parameter, $method, $pdo, $id, $txn_type, $paypal_environment, $payerid, $firstname, $clientemail, $subscriptionid, $api_username, $api_signature, $api_password, $api_url );

}else{
	echo '<script>alert("Xô! Permissão Negada! Dê o fora imediatamente!"); location.href = "/orangeadex/casamentoemdetalhes/termos.php";</script>';
}
?>