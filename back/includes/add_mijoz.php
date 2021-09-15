<!--bazaga taminotni qo`shish-->
<?php
if(isset($_POST['add_mijoz'])){
    
// maxsulot                       
$mijoz_ismi = $_POST['mijoz_ismi']; 
$mijoz_ismi = mysqli_real_escape_string($connection, $mijoz_ismi);
// tel
$tel_asosiy = $_POST['tel_asosiy'];
$tel_qoshimcha = $_POST['tel_qoshimcha'];

// telfon nomeriga validatsaiya
$query = "SELECT tel_asosiy FROM mijozlar WHERE tel_asosiy = '{$tel_asosiy}'";
$select_mijozlar = mysqli_query($connection, $query);
$row=mysqli_fetch_assoc($select_mijozlar);
$validate = mysqli_num_rows($select_mijozlar);
if($validate>0){
    echo "<script>alert('Bunday raqam bazada bor ! Boshqa raqam kiriting.')</script>";
}
    else{
// bazaga insert qilish
$query = "INSERT INTO mijozlar(mijoz_name, tel_asosiy, tel_qoshimcha, balance)";
$query .= "VALUES ('{$mijoz_ismi}', '{$tel_asosiy}', '{$tel_qoshimcha}', '0')";
$insert_mijoz = mysqli_query($connection, $query);
  if($insert_mijoz){
        header("Location:savdo.php?savdo=buyurtma_olish&t_id=$tel_asosiy");
                  }
    }
    
    }
?>
<!--bazaga taminotni qo`shish-->

<!--   Yangi maxsulot qo'shish drapdown-->
    <div class="justify-content-center">
<div class="col-md-12">
     <div class="card shadow-lg border-1 rounded-lg mt-2">
<div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data">
        <a href="#" data-toggle="collapse" data-target="#new_taminotchi" aria-expanded="false" aria-controls="collapseLayouts">
            <button class="btn btn-info btn-block my-4 ">Yangi Mijoz qo'shish <i class="fas fa-angle-down ml-1"></i></button>
        </a>
        <div class="collapse ml-0 mt-5 " id="new_taminotchi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="taminot_product">
                            <h4 class='text-center font-weight-light'>Mijoz Ismi</h4>
                        </label>
                        <input type="text" class="form-control" name="mijoz_ismi" placeholder="Mijoz ismi kiriting" required>
                    </div>
                </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_phone">Telefon raqami asosiy:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+998</span>
                                    </div>
                                    <input type="number" min="0" name="tel_asosiy" class="form-control" id="user_phone" placeholder="tel: asosiy" required>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_phone">Telefon raqami qo'shimcha:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+998</span>
                                    </div>
                                    <input type="number" min="0" name="tel_qoshimcha" class="form-control" id="user_phone" placeholder="tel: qo'shimcha">
                                </div>
                            </div>
            </div>
            <button class="btn btn-block btn-success mb-4" name="add_mijoz">Qo'shish</button>
        </div>
    </form>
    </div>
</div>
</div>
</div>
<!--   ./Yangi maxsulot qo'shish drapdown-->
<?php  include "all_mijozlar.php" ?>