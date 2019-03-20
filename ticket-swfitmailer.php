<?php
require('e-ticket-pdf.php');

/*
  |------------------------------------------------------------------------------------------------
  | Get Mail Setting 
  |------------------------------------------------------------------------------------------------
 */


require_once 'SwiftMailer/SwiftMailer/vendor/swiftmailer/swiftmailer/lib/swift_required.php';

ob_start();
require_once('mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

$mailer = new Swift_Mailer(new Swift_MailTransport()); // Create new instance of SwiftMailer
$message = Swift_Message::newInstance();
$message->setSubject('Aarong Festival 2018'); // Message subject
$message->setFrom('no-reply@aarongfestival.com', 'Aarong Festival'); // From:
$message->attach(Swift_Attachment::newInstance($pdf_content, 'Free Pass Aarong Festival 2018.pdf', 'application/pdf')); // Attach the generated PDF from earlier
$message->setTo(array(
// "shafayet.me@gmail.com" => "Shafayet (Gmail)",
    $email => $name
    ));

$message->setBody($html_message, 'text/html');

// Send the email, and show user message
if ($mailer->send($message)) {
    $success = true;

    $mobile  = $mobile; // for confirmation  message
    $registration_number  = $reg_id; // for confirmation  message

    $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$id'");
    $stmt->execute();

    require("sms/SMS-Confirm.php");
    
      echo "<script>alert('Congratulations! You have completed your registration successfully. Your Free e-Ticket has been sent to your email address. Please check inbox (Primary, Social, Updates, Forum folder OR spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. For more info pls visit www.aarongfestival.com'), window.location='https://aarongfestival.com/'</script>";
              
?>

    <style type="text/css">
        .taken{
            display: none;

        }
    </style>

<?php
            
} else {
    $error = true;
    echo "<script>alert('Sorry mail not sent.'), window.location='https://aarongfestival.com/'</script>";  
}
