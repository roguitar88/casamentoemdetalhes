<?php
// # Create Bulk Payout Sample
//
// This sample code demonstrate how you can create a synchronous payout sample, as documented here at:
// https://developer.paypal.com/docs/integration/direct/create-batch-payout/
// API used: /v1/payments/payouts
require __DIR__ . '/../bootstrap.php';
// Create a new instance of Payout object
$payouts = new \PayPal\Api\Payout();
// This is how our body should look like:
/*
 *{
    "sender_batch_header": {
        "sender_batch_id": "random_uniq_id",
        "email_subject": "You have a payment"
    },
    "items": [
        {
            "recipient_type": "EMAIL",
            "amount": {
                "value": 7.00,
                "currency": "BRL"
            },
            "receiver": "rogeriobsoares5-buyer@gmail.com",
            "note": "Thank you.",
            "sender_item_id": "item_1"
        },
        {
            "recipient_type": "EMAIL",
            "amount": {
                "value": 6.00,
                "currency": "BRL"
            },
            "receiver": "rogeriobs.10@hotmail.com",
            "note": "Thank you.",
            "sender_item_id": "item_2"
        },
        {
            "recipient_type": "EMAIL",
            "amount": {
                "value": 5.00,
                "currency": "USD"
            },
            "receiver": "rogeriobs.10-facilitator@hotmail.com",
            "note": "Thank you.",
            "sender_item_id": "item_3"
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
//$senderItem = array();

$payouts->setSenderBatchHeader($senderBatchHeader);


//ROGERIO---------------------------------------------------------------------
if($chosenplan == "Monthly Plan"){ $paymentvalue = $mcommission; }
if($chosenplan == "Yearly Plan"){ $paymentvalue = $ycommission; }
$i = 1;
while($fetchit = $searchaffiliatedata->fetch(PDO::FETCH_ASSOC) AND $i <= $countpendingpayments){    //$i <= $countpendingpayments
	//$chosenplan = $fetchit['chosenplan'];
	//$time_ago = $fetchit['date'];	
	//$paid = $fetchit['paid'];
	//$dayselapsed = timeAgo($time_ago);
	$id = $fetchit['id'];
    $affiliateid = $fetchit['affiliateid'];
    
    
    //This is to retrieve the email from the affiliates table where affiliates are registered...
	$searchinaffiliatestable = $pdo->prepare("SELECT * FROM affiliates WHERE id = ?");
	$searchinaffiliatestable->execute(array($affiliateid));
	$fetchaffiliate = $searchinaffiliatestable->fetch();
    
	$affiliateemail = $fetchaffiliate['paypal_email'];
	//$paypalname = $fetchaffiliate['name'];
	
    
	//if($dayselapsed >= 0 AND $paid == 0){     //8 days, because the client can claim the money back in the 7-day period for refund (Policy Refund in Terms of the Casamento em Detalhes affiliate program). Other than that, I believe this condition (if($dayselapsed >= ...)) can be deleted and restricted only to the query(ies) that follow(s)...
        
//for($i = 1; $i <= 1; $i++){
//foreach($affiliateemail as $email){
    ${'senderItem'.$i} = new \PayPal\Api\PayoutItem(
    array(
        "recipient_type" => "EMAIL",//values: PHONE, PAYPAL_ID, EMAIL
        "receiver" => $affiliateemail,
        "note" => "This payment is related to your affiliation (Casamento em Detalhes Magazine recurring payment). Congratulations!!",
        "sender_item_id" => uniqid(),
        "amount" => array(
            "value" => $paymentvalue,
            "currency" => $currencycode
            )
        )
    );
    
    $updatemarkerbyid = $pdo->prepare("UPDATE affiliatepayments SET marker = ? WHERE id = ?");
    $updatemarkerbyid->execute(array(1, $id));
    
    $payouts->addItem(${'senderItem'.$i});
    $i++;
//}
    //}
}
//ROGERIO---------------------------------------------------------------------------

    /*
    $sItem->setRecipientType('Email')
            ->setNote('This payment is related to your affiliation (Casamento em Detalhes Magazine recurring payment). Congratulations!!')
            ->setReceiver($affiliateemail)
            ->setSenderItemId(uniqid())
            ->setAmount(new \PayPal\Api\Currency('{
                                "value":"'. $paymentvalue .'",
                                "currency":"BRL"
                            }'));
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($sItem);

    foreach($senderItem as $sItem){
        
    }
    */

//$payouts->setSenderBatchHeader($senderBatchHeader)
    //->addItem($senderItem1)->addItem($senderItem2)->addItem($senderItem3);

// For Sample Purposes Only.
$request = clone $payouts;
// ### Create Payout
try {
    //$output = $payouts->create(null, $apiContext);
    $s = curl_init("https://$api_host/v1/payments/payouts");

	curl_setopt($s, CURLOPT_URL, "https://$api_host/v1/payments/payouts");
	curl_setopt($s, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $apiContext->getCredential()->getAccessToken(array())));
	curl_setopt($s,CURLOPT_POST,true);
	curl_setopt($s, CURLOPT_POSTFIELDS, $payouts->toJSON());
	
	$output = curl_exec($s);    //$result instead of $output
	curl_close($s);
	
    //$output2 = $payouts->toJSON();
    
	$status = "success";
    
    //ROGERIO----------------------------------------------------------------
    
    $updateaffiliatepayments = $pdo->prepare("UPDATE affiliatepayments SET paid = ?, status = ? WHERE status = ? AND futuredate = ? AND chosenplan = ? AND marker = ?");
    $updateaffiliatepayments->execute(array(1, $status, "guarantee", $currentdate, $chosenplan, 1));

    //Implement logic with an if/condition
    //I believe it's not a good idea to consider the code below for notifications via email. I believe a less bad alternative would be IPNs.
    /*
while($fetchit = $searchaffiliatedata->fetch(PDO::FETCH_ASSOC)){
    $id2 = $fetchit['affiliateid'];
    
    
    //This is to retrieve the email from the affiliates table where affiliates are registered...
	$searchinaffiliatestable2 = $pdo->prepare("SELECT * FROM affiliates WHERE id = ?");
	$searchinaffiliatestable2->execute(array($id2));
	$fetchaffiliate2 = $searchinaffiliatestable2->fetch();
    
	$affiliateemail2 = $fetchaffiliate2['paypal_email'];
    
    $sub = "Affiliate payment credited to your PayPal account - Casamento em Detalhes affiliate program";
    $mes = "Hello,
Now you've got money in your PayPal account. That amount (R$ BRL) is related to the recurring payment of a client's recurring subscription and because you are an Casamento em Detalhes affiliate. For further details, please login and check your dashboard at: /orangeadex/casamentoemdetalhes/affiliatedashboard.php. If you like, copy and paste the link straight into the address bar in your browser.

Yes, you can earn even more money by promoting more people to subcribe to our magazine.
Thank you very much and welcome!
Casamento em Detalhes - Uniting Peoples and Nations through English

This email was automatically generated. Please, do not respond.";
    $confirmation_email_address = "rogeriobsoares5@gmail.com";
    $recipients = array($affiliateemail2, $confirmation_email_address);
	$email_to = implode(',', $recipients);
    
    mail($email_to, $sub, $mes, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
}
*/
    //ROGERIO----------------------------------------------------------------
    
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	$status = "failure";
	
    //ROGERIO-----------------------------------------------------------------
    
    /*
    $updateaffiliatepayments = $pdo->prepare("UPDATE affiliatepayments SET status = ? WHERE status = ? AND futuredate = ?");
    $updateaffiliatepayments->execute(array($status, "guarantee", $currentdate));
    */
    
    /*
    $sub = "Affiliate payment FAILED!! - Casamento em Detalhes affiliate program";
    $mes = "Hello,
Oops, Houston, we have a problem. Unfortunately, the (R$ BRL) ammount failed to be paid into your account. But all the same, you can claim this payment by contacting our support immediately at /orangeadex/casamentoemdetalhes/contact.php for technical issues solutions. We're very sorry for that. It's likely to have been caused by some inconsistency or malfunction in the PayPal system itself or our integration. For further details, please login and check your dashboard at: /orangeadex/casamentoemdetalhes/affiliatedashboard.php. If you like, copy and paste the link straight into the address bar in your browser.

Yes, you can earn even more money by promoting more people to subcribe to our magazine.
Thank you very much and welcome!
Casamento em Detalhes - Uniting Peoples and Nations through English

This email was automatically generated. Please, do not respond.";

    mail($affiliateemail, $sub, $mes, "From: Casamento em Detalhes<suporte@orangeadex.tk>\nX-Mailer: PHP/" . phpversion());
    */
    //ROGERIO-----------------------------------------------------------------
    
    //echo "Batch Payout Failed - ". $request . ", " . $ex;
    //ResultPrinter::printError("Created Batch Payout", "Payout", null, $request, $ex);
    //exit(1);
}
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 //ResultPrinter::printResult("Created Batch Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);

echo "<pre>";
print_r($output);
echo "<br/><br/>";
print_r($request);
echo "</pre>";

//NOTE: add status and plan column to the table below:
$recordoutput = $pdo->prepare("INSERT INTO created_batch_payouts (request, plan, outcome, environment, date) VALUES (?, ?, ?, ?, NOW())");
$recordoutput->execute(array($request, $chosenplan, $status, $env));
//echo "PayPal Payout GetData:<br>". $ex->getData() . "<br><br>";
?>