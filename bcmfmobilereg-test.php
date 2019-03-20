<?php

// Require class User 
require_once("classes/class.user.php");
$auth_user = new USER();

$dir = dirname(__FILE__);

// $message=$_POST["message"];
// $getmobile=$_POST["mobile"];


$message    = "Bengal Md. Shafayet Kabir,shafayet.me@gmail.com,Software Engineer,25";
$getmobile  ="01715448331";
$test = FALSE;
// $test = FALSE;

// echo $getmobile;

date_default_timezone_set("Asia/Dhaka");
$currentdate = date('Y-m-d H:i:s');
$current_year = date("Y");

$special_char = '/[\'^£$%&*()}{~?><>|=+¬]/';

// $d1 = '2016-11-24 05:00:00';
// $d2 = '2016-11-25 05:00:00';
// $d3 = '2016-11-26 05:00:00';
// $d4 = '2016-11-27 05:00:00';
// $d5 = '2016-11-28 05:00:00';


// if ($currentdate>=$d1 && $currentdate<$d2) {
//     echo "24 Nov - TEST PERFORMERS - DAY : 01  *Program may change";
// } elseif ($currentdate>=$d2 && $currentdate<$d3) {
//     echo "25 Nov - TEST PERFORMERS - DAY : 02  *Program may change.";
// } elseif ($currentdate>=$d3 && $currentdate<$d4) {
//     echo "26 Nov - TEST PERFORMERS - DAY : 03  *Program may change.";
// } elseif ($currentdate>=$d4 && $currentdate<$d5) {
//     echo "27 Nov - TEST PERFORMERS - DAY : 04  *Program may change";
// } elseif ($currentdate>=$d5 && $currentdate<$d6) {
//     echo "28 Nov - TEST PERFORMERS - DAY : 05  *Program may change";
// } elseif($currentdate < '2016-11-06 21:59:59') {



if (!$test) {

    echo "Registration is not yet open. For other queries please visit www.aarongfestival.com";

    $PDO = $auth_user->runQuery("INSERT INTO `inquery` (`Mobile`, `Message`, `DateTime`) VALUES ('$getmobile', '$message', '$currentdate');");
    $PDO->execute();
    echo "Inquery";

} else {

    $length=strlen($message);
    $message_array=explode(',', $message);
    $total_part=count($message_array);
    //echo 
    if($length==6) {
        echo "Please type BENGAL<space>Name,Email,Profession,Age. Send to 6969";
    } elseif($length<6 || $total_part<4) {
        // echo "Incorrect format. Please type BENGAL<space>Name,Email,National ID or Passport Number or Birth Certificate,Profession,Age. Send to 6969";
        echo "Incorrect format. Please type BENGAL<space>Name,Email,Profession,Age. Send to 6969";
    } else {

    	// echo "<h1> All OK </h1>";
        $mobile     =   substr($getmobile,-11);
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
                        //PDO Statement
                        $PDO = $auth_user->runQuery("SELECT * FROM registration WHERE mobile='$mobile'");

                        $PDO->execute();

                        $mobilerow = $PDO->fetchAll(PDO::FETCH_ASSOC);

                        if ($mobilerow == "" || $mobile =="01715448331" || $mobile == "01552463255" || $mobile == "01756088863") // changed for test purpose
                        {
                            $unique_id = strtoupper(uniqid());
                            $final_uniq_id_1 = substr($unique_id, 2, 2);
                            $final_uniq_id_2 = substr($unique_id, 4, 9);
                            $reg_id = $final_uniq_id_1 . "GM" . $final_uniq_id_2;

                            if ($mobilerow[0]['id'] <=20000) {
                                $gate = 14;
                            } elseif ($mobilerow[0]['id'] > 20000 && $mobilerow[0]['id'] <= 40000){
                                $gate = 15;
                            } elseif ($mobilerow[0]['id'] > 40000){
                                $gate = 16;
                            }

                            // ------------------------------------------------------------------------------------------------------------------------------------------------------
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


                                $mailmessage = "Mail Message";
                                //PDO Statement
                                $PDO = $auth_user->runQuery("INSERT INTO registration (`reg_id`, `name`, `email`, `mobile`, `profession`, `birth_year`, `gate`, `created_at`) 
                                VALUES ('$reg_id', '$name','$email', '$mobile', '$profession',  '$year', '$gate', '$currentdate')");
                                $result = $PDO->execute();

                                var_dump($result);


                                if ($result) {
                                    $id = $mobilerow[0]['id'];
                                    include "ticket.php";

                                    // echo "<h1> All OK : ticket sent</h1>";
                                }

                            } else {
                                echo "Sorry, your Free Pass cannot be sent. Your email address is invalid. Pls re-register with a valid email address.";
                            }
                            // ------------------------------------------------------------------------------------------------------------------------------------------------------



                        } else {
                            echo "This mobile is already been registered";
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


        // implement logic


    }
}
?>