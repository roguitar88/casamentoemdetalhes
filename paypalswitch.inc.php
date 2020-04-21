<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/	
//Use this include here as a controller where you can switch between LIVE and SANDBOX mode. More practical and more easy, right? All PayPal credentials either from LIVE or SANDBOX environment go here

//include "config.php";

$turnonandoff = $pdo->prepare("SELECT * FROM paypalswitch WHERE id = ?");
$turnonandoff->execute(array(1));
$fetchturnonandoff = $turnonandoff->fetch(PDO::FETCH_ASSOC);

if($fetchturnonandoff['sandbox'] == 1){
    $env = 'SANDBOX';    // You only one action to switch/change from SANDBOX to LIVE or vice-versa...
    //$env VALUES: ['SANDBOX', 'LIVE']
}else{
    $env = 'LIVE';
}

if($env == 'SANDBOX'){
    // Use this to specify all of the email addresses that you have attached to paypal (ipnlistener.php):
    $my_email_addresses = array("casamentoemdetalhes20@gmail.com", "rogeriobsoares5@gmail.com");
    $pp_hostname = "www.sandbox.paypal.com";
    // The auth_token variable below stores the ID token for PDT (Payment Data Transfer) and for the thank you page success.php
    $auth_token = "Seu-Token-do-PayPal-aqui";
    //include for ipn/ipnlistener.php
    $enable_sandbox = true;
    //include for project/vendor/paypal/rest-api-sdk-php/sample/bootstrap.php
    //SANDBOX account: casamentoemdetalhes20@gmail.com
    $clientId = 'Id-do-Cliente-Codigo-Extenso';
    $clientSecret = 'Secredo-do-Cliente-Codigo-Extenso';
    $mode2 = 'sandbox';
    //include for managesubscription.php
    // SANDBOX API Credentials
    $api_username = 'casamentoemdetalhes20_api1.gmail.com';
    $api_password = 'senha-da-api-paypal';
    $api_signature = 'assinatura-da-api-paypal';
    $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    $api_host = 'api.sandbox.paypal.com';
    $hosted_button_id = 'DLRSETPMMGNVU';   //Sandbox
    //$donate_hosted_button_id = 'HBLLQ9AL2HCWJ';
}else{
    // Use this to specify all of the email addresses that you have attached to paypal (ipnlistener.php):
    $my_email_addresses = array("suporte@orangeadex.tk");
    $pp_hostname = "www.paypal.com";
    $auth_token = "Seu-Token-do-PayPal-aqui";
    $enable_sandbox = false;
    //LIVE account: suporte@orangeadex.tk
    $clientId = 'Id-do-Cliente-Codigo-Extenso';
    $clientSecret = 'Secredo-do-Cliente-Codigo-Extenso';
    $mode2 = 'live';
    //LIVE API Credentials
    $api_username = 'english4life88usa_api1.gmail.com';
    $api_password = 'senha-da-api-paypal';
    $api_signature = 'assinatura-da-api-paypal';
    $api_url = 'https://api-3t.paypal.com/nvp';
    $api_host = 'api.paypal.com';
    $hosted_button_id = 'HP4RLNCWYJ7YY';    //Live
    //$donate_hosted_button_id = 'F3VD5LGL2R9GJ';
}
?>