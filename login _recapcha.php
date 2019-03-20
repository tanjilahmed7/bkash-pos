<?php 
/* SESSION START */
session_start();
require_once("classes/class.user.php");

/* OBJECT */
$login = new USER();

if ($login->is_loggedin() != "") {
    $login->redirect('home.php');
}


if(isset($_POST['btn-login'])):
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
        //your site secret key
        $secret = '6Lc1ZwkUAAAAAEHhfAc8ykj_n9A4ZVydvaOGP6xZ';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):

            $uname = strip_tags($_POST['txt_uname_email']);
            $umail = strip_tags($_POST['txt_uname_email']);
            $upass = strip_tags($_POST['txt_password']);

            if ($login->doLogin($uname, $umail, $upass)) {
                $login->redirect('home.php');
            } else {
                echo "<div class='alert alert-warning'>Wrong Details !</div>";
            }
   
        else:
            echo "<div class='alert alert-warning'>Robot verification failed, please try again.</div>";
        endif;
    else:
        echo "<div class='alert alert-warning'>Please click on the reCAPTCHA box</div>";
    endif;
else:
    $errMsg = '';
    $succMsg = '';
endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>




<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log In to Aarong Festival REG.</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>

        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
     	<hr />

        <div class="form-group form-group-sm col-md-12" style="padding-left:0">
          <div class="g-recaptcha" data-sitekey="6Lc1ZwkUAAAAANdYL2hraKnEPHNId-OQPgd-5Vg1"></div>
        </div>
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  



      	<br />
            
      </form>

    </div>
    
</div>

</body>
</html>