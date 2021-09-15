<div class="col-md-12">
    <div class="row">
        <?php                              
$query = "SELECT * FROM mijozlar ORDER BY mijoz_id DESC";
$select_taminotchi_query = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_taminotchi_query)){
    $mijoz_id = $row['mijoz_id'];
    $mijoz_name = $row['mijoz_name'];
    $tel_asosiy = $row['tel_asosiy'];
    $tel_qoshimcha = $row['tel_qoshimcha'];
    $balance = $row['balance'];
    
    ?>

        <div class="col-md-3 mb-3">
            <div class="card shadow-lg border-1 mt-3 rounded-lg">
                  <div class="card-header">
                  
                   <h5 class=" text-center"><b><?php echo $mijoz_name; ?></b></h5> 
                </div>
            <div class="card-body">
                   <h5><small>asosiy: <a href="tel: +998<?php echo $tel_asosiy?>"><i class="fa fa-phone"></i> +998<?php echo $tel_asosiy ?></a></small></h5>
                  <?php 
        if(empty($tel_qoshimcha)){
        $tel_qoshimcha = "---yo`q";
    echo "<h5><small><a href='tel: +998$tel_qoshimcha'  class='text-danger'>+998$tel_qoshimcha</a></small></h5>"; 
        } 
    else{
      echo "<h5><small><a href='tel: +998$tel_qoshimcha'>+998$tel_qoshimcha</a></small></h5>   ";  
    }
    ?>
                   
               </div>
                <div class="card-footer">
                
                 <h5 class="text-center"><small>Balansi : </small><?php 
    if($balance>0){
    echo"<small class='text-info'> $balance so'm</small>"; }
     elseif($balance==0){
    echo"<small class='text-success'> $balance so'm</small>"; }
    else{
    echo"<small class='text-danger'> $balance so'm</small>"; }
                 ?></h5>   
                  </div>
            <a href="savdo.php?savdo=buyurtma_olish&t_id=<?php echo $tel_asosiy ?>"><button class="btn btn-block btn-info" value="<?php echo $mijoz_id ?>">Buyurtma Olish</button></a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
