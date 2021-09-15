<?php 
if(isset($_GET['absolyut_haydovchi'])){
$absolyut_haydovchi = $_GET['absolyut_haydovchi']; 

$query = "SELECT * FROM users WHERE user_id = '{$absolyut_haydovchi}'";
$select_users = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_users)){
$user_firstname = $row['user_firstname'];
$user_lastname = $row['user_lastname'];
}
}
?>
<div class="justify-content-center">
    <div class="card shadow-lg borde-1 rounded-lg">
        <div class="card-header">
            <h5 class="text-center">Barcha topshirilmagan buyurtmalarni ko'rish</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php 
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_olindi' && haydovchi_id = '{$absolyut_haydovchi}'";
$select = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select)){
 $buyurtma_id = $row['buyurtma_id'];
 $savdo_id = $row['savdo_id'];   
 $buyurtma_date = $row['buyurtma_date'];   
 $buyurtma_sum = $row['buyurtma_sum']; 
 $user_id = $row['user_id'];   
 $manzil = $row['manzil'];   
 $mojal = $row['mojal'];  
    
$query1 = "SELECT * FROM savdo WHERE savdo_id = $savdo_id";
$select_savdo = mysqli_query($connection, $query1);
while($row=mysqli_fetch_assoc($select_savdo)){
 $maxsulot_id = $row['savdo_maxsulot_id'];
 $buyurtmachi_id = $row['mijoz_id'];

$query2 = "SELECT maxsulot_nomi FROM maxsulotlar WHERE maxsulot_id = $maxsulot_id";
$select_maxsulot = mysqli_query($connection, $query2);
$row=mysqli_fetch_assoc($select_maxsulot);
$maxsulot_nomi = $row['maxsulot_nomi'];   
  
} 
                ?>

                <div class="col-md-4">
                <div class="card shadow-lg bordered-1 rounded-lg">
              <div class="card-header">
                  <h5 class="text-center"><?php echo $maxsulot_nomi ?> </h5>
              </div>
               <h5 class="text-center"><?php echo $buyurtma_date ?> </h5>
               <h5 class="text-center"><?php echo $buyurtma_sum ?> so'm</h5>
               <h5 class="text-center"><?php echo $buyurtmachi_id ?> </h5>
               <h5 class="text-center"><?php echo $user_id ?> </h5>
                <form action="" method="get">
               <div class="row">
                   <div class="col-md-12"><a href="savdo.php?savdo=view_mijoz&buyurtma_id=<?php echo $buyurtma_id; ?>" class="btn btn-block btn-info my-1"><i class="fas fa-truck mx-2"></i>Jo'nash</a></div>
                   <div class="col-md-12"><button type="button" class="btn btn-block btn-danger my-1"  data-toggle="modal" data-target="#buyurtmani_qaytarish"><i class="fas fa-trash mx-2"></i>Bazaga Qaytarish</button></div>
               </div>
               </form>
                </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="buyurtmani_qaytarish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buyurtmani Bekor qilish !!!!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text_gold text-center text_prf"><?php echo  $the_user_fullname;?> siz <?php echo $buyurtmachi_id ?> ni <?php echo $maxsulot_nomi." ".($buyurtma_sum)." ni"?> bazaga qaytarmoqchimisiz.</h4>            
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                <div class="modal-footer">
                   <button type="submit" name="buy_cancel" value="<?php echo $buyurtma_id ?>" class="btn btn-danger btn-block btn-sm"><i class="fas fa-trash mx-2"></i>Bazaga Qaytarish</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<!--  ./ Modal -->

<?php 
if(isset($_POST['buy_cancel'])){
$buyurtma_id = $_POST['buy_cancel'];
$query = "UPDATE buyurtma SET buyurtma_status = 'transdan_qaytdi', user_id = '{$the_user_id}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update = mysqli_query($connection, $query);
header("Location: buyurtmalar.php");
}
?>




