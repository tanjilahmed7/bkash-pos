<?php
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();

/*
|----------------------------------------------------------------------------------------------------------------------------
| VIPCOUNT Functions
|----------------------------------------------------------------------------------------------------------------------------
*/

function VIPCOUNT() {

    try {
        $auth_user = new USER();
        // Query    
        $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE `reg_vip_id` = 1");
        $stmt->execute();

    // Fetch array associative
        $VIPCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    return count($VIPCount);
}



if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = $_FILES['file']['tmp_name'];
            
            //skip first line
            // fgetcsv($csvFile);
            $csvFile = array_map('str_getcsv', file($csvFile));

            // remove first element in array
            array_shift($csvFile);

            // echo "<pre>";
            // print_r($csvFile);
            // echo "<pre/>";

            // die();

            foreach ($csvFile as $value) {

                $VipType        = 'VP';
                $Gate           = 1;
                $Name           = $value[3].$value[4];
                $Designation    = $value[5];
                $Organization   = $value[6];
                $Address        = $value[14].$value[15].$value[16].$value[17].$value[18].$value[19].$value[20].$value[21].$value[22];
                $district       = $value[20];
                $Mobile         = $value[31];
                $Email          = $value[32];
                $ReferredBy     = $value[34];
                $Info           = $value[35];
                



                $registration_number = $auth_user->RegID($VipType); 

                $count = VIPCOUNT();

                //var_dump($count);
                $totalcount = 'VP-' . (10001 + $count);


                // //insert member data into database
                $PDO = $auth_user->runQuery("INSERT INTO registration (reg_id, reg_vip_id, vip_id, name, address, email, mobile, designation, organization, details_info, gate, vip_type, referred_by, district) VALUES ('$registration_number', '1', '$totalcount', '$Name', '$Address', '$Email', '$Mobile', '$Designation', '$Organization','$Info','$Gate', '$VipType', '$ReferredBy', '$district')");

                $PDO->execute();
        ?>

                                                <table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px;font-family: sans-serif;">
                                                    <tr style="padding-bottom:0;margin-bottom:0">
                                                        <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;font-family: sans-serif;" colspan="2">
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
                                                    <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 10px;">
                                                        <div style="padding: 3px 3px 3px 3px;width:140px;border: 1px solid;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius:5px; text-align:center; font-size:20px;">
                                                            <strong>ENTRY PASS</strong>
                                                        </div>
                                                        <div style="letter-spacing: 1px;padding-left: 5px; padding-top:8px">
                                                            <?php //echo "$reg_vip_id";  ?>
                                                            <?php echo $totalcount; ?>
                                                        </div>
                                                    </td>

                                                        <td align="center" valign="middle" style="padding-right: 10px;padding-top: 5px;float: right;">
                                                            <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>

                                                            <div style="padding-top: 0;padding-left: 10px;">
                                                                <div class="gate_number" style="padding: 0px 0px 0px 0px; width:60px; height: 38px; font-size:30px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                                                                <?php echo $Gate; ?>
                                                                </div>                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="top" style="font-size: 9px; padding-right: 0px; text-align:center;padding-top:10px">* Please bring this ticket with you to the venue</td>
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
           

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
// header("Location: import-ticket.php".$qstring);