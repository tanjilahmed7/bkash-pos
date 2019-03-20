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
            $Role = ($userRow['user_role']);
            
            
            /*
            |-------------------------------------------------------------------------------------------------------------------
            | Show All PROFESSTION
            |-------------------------------------------------------------------------------------------------------------------
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
            |-------------------------------------------------------------------------------------------------------------------
            | Show All GENDER
            |-------------------------------------------------------------------------------------------------------------------
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
            |-------------------------------------------------------------------------------------------------------------------
            | Show All ID TYPE
            |-------------------------------------------------------------------------------------------------------------------
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
            |-------------------------------------------------------------------------------------------------------------------
            | Show All VIP Type
            |-------------------------------------------------------------------------------------------------------------------
            */
            
            try {
            
            // Query    
                $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 5');
                $stmt->execute();
            
            // Fetch array associative
                $VIPTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            |----------------------------------------------------------------------------------------------------------------------------
            | BKCOUNT Functions
            |----------------------------------------------------------------------------------------------------------------------------
            */
            
            function BKCOUNT() {
            
                try {
                    $auth_user = new USER();
                    // Query    
                    $stmt = $auth_user->runQuery("SELECT COUNT(*) AS TOTALBKCOUNT FROM `registration` WHERE `reg_vip_id` = 2");
                    $stmt->execute();
            
                // Fetch array associative
                    $BKCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
                return ($BKCount[0]['TOTALBKCOUNT']);
            
            }
            
            // End Brackets 
            
            
            /*
              |-------------------------------------------------------------------------------------------------------------
              | Isset check Save
              |-------------------------------------------------------------------------------------------------------------
             */
            
            if (isset($_POST['save'])) {
            
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
                $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
                $mobile = filter_input(INPUT_POST, "mobile", FILTER_SANITIZE_STRING);
                $profession = filter_input(INPUT_POST, "profession", FILTER_SANITIZE_STRING);
                $designation = filter_input(INPUT_POST, "designation", FILTER_SANITIZE_STRING);
                $organization = filter_input(INPUT_POST, "organization", FILTER_SANITIZE_STRING);
                $birth_year = filter_input(INPUT_POST, "birth_year", FILTER_SANITIZE_STRING);
                $id_type = filter_input(INPUT_POST, "id_type", FILTER_SANITIZE_STRING);
                $id_number = filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_STRING);
                $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_STRING);
                $vip_type = filter_input(INPUT_POST, "vip_type", FILTER_SANITIZE_STRING);
                $referred_by = filter_input(INPUT_POST, "referred_by", FILTER_SANITIZE_STRING);
                $gate = filter_input(INPUT_POST, "gate", FILTER_SANITIZE_STRING);
                $number = $_POST['number_of_ticket'];
            
                $errors = array();
            
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            
                    if (empty($name)) {
                        $errors['name'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Name Field! </div>";
                    }
            
            
                    if (empty($profession)) {
                        $errors['profession'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Profession Field! </div>";
                    }
                 
                    if (empty($vip_type)) {
                        $errors['vip_type'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Vip Type! </div>";
                    }        
            
                    if (empty($vip_type)) {
                        $errors['vip_type'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Vip Type! </div>";
                    }
            
                    if (empty($referred_by)) {
                        $errors['referred_by'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Input fields referred by! </div>";
                    }
            
            
                    if (empty($gate)) {
                        $errors['gate'] = true;
                        echo $msg = "<div class='alert alert-warning'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select gate! </div>";
                    }
            
            
                    if (empty($errors)) {
                            for ($i = 1; $i <= $number; $i++) {
            
                                /*
                                |--------------------------------------------------------------------------
                                | Count
                                |--------------------------------------------------------------------------
                                */
            
            
                                $count = BKCOUNT();
                                $totalcount = 'BK-' . (10001 + $count);
            
            
                                /*
                                |-----------------------------------------------------------------------------
                                |  Random unique ID Function From Classs -> class.user.php
                                |-----------------------------------------------------------------------------
                                */
            
                                $registration_number = $auth_user->RegID($_POST['vip_type']);           
            
            
            
                                try {
                                    // GET USER ID 
                                    $uID = $userRow['user_id'];
                                    // INSERT REG  
                                    $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                                                                            `name`, 
                                                                                            `reg_id`, 
                                                                                            `vip_id`, 
                                                                                            `reg_vip_id`, 
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
                                                                                            `referred_by`, 
                                                                                            `created_by` 
            
                                                                                            ) 
                                                                                            VALUES (
            
                                                                                            '$name', 
                                                                                            '$registration_number', 
                                                                                            '$totalcount', 
                                                                                            '2', 
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
                                                                                            '$vip_type', 
                                                                                            '$referred_by', 
                                                                                            '$uID' 
                                                                                            );          
                                                                ");
            
            
                                    $PDO->execute();
            
                                    if ($PDO) {
                                        $registration_number = $registration_number;
                                        $gate = $gate;
                                        $name = $name;
            
            
            
                                        
                                        ?>
        <table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px;font-family: sans-serif;">
            <tr style="padding-bottom:0;margin-bottom:0">
                <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;padding-right: 25px;" colspan="2">
                    <img src="<?php echo 'barcode/barcode.php?registration_number=' . $registration_number; ?>" width="299" height="55" alt="Barcode"/>
                </td>
                <td>
                </td>
            </tr>
            <tr style="padding-top:0;margin-top:0">
                <td align="left" valign="top" style="padding-left:24px;padding-top:0;margin-top:0" colspan="2">
                    <span style="font-size:10px;font-weight: bold;letter-spacing: 18px;font-family: sans-serif;">
                    <?php echo $registration_number; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 10px;">
                    <div style="padding: 3px 3px 3px 3px;width:140px;border: 1px solid;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius:5px; text-align:center; font-size:20px;">
                        <strong>ENTRY PASS</strong>
                    </div>
                    <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 12px;font-size: 13px;">
                        <?php echo $name; ?>
                    </div>
                    <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 3px;font-size: 13px;">
                        <?php
                            if ($profession == '29') {
                                echo "";
                            }
                            
                            else{
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
                            }
                                                        
                            
                            ?> 
                    </div>
                    <div style="letter-spacing: 0px;padding-left: 4px;padding-top: 2px;font-size: 13px;">
                        <?php //echo "$reg_vip_id";  ?>
                        <?php echo $totalcount; ?>
                    </div>
                </td>
                <td align="center" valign="middle" style="padding-right: 20px;padding-top: 10px;float: right;">
                    <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>
                    <div style="padding-top: 0;padding-left: 10px;">
                        <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                            <?php echo $gate; ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" style="font-size: 12px; padding-right: 15px; text-align:center;padding-top:5px">* Please bring this ticket with you to the venue</td>
            </tr>
        </table>
        <?php
            }
            ?>
        <style type="text/css">
            @media print {
            table.booth_ticket{
            page-break-before: always;
            padding-left: 20px;
            padding-right: 20px;
            margin: 0;
            }
            }
            body{
            background: none;
            }
        </style>
        <?php    
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
                echo '<meta http-equiv="refresh" content="2; URL=bulk-reg.php">';
            }
            }
            }
            }
            die();
            }
            ?>
        <?php require_once('nav.php'); ?>
        <div class="clearfix"></div>
        <div class="container-fluid" style="margin-top:80px;">
            <div class="container">
                <div class="main">
                <div class="col-md-8">
                    <div class="col-md-8">
                        <h3>BULK FORM</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="ticket">
                            <a href="bulk-ticket-find.php">[Find Ticket]</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form method="post">
                            <div class="form-group form-group-sm col-md-12">
                                <label for="exampleInputName">Name: * </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="profession">Profession: *</label>
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
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="organization">Organization: </label>
                                <input type="text" name="organization" class="form-control" id="organization" placeholder="Organization">
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="NumberOfTicket">Number of ticket * </label>
                                <input type="text" name="number_of_ticket" class="form-control" id="NumberOfTicket" placeholder="Number of Ticket" required>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="Bulk">Bulk Type: * </label>
                                <select class="form-control" id="vip" name="vip_type" required>
                                    <option value ="" selected disabled>Choose here</option>
                                    <?php
                                        foreach ($VIPTypes as $vip) {
                                            ?>
                                    <option value="<?php echo $vip['shortcode']; ?>"><?php echo $vip['name']; ?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group form-group-sm  col-md-6">
                                <label for="Gate">Gate: </label>
                                <span class="required">*</span>
                                <select class="form-control" id="vip" name="gate" required>
                                    <option selected disabled>Choose here</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="Referred-by">Referred by: * </label>
                                <input type="text" class="form-control" name="referred_by" id="Referred-by" placeholder="Referred by" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="save" value="Save" class="btn btn-primary">Submit</button> <br><br><br>
                            </div>
                        </form>
                    </div>
                </div>                    
                </div>
            </div>
        </div>
        <?php require('footer.php') ?>