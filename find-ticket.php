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
                $VarifyCode = $_POST['varify'];
                $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile_verify_code` = '$VarifyCode' AND reg_vip_id = 0 AND receive_mail = 0");
                $PDO->execute();
                $ticket_filter = $PDO->fetchAll(PDO::FETCH_ASSOC);
    
                if (!empty($ticket_filter)) {
    
                    $id = $ticket_filter[0]['id'];
                    $name = $ticket_filter[0]['name'];
                    $gate = $ticket_filter[0]['gate'];
                    $reg_id = $ticket_filter[0]['reg_id'];
                    $mobile = $ticket_filter[0]['mobile'];
                    $email = $ticket_filter[0]['email'];
                    $ticket_count = $id+10000;
                    require_once 'ticket.php';
                }
                else{
                  echo "<script>alert('Your verification code is invalid!'), window.location='find-ticket.php'</script>";
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
            <?php require('reg-header.php'); ?>
            <div class="main">           
                <form method="post">
                    <h3>Enter a Verification Code</h3>
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
                        <label for="varify">Enter a verification code </label>
                        <input type="text" class="form-control col-md-12" name="varify" id="varify" autofocus="autofocus" onfocus="this.value = this.value;" required>
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
    </body>
</html>