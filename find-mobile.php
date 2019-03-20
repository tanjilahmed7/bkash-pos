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
    
            // Ticket
            try {
                $mobile = $_POST['mobile'];
                $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile` = '$mobile' AND reg_vip_id = 0 AND receive_mail < 5");
                $PDO->execute();
                $ticket_filter = $PDO->fetchAll(PDO::FETCH_ASSOC);

    
                if (!empty($ticket_filter)) {
                  /*
                    |-----------------------------------------------------------------------------
                    |  SMS varification code Function From Classs -> class.user.php
                    |-----------------------------------------------------------------------------
                    */
                        
                    $VerifyCode = $auth_user->VerifyCode();
                    $mobile = $ticket_filter[0]['mobile'];
                    $stmt = $auth_user->runQuery("UPDATE `registration` SET  `mobile_verify_code` = '$VerifyCode' WHERE `mobile` = '$mobile'");
                    $stmt->execute();    
                    require("sms/Sms.php");
                    if ($response->StatusMessage) {
                        echo "<script>alert('Well done! A text message with a verification code was just sent to your mobile number. The code should reach within 10 minutes.'), window.location='verification.php'</script>";
                    } else {
                     echo "Message has been Failed!";
                    }                    
                    die();
                }
                else{
                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile` = '$mobile' AND reg_vip_id = 0 AND receive_mail > 5");
                    $PDO->execute();
                    $mailchecking = $PDO->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($mailchecking)) {
                        echo "<script>alert('You are mail too much exceeded.!'), window.location='find-ticket.php'</script>";
                    }

                    else{
                        echo "<script>alert('Your verification code is invalid!'), window.location='find-ticket.php'</script>";
                    }
                  
                }
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
    
    
        else:
            echo "<script>alert('Robot verification failed, please try again'), window.location='find-ticket.php'</script>";
        endif;
        else:
            echo $errMsg = '.';
            echo "<script>alert('Please click on the reCAPTCHA box'), window.location='find-ticket.php'</script>";
        endif;
        else:
            $errMsg = '';
            $succMsg = '';
        endif;
            ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"  />
        <title>Aarong Festival</title>
        <link rel="icon" href="fav.png" type="image/x-icon" />
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <div class="container">
            <?php require('terms-conditon.php'); ?>                    
            <form method="post">
                <h3>Enter a Verification Code</h3>
                <ul class="terms">
                    <li>Resend Code : Incase you have not received the code</li>
                    <li>Resend Email : Incase you have not received the email at the email address provided</li>
                </ul>
                <a class="btn btn-warning" href="find-mobile.php" role="button">Resend Code</a>
                <a class="btn btn-success" href="resend-email.php" role="button">Resend Email</a>
                <br><br>
                <div class="col-md-12">
                    <label > Enter your phone number </label>
                    <input type="text" class="form-control" name="mobile" id="mobile" autofocus="autofocus" onfocus="this.value = this.value;" required>
                    
                 
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
                    <h4>Helpline : 01616-111888 (10AM - 11:30PM)</h4>
                </div>
            </form>
            <div class="footer-logo">
                <img src="image/footer.png" alt="">
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>