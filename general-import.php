<?php
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();

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

            foreach ($csvFile as $value) {

                $name               = $value[0];
                $address            = $value[1];
                $email              = $value[2];
                $mobile             = $value[3];
                $profession         = $value[4];
                $designation        = $value[5];
                $organization       = $value[6];
                $birthyear          = $value[7];
                $gender             = $value[8];
                $idType             = $value[9];
                $idNumber           = $value[10];
                $gate               = $value[11];
                $reference          = $value[12];
                $request_by         = $value[13];


                if($profession == 'Actor') {$professions = '1';}
                elseif($profession == 'Advertising agent') {$professions = '2';}
                elseif($profession == 'Architect') {$professions = '3';}
                elseif($profession == 'Artist') {$professions = '4';}
                elseif($profession == 'Businessperson') {$professions = '5';}
                elseif($profession == 'Consultant') {$professions = '6';}
                elseif($profession == 'Defence personnel') {$professions = '7';}
                elseif($profession == 'Doctor') {$professions = '8';}
                elseif($profession == 'Graphic Designer') {$professions = '9';}
                elseif($profession == 'Engineer') {$professions = '10';}
                elseif($profession == 'Fashion Designer') {$professions = '11';}
                elseif($profession == 'Filmmaker') {$professions = '12';}
                elseif($profession == 'Homemaker') {$professions = '13';}
                elseif($profession == 'Journalist') {$professions = '14';}
                elseif($profession == 'Lawyer') {$professions = '15';}
                elseif($profession == 'Media personnel') {$professions = '16';}
                elseif($profession == 'Musician') {$professions = '17';}
                elseif($profession == 'Photographer') {$professions = '18';}
                elseif($profession == 'Civil Servant') {$professions = '19';}
                elseif($profession == 'Politician') {$professions = '20';}
                elseif($profession == 'Researcher') {$professions = '21';}
                elseif($profession == 'Private Service') {$professions = '22';}
                elseif($profession == 'NGO') {$professions = '23';}
                elseif($profession == 'Student') {$professions = '24';}
                elseif($profession == 'Teacher') {$professions = '25';}
                elseif($profession == 'Web Developer') {$professions = '26';}
                elseif($profession == 'IT') {$professions = '27';}
                elseif($profession == 'Writer') {$professions = '28';}
                elseif($profession == 'Other') {$professions = '29';}
                elseif($profession != 'Other') {$professions = '29';}

                if ($gender == 'Male') {$Gender = '59';}
                elseif ($gender == 'Female') {$Gender = '60';}
                elseif ($gender == 'Third Gender') {$Gender = '66';}

                if ($idType == 'National ID') {$IdType = '62';}
                elseif ($idType == 'Birth Certificate') {$IdType = '63';}
                elseif ($idType == 'Driving Licence') {$IdType = '64';}
                elseif ($idType == 'Passport') {$IdType = '65';}

                
                        $registration_number = $auth_user->RegID('GI'); 
                        // //insert member data into database
                        $PDO = $auth_user->runQuery("INSERT INTO registration (
                                                                reg_id, 
                                                                name, 
                                                                address, 
                                                                email, 
                                                                mobile, 
                                                                profession, 
                                                                designation, 
                                                                organization, 
                                                                birth_year, 
                                                                id_type, 
                                                                id_number, 
                                                                gender, 
                                                                gate, 
                                                                referred_by, 
                                                                details_info
                                                            ) VALUES (
                                                                '$registration_number', 
                                                                '$name', 
                                                                '$address', 
                                                                '$email', 
                                                                '$mobile', 
                                                                '$professions', 
                                                                '$designation', 
                                                                '$organization', 
                                                                '$birthyear', 
                                                                '$IdType', 
                                                                '$idNumber',
                                                                '$Gender', 
                                                                '$gate', 
                                                                '$reference', 
                                                                '$request_by'
                                                            )");
                        $PDO->execute();
                        $last_id = $auth_user->lastInsertedID();
                        $ticket_count = 10000+$last_id;
                    ?>


                                                <table width="270" border="0" cellpadding="0" cellspacing="0" class="booth_ticket" style="padding-left:5px;padding-top:5px">
                                                    <tr style="padding-bottom:0;margin-bottom:0">
                                                        <td align="left" valign="top" width="293" style="padding-left:26px;padding-top: 20px;padding-bottom:0;margin-bottom:0;margin-left:2px;font-family: sans-serif;" colspan="2">
                                                            <img src="<?php echo 'barcode/barcode.php?registration_number=' . $registration_number; ?>" width="299" height="55" alt="Barcode"/>
                                                        </td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                    <tr style="padding-top:0;margin-top:0">
                                                        <td align="left" valign="top" style="padding-left:25px;padding-top:0;margin-top:0" colspan="2">
                                                            <span style="font-size:10px;font-weight: bold;letter-spacing: 17px;font-family: calibri;">
                                                                <?php echo $registration_number; ?>
                                                            </span>
                                                        </td>              
                                                    </tr>
                                                    <tr>
                                                        <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 10px;">
                                                            <div style="padding: 3px 3px 3px 3px;width:140px;border: 1px solid;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius:5px; text-align:center; font-size:20px;">
                                                                <strong>ENTRY PASS</strong>
                                                            </div>

                                                            <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 2px;font-size: 14px;">
                                                            <b><?php echo $name; ?></b>

                                                            </div>   

                                                            <div style="letter-spacing: 0px;padding-left: 3px;padding-top: 1px;font-size: 8px;">
                                                                <?php
                                                                /*
                                                                  |------------------------------------------------------------------------------------------------------
                                                                  | GET PROFESSIONAL NAME
                                                                  |------------------------------------------------------------------------------------------------------
                                                                 */
                                                                try {

                                                                    $PDO = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE id = $professions");

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
                                                                <div class="sl">
                                                                  <?php echo $ticket_count; ?>
                                                                </div>                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="top" style="font-size: 9px; padding-right: 0px; text-align:center;padding-top:0px">* Please bring this ticket with you to the venue</td>
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