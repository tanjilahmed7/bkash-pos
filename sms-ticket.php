<?php
require('e-ticket-pdf.php');
/*
  |-----------------------------------------------------------------------------------------------------------------------
  | SENDGRID
  |-----------------------------------------------------------------------------------------------------------------------
 */
ob_start();
require_once('mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

require("sendgrid-php/sendgrid-php.php");

    $data = [
                'personalizations' => [
                        [
                            'to' => [
                                [ 'email' => $email ]
                            ],
                            'subject' => 'Aarong Festival 2018'
                         ]
                    ],
                'from' => [
                        'email' => 'ticket@aarongfestival.com',
                        'name' => 'Aarong Festival 2018'
                    ],
                'content' => [
                        [
                            'type' => 'text/html',
                            'value' => $html_message
                         ]
                    ],
                'track_settings' => [
                        [
                            'click_tracking' => true,
                            'open_tracking' => true
                        ]
                    ],
                'attachments' => [
                        [
                            'content' => base64_encode($pdf_content),
                            'type' => 'application/pdf',
                            'filename' => 'Free Pass Aarong Festival 2018.pdf',
                            'disposition' => 'attachment'
                        ]
                    ]
                ];

$apiKey = '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'; // Mahi
// $apiKey = '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';
// $apiKey = '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'; // Shafayet
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($data);

if (!$response) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {

    $mobile  = $mobile; // for confirmation  message
    $registration_number  = $reg_id; // for confirmation  message

    $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$id'");
    $stmt->execute();

    // require("sms/SMS-Confirm.php");
    echo "Congratulations! You have completed your registration successfully. Your ID is ".$registration_number. ", Gate ".$gate.". For more info pls visit www.aarongfestival.com";


}
