<div class="card-header mb-2">
    <h3 class="text-center font-weight-light">Hodimlar Ma'lumotlari</h3>
</div>

<div class="col-md-12">
    <div class="row">
        <?php                              
$query = "SELECT * FROM users";
$select_taminotchi_query = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_taminotchi_query)){
    $user_id =$row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_phone = $row['user_phone'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    ?>

        <div class="col-md-3">
           
            <div class="card shadow-lg border-1 mt-3 rounded-lg">
        <img height="200px" class="card-img-top cover" width="80px"  src="../../img/user/<?php echo $user_image?>">
            <div class="col-md-12">
             <p class="btn-sm text-center" style="background:#00000070; position:relative; top:-50px"><b class="text-white"><?php echo $user_firstname." ".$user_lastname; ?></b></p>
                  
                   <h5><?php echo $user_role; ?></h5> 
                   <h6 class="ml-1"><small><a href="tel:+998<?php echo "+998{$user_phone}"; ?>"><i class="fa fa-phone"></i><?php echo "  +998{$user_phone}  "; ?></a></small>|</h6>
               </div>
                    <a href="users.php?source=edit_user&u_id=<?php echo $user_id; ?>"><input class="btn btn-info btn-block mb-1" type="button" value="O'zgartirish"></a>
            </div>
     </div>
        <?php } ?>
    </div>
</div>