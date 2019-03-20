<?php
namespace HttpSDK_SMS;
require_once 'SMSClient.php';

$client = new SMSClient("1989472039", "g`w`D_q\+", "http://www.sms4bd.net");
$response = $client->SendSMS("bengal", "88".$mobile, "Your verification code is ".$VerifyCode.". This is NOT your registration number. Pls enter your verification code on the form to complete registration & get your ticket.", date('Y-m-d H:i:s'), SMSType::ASCII);

$response->StatusMessage;

//if ($response->StatusMessage) {
//    echo "<div class='alert alert-success'><strong>Well done!</strong> A text message with a verification code was just sent to your mobile number. </div>";
//    echo '<meta http-equiv="refresh" content="2; URL=gw-find-ticket.php">';
//} else {
//	echo "Message has been Failed!";
//}


