<?php
require_once("session.php");
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Aarong Festival</title>
</head>
<body>
<?php
require_once("classes/class.user.php");
$auth_user = new USER();
$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
/*
  |------------------------------------------------------------------------------------------------
  | Shows Value form input
  |------------------------------------------------------------------------------------------------
 */
try {
    $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE id = :id");
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
    $Data = $stmt->fetch(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$name = $Data->name;
$reg_id = $Data->reg_id;
$gate = $Data->gate;
$ticket_count = $Data->id+10000;
$email = $Data->email;
require('e-ticket-pdf.php');

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

    $ReceiveCount = $Data->receive_mail+1;
    if ($Data->receive_mail == 0 || $Data->receive_mail == NULL) {
      $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 1, `mobile_verify_code` = '' WHERE `id` = :id");
      $stmt->bindValue('id', $_GET['id']);
      $stmt->execute();
    }else{
      $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = '$ReceiveCount' WHERE `id` = :id");
      $stmt->bindValue('id', $_GET['id']);
      $stmt->execute();              
    }
    echo "<div class='alert alert-success'><strong>Well done!</strong> Message has been sent</div>";
    echo '<meta http-equiv="refresh" content="2; URL=home.php">';        
            
} else {
    $error = true;
    echo "<script>alert('Sorry mail not sent.'), window.location='https://aarongfestival.com/'</script>";  
}


?>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
