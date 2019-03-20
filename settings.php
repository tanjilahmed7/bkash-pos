<?php require('header.php'); ?>
<style>
    .sendgrid,.phpmailer{
    display: none!important;
    }
</style>
<div class="container-fluid" style="margin-top:80px;">
<div class="container">
    <?php 
        /*
          |------------------------------------------------------------------------------------------------
          | PHP MAILER
          |------------------------------------------------------------------------------------------------
         */
          try {
              $stmt = $auth_user->runQuery("SELECT * FROM `mail_settings` WHERE id = 1");
              $stmt->execute();
              $phpmailer_info = $stmt->fetch(PDO::FETCH_OBJ);
        
          } catch (PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
          }        
          /*
          |------------------------------------------------------------------------------------------------
          | SendGrid
          |------------------------------------------------------------------------------------------------
         */
          try {
              $stmt = $auth_user->runQuery("SELECT * FROM `mail_settings` WHERE id = 2");
              $stmt->execute();
              $sendgrid_info = $stmt->fetch(PDO::FETCH_OBJ);
        
          } catch (PDOException $e) {
              echo 'ERROR: ' . $e->getMessage();
          }
        
          /* 
          |------------------------------------------------------------------------
          | PHPMAILER
          |-----------------------------------------------------------------------
          */
            $from       = filter_input(INPUT_POST, "from", FILTER_SANITIZE_STRING);
            $host       = filter_input(INPUT_POST, "host", FILTER_SANITIZE_STRING);
            $username   = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
            $password   = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
            $port       = filter_input(INPUT_POST, "port", FILTER_SANITIZE_STRING); 
            $subject    = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING); 
            $smtp       = filter_input(INPUT_POST, "smtp", FILTER_SANITIZE_STRING); 
        
          /* 
          |------------------------------------------------------------------------
          | Sendgrid
          |-----------------------------------------------------------------------
          */
            $sfrom       = filter_input(INPUT_POST, "sfrom", FILTER_SANITIZE_STRING);   
            $sname       = filter_input(INPUT_POST, "sname", FILTER_SANITIZE_STRING);   
            $ssubject    = filter_input(INPUT_POST, "ssubject", FILTER_SANITIZE_STRING);   
            $api        = filter_input(INPUT_POST, "api", FILTER_SANITIZE_STRING);    
        
            if (isset($_POST['phpmailer'])) {
                    $errors = array();
        
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                    if (empty($host)) {
                        $errors['host'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert host! </div>";
                    }                   
                                         
        
                    if (empty($username)) {
                        $errors['username'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert User! </div>";
                    }                   
                     
                    if (empty($password)) {
                        $errors['password'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert password! </div>";
                    }                    
                    if (empty($port)) {
                        $errors['port'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert port! </div>";
                    }                    
        
                    if (empty($smtp)) {
                        $errors['smtp'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert Smtp! </div>";
                    }
        
                    if (empty($subject)) {
                        $errors['subject'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert Subject! </div>";
                    }                    
                    if (empty($from)) {
                        $errors['from'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert From! </div>";
                    }
                    else{
                          $stmt = $auth_user->runQuery("UPDATE `mail_settings` 
                                            SET 
                                                `mail`             = 'phpmailer', 
                                                `mail_usernme`     = '$username', 
                                                `mail_password`    = '$password', 
                                                `mail_port`        = '$port', 
                                                `mail_host`        = '$host', 
                                                `mail_from`        = '$from', 
                                                `mail_subject`     = '$subject', 
                                                `mail_smtp`        = '$smtp' 
        
                                            WHERE 
                                                `id` = 1"
                        );
        
        
                       $stmt->execute();
                        $stmt = $auth_user->runQuery("UPDATE `mail_settings` SET `status` = 1 WHERE `id` = 1");
                        $stmt->execute();                          
                        $stmt = $auth_user->runQuery("UPDATE `mail_settings` SET `status` = 0 WHERE `id` = 2");
                        $stmt->execute();
                        if ($stmt) {
                            echo "<div class='alert alert-info'><strong>Well done!</strong> Updated Successfully!</div>";
                            echo '<meta http-equiv="refresh" content="1; URL=settings.php">';
                        }
        
                    }
                }
            }
        
            if (isset($_POST['sendgrid'])) {
                    $errors = array();
        
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                    if (empty($api)) {
                        $errors['api'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert api! </div>";
                    }                      
        
                    if (empty($sfrom)) {
                        $errors['sfrom'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert From! </div>";
                    }                         
        
                    if (empty($sname)) {
                        $errors['sname'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert Name! </div>";
                    }   
        
                    if (empty($ssubject)) {
                        $errors['ssubject'] = true;
                        echo $msg = "<div class='alert alert-warning fade in'>    
                        <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                        Please insert Subject! </div>";
                    }                   
                                         
                    else{
                          $stmt = $auth_user->runQuery("
                                                        UPDATE `mail_settings` SET 
                                                                                  `mail_api`      = '$api',
                                                                                  `mail_from`     = '$sfrom',
                                                                                  `mail_name`     = '$sname',
                                                                                  `mail_subject`  = '$ssubject'
                                                                              WHERE `id` = 2"
                                                      );
                          $stmt->execute(); 
                          $stmt = $auth_user->runQuery("UPDATE `mail_settings` SET `status` = 1 WHERE `id` = 2");
                          $stmt->execute();                          
                          $stmt = $auth_user->runQuery("UPDATE `mail_settings` SET `status` = 0 WHERE `id` = 1");
                          $stmt->execute();
        
                        if ($stmt) {
                            echo "<div class='alert alert-info'><strong>Well done!</strong> Updated Successfully!</div>";
                            echo '<meta http-equiv="refresh" content="1; URL=settings.php">';
                        }
        
                    }
                }
            }
        
        
         ?>  
              
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div id="inputArea"></div>
                    <label for="">Mail Settings</label>
                    <select  class="form-control" id="dropdownlist">
                        <option>Select...</option>
                        <option value="1">Php Mailer</option>
                        <option value="2">Sendgrid</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="main">         
            <div class="phpmailer">
                <h3>PHP MAILER</h3>
                <form class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">From</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_from; ?>" name="from" placeholder="From" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Host</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_host; ?>" name="host" placeholder="Host" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_usernme; ?>" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_password; ?>"  name="password" id="inputPassword3" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Port</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_port; ?>" name="port" placeholder="Port" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_subject; ?>" name="subject" placeholder="Subject" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Smtp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $phpmailer_info->mail_smtp; ?>" name="smtp" placeholder="Smtp" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <?php 
                                if ($phpmailer_info->status == 1){
                                  echo '<p style="color:red;font-weight:bold;padding-top:5px;">Active</p>';
                                }
                                else{
                                ?>
                            <select id="inputStatus" class="form-control" required>
                                <option value="" selected>Choose...</option>
                                <option value="0" disabled> Deactivate </option>
                                <option value="1"> Active </option>
                            </select>
                            <?php   
                                } 
                                ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" value="phpmailer" name="phpmailer" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="sendgrid">
                <h3>SendGrid</h3>
                <form class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">From</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $sendgrid_info->mail_from; ?>" name="sfrom" placeholder="From" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $sendgrid_info->mail_name; ?>" name="sname" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $sendgrid_info->mail_subject; ?>" name="ssubject" placeholder="Subject" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">API</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $sendgrid_info->mail_api; ?>" name="api" placeholder="API" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <?php 
                                if ($sendgrid_info->status == 1){
                                  echo '<p style="color:red;font-weight:bold;padding-top:5px;">Active</p>';
                                }
                                else{
                                ?>
                            <select id="inputStatus" class="form-control" required>
                                <option value="" selected>Choose...</option>
                                <option value="0" disabled> Deactivate </option>
                                <option value="1"> Active </option>
                            </select>
                            <?php   
                                } 
                                ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" value="sendgrid" name="sendgrid" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>        
</div>
<script>
    $("#dropdownlist").change(function () {
          var numInputs = $(this).val();
          $("#inputArea").html(numInputs);
          var x;
          if (numInputs == "1") {
            var x = '<style>.sendgrid{display:none}.phpmailer{display:block!important;}</style>';
          }
          else if(numInputs == "2"){
            var x = '<style>.sendgrid{display:block!important;}.phpmailer{display:none;}</style>';
          }
          else{
            var x = '';
          }
    
          document.getElementById("inputArea").innerHTML = x;
    
        });         
    
    
</script>
<?php require('footer.php') ?>