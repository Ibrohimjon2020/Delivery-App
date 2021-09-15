<div class="justify-content-center">
    <div class="col-lg-12">
        <h1 class="mt-4">Transport bo'limi.</h1>
        <div class="card shadow-lg border-1 rounded-lg">
            <div class="card-header">
                <h3 class="text-center font-weight-light"> Yangi transport qo'shish</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                               <a href="#" data-toggle="collapse" data-target="#new_taminotchi" aria-expanded="false" aria-controls="collapseLayouts">
            <button class="btn btn-success btn-block">Yangi Mashina qo'shish <i class="fas fa-angle-down ml-1"></i></button>
            <a href="../admin/transport.php?transport=add_car_type" class="btn btn-dark mt-2" style="float: right;">Mashina turlari <i class="fas fa-angle-right ml-2"></i></a>
        </a>
        <div class="collapse ml-0 mt-5 " id="new_taminotchi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <div class="row">
                            <div class="row col-md-5 mt-2">
                                <div class="col-md-5">
                                    <img src="../images/zil.jpg" width="100%" alt="user_logo">
                                </div>
                                <div class="col-md-6">
                                    <label for="car_img">Transport rasmi:</label>
                                    <input type="file" name="car_img" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <label for="user_lastname">Nomeri boshi 2 xona:</label>
                                <input type="text" maxlength="2" name="old_2_xona" class="form-control" placeholder="Misol (40)" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label>Nomeri qolgani 6 xona:</label>
                                <input type="text" maxlength="6" name="qolgan_6_xona" class="form-control" placeholder="Misol (D987GA)" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Mashina xolati uchun izoh:</label>
                                <textarea class="form-control" name="izoh" placeholder="Izoh"></textarea>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Mashina turi:</label>
                                <select name="car_type" id="" required class="form-control">
                                    <option value=""></option>
<?php 
$query = "SELECT * FROM moshina_turlari";
$select_moshina_turlari = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_moshina_turlari)){
 $car_type_id = $row['car_type_id'];   
 $car_type_nomi = $row['car_type_nomi'];   

?>
                                    <option value="<?php echo $car_type_nomi ?>"><?php echo $car_type_nomi ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Haydovchini tanlang:</label>
                                
                                <!-- haydovchi tanlash -->
                                <select name="haydovchi" class="form-control">
                            <option value="0">yo'q</option>
                                    <?php
    $query = "SELECT user_id, user_firstname, user_lastname FROM users WHERE user_role = 'haydovchi'";
    $select_user = mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($select_user)){
    $user_id = $row['user_id'];    
    $user_firstname = $row['user_firstname'];    
    $user_lastname = $row['user_lastname'];   
    ?>
                                    <option value="<?php echo $user_id ?>"><?php echo $user_firstname." ".$user_lastname ?></option>
                                    <?php   }?>
                                </select>
                            </div>
                            <button class="btn btn-success btn-block mt-3" type="submit" name="add_car">Qo'shish</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- barcha transportlarni ko'rish-->
<?php include "view_transport.php"; ?>
<!-- barcha transportlarni ko'rish-->


<?php
if(isset($_POST['add_car'])){
    
    $car_img = $_FILES['car_img']['name'];
    $car_img_temp = $_FILES['car_img']['tmp_name'];
    move_uploaded_file($car_img_temp, "../../img/car_img/$car_img");

// rasim yo'q bolsa
     if(empty($car_img)){
    $car_img = "zil.jpg";
    }   
    
// mashina nomeri
    $old_2_xona = $_POST['old_2_xona'];
    
    $qolgan_6_xona = $_POST['qolgan_6_xona'];
    
// nomerni bosh hariflarda qiladi misol d874lk ni --> D874LK ga o'tkazadi
  $qolgan_6_xona = strtoupper($qolgan_6_xona);
    
// ./ mashina nomeri

// mashina uchun izoh
    $izoh = $_POST['izoh'];
    
// mashina turi
    $car_type = $_POST['car_type'];
    
// haydovchi tanlash
    $haydovchi_id = $_POST['haydovchi'];
    
 // mashina nomeri uchun validatsiya
$query = "SELECT nomer_viloyat, nomer_qolgani FROM moshina WHERE nomer_viloyat = '{$old_2_xona}' && nomer_qolgani = '{$qolgan_6_xona}'";
$select_moshina = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_moshina);
$num_nomer = mysqli_num_rows($select_moshina);
if($num_nomer>0){
    
    echo "<script>alert('Bunday mashina raqam bazada bor.')</script>";

}
    
    else{
         // hodimlar qo'shish
$query = "INSERT INTO moshina (nomer_viloyat, nomer_qolgani, moshina_izoh, image, moshina_turi, car_user_id)";
$query .= "VALUES('{$old_2_xona}', '{$qolgan_6_xona}', '{$izoh}', '{$car_img}', '{$car_type}', '{$haydovchi_id}')";
$insert_query = mysqli_query($connection , $query);
if($insert_query){
   header ("Location: transport.php?transport=add_transport");
}
        
   }
    
}

?>
