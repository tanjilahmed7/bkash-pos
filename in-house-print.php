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

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

$registration_number    = $Data->reg_id;
$name                   = $Data->name;
$gate                   = $Data->gate;
$profession             = $Data->profession;
$Designation            = $Data->designation;
$Organization           = $Data->organization;
$VipID                  = $Data->vip_id;


/*
  |------------------------------------------------------------------------------------------------------
  | GET PROFESSIONAL NAME
  |------------------------------------------------------------------------------------------------------
 */
/*
|----------------------------------------------------------------------------------------------------------------------------
| PROFESSION NAME SHOWS FUNCTIONS
|----------------------------------------------------------------------------------------------------------------------------
*/

function PRF($id) {

    try {
        $auth_user = new USER();
        // Query    
        $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE `id` = $id");
        $stmt->execute();

        // Fetch array associative
        $PPNAME = $stmt->fetchAll(PDO::FETCH_ASSOC);
        

        foreach ($PPNAME as  $value) {
            return $value['name'];
        }
        //return $PPNAME[0]['name'];

    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

}
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
            <td align="left" valign="top" style="padding-left:25px;padding-right:5px;padding-top:0;margin-top:0" colspan="2">
                <span style="font-size:10px;font-weight: bold;letter-spacing: 18px;font-family: sans-serif;">
                <?php echo $registration_number; ?>
                </span>
            </td>              
        </tr>
        <tr>
            <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 0px; font-size:14px;">

                <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 12px;font-weight:bold">
                <?php echo $name; ?>

                </div>   

                <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 3px; font-size:11px">
                    <?php 

                    /*
                    |----------------------------------------------------------------
                    | Ticket Print - Name, (Profession* || Disgnation), Organisation
                    |----------------------------------------------------------------
                    */    
                    if (empty($profession)) {
                        echo $Designation."<br>";
                    } 
                    elseif(empty($Designation)){
                        echo PRF($profession)."<br>";
                    }
                    elseif(!empty($profession) AND !empty($Designation)){
                        echo PRF($profession)."<br>";        
                    }
                    echo $Organization;                  

                     ?>                     
                </div>

                <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 5px;font-size: 14px;padding-bottom:0px; font-size: 11px;">
                 <?php echo $VipID; ?>          
                </div>  

                
            </td>

            <td align="center" valign="middle" style="padding-right: 10px;padding-top: 7px;float: right;">
                <div style="font-size:17px;padding-left:2px;padding-top:1px;"><strong style="margin-left: 7px;">GATE</strong></div>

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

    <style type="text/css">
        @media print {
            table.booth_ticket{
                page-break-before: always;
                padding: 10px;
            }
        }
    </style>   
        
    <?php
} else {
    header('Location: home.php');
}
?>
