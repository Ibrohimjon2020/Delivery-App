<?php 
if(isset($_GET['m_id'])){
$maxsulot_id = $_GET['m_id'];

$query = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id = '{$maxsulot_id}'";
$select_maxsulotlar_turi = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_maxsulotlar_turi);
$maxsulot_nomi = $row['maxsulot_nomi'];

    
$query1 = "SELECT * FROM maxsulotlar WHERE maxsulot_nomi = '{$maxsulot_nomi}'";
$select_maxsulotlar = mysqli_query($connection, $query1);
while($row=mysqli_fetch_assoc($select_maxsulotlar)){
$status = $row['status'];
$img = $row['img'];
    
}
    
}
?>
<div class="card shadow-lg border-1 rounded-lg">
    <div class="card-header">
        <h3 class="text-center font-weight-light"><?php echo $maxsulot_nomi ?> ma'lumotlarini o'zgartirish</h3>
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="row col-md-4 mt-2">
                        <div class="col-md-4">
                            <img src="../images/maxsulotlar/<?php echo $img;?>" width="100%" alt="<?php echo $maxsulot_nomi ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="user_image">Maxsulot rasmi:</label>
                            <input type="file" name="product_img" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4 mt-2">
                        <label for="user_login">Maxsulot Nomi:</label>
                        <input type="text" name="product" class="form-control" value="<?php echo $maxsulot_nomi; ?> ">
                    </div>

                    <div class="col-md-4 mt-2">
                        <label for="">Maxsulot :</label>
                        <select name="status" class="form-control">
                            <option value="<?php echo $status; ?>"><?php echo $status; ?> </option>
                            <option value="activ">activ</option>
                            <option value="not_activ">not_activ</option>
                        </select>
                    </div>                   
                    <button class="btn btn-success btn-block mt-3" type="submit" name="edit_product">Tasdiqlash</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
if(isset($_POST['edit_product'])){
    
// maxsulot rasimi   
    $product_img = $_FILES['product_img']['name'];
    $product_img_temp = $_FILES['product_img']['tmp_name'];
    move_uploaded_file($product_img_temp, "../images/maxsulotlar/$product_img");
    
if(empty($product_img)){
   $product_img = $img;
}
// nomi
$product = $_POST['product'];
$product = mysqli_real_escape_string($connection, $product);
 
// activ or not_activ
$status = $_POST['status'];

// maxsulotni update qilish
$query = "UPDATE maxsulotlar SET maxsulot_nomi = '{$product}', status = '{$status}', img = '{$product_img}' WHERE maxsulot_nomi = '{$maxsulot_nomi}'";
$update_maxsulotlar = mysqli_query($connection, $query);
    
// maxsulot_turi 
$query1 = "UPDATE maxsulot_turi SET maxsulot_nomi = '{$product}', status = '{$status}' WHERE maxsulot_nomi = '{$maxsulot_nomi}'";
$update_maxsulot_turi = mysqli_query($connection, $query1);
if($update_maxsulot_turi){

    header("Location: faoliyat.php");
}

}
?>
