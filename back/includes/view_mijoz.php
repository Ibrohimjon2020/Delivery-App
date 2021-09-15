<?php 
if(isset($_GET['buyurtma_id'])){
 $buyurtma_id = $_GET['buyurtma_id'];
    
#############################// buyurtmadan savdo qilingan ma'lumotlarini olib kelish  #############################    
$query = "SELECT * FROM buyurtma WHERE buyurtma_id = '{$buyurtma_id}'";
$select_buyurtma = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_buyurtma)){
$savdo_id = $row['savdo_id'];    
$mijoz_id = $row['mijoz_id'];
$buyurtma_date = $row['buyurtma_date'];     
$manzil = $row['manzil'];   
$mojal = $row['mojal']; 
}
#############################//./ buyurtmadan savdo qilingan ma'lumotlarini olib kelish   #############################   
    
#################################// mijoz ma'lumotlari#################################
$query1 = "SELECT * FROM mijozlar WHERE mijoz_id = '{$mijoz_id}'";
$select_mijoz = mysqli_query($connection, $query1);
while($row = mysqli_fetch_assoc($select_mijoz)){
 $mijoz_name = $row['mijoz_name'];   
 $tel_asosiy = $row['tel_asosiy'];   
 $tel_qoshimcha = $row['tel_qoshimcha'];   
}
#################################//./ mijoz ma'lumotlari#################################
    
#############################// savdodan mijoz olgan narsalar haqida ma'lumot olib kelish #############################   
$query2 = "SELECT * FROM savdo WHERE savdo_id = '{$savdo_id}'";
$select_savdo = mysqli_query($connection, $query2);
while($row = mysqli_fetch_assoc($select_savdo)){  
$car_type_id = $row['car_type_id'];      
$savdo_maxsulot_id = $row['savdo_maxsulot_id'];      
$savdo_foyda_narx = $row['savdo_foyda_narx'];    
$maxsulot_hajmi = $row['maxsulot_hajmi'];    
}
#############################// ./ savdodan mijoz olgan narsalar haqida ma'lumot olib kelish #############################   
    
##########################################// mashina turi ##########################################
$query3 = "SELECT car_type_nomi FROM moshina_turlari WHERE car_type_id = '{$car_type_id}'";
$select_mashina = mysqli_query($connection, $query3);
$row=mysqli_fetch_assoc($select_mashina);
$car_type_nomi = $row['car_type_nomi'];
##########################################// ./mashina turi ##########################################
        
################################// maxsulot id sidan nomini olib kelish  ################################
$query4 = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id = '{$savdo_maxsulot_id}'";
$select_maxsulot_turi = mysqli_query($connection, $query4);
$row=mysqli_fetch_assoc($select_maxsulot_turi);
 $maxsulot_nomi = $row['maxsulot_nomi']; 
################################// ./  maxsulot id sidan nomini olib kelish  ################################

}
?>
<div class="justify-content-center">
    <h1 class="text-center">Mijoz ma'lumotlari</h1>
    <div class="col-md-12">
        <div class="card shadow-lg border-1 rounded-lg">
            <div class="card-header">
                <h6 class="text-center"><?php echo $mijoz_name ?>ning ma'lumotlari.</h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <td>
                            <h6><span class="text_gold text_prf">Tel asosiy:</span> <a href="tel:+998<?php echo $tel_asosiy?>"><i class="fas fa-phone"></i>+998<?php echo $tel_asosiy?></a></h6>
                        </td>
                        <td>
                            <h6><span class="text_gold text_prf">Tel qoshimcha:</span> <a href="tel:+998<?php echo $tel_qoshimcha?>"><i class="fas fa-phone"></i>+998<?php echo $tel_qoshimcha?></a></h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6><span class="text_gold text_prf">Buyurtma olingan sana:</span> <?php echo $buyurtma_date; ?></h6>
                        </td>
                        <td>
                            <h6><span class="text_gold text_prf">Buyurtma summasi:</span> <?php echo number_format($savdo_foyda_narx); ?> so'm</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6><span class="text_gold text_prf">Manzil:</span> <?php echo $manzil; ?></h6>
                        </td>
                        <td>
                            <h6><span class="text_gold text_prf">Mojal:</span> <?php echo $mojal; ?></h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h6><span class="text_gold text_prf">Buyurtma:</span> <?php echo $maxsulot_nomi." ".$maxsulot_hajmi." ".$car_type_nomi; ?></h6>
                        </td>
                    </tr>
                </table>
                <form action="" method="post">
                    <div class="row">
                        <!--                    maxsuot narxi-->
                        <input type="hidden" name="hidden" value="<?php echo $savdo_foyda_narx ?>">
                        <!--                    maxsuot narxi-->
                        <div class="col-md-6"><input type="number" class="form-control my-2" name="price" min="0" value="<?php echo $savdo_foyda_narx ?>"></div>
                        <div class="col-md-6"><button type="submit" name="tolash" class="btn btn-info btn-block my-2"><i class="fas fa-coins mx-2"></i>To'lash</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
################################################// pul tolash qismi################################################
if(isset($_POST['tolash'])){
// buyurtma narxi
$buyurtma_narx = $_POST['hidden'];
// bergan puli
$price = $_POST['price'];
    
$nasiya_summa = $buyurtma_narx - $price;
 if($price>0){   
$query = "INSERT INTO kirim(kirim_user_id, kirim_buyurtma_id, kirim_summ, kirim_date, kirim_izoh, filial_id)";
$query .= "VALUES('{$the_user_id}', '{$buyurtma_id}', '{$price}', now(), 'mijozga yetkazildi', '{$the_filial_id}')";
$insert = mysqli_query($connection, $query);
 }
    
if($nasiya_summa>0){
    $buyurtma_status = 'b_nasiya';
echo '
<div class="col-md-12">
    <div class="card shadow-lg rounded-lg border-1">
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                <div class="card shadow rounded-lg border-1">
                    <div class="card-header">
                        <form action="" method="post">
                            <h5 class="font-weight-light text-center">Nasiya Muddatini Kiriting</h5>
                            <button class="btn btn-outline-danger" name="orqaga"><i class="fas fa-angle-left mr-2"></i>Orqaga qaytish</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <h5>Nasiya summa:<span class="text-danger ml-3">'.number_format($nasiya_summa).' so`m</span></h5>
                            <input type="hidden" name="nasiya_hidden" value="'.$nasiya_summa.'">
                            <label for="nas">Nasiya muddatini kiriting</label>
                            <input required id="nas" type="date" name="nas_ber_vaqt" class="form-control">
                            <button name="nasiyaga_berish" class="btn btn-info btn-block my-2">Tasdiqlash <i class="fa fa-check"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
';    
}
else{
    $buyurtma_status = 'm_topshirildi';
} 
    
$query = "UPDATE buyurtma SET buyurtma_status = '{$buyurtma_status}', haydovchi_id = '{$the_user_id}' WHERE buyurtma_id = '{$buyurtma_id}'";
$update = mysqli_query($connection, $query);    

if($nasiya_summa <= 0){
    header("Location: buyurtmalar.php");
}
}
################################################//./ pul tolash qismi ################################################
                               
                               
                               
#######################// orqaga qaytishni bosa hamma narsa bekor bo'lib sahifa yangilanadi#############################
if(isset($_POST['orqaga'])){
    
$query = "DELETE FROM kirim WHERE kirim_buyurtma_id = '{$buyurtma_id}'";
$delete_kirim = mysqli_query($connection, $query);
    
$query = "UPDATE buyurtma SET buyurtma_status = 'b_olindi', haydovchi_id = '0' WHERE buyurtma_id = '{$buyurtma_id}'";
$update = mysqli_query($connection, $query);
    header("Location: savdo.php?savdo=view_mijoz&buyurtma_id=$buyurtma_id");
}         
#############################//./orqaga qaytishni bosa hamma narsa bekor bo'lib sahifa yangilanadi#######################
                               
                               
############################################## // nasiyaga berish qismi ##############################################                             
if(isset($_POST['nasiyaga_berish'])){
    
    $nasiya_summa = $_POST['nasiya_hidden'];
    
    $nasiya_muddat = $_POST['nas_ber_vaqt'];

    $query = "INSERT INTO nasiya(buyurtma_id, nasiya_summa, olgan_vaqti, beradigan_vaqti, filial_id)";
    $query .= "VALUES('{$buyurtma_id}', '{$nasiya_summa}', now(), '{$nasiya_muddat}', '{$the_filial_id}')";
    $insert = mysqli_query($connection, $query); 
    if($insert){
        header("Location: buyurtmalar.php");
    }   
}
############################################## //./ nasiyaga berish qismi ##############################################                             
?>
