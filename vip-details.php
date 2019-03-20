<?php require('header.php');
?>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">

    	<?php 
    		$id = $_GET['id'];
		    try {
		        $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `vip_type` = '$id'");
		        $PDO->execute();
		        $VIPData = $PDO->fetchAll(PDO::FETCH_ASSOC);

		    } catch (PDOException $e) {
		        echo 'ERROR: ' . $e->getMessage();
		    }

 		?>


        <?php
        /*
          |------------------------------------------------------------------------------------------------
          | Shows Value form input
          |------------------------------------------------------------------------------------------------
         */


        ?>
    <div class="main" style="padding: 20px;">
 	    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Referred by:</th>
                <th>Request by:</th>
                <th>VIP Type</th>
                <th>Gate</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($VIPData as $value) {
       	?>
       	   <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['referred_by'] ?></td>
                <td><?php echo $value['details_info'] ?></td>
                <td><?php echo $value['vip_type'] ?></td>
                <td><?php echo $value['gate'] ?></td>
            </tr>  
       	<?php
        } ?>	
 
        </tbody>
        </table>
    </div>


	</div>
 </div>	
<?php require('footer.php'); ?>