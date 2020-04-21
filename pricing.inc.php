<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: /orangeadex/casamentoemdetalhes'); 
//https://wp-mix.com/php-protect-include-files/

$premiumplan = "65.00";  //Premium
$goldplan = "149.90";    //Gold

$premiumplan2 = str_replace('.', ',', $premiumplan);
$goldplan2 = str_replace('.', ',', $goldplan);

//40% de comissão para os possíveis afiliados
/* Cálculos de comissionamento */
$monthly = ($premiumplan * 40)/100;
$yearly = ($goldplan * 40)/100;

$mcommission = number_format($monthly, 2);
$ycommission = number_format($yearly, 2);

$feeonaffiliatepaymentmp = 0.16;
$feeonaffiliatepaymentyp = 1.60;
/* Cálculos de comissionamento */

$paypalrate = 0.0479;   //4.79% in Brazil
$paypalfee = 0.60;  //R$ 0.60 in Brazil

$limit = 250;  //15000 for batch payouts
$currencycode = "BRL";
?>