<?php
/*
  |-----------------------------------------------------------------------------------------------------------------------
  | SENDGRID
  |-----------------------------------------------------------------------------------------------------------------------
 */

try {
    $stmt = $auth_user->runQuery("SELECT * FROM `mail_settings` WHERE id = 2");
    $stmt->execute();
    $sendgridconfig = $stmt->fetch(PDO::FETCH_OBJ);    
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

// echo "Done sendgrid Top";

ob_start();
require_once('mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

require("sendgrid-php/sendgrid-php.php");
// For Server
// require("sendgrid-php/vendor/autoload.php");


    $data = [
                'personalizations' => [
                        [
                            'to' => [
                                [ 'email' => $email ]
                            ],
                            'subject' => $sendgridconfig->mail_subject
                         ]
                    ],
                'from' => [
                        'email' => $sendgridconfig->mail_from,
                        'name' => $sendgridconfig->mail_name
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

  //$apiKey = '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'; // Mahi
  $apiKey = $sendgridconfig->mail_api; // Tanjil
  // $apiKey = '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'; // Shafayet
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($data);

