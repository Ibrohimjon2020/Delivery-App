<div class="col-md-12">
    <div class="row">
        <?php                              
$query1 = "SELECT * FROM maxsulot_turi";
$select_taminotchi_query = mysqli_query($connection, $query1);
while($row=mysqli_fetch_assoc($select_taminotchi_query)){
    $maxsulot_turi_id  = $row['maxsulot_turi_id'];
    $maxsulot_nomi  = $row['maxsulot_nomi'];

$query = "SELECT * FROM maxsulotlar WHERE maxsulot_nomi = '{$maxsulot_nomi}'";
$select_maxsulotlar = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_maxsulotlar)){

    $status = $row['status'];
    $img = $row['img'];
}
    ?>

        <div class="col-md-3 mb-3">
            <div class="card shadow-lg border-1 mt-3 rounded-lg">

                <img height="200px" class="card-img-top cover" width="80px" src="../images/maxsulotlar/<?php echo $img ?>" alt="<?php echo $maxsulot_nomi ?>">
                  <div class="col-12">
                      <p class="btn-sm text-center" style="background:#00000070; position:relative; top:-50px"><b class="text-white"><?php echo $maxsulot_nomi; ?></b></p>
                   <h6 class=" text-center">Maxsulot hozirda: <?php echo $status; ?></h6>  
                  </div>
            <a href="faoliyat.php?faoliyat=edit_maxsulot&m_id=<?php echo $maxsulot_turi_id ?>"><button class="btn btn-block btn-success mt-2"><i class="fa fa-pen"></i> O'zgartirish</button></a>            <a href="faoliyat.php?faoliyat=edit_maxsulot_price&m_id=<?php echo $maxsulot_turi_id ?>"><button class=" btn btn-block btn-outline-dark mt-1"><i class="fa fa-truck"></i> Narxini o'zgartirish</button></a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
