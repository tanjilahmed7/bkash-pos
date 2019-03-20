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
        <link href="css/select2.min.css" rel="stylesheet" />
        <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"  />
        <title>Aarong Festival</title>
    </head>
    <body>
        <?php
            // Require class User 
            require_once("classes/class.user.php");
            $auth_user = new USER();
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
            $district = filter_input(INPUT_POST, "district", FILTER_SANITIZE_STRING);
            $array_profession = $_POST['profession'];
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
            
              $registration_number = $auth_user->RegID('BM');
            
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
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                
                }                
                if (empty($email)) {
                    $errors['email'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Email! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                
                }

            
                if (empty($address)) {
                    $errors['address'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Address Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();
                }
                if ($userRow['user_name'] !== "rezwanul") {
                    if (empty($mobile)) {
                        $errors['mobile'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Mobile Field! </div>";
                        echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                        die();                  
                    }  
                }
              
                if (empty($district)) {
                    $errors['district'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select District Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
                if (empty($array_profession)) {
                    $errors['profession'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Profession Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
            
                if (empty($birth_year)) {
                    $errors['birth_year'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Birth Year Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
            
                if (empty($id_type)) {
                    $errors['id_type'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select ID Type Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
                if (empty($id_number)) {
                    $errors['id_number'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select ID Number Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
                if (empty($gender)) {
                    $errors['gender'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Gender Field! </div>";
                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                    die();                  
                }
            
            
                if (empty($errors)) {
                    // GET User ID
                    $uID = $userRow['user_id'];
                    if ($userRow['user_name'] == "rezwanul"){
                        $year = $birth_year;
                        if (2004 >= $year) {
                            if (1930 <= $year) {
                                try {
                                  
                                    if ($RegID <= 15000) {
                                        $gate = 2;
                                    } elseif ($RegID > 15000 && $RegID <= 30000) {
                                        $gate = 3;
                                    } elseif ($RegID > 30000 && $RegID <= 45000) {
                                        $gate = 2;
                                    }
                                    elseif ($RegID > 45000) {
                                        $gate = 3;
                                    }


                                    $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                              `name`, 
                                                              `reg_id`, 
                                                              `email`, 
                                                              `address`, 
                                                              `mobile`, 
                                                              `district`, 
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
                                                              '$district', 
                                                              '$designation', 
                                                              '$organization', 
                                                              '$birth_year', 
                                                              '$id_type', 
                                                              '$id_number', 
                                                              '$gender', 
                                                              '$gate', 
                                                              'BM',
                                                              '1',
                                                              '$uID' 
                                                              );      
                                                              ");


                                    $PDO->execute();
                                    $last_id = $auth_user->lastInsertedID();
                                    foreach ($array_profession as $profession) {
                                        $PDO = $auth_user->runQuery("INSERT INTO `profession_category` (`reg_table_id`, `profession`, `ticket_type`) VALUES ('$last_id', '$profession', 'BM');");
                                        $PDO->execute();
                                    }                                                    
                                    $ticket_count = 10000+$last_id;
                                    if ($PDO) {
                                        $registration_number = $registration_number;
                                        $reg_id = $registration_number;
                                        $gate = $gate;
                                        $name = $name;
                                       $stmt = $auth_user->runQuery("SELECT ticket_category.name FROM `profession_category` LEFT JOIN ticket_category ON profession_category.profession=ticket_category.id WHERE reg_table_id = '$last_id'");
                                       $stmt->execute();  
                                       $profession_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        require_once 'ticket.php';  
                                    }
                                        require("sms/SMS-Print.php");
                                        die();
                                } //endtry 
                                    catch (PDOException $e) {
                                        echo 'ERROR: ' . $e->getMessage();
                                    }
                            } else {
                                echo "<div class='alert alert-warning'>Your Age is too long!</div>";
                                echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                die();
                            }
                        } else {
                            echo "<div class='alert alert-warning'>Your Age is too short!!</div>";
                            echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                            die();
                        }
                    }
                    else{
                        try {
                            // CHECK MOBILE NUMBER
                            $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile` = '$mobile'");
                
                            $PDO->execute();
                
                            $Uniqueph = $PDO->fetchAll(PDO::FETCH_ASSOC);
                
                            if ($Uniqueph) {
                                echo '<div class="alert alert-danger" role="alert">You are already registration!</div>';
                                echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
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
                                                            $gate = 2;
                                                        } elseif ($RegID > 15000 && $RegID <= 30000) {
                                                            $gate = 3;
                                                        } elseif ($RegID > 30000 && $RegID <= 45000) {
                                                            $gate = 2;
                                                        }
                                                        elseif ($RegID > 45000) {
                                                            $gate = 3;
                                                        }
        
                
                                                        $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                                                  `name`, 
                                                                                  `reg_id`, 
                                                                                  `email`, 
                                                                                  `address`, 
                                                                                  `mobile`, 
                                                                                  `district`, 
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
                                                                                  '$district', 
                                                                                  '$designation', 
                                                                                  '$organization', 
                                                                                  '$birth_year', 
                                                                                  '$id_type', 
                                                                                  '$id_number', 
                                                                                  '$gender', 
                                                                                  '$gate', 
                                                                                  'BM',
                                                                                  '1',
                                                                                  '$uID' 
                                                                                  );      
                                                                                  ");
                
                
                                                        $PDO->execute();
                                                        $last_id = $auth_user->lastInsertedID();
                                                        foreach ($array_profession as $profession) {
                                                            $PDO = $auth_user->runQuery("INSERT INTO `profession_category` (`reg_table_id`, `profession`, `ticket_type`) VALUES ('$last_id', '$profession', 'BM');");
                                                            $PDO->execute();
                                                        }                                                    
                                                        $ticket_count = 10000+$last_id;
                                                        if ($PDO) {
                                                            $registration_number = $registration_number;
                                                            $reg_id = $registration_number;
                                                            $gate = $gate;
                                                            $name = $name;
                                                           $stmt = $auth_user->runQuery("SELECT ticket_category.name FROM `profession_category` LEFT JOIN ticket_category ON profession_category.profession=ticket_category.id WHERE reg_table_id = '$last_id'");
                                                           $stmt->execute();  
                                                           $profession_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            require_once 'ticket.php';  
                                                        }
                                                            require("sms/SMS-Print.php");
                                                            die();
                                                    } //endtry 
                                                        catch (PDOException $e) {
                                                            echo 'ERROR: ' . $e->getMessage();
                                                        }
                                                } else {
                                                    echo "<div class='alert alert-warning'>Your Age is too long!</div>";
                                                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                                    die();
                                                }
                                            } else {
                                                echo "<div class='alert alert-warning'>Your Age is too short!!</div>";
                                                echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                                die();
                                            }
                                        } //preg_match  
                                        else {
                                            echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                                            echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                            die();
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                                        echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                        die();
                                    }
                                } else {
                                    echo "<div class='alert alert-warning'>Your Number is invalid!</div>";
                                    echo '<meta http-equiv="refresh" content="2; URL=booth-mail-ticket.php">';
                                    die();
                                }
                            }
                        } catch (PDOException $e) {
                            echo 'ERROR: ' . $e->getMessage();
                        }                        
                    }

                } //errors
            }
        }
            ?>                 
        <?php require_once('nav.php'); ?>
        <div class="container" style="margin-top:80px;">
            <div class="banner">
                <img src="image/banner.jpg" alt="" />
            </div>
            <?php require('terms-conditon.php'); ?>             
            <div class="main">
                <div class="col-md-10">
                    <h3 class="title">Booth Mail</h3>
                    <form method="post">
                        <div class="col-md-6">
                            <label for="name" >Name * </label>
                            <input type="text" class="form-control" name="name" id="name"  autofocus>
                        </div>

                        <div class="col-md-6">
                            <label for="mobile" > Mobile * </label>  
                            <input type="number" name="mobile" class="form-control" id="mobile" autofocus <?php if ($userRow['user_name'] !== "rezwanul"){echo "required"; } ?>>
                        </div>
                        <div class="col-md-12">
                            <label for="Address" > Address * </label>  
                            <textarea style="overflow: hidden;" class="form-control" rows="5" name="address" id="address" required autofocus>  </textarea> 
                        </div>                    
                        <div class="col-md-6">
                            <label  for="">Profession *</label>
                            <select class="js-example-basic-multiple form-control" name="profession[]" multiple="multiple" required autofocus>
                                <?php
                                    foreach ($professions as $profession) {
                                        ?>
                                <option value="<?php echo $profession['id']; ?>"><?php echo $profession['name']; ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <label for="IDNumber" > ID Number * </label> 
                            <input type="text" name="id_number" class="form-control" id="IDNumber" required autofocus>
                        </div>   
                        <div class="col-md-6">
                            <label for="birth_year" >  Birth Year * </label> 
                            <input type="number" name="birth_year" class="form-control" id="birth_year" required autofocus>
                        </div> 
                        <div class="col-md-6">
                            <label class="selectlabel" for="gendar">Gender: *</label>
                            <select class="form-control" id="gendar" name="gender" required autofocus>
                                <option selected value="">Choose here</option>
                                <?php
                                    foreach ($gendars as $gendar) {
                                        ?>
                                <option value="<?php echo $gendar['id']; ?>"><?php echo $gendar['name']; ?></option>
                                <?php
                                    }
                                    ?>
                            </select>
                        </div> 
                        <div class="col-md-6">
                            <label>District * </label>
                            <div class="form-group">
                                <select class="form-control input-form-custom" name="district" required>
                                    <option selected value="">Choose here</option>
                                    <option value="Bandarban">Bandarban</option>
                                    <option value="Barguna">Barguna</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Bhola">Bhola</option>
                                    <option value="Bogra">Bogra</option>
                                    <option value="Brahmanbaria">Brahmanbaria</option>
                                    <option value="Chandpur">Chandpur</option>
                                    <option value="Chapainawabganj">Chapainawabganj</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Chuadanga">Chuadanga</option>
                                    <option value="Comilla">Comilla</option>
                                    <option value="Cox's Bazar">Cox's Bazar</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Faridpur">Faridpur</option>
                                    <option value="Feni">Feni</option>
                                    <option value="Gaibandha">Gaibandha</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Gopalganj">Gopalganj</option>
                                    <option value="Habiganj">Habiganj</option>
                                    <option value="Jamalpur">Jamalpur</option>
                                    <option value="Jessore">Jessore</option>
                                    <option value="Jhalokati">Jhalokati</option>
                                    <option value="Jhenaidah">Jhenaidah</option>
                                    <option value="Joypurhat">Joypurhat</option>
                                    <option value="Khagrachhari">Khagrachhari</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Kishoreganj">Kishoreganj</option>
                                    <option value="Kurigram">Kurigram</option>
                                    <option value="Kushtia">Kushtia</option>
                                    <option value="Lakshmipur">Lakshmipur</option>
                                    <option value="Lalmonirhat">Lalmonirhat</option>
                                    <option value="Madaripur">Madaripur</option>
                                    <option value="Magura">Magura</option>
                                    <option value="Manikganj">Manikganj</option>
                                    <option value="Meherpur">Meherpur</option>
                                    <option value="Moulvibazar">Moulvibazar</option>
                                    <option value="Munshiganj">Munshiganj</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Naogaon">Naogaon</option>
                                    <option value="Narail">Narail</option>
                                    <option value="Narayanganj">Narayanganj</option>
                                    <option value="Narsingdi">Narsingdi</option>
                                    <option value="Natore">Natore</option>
                                    <option value="Netrakona">Netrakona</option>
                                    <option value="Nilphamari">Nilphamari</option>
                                    <option value="Noakhali">Noakhali</option>
                                    <option value="Pabna">Pabna</option>
                                    <option value="Panchagarh">Panchagarh</option>
                                    <option value="Patuakhali">Patuakhali</option>
                                    <option value="Pirojpur">Pirojpur</option>
                                    <option value="Rajbari">Rajbari</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangamati">Rangamati</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Satkhira">Satkhira</option>
                                    <option value="Shariatpur">Shariatpur</option>
                                    <option value="Sherpur">Sherpur</option>
                                    <option value="Sirajgonj">Sirajgonj</option>
                                    <option value="Sunamganj">Sunamganj</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Tangail">Tangail</option>
                                    <option value="Thakurgaon">Thakurgaon</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>                                                                                                                   
                        <div class="col-md-6">
                            <label for="Email" > Email  </label> 
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="col-md-6">
                            <label for="Designation" >  Designation </label>   
                            <input type="text" name="designation" class="form-control" id="designation" tabindex="1">
                        </div>
                        <div class="col-md-6">
                            <label for="Organization" > Organization </label>  
                            <input type="text" name="organization" class="form-control" id="organization" tabindex="2">
                        </div>

                        <div class="checkbox pull-right">
                            <button type="submit" name="save" value="Save" class="btn btn-primary btn-lg">Submit</button> <br><br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2({
                    placeholder: "Choose here",
                    allowClear: true
                });
            }); 
        </script>
        <script src="js/select2.min.js"></script>
    </body>
</html>