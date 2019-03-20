<?php
try {
    $stmt = $auth_user->runQuery("SELECT * FROM `mail_settings` WHERE id = 1");
    $stmt->execute();
    $phpmailerconfig = $stmt->fetch(PDO::FETCH_OBJ);	
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
ob_start();
require_once('mail_body_content.php');
$html_message = ob_get_contents();
ob_end_clean();

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $phpmailerconfig->mail_host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $phpmailerconfig->mail_usernme;                 // SMTP username
    $mail->Password = $phpmailerconfig->mail_password;                           // SMTP password
    $mail->SMTPSecure = $phpmailerconfig->mail_smtp;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $phpmailerconfig->mail_port;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($phpmailerconfig->mail_from, 'Bengal Classical Mustic Festival');
    $mail->addAddress($email, $name);     // Add a recipient


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $phpmailerconfig->mail_subject;
    $mail->Body    = $html_message;
    $mail->addStringAttachment($pdf_content, 'Free Pass Free Pass Aarong Festival 2018.pdf');
    $mail->send();

} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}