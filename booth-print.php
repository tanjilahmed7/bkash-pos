<?php
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();
$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

$Role = ($userRow['user_role']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
  <link rel="stylesheet" href="style.css" type="text/css"  />
  <title>Aarong Festival</title>
  <link rel="stylesheet" href="css/set1.css">
</head>
<body>
<?php
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
      |-------------------------------------------------------------------------------------------------------------
      | Isset check Save
      |-------------------------------------------------------------------------------------------------------------
     */


    if (isset($_POST['save']) && !empty($_POST['save'])) {
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

          $registration_number = $auth_user->RegID('BA');

        /*
          |-----------------------------------------------------------------------------
          |  SMS varification code Function From Classs -> class.user.php
          |-----------------------------------------------------------------------------
         */

          // $VerifyCode = $auth_user->VerifyCode();

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
                Please Select Name Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                
            }

            if (empty($email)) {
                $errors['email'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Email Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                
            }

            if (empty($address)) {
                $errors['address'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Address Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();
            }

            if (empty($mobile)) {
                $errors['mobile'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Mobile Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }

            if (empty($profession)) {
                $errors['profession'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Profession Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }


            if (empty($birth_year)) {
                $errors['birth_year'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Birth Year Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }


            if (empty($id_type)) {
                $errors['id_type'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select ID Type Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }

            if (empty($id_number)) {
                $errors['id_number'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select ID Number Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }

            if (empty($gender)) {
                $errors['gender'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Gender Field! </div>";
                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                die();                  
            }


            if (empty($errors)) {
                try {
                    // CHECK MOBILE NUMBER
                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile` = '$mobile'");

                    $PDO->execute();

                    $Uniqueph = $PDO->fetchAll(PDO::FETCH_ASSOC);

                    if ($Uniqueph) {
                        echo '<div class="alert alert-danger" role="alert">You are already registration!</div>';
                        echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                        die();
                    } else {

                        // You must first words 01
                        $digit = "01";
                        $number = $mobile;
                        $check = substr($number, 0, 2);
                        // GET User ID
                        $uID = $userRow['user_id'];

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
                                                } elseif ($RegID > 30000 && $RegID <= 45000) {
                                                    $gate = 16;
                                                } else{
                                                    $gate = 14;
                                                }

                                                $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                                          `name`, 
                                                                          `reg_id`, 
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
                                                                          `vip_type`,
                                                                          `print_receive`,
                                                                          `created_by` 

                                                                          ) 
                                                                          VALUES (

                                                                          '$name', 
                                                                          '$registration_number', 
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
                                                                          'BA',
                                                                          '1',
                                                                          '$uID' 
                                                                          );      
                                                                          ");


                                                $PDO->execute();
                                                $last_id = $auth_user->lastInsertedID();
                                                $ticket_count = 10000+$last_id;
                                                if ($PDO) {
                                                    $registration_number = $registration_number;
                                                    $reg_id = $registration_number;
                                                    $gate = $gate;
                                                    $name = $name;
                                                    $profession = $profession;
                                                ?>
                                                <table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px">
                                                    <tr style="padding-bottom:0;margin-bottom:0">
                                                        <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;font-family: sans-serif;" colspan="2">
                                                            <img src="<?php echo 'barcode/barcode.php?registration_number=' . $registration_number; ?>" width="299" height="55" alt="Barcode"/>
                                                        </td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                    <tr style="padding-top:0;margin-top:0">
                                                        <td align="left" valign="top" style="padding-left:25px;padding-top:0;margin-top:0" colspan="2">
                                                            <span style="font-size:10px;font-weight: bold;letter-spacing: 17px;font-family: calibri;">
                                                                <?php echo $registration_number; ?>
                                                            </span>
                                                        </td>              
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 10px;">
                                                            <div style="padding: 3px 3px 3px 3px;width:140px;border: 1px solid;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius:5px; text-align:center; font-size:20px;">
                                                                <strong>ENTRY PASS</strong>
                                                            </div>

                                                            <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 2px;font-size: 14px;">
                                                            <b><?php echo $name; ?></b>

                                                            </div>   

                                                            <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 1px;font-size: 8px;">
                                                                <?php
                                                                /*
                                                                  |------------------------------------------------------------------------------------------------------
                                                                  | GET PROFESSIONAL NAME
                                                                  |------------------------------------------------------------------------------------------------------
                                                                 */
                                                                try {

                                                                    $PDO = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE id = $profession");

                                                                    $PDO->execute();

                                                                    $professional_name = $PDO->fetchAll(PDO::FETCH_ASSOC);

                                                                    echo $professional_name[0]['name'];
                                                                } catch (PDOException $e) {
                                                                    echo 'ERROR: ' . $e->getMessage();
                                                                }
                                                                
                                                                ?> 
                                                            </div>
                                             

                                                        </td>

                                                        <td align="center" valign="middle" style="padding-right: 10px;padding-top: 5px;float: right;">
                                                            <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>

                                                            <div style="padding-top: 0;padding-left: 10px;">
                                                                <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                                                                <?php echo $gate; ?>
                                                                </div> 
                                                                <div class="sl">
                                                                  <?php echo $ticket_count; ?>
                                                                </div>                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="top" style="font-size: 9px; padding-right: 0px; text-align:center;padding-top:0px">* Please bring this ticket with you to the venue</td>
                                                    </tr>            
                                                </table>    
                                                <style type="text/css">
                                                    @media print {
                                                      table.booth_ticket{
                                                      page-break-before: always;
                                                      padding-left: 20px;
                                                      padding-right: 20px;
                                                      margin: 0;
                                                      }
                                                    }
                                                </style>                                                                                               
                                                <?php  
                                                }
                                                require("sms/SMS-Print.php");
                                                die();
                                            } //endtry 
                                            catch (PDOException $e) {
                                                echo 'ERROR: ' . $e->getMessage();
                                            }
                                        } else {
                                            echo "<div class='alert alert-warning'>Your Age is too long!</div>";
                                            echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                                            die();
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning'>Your Age is too short!!</div>";
                                        echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                                        die();
                                    }
                                } //preg_match  
                                else {
                                    echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                                    echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                                    die();
                                }
                            } else {
                                echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                                echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                                die();
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                            echo '<meta http-equiv="refresh" content="2; URL=booth-print.php">';
                            die();
                        }
                    }
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
            } //errors
        }
    }
    ?>                 
<?php require_once('nav.php'); ?>
     
              <div class="container" style="margin-top:80px;">
                <div class="col-md-10">
                <h3 class="title">Print Registration Form</h3>
                <form method="post">
                    <div class="col-md-12">
                        <span class="input input--hoshi">
                          <input type="text" class="input__field input__field--hoshi" name="name" id="name" required>
                         <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="name" >
                            <span class="input__label-content input__label-content--hoshi">Name *</span>
                          </label>
                        </span>
                    </div>    

                    <div class="col-md-12">
                        <span class="input input--hoshi">
                            <input type="text" class="input__field input__field--hoshi" name="address" id="address" required>  
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Address" >
                                <span class="input__label-content input__label-content--hoshi">Address *</span>
                              </label>                      
                        </span>
                    </div>


                    <div class="col-md-12">
                         <span class="input input--hoshi">
                           <input type="text" class="input__field input__field--hoshi" name="email" id="email" required>
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="Email" >
                                <span class="input__label-content input__label-content--hoshi">Email *</span>
                            </label>                   
                        </span>
                
                    </div>    

  
                    <div class="col-md-6">
                        <span class="input input--hoshi">
                          <input type="number" name="mobile" class="input__field input__field--hoshi" id="mobile">
                             <label class="input__label input__label--hoshi input__label--hoshi-color-3" for="mobile" >
                                <span class="input__label-content input__label-content--hoshi">Mobile *</span>
                            </label>                   
                        </span>
                      
                    </div>

                <div class="col-md-6">
                    <span class="input input--hoshi select form-group-sm">
                      <label class="selectlabel" for="">Profession *</label>
                    
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
                            <span class="input__label-content input__label-content--hoshi">Birth Year *</span>
                        </label>   
                    </span>
                </div>




                <div class="col-md-6">
                    <span class="input input--hoshi select form-group-sm">
                      <label class="selectlabel" for="gendar">Gender: *</label>
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

 


              <div class="checkbox pull-right">
                  <button type="submit" name="save" value="Save" class="btn btn-primary">Submit</button> <br><br><br>
              </div>

          </form>

              </div>
          <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
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