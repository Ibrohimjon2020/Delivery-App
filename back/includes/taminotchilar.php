<div class="col-md-12">
    <div class="row">
        <?php 
$query = "SELECT * FROM taminotchi WHERE filial_id = '{$the_filial_id}'";
$select_taminotchi = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_taminotchi)){
 $taminotchi_id = $row['taminotchi_id'];   
 $taminotchi_manzil = $row['taminotchi_manzil'];
//ixtsosligi id si keladi 
 $ixtsosligi = $row['ixtsosligi'];   
 $taminotchi_balance_som = $row['taminotchi_balance_som'];      
 $taminotchi_ismi = $row['taminotchi_ismi'];   
 $tel_asosiy = $row['tel_asosiy'];   
 $tel_qoshimcha = $row['tel_qoshimcha'];   
 $izoh = $row['izoh'];   
 $filial_id = $row['filial_id'];   

$query = "SELECT * FROM maxsulot_turi WHERE maxsulot_turi_id = '{$ixtsosligi}'";
$select_maxsulot = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_maxsulot)){
 $maxsulot_nomi = $row['maxsulot_nomi'];   
?>
        <div class="col-md-4 my-2">
            <div class="card rounded-lg shadow-lg border-1">
                <div class="card-header">
                    <h5 class="text-center"><?php echo $taminotchi_ismi?></h5>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-light">Iqtisosligi: <?php echo $maxsulot_nomi?></h5>
                    <h5 class="font-weight-light">Balasi so'mda:
                        <?php 
     if($taminotchi_balance_som>0){
         echo "<span class='text-success'>$taminotchi_balance_som</span>";
     }
          elseif($taminotchi_balance_som<0){
         echo "<span class='text-danger'>$taminotchi_balance_som</span>";
     } else{
           echo "<span class='text-danger'>$taminotchi_balance_som</span>";    
          }   
           ?>
                        so'm </h5>

                    <h5 class="font-weight-light">Manzil: <?php echo $taminotchi_manzil?></h5>
                    <a href="tel: +998<?php echo $tel_asosiy?>"><i class="fas fa-phone mr-2"></i>+9989<?php echo $tel_asosiy?></a> <br>
                    <?php 
                    if($tel_qoshimcha>0){
                        echo "
                    <a href='tel: +998$tel_qoshimcha'><i class='fas fa-phone mr-2'></i>+9989$tel_qoshimcha</a>
                        ";
                    }
                    ?>
                    <form action="" method="post">
                        <button type="button" class="btn btn-info btn-block mt-2" data-toggle="modal" data-target="#myModal_<?php echo $taminotchi_id?>"><i class="fas fa-pen mr-2"></i>O'zgartirish</button>

                        <!-- Modal -->
                        <div class="modal" id="myModal_<?php echo $taminotchi_id?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo $taminotchi_ismi?>ning ma'lumotlarini o'zgartirish</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <lable>Ism</lable>
                                                <input type="text" name="edit_ism" value="<?php echo $taminotchi_ismi?>" class="form-control" placeholder="ism">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Manzil</lable>
                                                <input type="text" name="edit_manzil" value="<?php echo $taminotchi_manzil?>" class="form-control" placeholder="manzil">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Tel: asosiy</lable>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            +998
                                                        </span>
                                                    </div>
                                                    <input type="number" name="edit_tel_asosiy" value="<?php echo $tel_asosiy?>" class="form-control" placeholder="tel: asosiy">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Tel: qoshimcha</lable>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            +998
                                                        </span>
                                                    </div>
                                                    <input type="number" name="edit_tel_qoshimcha" value="<?php echo $tel_qoshimcha?>" class="form-control" placeholder="tel: qoshimcha">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Balasi so'mda</lable>
                                                <div class="input-group">
                                                    <input type="number" name="edit_balace_som" value="<?php echo $taminotchi_balance_som?>" class="form-control" placeholder="balasi so'mda">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            so'm
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Iqtisosligi</lable>
                                                <select class="form-control" name="edit_iqtisosiligi">
                                                    <option value="<?php echo $ixtsosligi?>"><?php echo $maxsulot_nomi?></option>
                                                    <?php 
$query = "SELECT * FROM maxsulot_turi";
$select = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select)){
$maxsulot_turi_id = $row['maxsulot_turi_id'];   
$maxsulot_nomi = $row['maxsulot_nomi'];   
 
    ?>
                                                    <option value="<?php echo $maxsulot_turi_id?>"><?php echo $maxsulot_nomi?></option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <lable>Izoh</lable>
                                                <textarea name="edit_izoh" class="form-control" placeholder="izoh uchun ...." cols="60" rows="4"><?php echo $izoh?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-block btn-primary" value="<?php echo $taminotchi_id?>" name="save_edit" type="submit"><i class="fas fa-check mr-2"></i>Saqlash</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--  ./ Modal -->
                        <button type="submit" value="<?php echo $taminotchi_id?>" class="btn btn-danger btn-block mt-2" name="delete"><i class="fas fa-trash mr-2"></i>O'chirish</button>
                    </form>
                </div>
            </div>

        </div>
        <?php } } ?>
    </div>
</div>
<?php 
if(isset($_POST['save_edit'])){
// taminotchini id si keladi
 $taminotchi_id = $_POST['save_edit'];   
// iqtisosligini id si keladi
 $edit_iqtisosiligi = $_POST['edit_iqtisosiligi'];   
 $edit_balace_som = $_POST['edit_balace_som'];     
 $edit_tel_qoshimcha = $_POST['edit_tel_qoshimcha'];   
 $edit_tel_asosiy = $_POST['edit_tel_asosiy'];   
 $edit_manzil = $_POST['edit_manzil'];
$edit_manzil = mysqli_real_escape_string($connection, $edit_manzil);
 $edit_ism = $_POST['edit_ism'];
$edit_ism = mysqli_real_escape_string($connection, $edit_ism);
 $edit_izoh = $_POST['edit_izoh'];
$edit_izoh = mysqli_real_escape_string($connection, $edit_izoh);
    
$query = "UPDATE taminotchi SET taminotchi_ismi = '{$edit_ism}', tel_asosiy = '{$edit_tel_asosiy}', tel_qoshimcha = '{$edit_tel_qoshimcha}', taminotchi_balance_som = '{$edit_balace_som}', ixtsosligi = '{$edit_iqtisosiligi}', taminotchi_manzil = '{$edit_manzil}', izoh = '{$edit_izoh}' WHERE taminotchi_id = '{$taminotchi_id}' && filial_id = '{$the_filial_id}'";
$update_taminotchi = mysqli_query($connection, $query);
    if($update_taminotchi){
      header("Location: taminotchi.php"); 
    }
}
if(isset($_POST['delete'])){
$taminotchi_id = $_POST['delete'];        
$query = "DELETE FROM taminotchi WHERE taminotchi_id = '{$taminotchi_id}'";
$delete = mysqli_query($connection, $query);
    if($delete){
      header("Location: taminotchi.php"); 
    }
}
?>
