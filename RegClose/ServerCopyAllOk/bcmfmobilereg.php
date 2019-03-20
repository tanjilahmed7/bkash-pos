<?php
// Require class User 
require_once("classes/class.user.php");
$auth_user = new USER();

$dir = dirname(__FILE__);

$message=$_POST["message"];
$getmobile=$_POST["mobile"];


// $message    = "Bengal Md. Shafayet Kabir,shafayet.me@gmail.com,Software Engineer,15";
// // $message = "Bengal";
// // $getmobile  ="+8801844050607";
// $getmobile  	="+8801715448331";
// // $getmobile  ="+8801844050548"; // Mahi bhaia
// $test = FALSE;

date_default_timezone_set("Asia/Dhaka");
$currentdate = date('Y-m-d H:i:s');
$current_year = date("Y");

$special_char = '/[\'^£$%&*()}{~?><>|=+¬]/';


$reg_open_date = '2016-11-06 23:59:59';
$mobile     =   substr($getmobile,-11);
if ($mobile=='01715448331' || $mobile=='01844050548' || $mobile == "01931164546" || $mobile == "01717579731" || $currentdate >= $reg_open_date) {

    $length=strlen($message);
    $message_array=explode(',', $message);
    $total_part=count($message_array);
    //echo 
    if($length==6) {
        echo "Please type BENGAL<space>Name,Email,Profession,Age. Send to 6969";
    } elseif($total_part!=4) {
        // echo "Incorrect format. Please type BENGAL<space>Name,Email,National ID or Passport Number or Birth Certificate,Profession,Age. Send to 6969";
        echo "Incorrect format. Please type BENGAL<space>Name,Email,Profession,Age. Send to 6969";
    } else {

    	// echo "<h1> All OK </h1>";
       // $mobile     =   substr($mobile,-11);
        $msg        =   substr($message,6);
        $msg_array  =   explode(',', $msg);

        $name       =   $msg_array[0];
        $name       =   ucwords(strtolower($name));
        $name       =   trim($name);

        $email      =   trim($msg_array[1]);

        $profession =   $msg_array[2];
        $profession =   ucwords(strtolower($profession));

        $age        =   $msg_array[3];
        $year       =   $current_year-$age;

        /*
        |-----------------------------------------------------------------------------------------------------------------------------------------
        |   int preg_match_all ( string $pattern , string $subject [, array &$matches [, int $flags = PREG_PATTERN_ORDER [, int $offset = 0 ]]] )
        |-----------------------------------------------------------------------------------------------------------------------------------------
        |   preg_match_all — Perform a global regular expression match
        |   The preg_match_all() function matches all occurrences of pattern in string.
        |   It will place these matches in the array pattern_array in the order you specify using the optional input parameter order.
        |-----------------------------------------------------------------------------------------------------------------------------------------
        */

        if (!empty($name) AND preg_match_all($special_char, $name) == FALSE) {
            if (!empty($email) AND preg_match_all($special_char, $email) == FALSE) {
                if (!empty($profession) AND preg_match_all($special_char, $profession) == FALSE) {

                    if (!empty($year) AND preg_match_all($special_char, $year) == FALSE) {

                        if (2004 >= $year) {
                            if (1930 <= $year) {

                                // ---------------------------------------------------------------------------------------

                                //PDO Statement
                                $PDO = $auth_user->runQuery("SELECT * FROM registration WHERE mobile='$mobile'");
                                $PDO->execute();
                                $mobilerow = $PDO->fetch(PDO::FETCH_ASSOC);

                                // echo "<pre>";
                                // print_r($mobile);
                                // echo "</pre>";
                                // die();

                                if ($mobilerow == "" || $mobile =="01715448331" || $mobile == "01844050548" || $mobile == "01931164546" || $mobile == "01717579731") // changed for test purpose
                                {
                                    $unique_id = strtoupper(uniqid());
                                    $final_uniq_id_1 = substr($unique_id, 2, 2);
                                    $final_uniq_id_2 = substr($unique_id, 4, 9);
                                    $reg_id = $final_uniq_id_1 . "GM" . $final_uniq_id_2;

        	                        $PDO = $auth_user->runQuery("SELECT * FROM registration");
        	                        $PDO->execute();
        	                        $mobilerow = $PDO->fetchAll(PDO::FETCH_ASSOC);
        	                        $row_count = $PDO->rowCount();


                                    if ($row_count <=15000) {
                                        $gate = 14;
                                    } elseif ($row_count > 15000 && $row_count <= 30000){
                                        $gate = 15;
                                    } elseif ($row_count > 45000){
                                        $gate = 16;
                                    } else {
                                        $gate = 14;
                                    }

                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


                                        $mailmessage = "Mail Message";
                                        //PDO Statement
                                        $PDO = $auth_user->runQuery("INSERT INTO registration (`reg_id`, `name`, `email`, `mobile`, `profession`, `birth_year`, `vip_type`, `gate`, `created_at`) 
                                        VALUES ('$reg_id', '$name','$email', '$mobile', '$profession',  '$year', 'GM','$gate', '$currentdate')");
                                        $result = $PDO->execute();

                                        if ($result) {
                                        	$last_id = $id = $auth_user->lastInsertedID();
                                     		$ticket_count = 10000+$last_id;

                                            include "sms-ticket.php";
                                            //echo "successful"; // for test

                                        }


                                    } else {
                                        echo "Sorry, your Free Pass cannot be sent. Your email address is invalid. Pls re-register with a valid email address.";
                                    }

                                } else {
                                    echo "This mobile is already been registered";
                                }
                                
                                // ----------------------------------------------------------------
                            } else {
                                echo "Your age doesn’t fall within the acceptable range.";
                            }
                        } else {
                            echo "Your age doesn’t fall within the acceptable range.";
                        }

                    } else {
                        echo "Please enter the year field correctly.";
                    }

                } else {
                    
                    echo "Please enter the profession field correctly.";
                }
            } else {
                
                echo "Please enter the email field correctly.";
            }
        } else {
            
            echo "Please enter the name field correctly.";
        }
    }

} else {
	echo "Registration is not yet open. For other queries please visit www.aarongfestival.com";
    $PDO = $auth_user->runQuery("INSERT INTO `inquery` (`Mobile`, `Message`, `DateTime`) VALUES ('$mobile', '$message', '$currentdate');");
    $PDO->execute();
    // echo "Inquery";
}
