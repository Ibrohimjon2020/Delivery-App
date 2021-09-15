<div class="justify-content-center">
    <div class="card shadow-lg borde-1 rounded-lg">
        <div class="card-header">
            <h5 class="text-center">Barcha topshirilmagan buyurtmalarni ko'rish</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php 
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_olindi' && haydovchi_id = 0";
$select = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select)){
 $buyurtma_id = $row['buyurtma_id'];
 $savdo_id = $row['savdo_id'];   
 $buyurtma_date = $row['buyurtma_date'];   
 $buyurtma_sum = $row['buyurtma_sum'];   
 $manzil = $row['manzil'];   
 $mojal = $row['mojal'];  
    
$query1 = "SELECT * FROM savdo WHERE savdo_id = '{$savdo_id}'";
$select_savdo = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_savdo);
$maxsulot_id = $row['savdo_maxsulot_id'];
$mijoz_id = $row['mijoz_id'];
$car_type_id = $row['car_type_id'];
$maxsulot_hajmi = $row['maxsulot_hajmi'];

$query4 = "SELECT car_type_nomi FROM moshina_turlari WHERE car_type_id = '{$car_type_id}'";
$select_car_type = mysqli_query($connection, $query4);
$row=mysqli_fetch_assoc($select_car_type);
$car_type_nomi = $row['car_type_nomi'];
    
$query3 = "SELECT mijoz_name, tel_asosiy FROM mijozlar WHERE mijoz_id = '{$mijoz_id}'";
$select_mijozlar = mysqli_query($connection, $query3);
$row=mysqli_fetch_assoc($select_mijozlar);
$mijoz_name = $row['mijoz_name'];
$tel_asosiy = $row['tel_asosiy'];
    
$query2 = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id  = '{$maxsulot_id}'";
$select_maxsulot = mysqli_query($connection, $query2);
$row=mysqli_fetch_assoc($select_maxsulot);
$maxsulot_nomi = $row['maxsulot_nomi'];   
  
                ?>

                <div class="col-md-4">
                    <div class="card shadow-lg bordered-1 rounded-lg">
                        <div class="card-header">
                            <h5 class="text-center"><?php echo $maxsulot_nomi?> </h5>
                        </div>
                        <h5 class="text-center text_gold">Mijoz: <?php echo $mijoz_name ?> </h5>
                        <h5 class="text-center"><?php echo number_format($buyurtma_sum) ?> so'm</h5>
                        <h5 class="text-center">Hajmi: <?php echo $maxsulot_hajmi.' '.$car_type_nomi ?> </h5>

                        <h5 class="text-center">Manzil: <?php echo $manzil ?>. </h5>
                        <h5 class="text-center">Mojal: <?php echo $mojal ?>. </h5>
                        <h5 class="text-center"><a href="tel:+998<?php echo $tel_asosiy?>">tel: <i class="fas fa-phone mr-1"></i>+998<?php echo $tel_asosiy?></a> </h5>
                        <h6 class="text-center text-primary"><?php echo $buyurtma_date ?><i class="fas fa-calendar ml-2"></i></h6>
                        <form action="" method="get">

                            <a href="savdo.php?savdo=view_mijoz&buyurtma_id=<?php echo $buyurtma_id; ?>" class="btn btn-block btn-outline-info my-1"><i class="fas fa-truck mx-2"></i>Jo'nash</a>


                        </form>
                        <button type="button" class="btn btn-block btn-outline-danger my-1" data-toggle="modal" data-target="#buyurtmani_qaytarish_<?php echo $savdo_id?>"><i class="fas fa-trash mx-2"></i>Bazaga Qaytarish</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="buyurtmani_qaytarish_<?php echo $savdo_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
                                        <h4 class="text_gold text-center text_prf"><?php echo  $the_user_fullname;?> siz <?php echo $mijoz_name ?>ni </h4>
                                        <h4><?php echo $maxsulot_hajmi." ".$car_type_nomi." ".$maxsulot_nomi." || ".number_format($buyurtma_sum)." so'm ni"?> bazaga qaytarmoqchimisiz.</h4>
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
                <?php } ?>

            </div>
        </div>
    </div>
</div>


<?php 
if(isset($_POST['buy_cancel'])){
$buyurtma_id = $_POST['buy_cancel'];
$query = "UPDATE buyurtma SET buyurtma_status = 'transdan_qaytdi', user_id = '{$the_user_id}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update = mysqli_query($connection, $query);
header("Location: buyurtmalar.php");
}
?>
