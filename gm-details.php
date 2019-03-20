<?php 
require('header.php');
/*
|---------------------------------------------------------------
| ALL MOBILE SMS TICKET DETAILS
|---------------------------------------------------------------
*/
$id = $_GET['id'];
try {
    $PDO = $auth_user->runQuery("SELECT * FROM `registration` WHERE `vip_type` = '$id'");
    $PDO->execute();
    $TotalGMDetails = $PDO->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}


?>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>RegID</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Profession</th>
                <th>Gate</th>
                
            </tr>
        </thead>

        <tbody>
        	<?php foreach ($TotalGMDetails as $value) {
			?>
			<tr>
				<td> <?php echo $value['name']?> </td>
				<td> <?php echo $value['reg_id']?> </td>
				<td> <?php echo $value['email']?> </td>
				<td> <?php echo $value['mobile']?> </td>
				<td> <?php echo $value['profession']?> </td>
				<td> <?php echo $value['gate']?> </td>
			</tr>
			<?php	
        	} 
        	?>

        </tbody>
    </table>



	</div>
 </div>	
<?php require('footer.php'); ?>