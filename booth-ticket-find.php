<?php
    require_once("session.php");
    require_once("classes/class.user.php");
    $auth_user = new USER();
    $user_id = $_SESSION['user_session'];
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id" => $user_id));
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $Role = ($userRow['user_role']);
    if ($Role == "Gate") {
        header("Location: in.php");   
    } 
    
    
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
        <?php require_once('nav.php'); ?>
        <div class="clearfix"></div>

        <div class="container-fluid" style="margin-top:80px;">
            <div class="container">
            <div class="banner">
                <img src="image/banner.jpg" alt="" />
            </div>
            <?php require('terms-conditon.php'); ?>                    
                <div class="main" style="padding: 20px;">
                    <div class="col-md-12">
                        <form method="POST">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FindTicket">Find Ticket: </label>
                                    <input type="text" class="form-control" name="find" placeholder="Find Ticket">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <br><button type="submit" name="filter" value="filter" class="btn btn-primary">GO</button>
                            </div>
                        </form>
                        <?php
                            if (isset($_POST['filter'])) {
                                /*
                                  |--------------------------------------------------------------------------------------------
                                  | REG TICKET FIND
                                  |--------------------------------------------------------------------------------------------
                                 */
                            
                                try {
                                    $RegID = $_POST['find'];
                                    $Name = "%" . $_POST['find'] . "%";
                                    $Email = $_POST['find'];
                                    $Mobile = $_POST['find'];
                            
                                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE (reg_vip_id = 0) AND (`reg_id` = '$RegID' OR `name` LIKE '$Name' OR `email` LIKE '%$Email%' OR `mobile` = '$Mobile')");
                            
                                    $PDO->execute();
                                    $result = $PDO->fetchAll(PDO::FETCH_ASSOC);
                            
                            
                            
                                    if ($result) {
                                        ?>
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>RegID</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Print</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php foreach ($result as $value) {
                                        ?>
                                    <tr>
                                        <td><?php echo $value['name'] ?></td>
                                        <td><?php echo $value['reg_id'] ?></td>
                                        <td><?php echo $value['email'] ?></td>
                                        <td><?php echo $value['mobile'] ?></td>
                                        <td><?php echo $value['receive_mail'] ?></td>
                                        <td><?php echo $value['print_receive'] ?></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a class="btn btn-default" href="edit-reg.php?id=<?php echo $value['id'] ?>">Edit</a>
                                            <a class="btn btn-default" href="print.php?id=<?php echo $value['id'] ?>">Print</a>
                                            <a class="btn btn-primary" href="mail.php?id=<?php echo $value['id'] ?>">Mail</a>
                                        </td>
                                    </tr>
                                    <?php
                                        } //endforech
                                        ?>
                                </table>
                        <?php
                            } else {
                                echo '<div class="col-md-12 alert alert-danger" role="alert">Data not found!</div>';
                            }
                            } catch (PDOException $e) {
                            echo 'ERROR: ' . $e->getMessage();
                            }
                            ?>
                        <?php
                            } //endif
                            ?>
                    </div>                    
                </div>
            </div>
        </div>
        <?php require('footer.php') ?>