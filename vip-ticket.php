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
    | Show All VIP Type type_id = 4
    |-------------------------------------------------------------------------------------------------------------------
    */
    
    try {
    
    // Query    
        $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 4');
        $stmt->execute();
    
    // Fetch array associative
        $VIPTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    
    /*
    |----------------------------------------------------------------------------------------------------------------------------
    | VIPCOUNT Functions 
    |----------------------------------------------------------------------------------------------------------------------------
    |   vip_type ($short_code) = "VP" or "VC" or "VO" or "VS"
    |   To count specific type of VIP
    |   
    |----------------------------------------------------------------------------------------------------------------------------
    */
    
    function VIPCOUNT() {
    
        try {
            $auth_user = new USER();
            // Query    
            //new $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE `vip_type` = '$shortcode'");
            $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE `reg_vip_id` = '1'");        
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
    |-------------------------------------------------------------------------------------------------------------
    | Isset check Save
    |-------------------------------------------------------------------------------------------------------------
    */
    
    if (isset($_POST['save'])) {
        $name               = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $referred_by        = filter_input(INPUT_POST, "referred_by", FILTER_SANITIZE_STRING);
        $gate               = 1;
        $number_of_ticket   = filter_input(INPUT_POST, "number_of_ticket", FILTER_SANITIZE_STRING);
        $vip_type           = filter_input(INPUT_POST, "vip_type", FILTER_SANITIZE_STRING);
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
    

    
                if (empty($number_of_ticket)) {
                    $errors['number_of_ticket'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Number OF Ticket Field! </div>";
                }
    
                if (empty($vip_type)) {
                    $errors['vip_type'] = true;
                    echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please Select Vip Type! </div>";
                }
    
    
    
                if (empty($errors)) {
    
                    try {
                        /*
                        |-----------------------------------------------------------------------------
                        |  Random unique ID Function From Classs -> class.user.php
                        |-----------------------------------------------------------------------------
                        */
    
                        $registration_number = $auth_user->RegID($_POST['vip_type']);   
    
    
                        /*
                        |-----------------------------------------------------------------------------
                        |  Total VIP COUNT
                        |-----------------------------------------------------------------------------
                        */
    
                        $number_of_ticket = $_POST['number_of_ticket'];
                        $uID = $userRow['user_id'];
                        $count = VIPCOUNT($vip_type);
                        /*
                        |----------------------------------------------------------------------
                        | VIP PRINT BY SEARCH
                        |----------------------------------------------------------------------
                        */
                        $totalcount = 'VP-' . (10001 + $count);
    
    
                        $PDO = $auth_user->runQuery("INSERT INTO `registration` ( 
                                  `name`, 
                                  `reg_id`, 
                                  `vip_id`, 
                                  `reg_vip_id`, 
                                  `referred_by`, 
                                  `gate`, 
                                  `vip_type`, 
                                  `created_by`
    
    
                             ) 
                             VALUES (
    
                                  '$name', 
                                  '$registration_number', 
                                  '$totalcount', 
                                  '1', 
                                  '$referred_by', 
                                  '$gate',       
                                  '$vip_type',    
                                  '$uID'
                             );         
                             ");
    
    
                        $PDO->execute();
    
                        if ($PDO) {
    
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
            <div style="letter-spacing: 0px;padding-left: 5px; padding-top:12px">
                <?php //echo "$reg_vip_id";  ?>
                <?php echo $VIPID; ?>
            </div>
        </td>
        <td align="center" valign="middle" style="padding-right: 12px;padding-top: 5px;float: right;">
            <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>
            <div style="padding-top: 0;padding-left: 10px;">
                <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;padding-top: 5px;">
                    <?php echo $gate; ?>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" style="font-size: 12px; padding-right: 15px; text-align:center;padding-top:20px">* Please bring this ticket with you to the venue</td>
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
</style>
<?php    
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
                        <h3>VIP REG FORM</h3>
                    </div>
                    <div class="col-md-4">
                        <div class="ticket">
                            <a href="vip-ticket-reg-find.php">[Find Ticket]</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form method="post" actions="">
                            <div class="form-group form-group-sm  col-md-12">
                                <label for="exampleInputName">Name: </label>
                                <span class="required">*</span>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div class="form-group form-group-sm  col-md-6">
                                <label for="Referred-by">Referred by: </label>
                                <span class="required">*</span>
                                <input type="text" class="form-control" name="referred_by" id="Referred-by" placeholder="Referred by" required>
                            </div>
                            <div class="form-group form-group-sm  col-md-6">
                                <label for="Number-of-ticket">Number Of Ticket: </label>
                                <span class="required">*</span>
                                <input type="number" class="form-control" name="number_of_ticket" id="Number-of-ticket" placeholder="Number of ticket" required>
                            </div>
                            <div class="form-group form-group-sm  col-md-6">
                                <label for="VIP">VIP Type: </label>
                                <span class="required">*</span>
                                <select class="form-control" id="vip" name="vip_type" required>
                                    <option value="" selected disabled>Choose here</option>
                                    <?php
                                        foreach ($VIPTypes as $vip) {
                                            ?>
                                    <option value="<?php echo $vip['shortcode']; ?>"><?php echo $vip['name']; ?></option>
                                    <?php
                                        }
                                        ?>
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