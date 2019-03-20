<?php require('header.php'); ?>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
        <?php 
            if (isset($_POST['filter'])) {
                /*
                |-------------------------------------------------------------------------------------------------------
                | Daily Count Booth Ticket
                |-------------------------------------------------------------------------------------------------------
                */
                $date = $_POST['date'];
                $shortcode = $_POST['booth'];
            
                try {
                    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `vip_type` = '$shortcode' AND `created_at` LIKE '%$date%'");
                    $PDO->execute();
                    $BoothCountTicket = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
            ?>
        <div class="panel panel-default">
            <div class="panel-body">Daily Count : 
                <?php 
                    if ($shortcode == 'BA') {
                        $shortcode = "Abdul Razzaq";
                    }elseif ($shortcode =='BC') {
                      $shortcode = "Booth Bengal Centre";
                    }elseif ($shortcode == 'BL') {
                        $shortcode = "Booth Lucknow";
                    }
                    echo '<b>'.$shortcode.' ' . count($BoothCountTicket).'</b>';
                    ?>
            </div>
        </div>
        <?php
            }
            
            ?>
        <div class="main" style="padding: 20px;">
            <form method="POST">
                <div class="form-group form-group-sm  col-md-3">
                    <label for="Booth">Booth: </label>
                    <select class="form-control" id="booth" name="booth" required>
                        <option value="" selected="" disabled="">Choose here</option>
                        <option value="BC">Bengal Centre</option>
                        <option value="BA">Abdul Razzaq</option>
                        <option value="BL">Lucknow</option>
                    </select>
                </div>
                <div class="form-group form-group-sm col-md-3">
                    <label for="Day">Date: </label>
                    <input class="daily form-control" name="date" type="date" required>
                </div>
                <div class="col-md-3">
                    <br><button type="submit" name="filter" value="filter" class="btn btn-primary">GO</button>
                </div>
            </form>            
        </div>
    </div>
</div>
<?php require('footer.php') ?>