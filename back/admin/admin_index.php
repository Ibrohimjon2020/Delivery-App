<?php include "../includes/header.php"; ?>
<?php include "../includes/admin_sidebar.php"; ?>

<div class="justify-content-center mt-3">
    <div class="col-lg-12">
        <div class="card shadow-lg border-1 rounded-lg">




            <?php
if(isset($_POST['add_chiqim'])){
  
    $chiqim_name = $_POST['chiqim_izoh'];
    
    $chiqim_name = mysqli_real_escape_string($connection, $chiqim_name);
  
   if(empty($chiqim_name)){
            echo "<script>alert('Iltimos, chiqim uchun izoh kiriting')</script>";
        }
    else{  
        $query = "INSERT INTO type_chiqim (chiqim_name) ";
$query .= "VALUES ('{$chiqim_name}')";                                                      
$add_costumer_query = mysqli_query($connection, $query);
        
        if(!$add_costumer_query){
            echo "Query Failed".mysqli_error($connection);
        } else {
            header("Location: admin_index.php");
        }
    }
   
    
}
//
 if(isset($_POST['chiqim_yuborish'])){
     $chiqim_summa = $_POST['doimiy_chiqim_summa'];
     $chiqim_name = $_POST['chiqim_yuborish'];


     if(empty($chiqim_summa)){
         echo "<script>alert('Iltimos, chiqim uchun izoh kiriting')</script>";
        }
        else{  
            $query = "INSERT INTO chiqim (chiqim_narx, chiqim_date, chiqim_izoh, chiqim_user_id) ";
            $query .="VALUES ( '{$chiqim_summa}', now(), '{$chiqim_name}', '{$the_user_id}' )";                                                      
            $add_costumer_query = mysqli_query($connection, $query);
        
            if(!$add_costumer_query){
                echo "Query Failed".mysqli_error($connection);
            } else {
                echo "<script>alert('$chiqim_name ga $chiqim_summa so`m to`landi')</script>";
            }
        }
     
    }
 if(isset($_POST['bir_chiqim'])){
        $chiqim_name= $_POST['chiqim_bir_izoh'];
        $chiqim_summa = $_POST['chiqim_bir_summa'];


     if(empty( $chiqim_name)){
         echo "<script>alert('Iltimos, chiqim uchun izoh kiriting')</script>";
        }
        else{
            if(empty($chiqim_summa)){
                echo "<script>alert('Iltimos, chiqim summasini kiriting')</script>";
            }else{
                
            
            $query = "INSERT INTO chiqim (chiqim_narx, chiqim_date, chiqim_izoh, chiqim_user_id) ";
            $query .="VALUES ( '{$chiqim_summa}', now(), '{$chiqim_name}', '{$the_user_id}' )";                                                      
            $add_costumer_query = mysqli_query($connection, $query);
        
            if(!$add_costumer_query){
                echo "Query Failed".mysqli_error($connection);
            } else {
                 echo "<script>alert('$chiqim_name ga $chiqim_summa so`m to`landi')</script>";
            }
            }
        }
     
    }
                                    
                                    
?>


            <div class="card-header">
                <h3 class="text-center font-weight-light">Chiqimlar</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <a href="#" data-toggle="collapse" data-target="#new_taminotchi" aria-expanded="false" aria-controls="collapseLayouts">

                        <button class="btn btn-block btn_blue">Doimiy Chiqim Qo'shish<i class=" ml-1 fa fa-angle-down"></i></button>
                    </a>

                    <form action="" method="post">
                        <div class="collapse ml-0 mt-5 " id="new_taminotchi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <div class="form-row justify-content-center">

                                <div class="col-md-6">
                                    <label class="text-center">Doimiy Chiqim izohi</label>
                                    <input type="text" name="chiqim_izoh" placeholder="Doimiy chiqim izohini kiriting" class="form-control" required>
                                </div>

                            </div>
                            <br>

                            <button class="btn btn_blue btn-block" type="submit" name="add_chiqim">Qo'shish</button>


                        </div>

                    </form>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-8 card px-0">
                            <div class="card-header ">

                                <h4 class=" text-center font-weight-light">Doimiy Chiqimlar Ro'yxati</h4>
                            </div>
                            <div class="card-body">

                                <table class="table table-hover bordered">

                                    <tr>
                                        <th>T/r</th>
                                        <th>Izoh</th>
                                        <th>Summa</th>
                                        <th></th>


                                    </tr>

                                    <?php
                                    $i = 0;                                   
                                    
                                        $query = "SELECT * FROM type_chiqim";
                                        $select_doimiy_chiqim_query = mysqli_query($connection, $query);
                                    while($row=mysqli_fetch_assoc($select_doimiy_chiqim_query)){
                                        $doimiy_chiqim_id = $row['chiqim_id'];
                                        $doimiy_chiqim_name = $row['chiqim_name'];
                                        $i++;
   
                                    ?>
                                    <form action="" method="post">
                                        <tr>
                                            <td style="width:30px"><?php echo $i ?></td>
                                            <td class="text-dark">
                                            	<a href="trade.php?source=view_doimiy_chiqim&ch=<?php echo $doimiy_chiqim_id;?>">
                                            		<b><?php echo $doimiy_chiqim_name; ?></b>
                                            	</a>
                                            </td>
                                            <td style="width:150px">
                                                <input type="number" class="form-control doimiy_chiqim_summa px-0" name="doimiy_chiqim_summa" required>

                                            </td>
                                            <td class="px-0 pr-1">
                                                <button class="btn btn_blue ptichka" type="submit" value="<?php echo $doimiy_chiqim_name; ?>" name="chiqim_yuborish"><i class="fa fa-check "></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                    <?php } ?>
                                    
                                    

                                </table>
                                        <?php
                                            if(empty($doimiy_chiqim_name)){
                                                echo"<h6 class='text-center text-secondary'>Doimiy chiqimlar ro`yxati bo`sh</h6>";
                                            }
                                        ?>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-8 card px-0">
                            <div class="card-header ">

                                <h4 class=" text-center font-weight-light">Bir Martalik Chiqim kiritish</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label for="">Chiqim izohini kiriting</label>
                                            <input type="text" class="form-control" name="chiqim_bir_izoh" placeholder="chiqim uchun izoh" required>
                                        </div>

                                        <div class="col-md-4  ">
                                            <label for="">Summasi</label>
                                           <div class="input-group">
                                               
                                            <input type="number" class="form-control px-2" placeholder="summasi" name="chiqim_bir_summa" required>
                                            <div class="input-group-append px-1" style="font-size:13px">
                                               <div class="input-group-text">
                                                   
                                                <b>so'm</b>
                                               </div>
                                            </div>
                                           </div>

                                        </div>
                                        <div class="col-md-2   px-0">
                                        <label for=""><br></label>
                                            <button style="background-color:#1a2954;  color:white;" class="btn btn-block" type="submit" name="bir_chiqim">Kiritish</button>
                                        </div>


                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>




<!-- ./barcha buyurtmalar soni-->
<!--
<h1 class="mt-4">Korxonaning Asosiy Ko'rsatkichlari</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Bu bo'lim korxonaning barcha ko'rsatkichlari akslantirilib u faqatgina Adminda ko'rinadi</li>
</ol>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">Buyurtmalar <?php // echo $num_order_products; ?></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="trade.php?source=buyurtmalar">buyurtmalar ma`lumotini ko'rish</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">Amaldagi Buyurtmalar</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">amaldagi buyurtmalarni ko'rish</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Haqdorliklar</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="trade.php?source=haqdorlar">haqdorlar ro'yhati</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Qarzdorliklar</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="trade.php?source=qarzdorlar">qarzdorlar ro'yhati</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Bir Oylik Buyurtmalar Statistikasi
            </div>
            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar mr-1"></i>
                Ombordagi Tayyor Mahsulotlar Ko`rsatkichi
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Qarzdorliklar Hisobi
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class = "card-header text-center">
                        <tr>
                            <th>Mijoz</th>
                            <th>Qarzdorlik summasi</th>
                        </tr>
                    </thead>
                    <tbody class = "card-body">
                        <?php
//$query = "SELECT * FROM costumers";
//$select_costumer_name_query = mysqli_query($connection, $query);
//while($row = mysqli_fetch_assoc($select_costumer_name_query)){
//$costumer_name = $row['costumer_name'];
//$costumer_balance = $row['costumer_balance'];
//$costumer_id = $row['costumer_id'];
//    if($costumer_balance<0){
//
//  echo "
//  
//  
//                    <tr>
//                        <td><a href='trade.php?source=view_order&c_id=$costumer_id; '>$costumer_name </a></td>
//                        <td class='text-danger text-center'> $costumer_balance</td>
//                        </tr>
//
//
//                        ";
//                        }

                        ?>
                        <?php //} ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class = "card-header text-center">
                        <tr>
                            <th>Ta'minotchi</th>
                            <th>Qarzdorlik summasi</th>
                        </tr>
                    </thead>
                    <tbody class = "card-body">
                        <?php
//$query = "SELECT * FROM taminotchi";
//$select_costumer_name_query = mysqli_query($connection, $query);
//while($row = mysqli_fetch_assoc($select_costumer_name_query)){
//$taminotchi_name = $row['taminotchi_name'];
//$taminotchi_balance = $row['taminotchi_balance'];
//$taminotchi_id = $row['taminotchi_id'];
//    if($taminotchi_balance<0){
//
//  echo "
//  
//  
//                    <tr>
//                        <td><a href='taminotchi.php?source=view_taminotchi&t_id=$taminotchi_id;'>$taminotchi_name </a></td>
//                        <td class='text_danger text-center'> $taminotchi_balance</td>
//                        </tr>
//
//
//                        ";
//                        }

                        ?>
                        <?php //} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
-->




<?php  include "../includes/footer.php"; ?>
