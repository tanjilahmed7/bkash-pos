<?php 
/*
|------------------------------------------------------
| DB Connection
|------------------------------------------------------
*/
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();
$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$Role = ($userRow['user_role']);
?>

<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<link rel="stylesheet" href="bootstrap/css/jquery.dataTables.min.css" type="text/css"  />
<title>Aarong Festival</title>
</head>
<body>
<?php //require_once('nav.php'); ?>

    <div class="clearfix"></div>
      
  <div class="container-fluid" style="margin-top:80px;">
    <div class="container"> 
    <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a> 
<?php

if(isset($_REQUEST['Submit']))
{
    $status = 1;
    $bar = $_REQUEST['bar'];
    try {
      // Query    
      $stmt = $auth_user->runQuery("SELECT * FROM registration WHERE reg_id = '$bar'");
      $stmt->execute();
      // Fetch array associative
      $regrow = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
    }
      //getting present time
      date_default_timezone_set('Asia/Dhaka');
      $currentdt = date("Y-m-d H:i:s");
      $startTime = date("Y-m-d H:i:s",strtotime("-720 minutes",strtotime($currentdt)));
      if($regrow)
      {
            /*
            |-----------------------------------------------------
            | Check Day Entry
            |-----------------------------------------------------
            */
            date_default_timezone_set('Asia/Dhaka');
            $CurrentDateTime = date('Y-m-d H:i:s');

            $d1 = '2017-12-26 12:00:00';
            $d2 = '2017-12-27 12:00:00';
            $d3 = '2017-12-28 12:00:00';
            $d4 = '2017-12-29 12:00:00';
            $d5 = '2017-12-30 12:00:00';
            $d6 = '2017-12-31 12:00:00';


            if ($CurrentDateTime>=$d1 && $CurrentDateTime<$d2) {
              $MusicFestDay = "1";
            }elseif ($CurrentDateTime>=$d2 && $CurrentDateTime<$d3) {
              $MusicFestDay = "2";
            }elseif ($CurrentDateTime>=$d3 && $CurrentDateTime<$d4) {
              $MusicFestDay = "3";
            }elseif ($CurrentDateTime>=$d4 && $CurrentDateTime<$d5) {
              $MusicFestDay = "4";
            }elseif ($CurrentDateTime>=$d5 && $CurrentDateTime<$d6) {
              $MusicFestDay = "5";
            }

              try {
                  $Name     = $regrow[0]['name'];
                  $Address  = $regrow[0]['address'];
                  $Ph       = $regrow[0]['mobile'];
                  $Email    = $regrow[0]['email'];
                  $RegGate  = $regrow[0]['gate'];
                  $PDO = $auth_user->runQuery("INSERT INTO log_info (RegNumber, MemDT, RegGate, Status, RegEvent,day) values('$bar', '$currentdt','6', $status, 'AF2018','$MusicFestDay')");
                  $PDO->execute();

              } catch (PDOException $e) {
                  echo 'ERROR: ' . $e->getMessage();
              }

              try {
                // Query    
                $stmt = $auth_user->runQuery("SELECT * FROM log_info WHERE RegNumber='$bar' AND ( MemDT between '$startTime' and '$currentdt' ) order by MemDT desc");
                $stmt->execute();
                // Fetch array associative
                $selgrow = $stmt->fetchAll(PDO::FETCH_ASSOC);
              } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
              }
            }

            else{
              echo "<div class='alert alert-warning'><strong>Notice!</strong> Not Available Registration ID!</div>";
              echo '<meta http-equiv="refresh" content="3; URL=gate-1-in.php">';
            }

}

    
?>



        <h1 class="form-label dt" style="text-align: center;">Registration Form (Entry)</h1>

          <form id="form1" name="form1" method="post" action="">

            <div class="form-group form-group-sm col-md-6 col-md-offset-3">
              <label for="categoryinputname">Registration ID</label>
              <input type="text" class="form-control inputSuccess4" name="bar" value="" autofocus="autofocus" onfocus="this.value = this.value;">
            </div>

            <div class="form-group form-group-sm col-md-2" style="margin-top:20px;">
                <button type="Submit" class="btn btn-default" name="Submit" id="Submit" value="Search">Search</button> 
            </div>       
            <!-- <input type="Submit" name="Submit" id="Submit" value="Search" style="text-align:center;" /> -->
            
          </form>

          <div class="checkin col-md-12">

          <?php 
            if (!empty($selgrow)) {
            ?> 
            <div class="col-md-6">
              <h1>Information</h1>
  
                <h4>REG ID : <?php echo $regrow[0]['reg_id'] ?></h4> 
                <h4>Name: <?php echo $regrow[0]['name'] ?></h4> 
                <h4>Address: <?php echo $regrow[0]['address'] ?></h4> 
                <h4>Mobile: <?php echo $regrow[0]['mobile'] ?></h4> 
                <h4>Email: <?php echo $regrow[0]['email'] ?></h4> 
                <h4>Gate: <?php echo $regrow[0]['gate'] ?></h4> 
                <h4>Referred By: <?php echo $regrow[0]['referred_by'] ?></h4> 
            </div> 

            <div class="col-md-6">
              <h1>Log Info</h1>
              <table class="table table-bordered"> 
                <thead> 
                  <tr> 
                    <th>Date</th> 
                    <th>Time</th> 
                    <th>Day</th> 
                    <th>Gate</th> 
                    <th>Day</th> 
                  </tr>
                </thead> 
                <tbody> 
                <?php foreach ($selgrow as $log) {
                ?>
                  <tr> 
                    <td><?php echo date('d/m/Y', strtotime($log['MemDT']));?></td>
                    <td><?php echo date('H:i:s', strtotime($log['MemDT']));?></td>
                    <td><?php echo date('l', strtotime($log['MemDT']));?></td>
                    <td><?php echo $log['RegGate'] ?></td>
                    <td><?php echo $log['day'] ?></td>
                 </tr> 
                <?php
                } 
                ?>
                </tbody> 
              </table> 
            </div> 

         <?php   
            }
          ?>


        </div>
    </div>



    </div>
  </div>
<?php require('footer.php') ?>