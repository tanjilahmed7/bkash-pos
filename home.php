<?php require('header.php'); ?>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
        <?php 
            function CATNAME($shortcode){
                /*
                |-------------------------------------------------------------------------------------------------------
                | Show Category Name
                |-------------------------------------------------------------------------------------------------------
                */
                $auth_user = new USER();
                try {
                    $PDO = $auth_user->runQuery("SELECT * FROM `ticket_category` WHERE `shortcode` = '$shortcode'");
                    $PDO->execute();
                    $CatName = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
                    return $CatName[0]['name'];
            
            
                } catch (PDOException $e) {
                    echo 'ERROR: ' . $e->getMessage();
                }
            }
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | ALL Shortcode
            |-------------------------------------------------------------------------------------------------------
            */
            
            function ALLCOUNT($id){
                $auth_user = new USER();
                /*
                |-------------------------------------------------------------------------------------------
                | VIP REG COUNT GROUP BY
                |-------------------------------------------------------------------------------------------
                */
                try {
                    $PDO = $auth_user->runQuery("SELECT vip_type, COUNT(*) FROM `registration` WHERE `reg_vip_id` = '$id' GROUP BY vip_type");
                    $PDO->execute();
                    $VGC = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
                    //var_dump($VGC);
            
                    foreach ($VGC as $value) {
                    ?>
                    <a href="vip-details.php?id=<?php echo $value['vip_type'];?>">
                        <li><?php echo CATNAME($value['vip_type'])." :";?> <?php  echo $value['COUNT(*)']; ?></li>
                    </a>
                    <?php    
                }
            
            
            //var_dump($Shortcoderow);
            
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            } 
            
            }
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All WEB
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND vip_type = 'GW'");
            $PDO->execute();
            $TotalGWCOUNT = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
                        
            try {
            $PDO = $auth_user->runQuery("SELECT ticket_category.`id`, ticket_category.`name`, COUNT(ticket_category.`name`) AS TOTAL FROM `profession_category` LEFT JOIN ticket_category ON profession_category.`profession` = ticket_category.id WHERE profession_category.ticket_type = 'GW' GROUP BY ticket_category.`name`");
            $PDO->execute();
            $TotalProfessionWeb = $PDO->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All VIP COUNT
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 1");
            $PDO->execute();
            $TotalvIPCOUNT = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All BULK COUNT
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 2");
            $PDO->execute();
            $TotalBKCOUNT = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All IN HOUSE COUNT
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 3");
            $PDO->execute();
            $TotalINHCOUNT = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All Total Ticket
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(id) AS TOTALREG FROM `registration`");
            $PDO->execute();
            $TotalTicketCount = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All Booth Bus COUNT
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND `vip_type` = 'BM'");
            $PDO->execute();
            $Booth_Mail = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All Booth Abdul Razzak
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND `vip_type` = 'BA'");
            $PDO->execute();
            $Booth1 = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }

            try {
            $PDO = $auth_user->runQuery("SELECT ticket_category.`id`, ticket_category.`name`, COUNT(ticket_category.`name`) AS TOTAL FROM `profession_category` LEFT JOIN ticket_category ON profession_category.`profession` = ticket_category.id WHERE profession_category.ticket_type = 'BA' GROUP BY ticket_category.`name`");
            $PDO->execute();
            $TotalProfessionBA = $PDO->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }

            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All Mobile SMS Ticket
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND `vip_type` = 'GM'");
            $PDO->execute();
            $GM = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All BC
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND `vip_type` = 'BC'");
            $PDO->execute();
            $BC = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            try {
            $PDO = $auth_user->runQuery("SELECT ticket_category.`id`, ticket_category.`name`, COUNT(ticket_category.`name`) AS TOTAL FROM `profession_category` LEFT JOIN ticket_category ON profession_category.`profession` = ticket_category.id WHERE profession_category.ticket_type = 'BC' GROUP BY ticket_category.`name`");
            $PDO->execute();
            $TotalProfessionBC = $PDO->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show All BL
            |-------------------------------------------------------------------------------------------------------
            */
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`reg_vip_id`) AS TOTAL FROM `registration` WHERE `reg_vip_id` = 0 AND `vip_type` = 'BL'");
            $PDO->execute();
            $BL = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            try {
            $PDO = $auth_user->runQuery("SELECT ticket_category.`id`, ticket_category.`name`, COUNT(ticket_category.`name`) AS TOTAL FROM `profession_category` LEFT JOIN ticket_category ON profession_category.`profession` = ticket_category.id WHERE profession_category.ticket_type = 'BL' GROUP BY ticket_category.`name`");
            $PDO->execute();
            $TotalProfessionBP = $PDO->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }            
            
            
            /*
            |-------------------------------------------------------------------------------------------------------
            | Show Day COUNT
            |-------------------------------------------------------------------------------------------------------
            */
            
            function DAYAF($day){
            $auth_user = new USER();
            
            try {
            $PDO = $auth_user->runQuery("SELECT COUNT(`MemId`) AS TOTAL FROM `log_info` WHERE `day` = '$day'");
            $PDO->execute();
            $Day = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            return $Day[0]['TOTAL'];
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            }
            
            try {
            $PDO = $auth_user->runQuery("SELECT RegGate, COUNT(*) AS TOALGATE FROM log_info WHERE day = '5' GROUP BY `RegGate`");
            $PDO->execute();
            $ALLGateCount = $PDO->fetchAll(PDO::FETCH_ASSOC);
            
            } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            }
            
            
            
            
            if ($Role == "Admin"){
            ?>        
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Total Ticket
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $TotalTicketCount[0]['TOTALREG']; ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Booth Mail
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $Booth_Mail[0]['TOTAL']; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            WEB
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $TotalGWCOUNT[0]['TOTAL']; ?></h4>
                        <?php 
                            foreach ($TotalProfessionWeb as $value) {
                        ?>
                            <li><a href='gw-details.php?id=<?php echo $value['id'] ?>'><?php echo $value['name'] .' ' . $value['TOTAL']; ?></a></li>
                        <?php
                            }
                         ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Booth Abdul Razzak
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $Booth1[0]['TOTAL']; ?></h4>
                        <?php 
                            foreach ($TotalProfessionBA as $value) {
                        ?>
                            <li><a href='ba-details.php?id=<?php echo $value['id'] ?>'><?php echo $value['name'] .' ' . $value['TOTAL']; ?></a></li>
                        <?php
                            }
                         ?>                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Bengal Centre
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $BC[0]['TOTAL']; ?></h4>
                        <?php 
                            foreach ($TotalProfessionBC as $value) {
                        ?>
                            <li><a href='bc-details.php?id=<?php echo $value['id'] ?>'><?php echo $value['name'] .' ' . $value['TOTAL']; ?></a></li>
                        <?php
                            }
                         ?>                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Lucknow
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $BL[0]['TOTAL']; ?></h4>
                        <?php 
                            foreach ($TotalProfessionBP as $value) {
                        ?>
                            <li><a href='gw-details.php?id=<?php echo $value['id'] ?>'><?php echo $value['name'] .' ' . $value['TOTAL']; ?></a></li>
                        <?php
                            }
                         ?>                         
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            IN
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $TotalINHCOUNT[0]['TOTAL']; ?></h4>
                        <ul class="count">
                            <?php echo ALLCOUNT(3); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            BULK
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $TotalBKCOUNT[0]['TOTAL']; ?></h4>
                        <ul class="count">
                            <?php echo ALLCOUNT(2); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            VIP
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>TOTAL: <?php echo $TotalvIPCOUNT[0]['TOTAL']; ?></h4>
                        <ul class="count">
                            <?php echo ALLCOUNT(1); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Day 1 IN
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>Total : <?php echo DAYAF(1); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Day 2 IN
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>Total : <?php echo DAYAF(2); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Day 3 IN
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>Total : <?php echo DAYAF(3); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Day 4 IN
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>Total : <?php echo DAYAF(4); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Day 5 IN
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>Total : <?php echo DAYAF(5); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                foreach ($ALLGateCount as  $GateCount) {
                ?>
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Gate <?php echo $GateCount['RegGate'] ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <h4>Total : <?php echo $GateCount['TOALGATE']; ?></h4>
                    </div>
                </div>
            </div>
            <?php
                }          
                
                ?>  
        </div>
        <?php 
            }
            
            ?>
    </div>
</div>
</div>
<?php require('footer.php') ?>