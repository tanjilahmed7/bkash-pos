<?php
    require_once("session.php");
    require_once("classes/class.user.php");
    $auth_user = new USER();
    $user_id = $_SESSION['user_session'];
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id" => $user_id));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $Role = ($userRow['user_role']);
    
    
    
    
    
    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Show All VIP Type
    |-------------------------------------------------------------------------------------------------------------------
    */
    
    try {
    
    // Query    
        $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 6');
        $stmt->execute();
    
    // Fetch array associative
        $AllCat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
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
    |----------------------------------------------------------------------------------------------------------------------------
    | VIPCOUNT Functions
    |----------------------------------------------------------------------------------------------------------------------------
    */
    
    function VIPCOUNT($shortcode) {
    
        try {
            $auth_user = new USER();
            // Query    
            $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE `reg_vip_id` = 3");
            $stmt->execute();
    
        // Fetch array associative
            $VIPCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    
        return count($VIPCount);
    }
    
    // End Brackets 
    
    
    /*
    |----------------------------------------------------------------------------------------------------------------------------
    | PROFESSION NAME SHOWS FUNCTIONS
    |----------------------------------------------------------------------------------------------------------------------------
    */
    
    function PFNAME($id) {
    
        try {
            $auth_user = new USER();
            // Query    
            $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE `id` = $id");
            $stmt->execute();
    
            // Fetch array associative
            $PFNAME = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($PFNAME);
    
            return $PFNAME[0]['shortcode'];
    
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    
    }
    
    function PRF($id) {
    
        try {
            $auth_user = new USER();
            // Query    
            $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE `id` = $id");
            $stmt->execute();
    
            // Fetch array associative
            $PPNAME = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($PPNAME);
    
            foreach ($PPNAME as  $value) {
                return $value['name'];
            }
            //return $PPNAME[0]['name'];
    
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    
    
    }
    
    // End Brackets 
    
    
    
    
    
    /*
    |-------------------------------------------------------------------------------------------------------------
    | Isset check Save
    |-------------------------------------------------------------------------------------------------------------
    */
    
    if (isset($_POST['save'])) {
        $name               = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $referred_by        = filter_input(INPUT_POST, "referred_by", FILTER_SANITIZE_STRING);
        $gate               = filter_input(INPUT_POST, "gate", FILTER_SANITIZE_STRING);
        $number_of_ticket   = filter_input(INPUT_POST, "number_of_ticket", FILTER_SANITIZE_STRING);
        $vip_type           = filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING);
        $designation        = filter_input(INPUT_POST, "designation", FILTER_SANITIZE_STRING);
        $organization       = filter_input(INPUT_POST, "organization", FILTER_SANITIZE_STRING);
        $profession         = filter_input(INPUT_POST, "profession", FILTER_SANITIZE_STRING);
        $number             = $_POST['number_of_ticket'];
        
        for ($i = 1; $i <= $number; $i++) {
            $errors = array();
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (empty($name)) {
                    $errors['name'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Name Field! </div>";
                }
    
                if (empty($referred_by)) {
                    $errors['referred_by'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Referred By Field! </div>";
                }
    
                if (empty($gate)) {
                    $errors['gate'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Gate Field! </div>";
                }
    
                if (empty($number_of_ticket)) {
                    $errors['number_of_ticket'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Number OF Ticket Field! </div>";
                }
    
                if (empty($vip_type)) {
                    $errors['category'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Category! </div>";
                }
    
    
                if (empty($errors)) {
    
                    try {
                        /*
                        |-----------------------------------------------------------------------------
                        |  Random unique ID Function From Classs -> class.user.php
                        |-----------------------------------------------------------------------------
                        */
    
                        $registration_number = $auth_user->RegID(PFNAME($_POST['category']));           
    
    
                        /*
                        |-----------------------------------------------------------------------------
                        |  Total VIP COUNT
                        |-----------------------------------------------------------------------------
                        */
    
                        $number_of_ticket = $_POST['number_of_ticket'];
                        $uID = $userRow['user_id'];
                        $count = VIPCOUNT($vip_type);
    
                        //var_dump($count);
                        $totalcount = 'EM-' . (10001 + $count);
                        //var_dump($totalcount);
    
                        $shortcode = PFNAME($_POST['category']);
                        
    
    
                        $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                  `name`, 
                                  `reg_id`, 
                                  `vip_id`, 
                                  `reg_vip_id`, 
                                  `referred_by`, 
                                  `gate`, 
                                  `category`, 
                                  `vip_type`, 
                                  `designation`, 
                                  `organization`, 
                                  `profession`, 
                                  `created_by`
    
    
                             ) 
                             VALUES (
    
                                  '$name', 
                                  '$registration_number', 
                                  '$totalcount', 
                                  '3', 
                                  '$referred_by', 
                                  '$gate',       
                                  '$vip_type',    
                                  '$shortcode',    
                                  '$designation',    
                                  '$organization',    
                                  '$profession',    
                                  '$uID'
                             );         
                             ");
    
    
                        $PDO->execute();
    
                        if ($PDO) {
    
                            $Profession = $profession;
                            $Organization = $organization;
                            $Designation = $designation;
                            $Name = $name;
                            $registration_number = $registration_number;
                            $reg_vip_id = $vip_type;
                            $gate = $gate;
                            $VIPID = $totalcount;
    
    
    ?>
<table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px;font-family: sans-serif;">
    <tr style="padding-bottom:0;margin-bottom:0">
        <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;" colspan="2">
            <img src="<?php echo 'barcode/barcode.php?registration_number=' . $registration_number; ?>" width="299" height="55" alt="Barcode"/>
        </td>
        <td>
        </td>
    </tr>
    <tr style="padding-top:0;margin-top:0">
        <td align="left" valign="top" style="padding-left:25px;padding-top:0;margin-top:0" colspan="2">
            <span style="font-size:10px;font-weight: bold;letter-spacing: 18px;font-family: sans-serif;">
            <?php echo $registration_number; ?>
            </span>
        </td>
    </tr>
    <tr>
        <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 0px;">
            <div style="letter-spacing: 0px;padding-left: 5px; padding-top:12px">
                <div style="padding-bottom:0px;font-weight: bold;">
                    <?php echo $Name; ?>
                </div>
                <div style="padding-bottom:0px;font-size: 12px;">
                    <?php 
                        /*
                        |----------------------------------------------------------------
                        | Ticket Print - Name, (Profession* || Disgnation), Organisation
                        |----------------------------------------------------------------
                        */                                             
                            if (empty($Profession)) {
                                echo $Designation."<br>";
                            } 
                            elseif(empty($Designation)){
                                echo PRF($Profession)."<br>";
                            }
                            elseif(!empty($Profession) AND !empty($Designation)){
                                echo PRF($Profession)."<br>";        
                            }
                            echo '<b>'.$Organization."</b><br>"; 
                        
                        ?>
                </div>
                <div style="padding-bottom:0px;font-size: 12px;">
                    <?php echo $VIPID; ?>          
                </div>
            </div>
        </td>
        <td align="center" valign="middle" style="padding-right: 12px;padding-top: 5px;float: right;">
            <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>
            <div style="padding-top: 0;padding-left: 10px;">
                <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                    <?php echo $gate; ?>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" style="font-size: 10px; padding-right: 15px; text-align:center;padding-top:2px">* Please bring this ticket with you to the venue</td>
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
    
    } catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    }
    }
    }
    
    }
    
    
    die();
    }
    ?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
        <link rel="stylesheet" href="style.css" type="text/css"  />
        <title>Aarong Festival - <?php print($userRow['user_email']); ?></title>
    </head>
    <body>
        <?php require_once('nav.php'); ?>
        <div class="clearfix"></div>
        <div class="container-fluid" style="margin-top:80px;">
            <div class="container">
                <div class="main">
                <div class="col-md-8">
                    <div class="col-md-8">
                        <h3>EVENT MANAGEMENT PASS FORM</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="ticket">
                            <a href="in-house-ticket-find.php">[Find Ticket]</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form method="post" actions="">
                            <div class="form-group form-group-sm col-md-12">
                                <label for="exampleInputName">Name: </label>
                                <span class="required">*</span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="Referred-by">Referred by: </label>
                                <span class="required">*</span>
                                <input type="text" class="form-control" name="referred_by" id="Referred-by" placeholder="Referred by" required>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="Number-of-ticket">Number of ticket: </label>
                                <span class="required">*</span>
                                <input type="number" class="form-control" name="number_of_ticket" id="Number-of-ticket" placeholder="Number of ticket" required>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="category">Category: </label>
                                <span class="required">*</span>
                                <select class="form-control" id="category" name="category" required>
                                    <option selected value="">Choose here</option>
                                    <?php
                                        foreach ($AllCat as $category) {
                                            ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="profession">Profession: </label>
                                <span class="nonerequired">*</span>
                                <select class="form-control" id="profession" name="profession">
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
                                <span class="required">*</span>
                                <span class="nonerequired">*</span>
                                <input type="text" name="organization" class="form-control" id="organization" placeholder="Organization">
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="designation">Designation: </label>
                                <span class="nonerequired">*</span>
                                <input type="text" name="designation" class="form-control" id="designation" placeholder="Designation">
                            </div>
                            <div class="form-group form-group-sm col-md-6">
                                <label for="Gate">Gate: </label>
                                <span class="required">*</span>
                                <select class="form-control" id="vip" name="gate" required>
                                    <option value ="" selected disabled>Choose here</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="4">4</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="1 & 4">1 & 4</option>

                                </select>
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