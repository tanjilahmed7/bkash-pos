<?php
session_start();
$date = date('Y-m-d');
if (date('Y-m-d')<"2017-12-18") {
    header("Location: http://aarongfestival.com/", true, 301); 
}
    // Require class User 
    require_once("classes/class.user.php");
    $auth_user = new USER();
    


    
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
    $PDO = $auth_user->runQuery("SELECT COUNT(reg_vip_id) FROM `registration` WHERE reg_vip_id=0");
    
    $PDO->execute();
    $RegID = $PDO->fetchColumn();
    
    } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    }

    // die();
    
    /*
    |-------------------------------------------------------------------------------------------------------------
    | Isset check Save
    |-------------------------------------------------------------------------------------------------------------
    */
    
    
    if (isset($_POST['save']) && !empty($_POST['save'])){
        if (empty($_POST['registration_form_token']) OR $_POST['registration_form_token'] != $_SESSION['registration_form_token']) {

        #----------------------------------------------------------------------------------------------------------
        #   ERROR : From is not submitted correctly !!!!!!!!!!!
        #----------------------------------------------------------------------------------------------------------

        echo "<script>alert('Invalid form submission'), window.location='https://aarongfestival.com'</script>";
        } else {



            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $mobile = filter_input(INPUT_POST, "mobile", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $birth_year = filter_input(INPUT_POST, "birth_year", FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_STRING);
            $id_type = filter_input(INPUT_POST, "id_type", FILTER_SANITIZE_STRING);
            $id_number = filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_STRING);
            $tc = filter_input(INPUT_POST, "tc", FILTER_SANITIZE_STRING);
            $isForeign  = filter_input(INPUT_POST, "isForeign", FILTER_SANITIZE_STRING);
            
            
            
            /*
            |-----------------------------------------------------------------------------
            |  Random unique ID Function From Classs -> class.user.php
            |-----------------------------------------------------------------------------
            */
            
            $registration_number = $auth_user->RegID('GW');
            
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
            
                if (empty($mobile)) {
                    $errors['mobile'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please insert Mobile! </div>";
                }
            
                if (empty($email)) {
                    $errors['email'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please insert Email! </div>";
                }
            
            
                if (empty($birth_year)) {
                    $errors['birth_year'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Insert Birth Year! </div>";
                }
            
                if (empty($gender)) {
                    $errors['gender'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Gender! </div>";
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
            
                if (empty($isForeign)) {
                    $errors['id_number'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select your nationality! </div>";
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
            
                        if (!empty($Uniqueph)) {
                            echo "<script>alert('Same Mobile number registration: You are already registered!.'), window.location='index.php'</script>";
                        } else {
                            
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

                                                    print_r($_POST);
                                                    die();
                                                    
                                                    try {
                                                    
                                                        if ($isForeign == "Yes") {
                                                            if ($RegID <= 15000) {
                                                                $gate = 1;
                                                            } elseif ($RegID > 15000 && $RegID <= 30000) {
                                                                $gate = 2;
                                                            } elseif ($RegID > 30000 && $RegID <= 45000) {
                                                                $gate = 1;
                                                            }
                                                        }else{
                                                            if ($RegID <= 15000) {
                                                                $gate = 13;
                                                            } elseif ($RegID > 15000 && $RegID <= 30000) {
                                                                $gate = 14;
                                                            } elseif ($RegID > 30000 && $RegID <= 45000) {
                                                                $gate = 15;
                                                            } 

                                                         
                                                        }


            
                                                        $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                                                    `name`, 
                                                                                    `reg_id`, 
                                                                                    `email`, 
                                                                                    `mobile`, 
                                                                                    `birth_year`, 
                                                                                    `id_type`, 
                                                                                    `id_number`, 
                                                                                    `gender`, 
                                                                                    `gate`, 
                                                                                    `vip_type`, 
                                                                                    `isForeign`, 
                                                                                    `tc` 
            
                                                                                    ) 
                                                                                    VALUES (
                                                                                    '$name', 
                                                                                    '$registration_number', 
                                                                                    '$email', 
                                                                                    '$mobile', 
                                                                                    '$birth_year', 
                                                                                    '$id_type', 
                                                                                    '$id_number', 
                                                                                    '$gender',
                                                                                    '$gate',
                                                                                    'GW',
                                                                                    '$isForeign',
                                                                                    '1' 
                                                                                    );
                                                                                    ");
            
                                                        if ($PDO->execute()) {
                                                            $last_id = $auth_user->lastInsertedID();
                                                            $reg_id = $registration_number;
                                                            $ticket_count = $last_id+10000;
                                                            
                                                            require_once 'ticket.php';


            
                                                        }
                                                    } //endtry 
                                                    catch (PDOException $e) {
                                                        echo 'ERROR: ' . $e->getMessage();
                                                    }
                                                } else {
                                                    echo "<script>alert('Your age doesn’t fall within the acceptable range..'), window.location='index.php'</script>";
                                                }
                                            } else {
                                                echo "<script>alert('Your age doesn’t fall within the acceptable range.'), window.location='index.php'</script>";
                                            }
                                        } //preg_match  
                                        else {
                                            echo '<meta http-equiv="refresh" content="2; URL=index.php">';
                                            echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                                        }
                                    } else {
                                        echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                                    }
                                } else {
                                    echo "<script>alert('Your mobile number is invalid!'), window.location='index.php'</script>";
                                }
                            }
            
            
            
            
                        }
                        catch (PDOException $e) {
                                echo 'ERROR: ' . $e->getMessage();
                            }
                        } //errors
                    }

            }
        }

            
    ?>

    <?php include "reg-header.php"; ?>

    <?php include "top-logo.php"; ?>

    <?php include "about-the-festival.php"; ?>

    <?php include "terms-conditon.php"; ?> 

    <?php include "index-form-page64656.php"; ?>

 
    <?php include "reg-footer.php"; ?>