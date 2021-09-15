<div class="card-header mb-2">
    <h3 class="text-center font-weight-light">Mashina Ma'lumotlari</h3>
</div>
<div class="col-md-12">
    <div class="row">
        <?php                              
$query = "SELECT * FROM moshina";
$select_moshina_query = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_moshina_query)){
    $moshina_id = $row['moshina_id'];
    $nomer_viloyat = $row['nomer_viloyat'];
    $nomer_qolgani = $row['nomer_qolgani'];
    $moshina_izoh = $row['moshina_izoh'];
    $image = $row['image'];
    $moshina_turi = $row['moshina_turi'];
    $car_user_id = $row['car_user_id'];
    
// haydovchi ismi
$query = "SELECT user_firstname, user_lastname FROM users WHERE user_id = '{$car_user_id}'";
$select_users = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select_users)){
    $haydovchi_ism = $row['user_firstname'];
    $haydovchi_familya = $row['user_lastname'];
}
    ?>
        <div class="col-md-3">
            <div class="card shadow-lg border-1 mt-3 rounded-lg">
                <img height="200px" class="card-img-top cover" width="80px" src="../../img/car_img/<?php echo $image ?>">
                <div class="col-md-12">
                    <p class="btn-sm text-center" style="background:#00000070; position:relative; top:-50px"><b class="text-white"><?php echo $nomer_viloyat." ".$nomer_qolgani; ?> | UZ</b></p>
                    <h5><?php echo $moshina_turi; ?></h5>
                    <h6><b>Nomer: <?php echo $nomer_viloyat." ".$nomer_qolgani; ?> | UZ</b></h6>
                    <?php 
                    if($car_user_id == "0"){
                        echo "<h6><b>Haydovchi: <span class='text-danger'>Yo'q</span></b></h6>";
                    }
    else{
        echo "<h6><b>Haydovchi: $haydovchi_ism $haydovchi_familya</b></h6>";
    }
                    ?>

                </div>
                <a href="transport.php?transport=edit_transport&c_id=<?php echo $moshina_id; ?>"><input class="btn btn-info btn-block mb-1" type="button" value="O'zgartirish"></a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
