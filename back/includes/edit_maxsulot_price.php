<?php
if(isset($_GET['m_id'])){
$maxsulot_id = $_GET['m_id'];

$query1 = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id  = $maxsulot_id";
$select_maxsulota = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_maxsulota);
$maxsulot_nomi = $row['maxsulot_nomi'];
$maxsulot_nomi = mysqli_real_escape_string($connection, $maxsulot_nomi);

$query = "SELECT * FROM maxsulotlar WHERE maxsulot_nomi = '{$maxsulot_nomi}'";
$select_maxsulot = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_maxsulot)){
$maxsulot_nomi = $row['maxsulot_nomi'];    
$img = $row['img']; 
}    
}
?>

<div class="justify-content-center">
    <div class="card shadow-lg rounded-lg border-1">
        <div class="card-header">
       <a href="faoliyat.php" class="btn btn-dark"><i class="fas fa-angle-left mr-2"></i>Orqaga</a>
            <h3 class="text-center"><?php echo $maxsulot_nomi ?></h3>
            <center>
                <img src="../images/maxsulotlar/<?php echo $img ?>" width="300px" height="100px" alt="">
            </center>
        </div>
        <div class="card-body">
                <div class="row">
                <?php 
                    $query = "SELECT * FROM taminotchi WHERE ixtsosligi = '{$maxsulot_id}'";
                     $select = mysqli_query($connection, $query);
                     while($row = mysqli_fetch_assoc($select)){
                     $taminotchi_id = $row['taminotchi_id'];
                     $taminotchi_manzil = $row['taminotchi_manzil'];
                     $taminotchi_ismi = $row['taminotchi_ismi'];
                         
                     ?>
                <div class="col-md-4 my-2">
                    <div class="card shadow-lg border-1">
                        
                            <div class="card-body">
                               <h5 class="font-weight-light">Ismi: <?php echo $taminotchi_ismi ?></h5>
                               <h5 class="font-weight-light">Manzil: <?php echo $taminotchi_manzil ?></h5>
                                <button type="button" class="btn btn-block btn-outline-dark" data-toggle="modal" data-target="#set_money<?php echo $taminotchi_id?>"><i class="fas fa-coins mr-2"></i>Narx Belgilash</button>
                            </div>
                     
                    </div>
                </div>
              
                
                  <!-- Modal -->
    <div class="modal fade" id="set_money<?php echo $taminotchi_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form action="" method="post"> 
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ismi: <?php echo $taminotchi_ismi." Manzil: ".$taminotchi_manzil?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                <?php 
                    $query = "SELECT * FROM moshina_turlari";
                     $select_cars = mysqli_query($connection, $query);
                     while($row = mysqli_fetch_assoc($select_cars)){
                     $car_type_id = $row['car_type_id'];
                     $car_type_nomi = $row['car_type_nomi'];
                        
 $query1 = "SELECT * FROM maxsulotlar WHERE maxsulot_nomi = '{$maxsulot_nomi}' && olchov = '{$car_type_nomi}' && taminotchi_id = '{$taminotchi_id}'";
$select_maxsulott = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_maxsulott);
    // narxi
$price = $row['price'];  
// min narxi
$min_price = $row['min_price'];
//
  if(empty($price)){
  $price = 0;    
  }  
if(empty($min_price)){
  $min_price = 0;    
  }                 ?>
                <div class="col-md-4 my-2">
                    <div class="card shadow-lg border-1">
                        
                            <div class="card-body">
                                <lable><?php echo $car_type_nomi; ?> uchun sotuv narx</lable>
                                <input type="number" name="price" value="<?php echo $price ?>" class="form-control mb-2" placeholder="Sotuv narx">
                                <lable><?php echo $car_type_nomi; ?> uchun min narx</lable>
                                <input type="number" name="min_price" value="<?php echo $min_price ?>" class="form-control mb-2" placeholder="Min narx">
                                <button class="btn btn-block btn-info" name="tasdiqlash" value="<?php echo $car_type_nomi?>">Tasdiqlash</button>
                            </div>
                       
                    </div>
                </div>

                <?php }?>

            </div>
                </div>
                <div class="modal-footer">
                   
                   
                </div>
                
                 </form>
            </div>
        </div>
    </div>
<!--  ./ Modal -->
                
                
                 <?php   }  ?>
                 
 
            </div>
        </div>
    </div>
</div>



<?php 
if(isset($_POST['tasdiqlash'])){
 $car_type_nomi = $_POST['tasdiqlash'];
//sotuv narx
 $price = $_POST['price'];   
// minimum narx
 $min_price = $_POST['min_price'];  

$query = "UPDATE maxsulotlar SET price = '{$price}', min_price = '{$min_price}' WHERE olchov = '{$car_type_nomi}' && maxsulot_nomi = '{$maxsulot_nomi}'";
$update = mysqli_query($connection, $query);
if($update){
    header("Location: faoliyat.php?faoliyat=edit_maxsulot_price&m_id=$maxsulot_id");
}
}
?>








