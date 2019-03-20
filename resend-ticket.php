<?php
require('e-ticket-pdf.php');
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
            $receive_mail = $TicketSend[0]['receive_mail']+1;
            if ($receive_mail == 0 || $receive_mail == NULL) {
              $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$id'");
              $stmt->execute();
            }else{
              $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = '$receive_mail' WHERE `id` = '$id'");
              $stmt->execute();              
            }
            echo "<script>alert('Congratulations! Your Free pass has been sent to your email address. Please check inbox (Primary, Social, Updates, Forum folder OR spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. For more info pls visit www.bengalculturalfest.com'), window.location='https://aarongfestival.com'</script>";           
            
      }       
    } 
    else if ($mail_server == 'sendgrid' AND $status == 1) {
        require_once 'sendgrid.php';
        $response = $sg->client->mail()->send()->post($data);
        if (!$response) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $receive_mail = $TicketSend[0]['receive_mail']+1;
            if ($receive_mail == 0 || $receive_mail == NULL) {
              $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = '$id'");
              $stmt->execute();
            }else{
              $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = '$receive_mail' WHERE `id` = '$id'");
              $stmt->execute();              
            }
            echo "<script>alert('Congratulations! Your Free pass has been sent to your email address. Please check inbox (Primary, Social, Updates, Forum folder OR spam), print in laser, on good quality paper & bring the ticket with you to the venue. Without a readable barcode, entry into the venue will not be allowed. For more info pls visit www.bengalculturalfest.com'), window.location='https://aarongfestival.com'</script>";         
      }  

    }
    else {
        echo "No Mail";
    }
    

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>