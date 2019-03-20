<?php
require('e-ticket-pdf.php');

/*
  |------------------------------------------------------------------------------------------------
  | Get Mail Setting 
  |------------------------------------------------------------------------------------------------
 */


try {
    $stmt = $auth_user->runQuery("SELECT * FROM `mail_settings` WHERE status = 1");
    $stmt->execute();
    $mailconfig = $stmt->fetch(PDO::FETCH_OBJ);
    $mail_server = $mailconfig->mail;
    $status = $mailconfig->status;
    if ($mail_server == 'phpmailer' AND $status == 1) {
        require_once 'phpmailer.php';
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo "<script>alert('Congratulations! You have completed your registration successfully. Your Free Pass has been sent to your email address. Please check inbox (Primary, Social, Updates, Forum folder OR spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. For more info pls visit www.aarongfestival.com'), window.location='https://www.facebook.com/events/158069895136719/'</script>";
        //     Congratulations! You have completed your registration successfully. Your Free Pass has been sent to your email address. Please check inbox Primary, Social, Updates, Forum folder OR spam, print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. 

            // $id = $ticket_filter [0]['id'];
            $mobile  = $mobile; // for confirmation  message
            $registration_number  = $reg_id; // for confirmation  message

            $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$id'");
            $stmt->execute();

            require("sms/SMS-Confirm.php");
            ?>
            <style type="text/css">
                .taken{
                    display: none;

                }
            </style> 
            <?php

        }        
    } 
    else if ($mail_server == 'sendgrid' AND $status == 1) {

        require_once 'sendgrid.php';
        
        if (!$response) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {

            $mobile  = $mobile; // for confirmation  message
            $registration_number  = $reg_id; // for confirmation  message

            // echo "ID: " . $last_id;

            // die();

            $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$last_id'");
            $stmt->execute();

            echo "<script>alert('Congratulations! You have completed your registration successfully. Your Free Pass has been sent to your email address. Please check inbox (Primary, Social, Updates, Forum folder OR spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. For more info pls visit www.aarongfestival.com'), window.location='https://www.facebook.com/events/158069895136719/'</script>";


            // require("sms/SMS-Confirm.php");
            ?>
            <style type="text/css">
                .taken{
                    display: none;

                }
            </style> 
            <?php

        }

    } else {
        echo "No Mail";
    }
    

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

