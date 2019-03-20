<?php
// Require class User 
require_once("classes/class.user.php");
$auth_user = new USER();

/*
  |-------------------------------------------------------------------------------------------------------------
  | Isset check Save
  |-------------------------------------------------------------------------------------------------------------
 */


  if (isset($_POST['save']) && !empty($_POST['save'])):
    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //local site secret key
        $secret = '6Lc1ZwkUAAAAAEHhfAc8ykj_n9A4ZVydvaOGP6xZ';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

     if ($responseData->success):
        try {
           $RegId = $_POST['reg_id'];
           $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE receive_mail <= 4 AND `reg_id` = '$RegId' AND mobile_verify_code = ''");
           $PDO->execute();
           $TicketSend = $PDO->fetchAll(PDO::FETCH_ASSOC);

           if ($TicketSend) {
              $id = $TicketSend[0]['id'];
              $name = $TicketSend[0]['name'];
              $gate = $TicketSend[0]['gate'];
              $reg_id = $TicketSend[0]['reg_id'];
              $mobile = $TicketSend[0]['mobile'];
              $email = $TicketSend[0]['email'];
              $ticket_count = $id+10000;
              require_once 'resend-ticket.php';          
           } else {
              echo "<script>alert('Warning! Your registration ID is not valid or you have been trying too many times. Please contact with Helpline 01616111888'), window.location='resend-email.php'</script>";
           }
        }catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

     else:
         echo "<script>alert('Warning! Robot verification failed, please try again.'), window.location='resend-email.php'</script>";
        endif;
        else:
            echo $errMsg = '.';
            echo "<script>alert('Warning! Please click on the reCAPTCHA box'), window.location='resend-email.php'</script>";
        endif;
        else:
            $errMsg = '';
            $succMsg = '';
        endif;
?>
<?php require('reg-header.php'); ?>                
    <div class="main">
        <form method="post">
            <h3>Resend Email Ticket</h3>
            <ul class="terms">
                <li>Resend Code : Incase you have not received the code</li>
                <li>Resend Email : Incase you have not received the email at the email address provided</li>
            </ul>
            <div class="ticket-assistance">
                <a class="btn btn-warning" href="resend-verification-code.php" role="button">Resend Code</a>
                <a class="btn btn-success" href="resend-email.php" role="button">Resend Email</a>                  
            </div>
            <br><br>
            <div class="col-md-12">
                <label> Registration ID </label>
                <input type="text" class="form-control" name="reg_id" id="reg_id" autofocus="autofocus" onfocus="this.value = this.value;" required>
            </div>
            <div class="col-md-12">
                <div class="form-group form-group-sm ">
                    <div class="g-recaptcha" data-sitekey="6Lc1ZwkUAAAAANdYL2hraKnEPHNId-OQPgd-5Vg1"></div>
                    <!-- local -->
                </div>
            </div>
            <div class="col-md-4"> 
                <button type="submit" name="save" value="Save" class="btn btn-primary">Done</button>
            </div>
            <div class="helpline col-md-8">
               <h4>Helpline : +88 09639 555 000 (9.00AM - 11:00PM)</h4>
            </div>
        </form>
    </div>
<?php require('reg-footer.php'); ?>    