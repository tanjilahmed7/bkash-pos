<?php
namespace HttpSDK_SMS;
require_once 'SMSClient.php';
$client = new SMSClient("1989472039", "g`w`D_q\+", "http://www.sms4bd.net");
// $response = $client->SendSMS("bengal", "88".$mobile, "Registration is Complete. Your Registration ID : ".$registration_number. " and Gate : ".$gate, date('Y-m-d H:i:s'), SMSType::ASCII);
$response = $client->SendSMS("bengal", "88".$mobile, "Congratulations! You have completed your registration successfully. Your ID is ".$registration_number. ", Gate ".$gate.". For more info pls visit www.aarongfestival.com", date('Y-m-d H:i:s'), SMSType::ASCII);