<div class="card shadow-lg rounded-lg border-1">
    <div class="card-header">
        <h4 class="text-center">Nasiyachilar</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <?php 

##############################// buyurtmadan barcha shu filialga mansub nasiyalarni chiqarish##############################
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_nasiya' && filial_id = '{$the_filial_id}'";
$select_buyurtma = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_buyurtma)){
$buyurtma_id = $row['buyurtma_id'];
$mijoz_id = $row['mijoz_id'];
##############################//./ buyurtmadan barcha shu filialga mansub nasiyalarni chiqarish#########################
          
##############################// mijozlardan nasiyalarni olib chiqarish##############################
$query1 = "SELECT * FROM mijozlar WHERE mijoz_id  = '{$mijoz_id}'";
$select_mijoz = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_mijoz);
$mijoz_name = $row['mijoz_name'];
$tel_asosiy = $row['tel_asosiy'];
$tel_qoshimcha = $row['tel_qoshimcha'];

##############################//./ mijozlardan nasiyalarni olib chiqarish#########################

#############################// nasiyadan barcha shu filialga mansublarini chiqarish#############################
$query = "SELECT * FROM nasiya WHERE buyurtma_id = '{$buyurtma_id}'";
$select_nasiya = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_nasiya);
$nasiya_summa = $row['nasiya_summa'];   
$olgan_vaqti = $row['olgan_vaqti'];   
$beradigan_vaqti = $row['beradigan_vaqti'];  

$now = date("Y-m-d");

$current_date = strtotime("$now");
$call_date = strtotime("$beradigan_vaqti");

$difference = $call_date - $current_date;
$difference_in_days = floor($difference/(60*60*24));
    
    
#############################//./ nasiyadan barcha shu filialga mansublarini chiqarish#############################
?>
            <div class="col-md-4">
                <div class="card shadow-lg rounded-lg border-1">
                    <div class="card-header">
                        <h5 class="text-center text_gold"><?php echo $mijoz_name ?></h5>
                    </div>
                    <div class="card-body">
                        <h5><a href="tel: +9989<?php echo $tel_asosiy?>"><i class="fas fa-phone"></i>+9989<?php echo $tel_asosiy?></a></h5>
                        <?php 
                        if($tel_qoshimcha>0){
                        echo "<h5><a href='tel: +9989$tel_qoshimcha'><i class='fas fa-phone'></i>+9989$tel_qoshimcha</a></h5>";    
                        } 
                        ?>


                        <h5>Nasiya summa <?php echo number_format($nasiya_summa)?> so'm</h5>
                        <?php
    if($difference_in_days>0){
echo "<button type='button' data-toggle='modal' data-target='#pay_nasiya_$mijoz_id' class='btn btn-block btn-outline-success'>".$difference_in_days." kun || <i class='fas fa-coins mx-1'></i>Tolash</button>";
}
elseif($difference_in_days==0){
echo "<button type='button' data-toggle='modal' data-target='#pay_nasiya_$mijoz_id' class='btn btn-block btn-outline-warning'>".$difference_in_days." kun || <i class='fas fa-coins mx-1'></i>Tolash</button>";
}
else{
echo "<button type='button' data-toggle='modal' data-target='#pay_nasiya_$mijoz_id' class='btn btn-block btn-outline-danger'>".$difference_in_days." kun || <i class='fas fa-coins mx-1'></i>Tolash</button>";
}
?>
                        <button class="btn btn-block btn-outline-primary" data-toggle='modal' data-target='#edit_data_<?php echo $mijoz_id ?>'><i class="fas fa-pen mr-2"></i>Vaqtni o'zgartirish<i class="fas fa-calendar ml-2"></i></button>
                    </div>
                </div>
            </div>

            <!-- Modal tolovga -->
            <div class="modal fade" id="pay_nasiya_<?php echo $mijoz_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nasiya</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text_gold text-center text_prf"><?php echo  $mijoz_name;?> ga pul to'lash</h4>
                                        <div class="col-md-6 mt-2">
                                            <lable>To'lanishi kerak summa : <span class="text-success"><?php echo number_format($nasiya_summa)?></span> so'm</lable>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="nasiya_summa" min="0" value="<?php echo $nasiya_summa?>">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        so'm
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="mijoz_id" value="<?php echo $mijoz_id ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="<?php echo $buyurtma_id?>" name="nasiyani_tolsh" class="btn btn_blue btn-block btn-sm"><i class="fas fa-coins mr-3"></i>To'lash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  ./ Modal tolovga-->

            <!-- Modal vaqtga -->
            <div class="modal fade" id="edit_data_<?php echo $mijoz_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form action="" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nasiya vaqtini o'zgartirish</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text_gold text-center text_prf"><?php echo  $mijoz_name;?>ni vaqtini o'zgartirish</h4>
                                        <div class="col-md-6 mt-2">
                                            <lable>Vaqtni kiriting</lable>
                                            <input type="date" class="form-control mt-2" name="edit_data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" value="<?php echo $buyurtma_id?>" name="edit_vaqt" class="btn btn_blue btn-block btn-sm"><i class="fas fa-calendar mr-3"></i>Yuborish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  ./ Modal vaqtga-->
            <?php } ?>
        </div>
    </div>
</div>
<?php 
########################################// pul qo'lash ########################################
if(isset($_POST['nasiyani_tolsh'])){
    
// buyrtma id
$buyurtma_id = $_POST['nasiyani_tolsh'];
// ./  buyrtma id
    
// mijoz id
$mijoz_id = $_POST['mijoz_id'];
// ./  mijoz id
    
// mijoz tolagan summa
$pay_nasiya_summa = $_POST['nasiya_summa'];
// ./ mijoz tolagan summa
    
    
############################// nasiyadan mijoz nasiya summasini olib kelish  ###############################
$query = "SELECT nasiya_summa FROM nasiya WHERE buyurtma_id = '{$buyurtma_id}'";
$select_nasiya = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_nasiya);
$nasiya_summa = $row['nasiya_summa'];
############################//./ nasiyadan mijoz nasiya summasini olib kelish   ############################ 
    
############################// mijoz balansi olib kelish  ###############################
$query6 = "SELECT balance FROM mijozlar WHERE mijoz_id = '{$mijoz_id}'";
$select_mijozlar = mysqli_query($connection, $query6);
$row=mysqli_fetch_assoc($select_mijozlar);
$mijoz_balance = $row['balance'];
############################//./ mijoz balansi olib kelish   ############################ 
    
#########   // nasiya summasini hisoblash      #########   
$new_summa = $nasiya_summa - $pay_nasiya_summa;
#########   //./ nasiya summasini hisoblash      ######### 
 
###########################   // mijoz balansi hisoblash      ##########################   
$new_mijoz_balansi = $mijoz_balance - $pay_nasiya_summa;
###########################   //./ mijoz balansi hisoblash      ########################## 
    
if($new_summa<=0){   
$query = "UPDATE buyurtma SET buyurtma_sum = '{$new_summa}', buyurtma_status = 'm_topshirildi' WHERE buyurtma_id = '{$buyurtma_id}'";
$update_buyurtma = mysqli_query($connection, $query);
      }
    
    
else{
$query = "UPDATE buyurtma SET buyurtma_sum = '{$new_summa}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update_buyurtma = mysqli_query($connection, $query);     
    } 
    
$query2 = "INSERT INTO kirim (kirim_summ, kirim_date, kirim_user_id, kirim_buyurtma_id, kirim_izoh, filial_id)";
$query2 .= "VALUES('{$pay_nasiya_summa}', now(), '{$the_user_id}', '{$buyurtma_id}', 'nasiyadan', '{$the_filial_id}')";
$insert_kirim = mysqli_query($connection, $query2);

$query = "UPDATE mijozlar SET balance = '{$new_mijoz_balansi}' WHERE mijoz_id = '{$mijoz_id}'";
$update_nasiya = mysqli_query($connection, $query);
    
$query1 = "UPDATE nasiya SET nasiya_summa = '{$new_summa}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update_nasiya = mysqli_query($connection, $query1);
if($update_nasiya){
     header("Location: nasiya.php");
 }    

    
}
########################################//./ pul qo'lash ########################################

#################################// vaqtni o'zgartirish #################################
if(isset($_POST['edit_vaqt'])){

 $buyurtma_id = $_POST['edit_vaqt']; 
    
 $vaqt = $_POST['edit_data']; 
    
$query = "UPDATE nasiya SET beradigan_vaqti = '{$vaqt}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update_nasiya_vaqt = mysqli_query($connection, $query);
 if($update_nasiya_vaqt){
     header("Location: nasiya.php");
 }   
}
#################################// ./ vaqtni o'zgartirish #################################
?>
