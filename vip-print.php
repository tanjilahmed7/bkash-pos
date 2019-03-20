<?php
require_once("session.php");
require_once("classes/class.user.php");

$auth_user = new USER();
$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

/*
  |------------------------------------------------------------------------------------------------
  | Shows Value form input
  |------------------------------------------------------------------------------------------------
 */
try {
    $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE id = :id");
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
    $Data = $stmt->fetch(PDO::FETCH_OBJ);

//var_dump($Data);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$registration_number = $Data->reg_id;
$name = $Data->name;
$gate = $Data->gate;
$profession = $Data->profession;
$VIPID = $Data->vip_id;

/*
|-------------------------------------------------------------------------
| Receive Mail Count
|-------------------------------------------------------------------------
*/
$id = $Data->id;
$Receiveticket = $Data->print_receive+1;
$stmt = $auth_user->runQuery("UPDATE `registration` SET `print_receive` = '$Receiveticket' WHERE `id` = '$id'");
$stmt->execute();

?>

<?php
if ($Data->id) {
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
                <span style="font-size:10px;font-weight: bold;letter-spacing: 18px;font-family: sans-serif;;">
                    <?php echo $registration_number; ?>
                </span>
            </td>              
        </tr>
        <tr>
            <td align="left" valign="top" width="190" height="10" style="padding-left:35px;padding-top: 10px;">
                <div style="padding: 3px 3px 3px 3px;width:140px;border: 1px solid;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius:5px; text-align:center; font-size:20px;">
                    <strong>ENTRY PASS</strong>
                </div>
                <div style="letter-spacing: 0px;padding-left: 0px; padding-top:12px">
                    <?php echo $VIPID; ?>
                </div>
            </td>

            <td align="center" valign="middle" style="padding-right: 12px;padding-top: 5px;">
                <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>

                <div style="padding-top: 0;padding-left: 10px;">
                    <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                        <?php echo $gate; ?>
                    </div>                                                
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" style="font-size: 10px; padding-right: 15px; text-align:center;padding-top:20px">* Please bring this ticket with you to the venue</td>
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
} else {
    header('Location: home.php');
}
?>
