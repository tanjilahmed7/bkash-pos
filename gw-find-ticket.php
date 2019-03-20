<?php

require_once("classes/class.user.php");
$auth_user = new USER();


/*
  |---------------------------------------------------------------------------------------------
  | FIND TICKET
  |---------------------------------------------------------------------------------------------
 */
if (isset($_POST['save'])) {
    try {
        $VarifyCode = $_POST['varify'];
        /*
        |--------------------------------------------------------------------------------------
        | Mobile Verification Match input
        |--------------------------------------------------------------------------------------
        */
        $pdo = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile_verify_code` = '$VarifyCode' AND reg_vip_id = 0 AND receive_mail = 0");
        $pdo->execute();
        $ticket_filter = $pdo->fetchAll(PDO::FETCH_ASSOC);


        if ($ticket_filter) {

            $reg = $ticket_filter[0]['reg_id'];
            $name = $ticket_filter[0]['name'];
            $gate = $ticket_filter[0]['gate'];
            $profession = $ticket_filter[0]['profession'];
            ?>

            <table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px;font-family: sans-serif;">
                 <tr style="padding-bottom:0;margin-bottom:0">
                     <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;" colspan="2">
                         <img src="<?php echo 'barcode/barcode.php?registration_number=' . $reg; ?>" width="299" height="55" alt="Barcode"/>
                     </td>
                     <td>

                     </td>
                 </tr>
                 <tr style="padding-top:0;margin-top:0">
                     <td align="left" valign="top" style="padding-left:25px;padding-top:0;margin-top:0" colspan="2">
                         <span style="font-size:10px;font-weight: bold;letter-spacing: 18px;font-family: sans-serif;">
                            <?php echo $reg; ?>
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
                     </td>

                     <td align="center" valign="middle" style="padding-right: 10px;padding-top: 5px;float: right;">
                         <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>

                         <div style="padding-top: 0;padding-left: 10px;">
                             <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                                <?php echo $gate; ?>
                             </div>                                                
                         </div>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="2" valign="top" style="font-size: 10px; padding-right: 0px; text-align:center;padding-top:7px">* Please bring this ticket with you to the venue</td>
                 </tr>            
             </table>  

            <?php
                $id = $ticket_filter [0]['id'];
                $stmt = $auth_user->runQuery("UPDATE `registration` SET `receive_mail` = 0, `mobile_verify_code` = '' WHERE `id` = '$id'");
                $stmt->execute();

               /*
              |-------------------------------------------------------------------------
              | Receive Mail Count
              |-------------------------------------------------------------------------
              */
              $Receiveticket = $ticket_filter [0]['print_receive']+1;
              $stmt = $auth_user->runQuery("UPDATE `registration` SET `print_receive` = '$Receiveticket' WHERE `id` = '$id'");
              $stmt->execute();


            die();
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    /*
    |---------------------------------------------------------------------------
    | Already Ticket Taken 
    |---------------------------------------------------------------------------
    */ 
    try {
        $VarifyCode = $_POST['varify'];
        $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `mobile_verify_code` = '' AND reg_vip_id = 0 AND receive_mail = 0");
        $PDO->execute();
        $haveTicket = $PDO->fetchAll(PDO::FETCH_ASSOC);

        if ($haveTicket) {
            echo "<div class='taken alert alert-warning'><strong>Warning! </strong> Incorrect your Reg ID! </div>";
            echo '<meta http-equiv="refresh" content="2; URL=booth-general-reg.php">';
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
require('header.php');


?>

<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
        <div class="col-md-8">
            <h3>Enter a verification code</h3>
            <form method = "POST">

                <div class="form-group">
                    <label for="FindTicket">A text message with a verification code was just sent to your phone number* </label>
                    <input type="text" name="varify" class="form-control" id="FindTicket" placeholder="Enter a verification code" required>
                </div>

                <button type="submit" name="save" value="Save" class="btn btn-primary">Done</button> <br><br><br>
            </form>
        </div>

        <div class="col-md-4">
            <div class="ticket">
                <a href="index.php">[Registration]</a>
            </div>
        </div>
</div>        




    </div>		
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
