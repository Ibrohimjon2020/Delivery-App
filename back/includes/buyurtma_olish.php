<?php
if(isset($_GET['t_id'])){
    $mijoz_tel = $_GET['t_id'];
$query = "SELECT * FROM mijozlar WHERE tel_asosiy = '{$mijoz_tel}'";
$select_mijozlar = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_mijozlar)){
$mijoz_id = $row['mijoz_id'];
$mijoz_name = $row['mijoz_name'];
$tel_asosiy = $row['tel_asosiy'];
$tel_qoshimcha = $row['tel_qoshimcha'];
$balance = $row['balance'];
$jami_savdo_balansi = $row['jami_savdo_balansi'];
   
}
}
if(isset($_POST['add_buyurtma'])){
    
$mojal = $_POST['mojal'];
$mojal = mysqli_real_escape_string($connection, $mojal);
    
$manzil = $_POST['manzil'];
$mojal = mysqli_real_escape_string($connection, $mojal);
    
$tel_asosiy = $_POST['tel_asosiy'];
    
//mashina id si keladi  kamaz, zil, jumng, labo 
$olchov = $_POST['olchov']; 
    
// maxsulot id si
$product = $_POST['product']; 
    
$miqdor = $_POST['miqdor']; 
    
// mijozga sotiladigan narx 
$mijoz_narx = $_POST['mijoz_narx'];

// haydovchi id si 
$haydovchi = $_POST['haydovchi'];

if(empty($balance)){
    $balance = 0;
}
    
// buyurtmani olingan kegin mijozning balansi
$balance = $balance + $mijoz_narx;
    
if(empty($jami_savdo_balansi)){
    $jami_savdo_balansi = 0;
}
// jami mijoz olgan savdo balansi eskilari ham
$jami_savdo_balansi = $jami_savdo_balansi + $mijoz_narx;
    
    

############################### // maxsulotni id sidan nomini olib kelish  #################################  
$query1 = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id = $product";
$select_maxsulot_turi = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_maxsulot_turi);
$maxsulot_nomi = $row['maxsulot_nomi'];    

 ##########################    // olchovda mashina id si keladi undan mashina nomini olib kelamiz ######################
$query = "SELECT car_type_nomi FROM moshina_turlari WHERE car_type_id = $olchov";
$select_car_type = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_car_type);
    
// mashina nomi  
$car_type_nomi = $row['car_type_nomi'];   
 

###################################  // maxsulotni nomidan narxini olib kelish   ##################################
$query = "SELECT price, min_price FROM maxsulotlar WHERE maxsulot_nomi = '{$maxsulot_nomi}' && olchov = '{$car_type_nomi}'";
$select = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select)){
 $price = $row['price'];   
 $min_price = $row['min_price'];   
}
  // narxi
$narx = $price * $miqdor;

// min narxi
$min_narx = $min_price * $miqdor;
    
####################################   Buyurtmaga Inserrt qilish #########################################       
$query = "INSERT INTO buyurtma (buyurtma_date, buyurtma_sum, user_id, manzil, mojal, location, mijoz_id, haydovchi_id, filial_id)";
$query .= "VALUES(now(), '{$mijoz_narx}', '{$the_user_id}', '{$manzil}', '{$mojal}', '0', '{$mijoz_id}', '{$haydovchi}', '{$the_filial_id}')";
$insert_buyurtma = mysqli_query($connection, $query);
    
    
 ##################################   Savdo ga INSERT qilish ################################################   
$query1 = "INSERT INTO savdo (car_type_id , savdo_maxsulot_id, savdo_tan_narx, savdo_foyda_narx, maxsulot_hajmi, mijoz_id, filial_id)";
$query1 .= "VALUES('{$olchov}', '{$product}', '{$min_narx}', '{$mijoz_narx}', '{$miqdor}', '{$mijoz_id}', '{$the_filial_id}')";
$insert_savdo = mysqli_query($connection, $query1);
    
if($insert_savdo){
    echo "
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Mijoz: $mijoz_name (+998$tel_asosiy)</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='row'>
                        <div class='col-md-7'>
                          <h4 class='text_gold text-center text_prf'>$maxsulot_nomi ( $miqdor $car_type_nomi )</h4> 
                        </div>
                        <div class='col-md-5'>
                            <h5 class='text_gold text-center'> Sotilgan Narxi: $mijoz_narx so'm</h5>
                            <h6 class='text-center text-secondary'>
                             Narxi: $narx so'm</h6>               
                        </div>
                    </div>
                </div>
                <form method='post'>
                <input type='hidden' name='m_tel_asosiy' value='$tel_asosiy'>
                <div class='col-md-12'>
                <div class='row'>
                <div class='col-md-6'><button type='submit' class='btn btn-info btn-block mb-2' name='tekshirish'><i class='fas fa-check mr-2'></i>To'g'ri</button></div>
                <div class='col-md-6'><button type='submit' class='btn btn-danger btn-block mb-2' name='delete'><i class='fas fa-trash mr-2'></i>Qaytarish</button></div>
                </div>
               
                </div>
                 </form>
                </div>
        </div>

    ";
}}

#############################################  INSERT ##########################################################
    if(isset($_POST['tekshirish'])){
$m_tel_asosiy = $_POST['m_tel_asosiy'];
        
###########################// savdodan shu mijozga tegishli ma'lumotlarni olib kelish ###########################       
$query2 = "SELECT * FROM savdo WHERE mijoz_id = $mijoz_id ORDER BY savdo_id DESC";
$select_savdo = mysqli_query($connection, $query2);
$row=mysqli_fetch_assoc($select_savdo);
$savdo_id = $row['savdo_id'];
// mijozga sotiladigan narxi
$savdo_balance = $row['savdo_foyda_narx'];
// maxsulotning tan narxi
$savdo_tan_narx = $row['savdo_tan_narx'];
$savdo_maxsulot_id = $row['savdo_maxsulot_id'];
###########################// ./savdodan shu mijozga tegishli ma'lumotlarni olib kelish ###########################       
        
#################################// maxsulotni qaysi taminotchidan olinganini bilish #################################
$query = "SELECT taminotchi_balance_som, taminotchi_id FROM taminotchi WHERE ixtsosligi = '{$savdo_maxsulot_id}'";
$select_taminotchi = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_taminotchi);
$taminotchi_balance_som = $row['taminotchi_balance_som'];
$taminotchi_id = $row['taminotchi_id'];
#################################// ./  maxsulotni qaysi taminotchidan olinganini bilish #################################
        
// savdodan kelgan summani taminotchi balansidan ayrish
$new_taminotchi_balance = $taminotchi_balance_som - $savdo_tan_narx;          

        
$query3 = "SELECT balance, jami_savdo_balansi FROM mijozlar WHERE mijoz_id = $mijoz_id";
$select_mijozlar = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_mijozlar)){
 $balance = $row['balance'];   
 $jami_savdo_balansi = $row['jami_savdo_balansi'];   
}
        

 // mijoz yangi balansi       
if(empty($balance)){
    $balance = 0;
}

$balance = $balance + $savdo_balance;   
        
 // mijoz barcha balansi eskilari bilan           
if(empty($jami_savdo_balansi)){
    $jami_savdo_balansi = 0;
}
      
 $jami_savdo_balansi = $jami_savdo_balansi + $savdo_balance;       
        
###################################  taminotchi balansini update qilish ###############################
$query = "UPDATE taminotchi SET taminotchi_balance_som = '{$new_taminotchi_balance}' WHERE taminotchi_id = '{$taminotchi_id}'";
$update_taminotchi = mysqli_query($connection, $query);
################################### ./ mijoz balansini update qilish ###############################        
        
###################################  taminotchi balansini update qilish ###############################
$query = "UPDATE mijozlar SET balance = '{$balance}', jami_savdo_balansi = '{$jami_savdo_balansi}', tel_asosiy = '{$m_tel_asosiy}' WHERE mijoz_id = '{$mijoz_id}'";
$update_mijozlar = mysqli_query($connection, $query);
################################### ./ mijoz balansini update qilish ###############################
        
####################################   Buyurtmaga UPdate qilish #########################################       
$query = "UPDATE buyurtma SET savdo_id = '{$savdo_id}', buyurtma_status = 'b_olindi' WHERE mijoz_id = '{$mijoz_id}' && buyurtma_sum = '{$savdo_balance}' ORDER BY buyurtma_id DESC";
$update_buyurtma = mysqli_query($connection, $query);
if($update_buyurtma){
    header("Location: savdo.php?savdo=add_mijoz");
}  
####################################   ./Buyurtmaga UPdate qilish #########################################       

    }
######################################  DELETE  ############################################################
if(isset($_POST['delete'])){
// savdoni select qilish    
$query2 = "SELECT savdo_id FROM savdo WHERE mijoz_id = $mijoz_id ORDER BY savdo_id DESC";
$select_savdo = mysqli_query($connection, $query2);   
$row=mysqli_fetch_assoc($select_savdo);
$savdo_id = $row['savdo_id'];
    
// buyurtmani select qilish   
$query3 = "SELECT buyurtma_date FROM buyurtma WHERE mijoz_id = $mijoz_id ORDER BY buyurtma_id DESC";
$select_buyurtma = mysqli_query($connection, $query3);
$row=mysqli_fetch_assoc($select_buyurtma);
$buyurtma_date = $row['buyurtma_date'];  
    
    
#################### DELETE buyurtma #############################################################   
$query = "DELETE FROM buyurtma WHERE mijoz_id = '{$mijoz_id}' && buyurtma_date = '{$buyurtma_date}' ORDER BY buyurtma_id DESC";
$delete_buyurtma = mysqli_query($connection, $query);
    
 #################### DELETE savdo #############################################################   
$query = "DELETE FROM savdo WHERE savdo_id = $savdo_id";
$delete = mysqli_query($connection, $query);
if($delete){
  header("Location: savdo.php?savdo=add_mijoz");   
}
}     
?>

<!--   Yangi maxsulot qo'shish  -->
<div class="justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-lg border-1 rounded-lg mt-2">
            <div class="card-header">
                <h5 class="text-center"><b><?php echo $mijoz_name ?> Balansi:</b> <?php if($balance>0){
    echo "<span class='text-info'>$balance so'm </span>";  
} 
                    elseif($balance==0){
    echo "<span class='text-success'>$balance so'm </span>";  
}
                    else{
   echo "<span class='text-danger'>$balance so'm </span>";
                    }?></h5>
            </div>

            <div class="card-body">
                <div class="container-fluid">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="taminot_product">
                                        <h4 class='text-center font-weight-light'>Maxsulot</h4>
                                    </label>
                                    <select name="product" id="product" class="form-control">
                                        <?php 
  
$query1 = "SELECT maxsulot_nomi, maxsulot_turi_id FROM maxsulot_turi WHERE status = 'activ'";
$select = mysqli_query($connection, $query1);
while($row=mysqli_fetch_assoc($select)){
$maxsulot_turi_id = $row['maxsulot_turi_id'];
$maxsulot_nomi = $row['maxsulot_nomi'];
                                        
                                        ?>
                                        <option value="<?php echo $maxsulot_turi_id ?>"><?php echo $maxsulot_nomi ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="user_phone">
                                    <h4 class=" font-weight-light">Hajmi: </h4>
                                </label>
                                <div class="input-group">
                                    <input type="number" id="hajim" min="0" name="miqdor" class="form-control" placeholder="Miqdorini kiriting">
                                    <div class="input-group-append">

                                        <select name="olchov" id="olchov" class="form-control" required>
                                            <option value="">Mashina</option>
                                            <?php 
                                            $query = "SELECT car_type_id, car_type_nomi FROM moshina_turlari";
                                            $select_car_type = mysqli_query($connection, $query);
                                            while($row=mysqli_fetch_assoc($select_car_type)){
                                           $car_type_id = $row['car_type_id'];     
                                           $car_type_nomi = $row['car_type_nomi'];     
                                            ?>
                                            <option value="<?php echo $car_type_id ?>"><?php echo $car_type_nomi ?></option>
                                            <?php  } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="user_phone">
                                    <h4 class="text-center font-weight-light">Telefon raqami asosiy:</h4>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+998</span>
                                    </div>
                                    <input type="number" min="0" name="tel_asosiy" class="form-control" value="<?php echo $tel_asosiy ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="taminot_product">
                                        <h4 class='text-center font-weight-light'>Manzil / uy:</h4>
                                    </label>
                                    <input type="text" class="form-control" name="manzil" placeholder="Manzil uy raqami bilan" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="taminot_product">
                                        <h4 class='text-center font-weight-light'>Mo'ljal:</h4>
                                    </label>
                                    <input type="text" class="form-control" name="mojal" placeholder="Mo'ljal">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <center>
                                    <div class="form-group">
                                        <label for="taminot_product">
                                            <h4 class='text-center'>Jami narxi:</h4>
                                            <h4 style="text-align: center" id="result">so'm</h4>
                                        </label>
                                    </div>
                                </center>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="taminot_product">
                                        <h4 class='text-center font-weight-light'>Mijoz uchun sotuv narx:</h4>
                                    </label>
                                    <input type="number" min="0" class="form-control" name="mijoz_narx" placeholder="Mijoz uchun narx" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="taminot_product">
                                        <h4 class='text-center font-weight-light'>Haydovchini tanlang:</h4>
                                    </label>
                                    <select name="haydovchi" class="form-control">
                                        <option value=""></option>
                                        <?php 

#####################################// haydovchilarni olib kelish   ###############################
$query = "SELECT user_firstname, user_lastname, user_id FROM users WHERE user_role = 'haydovchi' && filial_id = '{$the_filial_id}'";
$select_users = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_users)){
$user_id = $row['user_id'];   
$user_firstname = $row['user_firstname'];   
$user_lastname = $row['user_lastname'];
    
$query = "SELECT * FROM moshina WHERE car_user_id = $user_id";
$select_moshina = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_moshina);
$nomer_viloyat = $row['nomer_viloyat'];    
$nomer_qolgani = $row['nomer_qolgani'];    
$moshina_turi = $row['moshina_turi'];    
?>
                                        <option value="<?php echo $user_id ?>"><?php echo $user_firstname." ".$user_lastname." ".$moshina_turi." ".$nomer_viloyat."|".$nomer_qolgani ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-success mb-4" name="add_buyurtma">Qo'shish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   ./Yangi maxsulot qo'shish -->
