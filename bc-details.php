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

          $UserData = new USER();

          $data = $UserData->ViewData($_GET['id'],'BC');
 
        ?>

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>RegID</th>
                <th>Address</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Profession</th>
                <th>ID Type</th>
                <th>ID number</th>
                <th>Gate</th>
                
            </tr>
        </thead>

        <tbody>
          <?php  
            foreach ($data as $value) {
           ?>
            <tr>
                <td><?php echo $value->name; ?></td>
                <td><?php echo $value->reg_id; ?></td>
                <td><?php echo $value->address; ?></td>
                <td><?php echo $value->email; ?></td>
                <td><?php echo $value->mobile; ?></td>
                <td><?php $ALLProfession = $UserData->ViewProssion($value->profession); echo ($ALLProfession[0]->name); ?></td>
                <td><?php $IDType = $UserData->ViewProssion($value->id_type); echo ($IDType[0]->name); ?></td>
                <td><?php echo $value->id_number; ?></td>
                <td><?php echo $value->gate; ?></td>
            </tr>  
           <?php
            }
          ?>


        </tbody>
    </table>



  </div>
 </div> 
<?php require('footer.php'); ?>