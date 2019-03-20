<?php require('header.php');
?>

<div class="container-fluid" style="margin-top:80px;">

    <div class="container">

        <?php
        /*
          |----------------------------------------------------------------------------------------------------
          | Ticket Type Shows
          |----------------------------------------------------------------------------------------------------
         */
        // type_id 1 == Profession 
        try {

        // Query	
            $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 1');
            $stmt->execute();

        // Fetch array associative
            $professions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        // type_id 2 == Gendar
        try {

            // Query	
            $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 2');
            $stmt->execute();

            // Fetch array associative
            $gendars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }


        // type_id 3 == ID Type
        try {

            // Query	
            $stmt = $auth_user->runQuery('SELECT * FROM `ticket_category` WHERE type_id = 3');
            $stmt->execute();

            // Fetch array associative
            $IDTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        /*
          |------------------------------------------------------------------------------------------------
          | Shows Value form input
          |------------------------------------------------------------------------------------------------
         */
        try {
            $stmt = $auth_user->runQuery("SELECT * FROM `registration` WHERE id = :id");
            $stmt->bindValue('id', $_GET['id']);
            $stmt->execute();
            $Data = $stmt->fetch(PDO::FETCH_OBJ);
            $before = (array) $Data;

        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }

        $id             = $before['id'];
        $ticket_count   = $before['id']+10000;
        $name           = $before['name'];
        $reg_id         = $before['reg_id'];
        $gate           = $before['gate'];
        $receive_mail   = $before['receive_mail'];




        /*
        |-------------------------------------------------------------------------------------------------
        | Function Edit Select Value Shows 
        |-------------------------------------------------------------------------------------------------
        */

        function EditValue($id){
            $auth_user = new USER();
            try {
                $stmt = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE id = '$id'");
                $stmt->bindValue('id', $_GET['id']);
                $stmt->execute();
                $values = $stmt->fetch(PDO::FETCH_OBJ);
                return $values->name;
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }
        }


        /*
          |------------------------------------------------------------------------------------------------
          | UPdate Query
          |------------------------------------------------------------------------------------------------
         */


        if (isset($_POST['update'])) {

            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
            $profession = filter_input(INPUT_POST, "profession", FILTER_SANITIZE_STRING);
            $designation = filter_input(INPUT_POST, "designation", FILTER_SANITIZE_STRING);
            $organization = filter_input(INPUT_POST, "organization", FILTER_SANITIZE_STRING);
            $birth_year = filter_input(INPUT_POST, "birth_year", FILTER_SANITIZE_STRING);
            $id_type = filter_input(INPUT_POST, "id_type", FILTER_SANITIZE_STRING);
            $id_number = filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_STRING);
            $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_STRING);
            $artist_name = filter_input(INPUT_POST, "artist_name", FILTER_SANITIZE_STRING);

            $errors = array();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (empty($name)) {
                    $errors['name'] = true;

                    echo $msg = "<div class='alert alert-warning fade in'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Name Field! </div>";
                }


                if (empty($profession)) {
                    $errors['profession'] = true;
                    echo $msg = "<div class='alert alert-warning'>    
                    <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                    Please Select Profession Field! </div>";
                }



                if (empty($errors)) {
                    try {


                        // UPDATE INFORMATION
                        $uID = $userRow['user_id'];
                        $today = date("Y-m-d H:i:s");

                        $stmt = $auth_user->runQuery("UPDATE `registration` 
                            SET 
                            `name` 		    = '$name',  
                            `address` 		= '$address',  
                            `email` 		= '$email',   
                            `profession` 	= '$profession',  
                            `designation` 	= '$designation',  
                            `organization` 	= '$organization',  
                            `birth_year` 	= '$birth_year',  
                            `id_type` 		= '$id_type',  
                            `id_number` 	= '$id_number',  
                            `gender` 		= '$gender',    
                            `update_at` 	= '$today', 
                            `update_by` 	= '$uID' 

                            WHERE 
                            `id` = :id;"
                        );

                        $stmt->bindValue('id', $_GET['id']);
                        $stmt->execute();

                        /*
                        |------------------------------------------------------------------
                        | After POST
                        |------------------------------------------------------------------
                        */
                        
                        $after = $_POST;
                        array_pop($after); //Last Value remove



                        
                        /*
                        |------------------------------------------------------------------
                        | Differents Values 
                        |------------------------------------------------------------------
                        */                        


                        $pre_info = array_diff($after, $before);


                        /*
                        |------------------------------------------------------------------
                        | Value by json_encode
                        |------------------------------------------------------------------
                        */     

                        $result = json_encode($pre_info);
                        

                        /*
                        |------------------------------------------------------------------
                        | Edit Tracking Users Record 
                        |------------------------------------------------------------------
                        */
                        try {
                            $uID = $userRow['user_id'];
                            $id = $_GET['id'];
                            $PDO = $auth_user->runQuery("INSERT INTO `update_tracker` (`users_id`,`table_name`, `changes_info`,`updated_by`) VALUES ('$id','registration','$result','$uID')");
                            $PDO->execute();
                        } 

                        catch (PDOException $e) {
                            echo 'ERROR: ' . $e->getMessage();
                        }

                        if ($stmt) {
                            echo "<div class='alert alert-info'><strong>Well done!</strong> Updated Successfully!</div>";
                            echo '<meta http-equiv="refresh" content="1; URL=bulk-ticket-find.php">';

                        }



                    } catch (PDOException $e) {
                        echo 'ERROR: ' . $e->getMessage();
                    }
                }
            }
        }


        ?>


        <div class="col-md-8">
            <div class="col-md-12">
                <form method="post">
                    <div class="form-group form-group-sm col-md-12">
                        <h3>EDIT BULK REG FORM</h3>
                        <label for="exampleInputName">Name: </label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $Data->name; ?>" placeholder="Name" required>
                    </div>  


                    <div class="form-group form-group-sm col-md-6">
                        <label for="profession">Profession: </label>

                        <select class="form-control" id="profession" name="profession" required>
                            <option selected value="<?php echo $Data->profession; ?>"><?php echo EditValue($Data->profession); ?></option>

                            <?php
                            foreach ($professions as $profession) {
                                ?>
                                <option value="<?php echo $profession['id']; ?>"><?php echo $profession['name']; ?></option>
                                <?php
                            }
                            ?>



                        </select>
                    </div>

                    <div class="form-group form-group-sm col-md-6">
                        <label for="organization">Organization: </label>
                        <input type="text" name="organization" class="form-control" id="organization" value="<?php echo $Data->organization; ?>" placeholder="Organization">
                    </div>
	


                    <div class="form-group form-group-sm  col-md-6">
                        <label for="Gate">Gate: </label>
                        <span class="required">*</span>
                        <select class="form-control" id="vip" name="gate" required>
                            <option selected value="<?php echo $Data->gate; ?>"><?php echo $Data->gate; ?></option>
                            <option value="14">14</option>    
                            <option value="15">15</option>    
                            <option value="16">16</option>    

                        </select>
                    </div>



                    <div class="form-group form-group-sm col-md-12">
                        <button type="submit" name="update" value="Save" class="btn btn-primary">Updated</button>
                    </div>    
                </form>
            </div>
        </div>	

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-heading">Created Tracker</div>
                <div class="panel-body">
                    <p>Created at : <?php echo $Data->created_at; ?> </p>
                    <p>Created by : <?php echo $Data->created_by; ?> </p>
                </div>
            </div>           

             <div class="panel panel-default">
                <div class="panel-heading">Updated Tracker</div>
                <div class="panel-body">
                <?php 
                    try {
                        $id = $_GET['id'];
                        $stmt = $auth_user->runQuery("SELECT * FROM `update_tracker` WHERE users_id = '$id' ORDER BY id DESC");
                        $stmt->execute();
                        $UpdatedData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        //var_dump($UpdatedData);

                      
                    } catch (PDOException $e) {
                        echo 'ERROR: ' . $e->getMessage();
                    }

                        function ShortcodeName ($table,$id,$column_name,$table_id){
                            $auth_user = new USER();
                            $stmt = $auth_user->runQuery("SELECT * FROM $table WHERE $table_id = $id");
                            $stmt->execute();
                            $shortcode = $stmt->fetchAll(PDO::FETCH_ASSOC);   
                            return $shortcode[0][$column_name];                            
                        }



                        foreach ($UpdatedData as  $Changeinfo) {
                             $info = ($Changeinfo['changes_info']);


                             echo "<ul>";
                             $jsondata = json_decode($info);

                             if (!empty($jsondata )) {
                                 foreach ($jsondata as $keys => $value) {
                                    //echo str_replace('_', ' ', ucfirst($keys)).' - ' . $value  . "<br>";
                                    if ($keys === 'id_type' || $keys === 'gender' || $keys === 'profession' ) {
                                        echo str_replace('_', ' ', ucfirst($keys)).' - ' . ShortcodeName('ticket_category', $value, 'name','id') . "<br>";
                                    }else{
                                        echo str_replace('_', ' ', ucfirst($keys)).' - ' . $value  . "<br>";
                                    }
                                 }                                 
                             }

                                echo "Updated At: " . $Changeinfo['updated_at'] ."<br>";
                                echo "Updated By : " . ShortcodeName('users', $Changeinfo['updated_by'], 'user_name', 'user_id')  ."<br>";
                                echo "<hr>";
                            echo "</ul>";
                        }


              

                 ?>
                </div>
            </div>

        </div>


    </div>

</div>
<?php require('footer.php') ?>