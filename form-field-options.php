<?php
require('header.php')
?>

<div class="container">
    <h3>Professional Category</h3>

    <?php
    if (isset($_POST['save'])) {

        /*
          |-------------------------------------------------------------------------------------------
          | Check Type ID
          |-------------------------------------------------------------------------------------------
         */
        if (!empty($_POST['type_id'])) {

            if ($_POST['type_id'] == "1") {
                $Type = 'Profession';
            }

            if ($_POST['type_id'] == "2") {
                $Type = 'Gender';
            }

            if ($_POST['type_id'] == "3") {
                $Type = 'ID Type';
            }
        }

        /*
          |-------------------------------------------------------------------------------------------
          | Check Vaild Input fields
          |-------------------------------------------------------------------------------------------
         */
        $errors = array();

        $TypeID = filter_input(INPUT_POST, "type_id", FILTER_SANITIZE_STRING);
        $Name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (empty($TypeID)) {
                $errors['type_id'] = true;

                echo $msg = "<div class='alert alert-warning fade in'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Type ID </div>";
            }

            if (empty($Name)) {
                $errors['name'] = true;
                echo $msg = "<div class='alert alert-warning'>    
                <a class='close' data-dismiss='alert' aria-label='close' title='close'>×</a>
                Please Select Name </div>";
            }

            if (empty($errors)) {


                /*
                  |-------------------------------------------------------------------------------------------
                  | Ticket_category table insert Query
                  |-------------------------------------------------------------------------------------------
                 */

                try {
                    $uID = $userRow['user_id'];

                    $PDO = $auth_user->runQuery("INSERT INTO `ticket_category` (`type_id`, `type_name`, `name`,`created_by`) VALUES (:type_id, :type_name, :name, '$uID')");

                    $PDO->bindValue('type_id', $TypeID);
                    $PDO->bindValue('type_name', $Type);
                    $PDO->bindValue('name', $Name);

                    $PDO->execute();

                    if ($PDO) {
                        echo "<div class='alert alert-success'><strong>Well done!</strong> Record Added Successfully!</div>";
                        echo '<meta http-equiv="refresh" content="2; URL=form-field-options.php">';
                    }
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
            }
        }
    }
    ?>

    <div class="ticket-cat">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Form Field Options</div>
                <div class="panel-body">

                    <form method="post">
                        <div class="form-group">
                            <label for="TypeID">Type ID</label>
                            <select class="form-control" id="TypeID" name="type_id" required>
                                <option selected value="">Choose here</option>
                                <option value="1">Profession</option>
                                <option value="2">Gender</option>
                                <option value="3">ID Type</option>
                            </select>			    


                        </div> 

                        <div class="form-group">
                            <label for="categoryinputname">Name</label>
                            <input type="text" class="form-control" name="name" id="categoryinputname" placeholder="Name" required>
                        </div>

                        <button type="submit" name="save" value="Save" class="btn btn-default">Submit</button>


                    </form>	


                </div>
            </div>


        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                  <div class="panel-heading">Filter Category</div>
                      <div class="panel-body">
                            <div class="filters">
                                <form method="post">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <label for="TypeID">Type ID</label>
                                            <select class="form-control" id="TypeID" name="type_id" required>
                                                <option selected value="">Choose here</option>
                                                <option value="1">Profession</option>
                                                <option value="2">Gender</option>
                                                <option value="3">ID Type</option>
                                                <option value="4">VIP Type</option>
                                                <option value="5">Bulk Type</option>
                                                <option value="6">Ticket Category</option>
                                             </select>              
                                        </div> 
                                            <button type="submit" name="filter" value="Save" class="btn btn-default">GO</button>
                                    </div>

                            </form>
                        
                        </div>

                      </div>
            </div>




<?php
/*
  |------------------------------------------------------------------------------------------------------
  | Category Ticket Filter
  |------------------------------------------------------------------------------------------------------
 */

if (isset($_POST['filter'])) {

    if (!empty($_POST['type_id'])) {
        $type_id = $_POST['type_id'];

        try {

            $PDO = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE `type_id` = '$type_id'");

            $PDO->execute();

            $ticket_filter = $PDO->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        ?>

                    <table class="table table-striped">
                        <tr>
                            <th>Type Name</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>

                    <?php foreach ($ticket_filter as $filters) {
                        ?>
                            <tr>
                                <td><?php echo $filters['type_name']; ?></td>
                                <td><?php echo $filters['name']; ?></td>
                                <td>
                                    <a class="btn btn-default" href="edit-ticket-category.php?id=<?php echo $filters['id']; ?>">Edit</a>
                                </td>

                            </tr>


            <?php }
        ?>
                    </table>
        <?php
    }
}
?>

        </div>
    </div>		
</div>



<?php require('footer.php') ?>