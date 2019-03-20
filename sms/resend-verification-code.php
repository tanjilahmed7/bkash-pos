<?php
namespace HttpSDK_SMS;
require_once 'SMSClient.php';
$client = new SMSClient("1989472039", "g`w`D_q\+", "http://www.sms4bd.net");
$response = $client->SendSMS("bengal", "88".$mobile, "Mobile verification code for Aarong Festival registration : ".$code, date('Y-m-d H:i:s'), SMSType::ASCII);
$response->StatusMessage;
if ($response->StatusMessage) {
echo "<script>alert('Well done! A text message with a verification code was just sent to your mobile number. The code should reach within 10 minutes.'), window.location='find-ticket.php'</script>";
?>
<style type="text/css" media="screen">
.taken.alert.alert-warning {
    display: none;
}
</style>
<?php
}
?>