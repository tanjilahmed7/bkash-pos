<?php
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();

function PRORF($id) {

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
        //echo 'ERROR: ' . $e->getMessage();
    }


}

/*
|----------------------------------------------------------------------------------------------------------------------------
| VIPCOUNT Functions
|----------------------------------------------------------------------------------------------------------------------------
*/

function EMCOUNT() {

    try {
        $auth_user = new USER();
        // Query    
        $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE `reg_vip_id` = 3");
        $stmt->execute();

    // Fetch array associative
        $EMCount = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    return count($EMCount);
}

// End Brackets 


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
                $Name           = $value[0];
                $Gate           = $value[1];
                $Address        = $value[2];
                $district       = $value[3];
                $Mobile         = $value[4];    
                $Email          = $value[5];    
                $Profession     = $value[6];    
                $Designation    = $value[7];
                $Organization   = $value[8];
                $Gender         = $value[9];
                $IDType         = $value[10];
                $IDNumber       = $value[11];
                $Category       = $value[12];
                $ReferredBy     = $value[13];
                $RequesedBy     = $value[14];

                if ($Category == 'BD Artist') {
                    $cat        = 'SX';
                    $cat_id     = '31';
                }

                elseif ($Category == 'All Access') {
                    $cat = 'SA';
                    $cat_id     = '30';
                }

                elseif ($Category == 'Brand Promoter') {
                    $cat = 'SB';
                    $cat_id     = '32';
                }

                elseif ($Category == 'Bangladesh Army') {
                    $cat = 'SK';
                    $cat_id     = '33';                    
                }

                elseif ($Category == 'Crew') {
                    $cat = 'SC';
                    $cat_id     = '34';
                }

                elseif ($Category == 'Facilitator Backstage Access') {
                    $cat = 'SF';
                    $cat_id     = '35';                    
                }

                elseif ($Category == 'Management') {
                    $cat = 'SM';
                    $cat_id     = '36';                    
                }

                elseif ($Category == 'Media Center') {
                    $cat = 'SH';
                    $cat_id     = '37';                      
                }
                elseif ($Category == 'Organizer Support') {
                    $cat = 'SJ';
                    $cat_id     = '38';                    
                }
                elseif ($Category == 'Organizer Management') {
                    $cat = 'SO';
                    $cat_id     = '39';                    
                }
                elseif ($Category == 'Partner') {
                    $cat = 'SR';
                    $cat_id     = '40';                    
                }                
                elseif ($Category == 'Press') {
                    $cat = 'SP';
                    $cat_id     = '41';                      
                }                
                elseif ($Category == 'Sponsor') {
                    $cat = 'SE';
                    $cat_id     = '42';                      
                }

                elseif ($Category == 'Stage Management') {
                    $cat = 'SS';
                    $cat_id     = '43';                        
                }

                elseif ($Category == 'Support') {
                    $cat = 'SD';
                    $cat_id     = '44';                      
                }

                elseif ($Category == 'Temporary Backstage Access') {
                    $cat = 'ST';
                    $cat_id     = '45';                     
                }
                elseif ($Category == 'Vendor') {
                    $cat = 'SV';
                    $cat_id     = '46';                      
                }                
                elseif ($Category == 'Green Room') {
                    $cat = 'SG';
                    $cat_id     = '47';                      
                }                

                elseif ($Category == 'Bengal Pavilion') {
                    $cat = 'SL';
                    $cat_id     = '67';                      
                }
                elseif ($Category == 'Stage and Artist management') {
                    $cat = 'SAM';
                    $cat_id     = '68';                      
                }                
                elseif ($Category == 'Events') {
                    $cat = 'SEV';
                    $cat_id     = '69';                      
                }                
                elseif ($Category == 'F&B') {
                    $cat = 'FB';
                    $cat_id     = '70';                      
                }                
                elseif ($Category == 'Communications') {
                    $cat = 'SCM';
                    $cat_id     = '71';                      
                }                
                elseif ($Category == 'Tech') {
                    $cat = 'STT';
                    $cat_id     = '72';                      
                }                
                elseif ($Category == 'Associate') {
                    $cat = 'SAE';
                    $cat_id     = '73';                      
                }                
                elseif ($Category == 'Core Management') {
                    $cat = 'SCC';
                    $cat_id     = '74';                      
                }
                elseif ($Category == 'Logistics') {
                    $cat = 'SLL';
                    $cat_id     = '75';                      
                }


            if($Profession == 'Actor') {$professions = '1';}
            elseif($Profession == 'Advertising agent') {$professions = '2';}
            elseif($Profession == 'Architect') {$professions = '3';}
            elseif($Profession == 'Artist') {$professions = '4';}
            elseif($Profession == 'Businessperson') {$professions = '5';}
            elseif($Profession == 'Consultant') {$professions = '6';}
            elseif($Profession == 'Defence personnel') {$professions = '7';}
            elseif($Profession == 'Doctor') {$professions = '8';}
            elseif($Profession == 'Graphic Designer') {$professions = '9';}
            elseif($Profession == 'Engineer') {$professions = '10';}
            elseif($Profession == 'Fashion Designer') {$professions = '11';}
            elseif($Profession == 'Filmmaker') {$professions = '12';}
            elseif($Profession == 'Homemaker') {$professions = '13';}
            elseif($Profession == 'Journalist') {$professions = '14';}
            elseif($Profession == 'Lawyer') {$professions = '15';}
            elseif($Profession == 'Media personnel') {$professions = '16';}
            elseif($Profession == 'Musician') {$professions = '17';}
            elseif($Profession == 'Photographer') {$professions = '18';}
            elseif($Profession == 'Civil Servant') {$professions = '19';}
            elseif($Profession == 'Politician') {$professions = '20';}
            elseif($Profession == 'Researcher') {$professions = '21';}
            elseif($Profession == 'Private Service') {$professions = '22';}
            elseif($Profession == 'NGO') {$professions = '23';}
            elseif($Profession == 'Student') {$professions = '24';}
            elseif($Profession == 'Teacher') {$professions = '25';}
            elseif($Profession == 'Web Developer') {$professions = '26';}
            elseif($Profession == 'IT') {$professions = '27';}
            elseif($Profession == 'Writer') {$professions = '28';}
            elseif($Profession == 'Other') {$professions = '29';}
            else
            {
                $professions = '';
            }

            if ($Gender == 'Male') {$gender = '59';}
            elseif ($Gender == 'Female') {$gender = '60';}
            elseif ($Gender == 'Third Gender') {$gender = '66';}
            else{
               $gender == '';
            }

            if ($IDType == 'National ID') {$idtype = '62';}
            elseif ($IDType == 'Birth Certificate') {$idtype = '63';}
            elseif ($IDType == 'Driving Licence') {$idtype = '64';}
            elseif ($IDType == 'Passport') {$idtype = '65';}
            else{
                $idtype = '';    
            }




                $registration_number = $auth_user->RegID($cat); 
                $count = EMCOUNT();

                //var_dump($count);
                $totalcount = 'EM-' . (10001 + $count);



                // //insert member data into database
                $PDO = $auth_user->runQuery("INSERT INTO registration (reg_id, reg_vip_id, vip_id, name, address, mobile, email, designation, organization, profession, details_info, gate, vip_type, referred_by,gender,id_type,id_number,category) VALUES ('$registration_number', '3', '$totalcount', '$Name', '$Address', '$Mobile', '$Email', '$Designation', '$Organization', '$professions','$RequesedBy','$Gate', '$cat', '$ReferredBy','$gender','$idtype','$IDNumber','$cat_id')");

                $PDO->execute();
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
                                                            <span style="font-size:10px;font-weight: bold;letter-spacing: 15px;font-family: sans-serif;">
                                                                <?php echo $registration_number; ?>
                                                            </span>
                                                        </td>              
                                                    </tr>
                                                    <tr>
                                                <td align="left" valign="top" width="190" height="10" style="padding-left:25px;padding-top: 0px;">
                                                    <div style="letter-spacing: 0px;padding-left: 5px; padding-top:12px">
                                                        <div style="padding-bottom:0px;font-weight: bold;">
                                                            <?php echo ucwords(strtolower($Name)); ?>
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
                                                                echo PRORF($professions)."<br>";
                                                            }
                                                            elseif(!empty($Profession) AND !empty($Designation)){
                                                                echo PRORF($professions)."<br>";        
                                                            }


                                                             echo '<b>'.$Organization."</b><br>";               

                                                            ?> 
                                                        </div>    

                                                            <div style="padding-bottom:0px;font-size: 12px;">
                                                                <?php echo $totalcount; ?>          
                                                            </div> 


                                                    </div>   




                                             

                                                        </td>

                                                        <td align="center" valign="middle" style="padding-right: 15px;padding-top: 5px;float: right;">
                                                            <div style="font-size:17px;padding-left:2px"><strong style="margin-left: 7px;">GATE</strong></div>

                                                            <div style="padding-top: 0;padding-left: 10px;">
                                                                <div class="gate_number" style="padding: 5px 5px 1px 5px; width:60px; height: 38px; font-size:24px; text-align: center; color: white; background-color: black;-webkit-print-color-adjust: exact; border: 1px solid;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius:8px;">
                                                                <?php echo $Gate; ?>
                                                                </div>                                               
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" valign="top" style="font-size: 9px; padding-right: 0px; text-align:center;padding-top:5px">* Please bring this ticket with you to the venue</td>
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