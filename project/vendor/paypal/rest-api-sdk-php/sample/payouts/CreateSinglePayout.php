<?php
// # Create Single Synchronous Payout Sample
//
// This sample code demonstrate how you can create a synchronous payout sample, as documented here at:
// https://developer.paypal.com/docs/integration/direct/create-single-payout/
// API used: /v1/payments/payouts?sync_mode=true
require __DIR__ . '/../bootstrap.php';
// Create a new instance of Payout object
$payouts = new \PayPal\Api\Payout();
// This is how our body should look like:
/*
 * {
            "sender_batch_header":{
                "sender_batch_id":"2014021801",
                "email_subject":"You have a Payout!"
            },
            "items":[
                {
                    "recipient_type":"EMAIL",
                    "amount":{
                        "value":"8.0",
                        "currency":"BRL"
                    },
                    "note":"Thanks for your patronage!",
                    "sender_item_id":"2014031400023",
                    "receiver":"rogeriobsoares5-buyer@gmail.com"
                }
            ]
        }
 */
$senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
// ### NOTE:
// You can prevent duplicate batches from being processed. If you specify a `sender_batch_id` that was used in the last 30 days, the batch will not be processed. For items, you can specify a `sender_item_id`. If the value for the `sender_item_id` is a duplicate of a payout item that was processed in the last 30 days, the item will not be processed.
// #### Batch Header Instance
$senderBatchHeader->setSenderBatchId(uniqid())
    ->setEmailSubject("Affiliate Payment Completed - Casamento em Detalhes!");
// #### Sender Item
// Please note that if you are using single payout with sync mode, you can only pass one Item in the request

$senderItem = new \PayPal\Api\PayoutItem();

$senderItem->setRecipientType('Email')
    ->setNote('This payment is related to your affiliation (Casamento em Detalhes Magazine recurring payment). Congratulations!!')
    ->setReceiver($affiliateemail)
    ->setSenderItemId(uniqid())
    ->setAmount(new \PayPal\Api\Currency('{
                        "value":"'. $paymentvalue .'",
                        "currency":"'. $currencycode .'"
                    }'));
$payouts->setSenderBatchHeader($senderBatchHeader)
    ->addItem($senderItem);

// For Sample Purposes Only.
$request = clone $payouts;
// ### Create Payout
try {
    //$output = $payouts->createSynchronous($apiContext);
	$s = curl_init("https://api.sandbox.paypal.com/v1/payments/payouts");

	curl_setopt($s, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payouts");
	curl_setopt($s, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $apiContext->getCredential()->getAccessToken(array())));
	curl_setopt($s,CURLOPT_POST,true);
	curl_setopt($s, CURLOPT_POSTFIELDS, $payouts->toJSON());
	
	$output = curl_exec($s);    //$result instead of $output
	curl_close($s);
	
	$status = "success";
	} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	
	$status = "failure";
	echo "Single Synchronous Payout Failed - ". $request . ", " . $ex;
	//ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
    //exit(1);
}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
  
  //ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);

//return $output;
?>