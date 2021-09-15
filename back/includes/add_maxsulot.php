<!--bazaga taminotni qo`shish-->
<?php
if(isset($_POST['add_maxsulot'])){
// maxsulot                       
$product = $_POST['product']; 
$product = mysqli_real_escape_string($connection, $product);

    
// maxsulot active or not active
    $status = $_POST['status'];                
                  
// maxsulot rasimi   
    $product_img = $_FILES['product_img']['name'];
    $product_img_temp = $_FILES['product_img']['tmp_name'];
    move_uploaded_file($product_img_temp, "../images/maxsulotlar/$product_img");

    
// maxsulot turini kiritish misol uchun G'isht, Qum, Shag'al
$query = "INSERT INTO maxsulot_turi(maxsulot_nomi, status)";
$query .="VALUES('{$product}', '{$status}')";
$insert_maxsulot_turi = mysqli_query($connection, $query);
//./ maxsulot turini kiritish misol uchun G'isht, Qum, Shag'al
  
    
// moshina turlai qancha bolsa shu maxsulotdan shuncha qoshiladi                       
$query = "SELECT car_type_nomi FROM moshina_turlari";
$select_moshina_turlari = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_moshina_turlari)){
 $car_type_nomi = $row['car_type_nomi'];   
        // bazaga insert qilish
$query2 = "INSERT INTO maxsulotlar(maxsulot_nomi, olchov, data, status, img) ";
$query2 .="VALUES('{$product}', '{$car_type_nomi}', now(), '{$status}', '{$product_img}')";
$insert_product = mysqli_query($connection, $query2);
    
    if($insert_product){
       header("Location: faoliyat.php");
    }
 }      
    
// ./moshina turlai qancha bolsa shu maxsulotdan shuncha qoshiladi 
    
    }
?>
<!--bazaga taminotni qo`shish-->

<!--   Yangi maxsulot qo'shish drapdown-->
<div class="col-md-12">
    <form action="" method="post" enctype="multipart/form-data">
        <a href="#" data-toggle="collapse" data-target="#new_taminotchi" aria-expanded="false" aria-controls="collapseLayouts">
            <button class="btn btn-info btn-block my-4 ">Yangi maxsulot qo'shish <i class="fas fa-angle-down ml-1"></i></button>
        </a>
        <div class="collapse ml-0 mt-5 " id="new_taminotchi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <div class="row">
            <div class="col-md-7 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="../images/maxsulotlar/Default/shibyonka.jpg" width="100%" alt="maxsulot_rasmi">
                        </div>
                        <div class="col-md-5">
                            <label for="user_passport">Maxsulot surati: </label>
                            <input type="file" name="product_img" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="user_passport">Maxsulot activ</label>
                            <div class="input-group">
                                <select name="status" class="form-control">
                                    <option value="activ">activ</option>
                                    <option value="not_activ">not activ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taminot_product">
                           Mahsulot
                        </label>
                        <input type="text" class="form-control" name="product" placeholder="Mahsulot  kiriting" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-block btn-success mb-4" name="add_maxsulot">Qo'shish</button>
        </div>
    </form>
</div>
<!--   ./Yangi maxsulot qo'shish drapdown-->
<?php include "maxsulotlarni_korish.php" ?>