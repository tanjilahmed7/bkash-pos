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
              $phone = $_POST['phone'];
              $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE receive_mail = 0 AND mobile = '$phone'");
              $PDO->execute();
              $VSend = $PDO->fetchAll(PDO::FETCH_ASSOC);

              if ($VSend) {
                $mobile = $VSend[0]['mobile'];
                $code = $VSend[0]['mobile_verify_code'];
                require("sms/resend-verification-code.php");
              }
          }catch (PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
          }

      /*
        |---------------------------------------------------------------------------------------------
        | Already Verification code
        |---------------------------------------------------------------------------------------------
       */

          try {
              $phone = $_POST['phone'];
              $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE receive_mail = 1 AND mobile = '$phone'");
              $PDO->execute();
              $ReTicketSend = $PDO->fetchAll(PDO::FETCH_ASSOC);
               if ($ReTicketSend) {
                  echo "<script>alert('Sorry! You have a already ticket taken.'), window.location='resend-verification-code.php'</script>";
               }else{
                echo "<script>alert('Sorry! Invalid your Phone Number. Please try again.'), window.location='resend-verification-code.php'</script>";
               }

            }catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            else:
                echo "<script>alert('Robot verification failed, please try again.'), window.location='resend-verification-code.php'</script>"; 
            endif;
            else:
                echo $errMsg = '.';
                echo "<script>alert('Please click on the reCAPTCHA box'), window.location='resend-verification-code.php'</script>"; 
            endif;
            else:
                $errMsg = '';
                $succMsg = '';
            endif;
?>
    <?php require('reg-header.php'); ?>              
        <div class="main">
            <form method="post">
                <h3>Resend Verification</h3>
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
                    <label for="phone">Phone Number</label>
                    <input type="number" class="form-control" name="phone" id="phone" autofocus="autofocus" onfocus="this.value = this.value;" required>
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