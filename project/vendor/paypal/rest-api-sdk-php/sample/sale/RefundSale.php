<?php
// # Sale Refund Sample
// This sample code demonstrate how you can 
// process a refund on a sale transaction created 
// using the Payments API.
// API used: /v1/payments/sale/{sale-id}/refund
/** @var Sale $sale */
$sale = require 'GetSale.php';
$saleId = $sale->getId();
use PayPal\Api\Amount;
use PayPal\Api\Refund;
use PayPal\Api\RefundRequest;
use PayPal\Api\Sale;
// ### Refund amount
// Includes both the refunded amount (to Payer) 
// and refunded fee (to Payee). Use the $amt->details
// field to mention fees refund details.
$amt = new Amount();
$amt->setCurrency($currencycode)
    ->setTotal($setvalue);     //This variable $setvalue must be set by me, ROGERIO
// ### Refund object
$refundRequest = new RefundRequest();
$refundRequest->setAmount($amt);
// ###Sale
// A sale transaction.
// Create a Sale object with the
// given sale transaction id.
$sale = new Sale();
$sale->setId($saleId);
try {
    // Create a new apiContext object so we send a new
    // PayPal-Request-Id (idempotency) header for this resource
    $apiContext = getApiContext($clientId, $clientSecret);
    // Refund the sale
    // (See bootstrap.php for more on `ApiContext`)
    $refundedSale = $sale->refundSale($refundRequest, $apiContext);
    
    //Lines of code below: altering DB, author: ROGERIO
    $refundstatus = $pdo->prepare("UPDATE ipn_notifications SET payment_status = ? WHERE transactionid = ? AND payment_status = ?");
    $refundstatus->execute(array("Refunded", $saleId, "Completed"));
    
    //$refundstatus2 is for updating the affiliatepayments table whose any row contain the column with the same value as the transaction id ($saleId). It simply updates it as Refunded, in order to avoid future payments to affiliates whose subscriber(s) has/have requested subscription cancel and refund. That being said, refunded payments wont have their commisions sent out to affiliates.
    //$refundstatus2 = $pdo->prepare("UPDATE affiliatepayments SET status = ? WHERE transactionid = ? AND status = ?");
    //$refundstatus2->execute(array("Refunded", $saleId, "guarantee"));
    
    echo "Reembolso emitido com sucesso<br/>
    <a href=\"urlHost\">Voltar pra Home</a>";
    //echo "<script>alert('Refund issued successfully'); location.href='$urlHost/contact.php';</script>";
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    echo "Erro: Falha no reembolso<br/>
    <a href=\"urlHost\">Voltar pra Home</a>";
    
    //ResultPrinter::printError("Refund Sale", "Sale", null, $refundRequest, $ex);
    //echo "<script>alert('Error: Unsuccessful Refund'); location.href='$urlHost/learnersnook.php';</script>";
    //exit(1);
}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
//ResultPrinter::printResult("Refund Sale", "Sale", $refundedSale->getId(), $refundRequest, $refundedSale);
//return $refundedSale;