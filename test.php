<?php
require("sendgrid-php/sendgrid-php.php");
// For Server
// require("sendgrid-php/vendor/autoload.php");


    $data = [
                'personalizations' => [
                        [
                            'to' => [
                                [ 'email' => 'tanjilahmed87@gmail.com' ]
                            ],
                            'subject' => 'test mail'
                         ]
                    ],
                'from' => [
                        'email' => 'test@bengalfoundation.org',
                        'name' => 'bengal'
                    ],
                'content' => [
                        [
                            'type' => 'text/html',
                            'value' => 'hello world!'
                         ]
                    ],
                'track_settings' => [
                        [
                            'click_tracking' => true,
                            'open_tracking' => true
                        ]
                    ]
                ];

  //$apiKey = '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'; // Mahi
$apiKey = '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'; // Tanjil
  // $apiKey = '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'; // Shafayet
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($data);

var_dump($response);

