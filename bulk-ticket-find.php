<?php require('header.php'); ?> 
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
        <div class="col-md-12">
            <form method="POST">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="FindTicket">Find Ticket: </label>
                        <input type="text" class="form-control" name="find" placeholder="Find Ticket" autofocus="autofocus" onfocus="this.value = this.value;">
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

                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE (reg_vip_id = 2) AND (`reg_id` = '$RegID' OR `name` LIKE '$Name' OR `email` LIKE '%$Email%' OR `mobile` = '$Mobile')");

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
                                <th>BK ID</th>
                                <th>Action</th>
                            </tr>

                            <?php foreach ($result as $value) {
                                ?>
                                <tr>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['reg_id'] ?></td>
                                    <td><?php echo $value['email'] ?></td>
                                    <td><?php echo $value['mobile'] ?></td>
                                    <td><?php echo $value['vip_id'] ?></td>
                                    <td>
                                        <a class="btn btn-default" href="edit-bulk.php?id=<?php echo $value['id'] ?>">Edit</a>
                                        <a class="btn btn-default" href="bulk-print.php?id=<?php echo $value['id'] ?>">Print</a>
                                        <!-- <a class="btn btn-primary" href="mail.php?id=<?php echo $value['id'] ?>">Mail</a> -->

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
<?php require('footer.php') ?>