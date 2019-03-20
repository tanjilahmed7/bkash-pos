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
            
      }       
    } 
    else if ($mail_server == 'sendgrid' AND $status == 1) {
        require_once 'sendgrid.php';
        $response = $sg->client->mail()->send()->post($data);
        if (!$response) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
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
      }  

    }
    else {
        echo "No Mail";
    }
    

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


?>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
