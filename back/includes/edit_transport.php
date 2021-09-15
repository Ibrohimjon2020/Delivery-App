<?php
if(isset($_GET['c_id'])){
$car_id = $_GET['c_id'];

$query = "SELECT * FROM moshina WHERE moshina_id = $car_id";
$select_moshina = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_moshina)){
    
// nomer viloyatlar bo'yich misol uchun 40 yoki 10
 $nomer_2_xona = $row['nomer_viloyat'];   
    
// nomer qolgan 6 xona misol uchun D846KA yoki G875YT
 $nomer_6_xona = $row['nomer_qolgani'];   
    
 $moshina_izoh = $row['moshina_izoh'];
    
// mashina rasimi
 $image = $row['image'];   
    
 $moshina_turi = $row['moshina_turi']; 

// haydovchi id si
 $car_user_id = $row['car_user_id'];   
}
    $query = "SELECT * FROM users WHERE user_id = $car_user_id";
    $select_user = mysqli_query($connection, $query);
    while($row=mysqli_fetch_assoc($select_user)){   
    $user_firstname = $row['user_firstname'];    
    $user_lastname = $row['user_lastname'];
}
}
?>
<div class="justify-content-center">
    <div class="col-lg-12">
        <h1 class="mt-4">Transport bo'limi.</h1>
        <div class="card shadow-lg border-1 rounded-lg">
            <div class="card-header">
                <h3 class="text-center font-weight-light"> Transport Ma'lumotlari</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="row col-md-6 mt-2">
                                <div class="col-md-4">
                                    <img src="../../img/car_img/<?php echo $image?>" width="100%" alt="user_logo">
                                </div>
                                <div class="col-md-7">
                                    <label for="car_img">Transport rasmi:</label>
                                    <input type="file" name="car_img" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <label for="user_lastname">Nomeri boshi 2 xona:</label>
                                <input type="text" maxlength="2" name="old_2_xona" class="form-control" placeholder="Misol (40)" required value="<?php echo $nomer_2_xona ?>">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label>Nomeri qolgani 6 xona:</label>
                                <input type="text" maxlength="6" name="qolgan_6_xona" class="form-control" placeholder="Misol (D987GA)" required value="<?php echo $nomer_6_xona ?>">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Mashina xolati uchun izoh:</label>
                                <textarea class="form-control" name="izoh" placeholder="Izoh"><?php echo $moshina_izoh ?></textarea>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Mashina turi:</label>
                    <select name="car_type" id="" class="form-control">
                        <option value="<?php echo $moshina_turi ?>"><?php echo $moshina_turi ?></option>
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
                                    <?php 
                                          if($car_user_id == 0){
                                                 echo "<option value='$car_user_id'>Yo'q</option>";
                                                  }
                                         else{
                                             echo "<option value='$car_user_id'>$user_firstname $user_lastname</option>";
                                            }

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
                            <button class="btn btn-primary btn-block mt-3" type="submit" name="edit"><i class="fa fa-pen"></i>  O'zgartirish</button>
                            <button class="btn btn-danger btn-block mt-3" type="submit" name="delete"><i class="fa fa-trash"></i>  O'chirish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

// o'zgartirish
if(isset($_POST['edit'])){
    $car_img = $_FILES['car_img']['name'];
    $car_img_temp = $_FILES['car_img']['tmp_name'];
    move_uploaded_file($car_img_temp, "../../img/car_img/$car_img");

// rasim yo'q bolsa
     if(empty($car_img)){
    $car_img = $image;
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
$query = "SELECT nomer_viloyat, nomer_qolgani FROM moshina WHERE nomer_viloyat = '{$old_2_xona}' && nomer_qolgani = '{$qolgan_6_xona}' && moshina_id != $car_id";
$select_moshina = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_moshina);
$num_nomer = mysqli_num_rows($select_moshina);
if($num_nomer>0){
    
    echo "<script>alert('Bunday mashina raqam bazada bor.')</script>";

}
    
    else{
         // mashina ma'lumotlarini o'zgartirish
$query = "UPDATE moshina SET nomer_viloyat = '{$old_2_xona}', nomer_qolgani = '{$qolgan_6_xona}', moshina_izoh = '{$izoh}', image = '{$car_img}', moshina_turi = '{$car_type}', car_user_id = '{$haydovchi_id}' WHERE moshina_id = $car_id";
$update_query = mysqli_query($connection , $query);
    // 
$query = "UPDATE moshina SET car_user_id = '0' WHERE car_user_id = '{$haydovchi_id}' && moshina_id != '{$car_id}'";
$update_moshina_query = mysqli_query($connection, $query);
        
if($update_moshina_query){
   header ("Location: transport.php?transport=add_transport");
}
        
   }
    
}
// ./ o'zgartirish

###################################################### DELETE ########################################################

// delet qilish 
if(isset($_POST['delete'])){
$query = "DELETE FROM moshina WHERE moshina_id = '{$car_id}'";
$delete = mysqli_query($connection, $query);
    if($delete){
        header("Location: transport.php?transport=add_transport");
    }
}
// ./  delet qilish 
?>
