<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "config.php";
session_start();
//session_save_path($sessionpath);
//Nota: Headers already sent - quando isto acontecer, verifique se o config.php está configurado para utf-8 sem BOM. Verifique também se não há algum espaço antes, entre ou após as tags php, ou algum código html anterior ou mesmo algum código php; quaisquer funções envolvendo "echo" ou "print" que produzam algum tipo de saída ou hipertexto; e verifique também se há mensagens de erros ou avisos. Todas estas causas que citei são as mais comuns que ocasionam esse tipo de problema/erro.
include 'sessao.php';

if(!isset($_SESSION['email'])){
    header('Location: /orangeadex/casamentoemdetalhes');
}

$referer = $_SERVER['HTTP_REFERER'];
$referer_parse = parse_url($referer);
$full_url = $referer_parse['host'] . $referer_parse['path'];
//Indexes or array keys of parse_url parameter:
//host
//scheme (http or https)
//user
//pass
//path (/directory/etc...)
//query (after ?)
//fragment (after #)

//AND ($full_url == "orangeadex.heliohost.org" || $full_url == "www.orangeadex.heliohost.org")
if(isset($_GET['tx']) AND isset($_GET['cp']) AND isset($_POST['refund'])){ 
    include "pricing.inc.php";
    include "paypalswitch.inc.php";
    if($_GET['cp'] == "Premium"){
        $setvalue = $premiumplan;
    }
    if($_GET['cp'] == "Gold"){
        $setvalue = $goldplan;
    }
    $tx_token = $_GET['tx'];
    include "project/vendor/paypal/rest-api-sdk-php/sample/sale/RefundSale.php";
}else{
    header('Location: /orangeadex/casamentoemdetalhes');
}
?>