<?php
require_once("session.php");
require_once("classes/class.user.php");
$auth_user = new USER();
$user_id = $_SESSION['user_session'];
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$Role = ($userRow['user_role']);


try {
    // Query    
    $stmt = $auth_user->runQuery("SELECT * FROM registration WHERE reg_vip_id = 3");
    $stmt->execute();

    // Fetch array associative
    $csvdata = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

               

?>


<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title>Import CSV File Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/jquery.dataTables.min.css" type="text/css"  />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css"  />

  <style type="text/css">
    .panel-heading a{float: right;}
    #importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
  </style>
    </head>

    <body>

<?php require_once('nav.php'); ?>

        <div class="clearfix"></div>



        <div class="container-fluid" style="margin-top:80px;">

            <div class="container">
                <?php 
                    $CSVTicket = end($csvdata);
                 ?>

                   <div class="panel panel-default">
                        <div class="panel-body">Last Inserted 
                            <?php 
                                if ($CSVTicket['vip_id'] == NULL) {
                                    echo 0;
                                } 
                                else{
                                    echo $CSVTicket['vip_id'];
                                }
                            ?>
                        </div>
                    </div>

                <h2>Import CSV File</h2>
                <?php if(!empty($statusMsg)){
                    echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
                } 
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        E-Mangement IMPORT 
                        <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Members</a>
                    </div>
                    <div class="panel-body">
                        <form action="e-mangement-import-data.php" method="post" enctype="multipart/form-data" id="importFrm">
                            <input type="file" name="file" />
                            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                        </form>

                    </div>
                </div>

            </div>

        </div>

<?php require('footer.php') ?>