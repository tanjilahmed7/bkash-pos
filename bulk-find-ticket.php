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

if (isset($_POST['submit'])) {

    $From = $_POST['from']-1;
    $To = ($_POST['to'] - $_POST['from']) + 1;


    /*
      |------------------------------------------------------------------------------------------------
      | Shows Value form input
      |------------------------------------------------------------------------------------------------
     */
    try {
        $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE reg_vip_id = 2 ORDER BY `vip_id` LIMIT $From,$To");
        $stmt->execute();
        $VIPTICKET = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($VIPTICKET) {
            foreach ($VIPTICKET as $value) {
                $registration_number = $value['reg_id'];
                $name = $value['name'];
                $profession = $value['profession'];
                $totalcount = $value['vip_id'];
                $gate = $value['gate'];
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

                                <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 12px;font-size: 14px;">
                                    <?php echo $name; ?>

                                </div>   

                                <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 3px;font-size: 14px;">
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

                                <div style="letter-spacing: 0px;padding-left: 4px;padding-top: 2px;font-size: 14px;">
                                    <?php //echo "$reg_vip_id";  ?>
                                    <?php echo $totalcount; ?>
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
                                <td colspan="2" valign="top" style="font-size: 10px; padding-right: 15px; text-align:center;padding-top:5px">* Please bring this ticket with you to the venue</td>
                            </tr>            
                        </table> 





                    <style type="text/css">
                        @media print {
                            table.booth_ticket{
                                page-break-before: always;
                                padding: 10px;
                            }
                        }
                    </style>
        <?php
        }

        die();
    ?>  
     <?php  
        }       
        else{
            echo "Ticket not found!";
            echo '<meta http-equiv="refresh" content="2; URL=bulk-find-ticket.php">';
            die();
        }

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

}
 ?>
<?php require('header.php'); ?>
<!-- Header -->

<div class="container-fluid" style="margin-top:80px;">

    <div class="container">

    <form action="" method="post" accept-charset="utf-8">

        <div class="form-group form-group-sm col-md-3" style="padding-right: 0!important">
            <label for="From">From: </label>
            <span class="required">*</span>
            <input type="number" name="from" class="form-control" id="From" placeholder="From" required>
        </div>

        <div class="form-group form-group-sm col-md-3" style="padding-right: 0!important">
            <label for="To">To: </label>
            <span class="required">*</span>
            <input type="number" name="to" class="form-control" id="To" placeholder="To" required>
        </div>

        <div class="form-group form-group-sm col-md-3" style="padding-right: 0!important;margin-top:23px;">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">GO</button>
        </div>
        

    </form>

    </div>
    
</div>
<?php require('footer.php') ?>