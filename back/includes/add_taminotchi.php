<?php 
if(isset($_POST['taminotchi'])){
// taminotchi ismi
$ismi = $_POST['ismi'];
$ismi = mysqli_real_escape_string($connection, $ismi);
// taminotchi telfon    
$tel_asosiy = $_POST['tel_asosiy'];
// taminotchi telfon
$tel_qoshimcha = $_POST['tel_qoshimcha'];

// taminotchi manzil
$taminotchi_manzil = $_POST['taminotchi_manzil'];
$taminotchi_manzil = mysqli_real_escape_string($connection, $taminotchi_manzil);
    
$balasi_som = $_POST['balasi_som'];
    
$iqtisosligi = $_POST['iqtisosligi'];
    
$izoh = $_POST['izoh'];
$izoh = mysqli_real_escape_string($connection, $izoh);
    
$query = "INSERT INTO taminotchi(taminotchi_manzil, izoh, ixtsosligi, taminotchi_balance_som, taminotchi_ismi, tel_asosiy, tel_qoshimcha, filial_id)";
$query .= "VALUES('{$taminotchi_manzil}', '{$izoh}', '{$iqtisosligi}', '{$balasi_som}', '{$ismi}', '{$tel_asosiy}', '{$tel_qoshimcha}', '{$the_filial_id}')";
    
$query_insert = mysqli_query($connection, $query);
if($query_insert){
   echo "<script>alert('Taminotchi bazaga qoshildi.')</script>";
}
}
?>

    <form action="" method="post">
    <div class="card shadow-lg border-1 rounded-lg">
<div class="card-header">
            <!--                       <a href="transport.php?transport=add_transport" class="btn btn-dark" style="float-right"><i class="fas fa-angle-left mr-1"></i>Orqaga</a>-->
            <h4 class="text-center">Taminotchinilarni qo'shish</h4>
        </div>
        <div class="card-body">
                          <a href="#" data-toggle="collapse" data-target="#new_taminotchi" aria-expanded="false" aria-controls="collapseLayouts">
            <button class="btn btn-info btn-block my-4 ">Yangi maxsulot qo'shish <i class="fas fa-angle-down ml-1"></i></button>
        </a>
        <div class="collapse ml-0 mt-5 " id="new_taminotchi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
        
            <div class="row">
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini ismi</h6>
                    </lable>
                    <input type="text" class="form-control my-2" name="ismi" required placeholder="Taminotchi ismi">
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini tel: asosiy</h6>
                    </lable>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text mb-2">+998</span>
                        </div>
                        <input required type="number" min="0" class="form-control mb-2" name="tel_asosiy" placeholder="tel: asosiy">
                    </div>
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini tel: qoshimcha</h6>
                    </lable>
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text mb-2">+998</span>
                        </div>
                        <input type="number" min="0" class="form-control mb-2" name="tel_qoshimcha" placeholder="tel: qoshimcha">
                    </div>
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini manzil</h6>
                    </lable>
                    <input type="text" class="form-control my-2" name="taminotchi_manzil" required placeholder="Taminotchini manzil">
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini balansi so'mda</h6>
                    </lable>
                    <div class="input-group">
                        <input type="number" min="0" class="form-control mb-2" name="balasi_som" placeholder="Balasi so'm">
                        <div class="input-group-append mb-2">
                            <div class="input-group-text">
                                so'm
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini Iqtisosligi</h6>
                    </lable>
                    <select name="iqtisosligi" id="" class="form-control" required>
                        <option value=""></option>
                        <?php 
$query = "SELECT * FROM maxsulot_turi";
$select_maxsulot_turi = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_maxsulot_turi)){
$maxsulot_turi_id = $row['maxsulot_turi_id'];    
$maxsulot_nomi = $row['maxsulot_nomi'];    
?>
                        <option value="<?php echo $maxsulot_turi_id?>"><?php echo $maxsulot_nomi?></option>
                        <?php  } ?>
                    </select>
                </div>
                <div class=" col-md-4 mb-2">
                    <lable>
                        <h6>Taminotchini uchun izoh</h6>
                    </lable>
                    <textarea name="izoh" class="form-control mb-3" id="" placeholder="Izoh qoldiring" cols="20" rows="3"></textarea>
                </div>
                <button class="btn btn-info btn-block" name="taminotchi">Qo'shish</button>
            </div>
        </div>
    </div>

        </div>
</form>
       <?php include "taminotchilar.php"?>