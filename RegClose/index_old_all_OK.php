<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" href="image/fav.png" type="image/png" sizes="16x16">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css"  />
  <title>Aarong Festival</title>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="css/set1.css">
</head>
<body>
        <?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
        // Require class User 
        require_once("classes/class.user.php");
        $auth_user = new USER();


    /*
      |----------------------------------------------------------------------------------------------------
      | Ticket Type Shows
      |----------------------------------------------------------------------------------------------------
     */
    /*
      |--------------------------------------------------------------------------
      | Type ID 1 == Profession
      |--------------------------------------------------------------------------
     */
      try {

        // Query  
        $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 1');
        $stmt->execute();

        // Fetch array associative
        $professions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    /*
      |--------------------------------------------------------------------------
      | Type ID 2 == Gendar
      |--------------------------------------------------------------------------
     */

      try {

        // Query  
        $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 2');
        $stmt->execute();

        // Fetch array associative
        $gendars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    /*
      |--------------------------------------------------------------------------
      | Type ID 3 == ID Type
      |--------------------------------------------------------------------------
     */


      try {

        // Query  
        $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 3');
        $stmt->execute();

        // Fetch array associative
        $IDTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    /*
      |----------------------------------------------------------------------------------------------------
      | Reg ID Count
      |----------------------------------------------------------------------------------------------------
     */

      try {
        $PDO = $auth_user->runQuery("SELECT * FROM `registration`");

        $PDO->execute();
        $reg = $PDO->fetchAll(PDO::FETCH_ASSOC);

        $RegID = count($reg);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
/*
|-----------------------------------------------------------------------------
|  Total Ticket
|-----------------------------------------------------------------------------
*/

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
            ?>

        <?php
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
        $mobile = filter_input(INPUT_POST, "mobile", FILTER_SANITIZE_STRING);
        $profession = filter_input(INPUT_POST, "profession", FILTER_SANITIZE_STRING);
        $designation = filter_input(INPUT_POST, "designation", FILTER_SANITIZE_STRING);
        $organization = filter_input(INPUT_POST, "organization", FILTER_SANITIZE_STRING);
        $birth_year = filter_input(INPUT_POST, "birth_year", FILTER_SANITIZE_STRING);
        $id_type = filter_input(INPUT_POST, "id_type", FILTER_SANITIZE_STRING);
        $id_number = filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_STRING);
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_STRING);
        $artist_name = filter_input(INPUT_POST, "artist_name", FILTER_SANITIZE_STRING);
        $tc = filter_input(INPUT_POST, "tc", FILTER_SANITIZE_STRING);


        /*
        |-----------------------------------------------------------------------------
        |  Random unique ID Function From Classs -> class.user.php
        |-----------------------------------------------------------------------------
        */

        $registration_number = $auth_user->RegID('GW');

        /*
        |-----------------------------------------------------------------------------
        |  SMS varification code Function From Classs -> class.user.php
        |-----------------------------------------------------------------------------
        */

        $VerifyCode = $auth_user->VerifyCode();



        /*
        |-----------------------------------------------------------------------------
        |  Empty Value Check
        |-----------------------------------------------------------------------------
        */

        $errors = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (empty($name)) {
                $errors['name'] = true;
                echo $msg = "<div class='alert alert-warning fade in'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please insert Name! </div>";
            }

            if (empty($email)) {
                $errors['email'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please insert Email! </div>";
            }

            if (empty($address)) {
                $errors['address'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please insert Address! </div>";
            }

            if (empty($mobile)) {
                $errors['mobile'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please insert Mobile! </div>";
            }

            if (empty($profession)) {
                $errors['profession'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Profession! </div>";
            }


            if (empty($birth_year)) {
                $errors['birth_year'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Insert Birth Year! </div>";
            }


            if (empty($id_type)) {
                $errors['id_type'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select ID Type! </div>";
            }

            if (empty($id_number)) {
                $errors['id_number'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please insert ID Number! </div>";
            }

            if (empty($gender)) {
                $errors['gender'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Gender! </div>";
            }

            if (empty($tc)) {
                $errors['tc'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please agree to the terms and conditions to proceed </div>";
            }

            if (empty($errors)) {
                try {
                    // CHECK MOBILE NUMBER
                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile` = '$mobile'");

                    $PDO->execute();

                    $Uniqueph = $PDO->fetchAll(PDO::FETCH_ASSOC);

                    if ($Uniqueph) {
                        echo "<script>alert('Same Mobile number registration: You are already registered!.'), window.location='index.php'</script>";
                    }   

                    
                    else{
                        
                            // You must first words 01
                            $digit = "01";
                            $number = $mobile;
                            $check = substr($number, 0, 2);

                            if ($digit == $check) {
                                if (strlen($number) == 11) {
                                    if (preg_match('/^[0-9]*$/', $number)) {
                                        $year = $birth_year;
                                        if (2004 >= $year) {
                                            if (1930 <= $year) {
                                                try {

                                                    if ($RegID <= 15000) {
                                                        $gate = 14;
                                                    } elseif ($RegID > 15000 && $RegID <= 30000) {
                                                        $gate = 15;
                                                    } elseif ($RegID > 30000) {
                                                        $gate = 16;
                                                    }

                                                    $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                                                `name`, 
                                                                                `reg_id`, 
                                                                                `mobile_verify_code`, 
                                                                                `email`, 
                                                                                `address`, 
                                                                                `mobile`,
                                                                                `profession`, 
                                                                                `designation`, 
                                                                                `organization`, 
                                                                                `birth_year`, 
                                                                                `id_type`, 
                                                                                `id_number`, 
                                                                                `gender`, 
                                                                                `gate`, 
                                                                                `tc` 

                                                                                ) 
                                                                                VALUES (

                                                                                '$name', 
                                                                                '$registration_number', 
                                                                                '$VerifyCode', 
                                                                                '$email', 
                                                                                '$address', 
                                                                                '$mobile', 
                                                                                '$profession', 
                                                                                '$designation', 
                                                                                '$organization', 
                                                                                '$birth_year', 
                                                                                '$id_type', 
                                                                                '$id_number', 
                                                                                '$gender', 
                                                                                '$gate',  
                                                                                '1' 
                                                                                );      
                                                                                ");


                                                    $PDO->execute();
                                                    if ($PDO) {

                                                        /*
                                                          |-----------------------------------------------------------------------------
                                                          | Mobile SMS
                                                          |-----------------------------------------------------------------------------
                                                         */

                                                        require("sms/Sms.php");
                                                        if ($response->StatusMessage) {
                                                           //echo "<div class='alert alert-success'><strong>Well done!</strong> A text message with a verification code was just sent to your mobile number. </div>";
                                                           //echo '<meta http-equiv="refresh" content="2; URL=find-ticket.php">';
                                                            echo "<script>alert('Well done! A text message with a verification code was just sent to your mobile number. The code should reach within 10 minutes.'), window.location='find-ticket.php'</script>";
                                                        } else {
                                                         echo "Message has been Failed!";
                                                        }

                                                    }
                                                } //endtry 
                                                catch (PDOException $e) {
                                                    echo 'ERROR: ' . $e->getMessage();
                                                }
                                            } else {
                                                // echo "<div class='alert alert-warning'>Your age doesn’t fall within the acceptable range.* 1930 </div>";
                                                // echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                                echo "<script>alert('Your age doesn’t fall within the acceptable range..'), window.location='index.php'</script>";
                                            }
                                        } else {
                                            // echo "<div class='alert alert-warning'>Your age doesn’t fall within the acceptable range.* 1930</div>";
                                            // echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                            echo "<script>alert('Your age doesn’t fall within the acceptable range.'), window.location='index.php'</script>";
                                        }
                                    } //preg_match  
                                    else {
                                        // echo "<div class='alert alert-warning'>Your mobile number is invalid!</div>";
                                        echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                        echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                                    }
                                } else {
                                    // echo "<div class='alert alert-warning'>Your mobile number is invalid!</div>";
                                    // echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                    echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                                }
                            } else {
                                // echo "<div class='alert alert-warning'>Your mobile number is invalid!</div>";
                                // echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                            }
                        }




                    }
                    catch (PDOException $e) {
                            echo 'ERROR: ' . $e->getMessage();
                        }
                    } //errors
                }
                ?>


                <?php
                else:
                    echo "<div class='alert alert-warning'>Robot verification failed, please try again.</div>";
                    echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                endif;
                else:
                    echo $errMsg = '.';
                    echo "<div class='alert alert-warning'>Please click on the reCAPTCHA box</div>";
                    echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                endif;
                else:
                    $errMsg = '';
                    $succMsg = '';
                endif;
                ?>
                

            <div class="col-md-6 left side">
                <img src="image/Main-form-logo.png" alt="">
            </div>    
            <div class="col-md-6 reg-form">
                <?php require('terms-conditon.php'); ?>              

                <h3 class="title col-md-4">Registration Form</h3>
                <div class="col-md-4"><a class="btn btn-info ticket-terms" href="find-ticket.php" title=""> Ticket Assistance! </a></div>
                <div class="col-md-4"><a class="btn btn-default ticket-terms" href="https://aarongfestival.com/faq/" title=""> FAQ </a></div>
                

              <div class="col-md-10">

                <form method="post">
                    <div class="col-md-12">
                        <span class="input input--hoshi">
                          <input type="text" class="input__field input__field--hoshi" name="name" id="name" required>
                         <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name" >
                            <span class="input__label-content input__label-content--hoshi">Name * </span>
                          </label>
                        </span>
                    </div>    

                    <div class="col-md-12">
                        <span class="input input--hoshi">
                            <input type="text" class="input__field input__field--hoshi" name="address" id="address" required>  
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Address" >
                                <span class="input__label-content input__label-content--hoshi">Address * </span>
                              </label>                      
                        </span>
                    </div>


                    <div class="col-md-12">
                         <span class="input input--hoshi">
                           <input type="text" class="input__field input__field--hoshi" name="email" id="email" required>
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Email" >
                                <span class="input__label-content input__label-content--hoshi">Email * </span>
                            </label>                   
                        </span>
                
                    </div>    

  
                    <div class="col-md-6">
                        <span class="input input--hoshi">
                          <input type="number" name="mobile" class="input__field input__field--hoshi" id="mobile">
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="mobile" >
                                <span class="input__label-content input__label-content--hoshi">Mobile * </span>
                            </label>                   
                        </span>
                      
                    </div>

                    <div class="col-md-6">
                        <span class="input input--hoshi select form-group-sm">
                          <label class="selectlabel" for="">Profession * </label>
                        
                          <select class="form-control" id="profession" name="profession" required>
                              <option selected value="">Choose here</option>

                              <?php
                              foreach ($professions as $profession) {
                                  ?>
                                  <option value="<?php echo $profession['id']; ?>"><?php echo $profession['name']; ?></option>
                                  <?php
                              }
                              ?>
                          </select>
                        </span>  
                    </div>

                <div class="col-md-6">
                    <span class="input input--hoshi">
                      <input type="text" name="designation" class="input__field input__field--hoshi" id="designation" >
                         <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Designation" >
                            <span class="input__label-content input__label-content--hoshi">Designation</span>
                        </label>                  

                    </span> 
                </div>

                <div class="col-md-6">
                    <span class="input input--hoshi">
                      <input type="text" name="organization" class="input__field input__field--hoshi" id="organization">
                         <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Organization" >
                            <span class="input__label-content input__label-content--hoshi">Organization</span>
                        </label>                   
                    </span>
                </div>    

                <div class="col-md-6">
                    <span class="input input--hoshi">
                        <input type="number" name="birth_year" class="input__field input__field--hoshi" id="birth_year" required>
                        <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="birth_year" >
                            <span class="input__label-content input__label-content--hoshi">Birth Year * </span>
                        </label>   
                    </span>
                </div>





                <div class="col-md-6">
                    <span class="input input--hoshi select form-group-sm">
                      <label class="selectlabel" for="gendar">Gender: * </label>
                      <select class="form-control" id="gendar" name="gender" required>
                          <option selected value="">Choose here</option>
                          <?php
                          foreach ($gendars as $gendar) {
                              ?>
                              <option value="<?php echo $gendar['id']; ?>"><?php echo $gendar['name']; ?></option>
                              <?php
                          }
                          ?>

                      </select>
                    </span>  
                </div>    
     

                <div class="col-md-6">
                   <span class="input input--hoshi select form-group-sm">
                      <label class="selectlabel" for="idtype">ID Type: * </label>
                      <select class="form-control" id="id_type" name="id_type" required>
                          <option selected value="">Choose here</option>

                          <?php
                          foreach ($IDTypes as $IdTypes) {
                              ?>
                              <option value="<?php echo $IdTypes['id']; ?>"><?php echo $IdTypes['name']; ?></option>
                              <?php
                          }
                          ?>

                      </select>
                  </span>
                </div>  

                <div class="col-md-6">
                    <span class="input input--hoshi">
                        <input type="text" name="id_number" class="input__field input__field--hoshi" id="IDNumber" required>
                        <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="IDNumber" >
                            <span class="input__label-content input__label-content--hoshi">ID Number * </span>
                        </label>   
                    </span>
                </div>

                <div class="col-md-12">   
                      <div class="form-group form-group-sm ">
                          <div class="g-recaptcha" data-sitekey="6Lc1ZwkUAAAAANdYL2hraKnEPHNId-OQPgd-5Vg1"></div>
                          <!-- local -->
                      </div>
                </div>


              <div class="checkbox col-md-12">
                  <label>
                      <input type="checkbox" id="inputTermsConditions" name="tc" required> I have read and I agree to the <a href="" data-toggle="modal" data-target="#myModal" style="color:green; text-decoration:none;">Aarong Festival Ticketing Terms and Condition * </a>.
                  </label>
                  <br><br><br>
              </div>
              <div class="col-md-4">
                <button type="submit" name="save" value="Save" class="btn btn-primary">Submit</button>
             </div>
              
              <div class="helpline col-md-8">
                <h4>Helpline : 01616-111888 (10AM - 11:30PM)</h4>
            </div>

          </form>
            <div class="footer-logo">
                <img src="image/footer.png" alt="">

            </div>
              </div>
      </div>
  </div>  
  




<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="js/scripts.js"></script>
<script src="js/classie.js"></script>
<script>
  (function() {
    // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
    if (!String.prototype.trim) {
      (function() {
        // Make sure we trim BOM and NBSP
        var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
        String.prototype.trim = function() {
          return this.replace(rtrim, '');
        };
      })();
    }

    [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
      // in case the input is already filled..
      if( inputEl.value.trim() !== '' ) {
        classie.add( inputEl.parentNode, 'input--filled' );
      }

      // events:
      inputEl.addEventListener( 'focus', onInputFocus );
      inputEl.addEventListener( 'blur', onInputBlur );
    } );

    function onInputFocus( ev ) {
      classie.add( ev.target.parentNode, 'input--filled' );
    }

    function onInputBlur( ev ) {
      if( ev.target.value.trim() === '' ) {
        classie.remove( ev.target.parentNode, 'input--filled' );
      }
    }
  })();

  
</script>
</body>
</html>