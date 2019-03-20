<?php require('header.php');
?>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
        <?php
        /*
          |------------------------------------------------------------------------------------------------
          | Shows Value form input
          |------------------------------------------------------------------------------------------------
         */
        try {
            $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE id = :id");
            $stmt->bindValue('id', $_GET['id']);
            $stmt->execute();
            $Ticviews = $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }



        /*
          |------------------------------------------------------------------------------------------------
          | UPdate Query
          |------------------------------------------------------------------------------------------------
         */

        if (isset($_POST['submit'])) {

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $shortcode = filter_input(INPUT_POST, "shortcode", FILTER_SANITIZE_STRING);

            $errors = array();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (empty($name)) {
                    $errors['name'] = true;

                    echo $msg = "<div class='alert alert-warning fade in'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Name Field! </div>";
                }


                if (empty($errors)) {
                    try {


                        $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE id = :id");
                        $stmt->bindValue('id', $_GET['id']);
                        $stmt->execute();
                        $TID = $stmt->fetch(PDO::FETCH_OBJ);

                        // UPDATE INFORMATION
                        $uID = $userRow['user_id'];
                        $today = date("Y-m-d H:i:s");

                        $stmt = $auth_user->runQuery("UPDATE `ticket_category` 
                                            SET 
                                                `name` 		= '$name', 
                                                `shortcode` 	= '$shortcode', 
                                                `updated_by` 	= '$uID', 
                                                `updated_at` 	= '$today' 
                                            WHERE 
                                                `id` = :id;"
                        );

                        $stmt->bindValue('id', $_GET['id']);
                        

                        $stmt->execute();

                        if ($stmt) {
                            echo "<div class='alert alert-info'><strong>Well done!</strong> Updated Successfully!</div>";
                            echo '<meta http-equiv="refresh" content="1; URL=home.php">';
                        }
                    } catch (PDOException $e) {
                        echo 'ERROR: ' . $e->getMessage();
                    }
                }
            }
        }
?>



<?php 
/*
|---------------------------------------------------------------------------
| Form
|---------------------------------------------------------------------------
*/

?>
	<div class="col-md-6">
		<h3>Edit Ticket Category</h3>

		<form method="POST">

		  <div class="form-group form-group-sm">
		    <label for="CatTic">Edit Ticket Category</label> 
		    <input typ

		    e="text" class="form-control" id="CatTic"  name="name" value="<?php echo $Ticviews->name; ?>" required>
		  </div>
		  <div class="form-group form-group-sm">
		    <label for="Shortcode">Shortcode</label> 
		    <input type="text" class="form-control" id="CatTic"  name="shortcode" value="<?php echo $Ticviews->shortcode; ?>" required>
		  </div>

			<button type="submit" class="btn btn-primary" name="submit">Submit</button>
		</form>

	</div>

	</div>
 </div>	
<?php require('footer.php'); ?>