<?php 
    if($the_user_role !== 'admin'){
        header("Location:../../includes/log_out.php");
    } 
######################// nechta buyurtma olinganini topish ######################
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_olindi' && filial_id = '{$the_filial_id}'";
$select = mysqli_query($connection, $query);
$buyurtma=mysqli_num_rows($select);
######################//./ nechta buyurtma olinganini topish ######################
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_nasiya' && filial_id = '{$the_filial_id}'";
$select_buyurtma = mysqli_query($connection, $query);
$num_nasiya = mysqli_num_rows($select_buyurtma);
?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu bg-blue scroll">
                <div class="nav ">
                    <div class="sb-sidenav-menu-heading text_gold">
                        <div class="row">
                            <div class="col-2"><img width="30px" height="30px" class="cover mr-2" style="border-radius:20px" src="../../img/user/<?php echo $the_user_image;?>" alt="rasim yo'q"></div>

                            <div class="col-8 ml-3">

                                <?php echo  $the_user_fullname;?>
                            </div>
                        </div>
                    </div>
                    <a class="nav-link" href="admin_index.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-home"></i></div>
                        Bosh menu
                    </a>
                    <div class="sb-sidenav-menu-heading text_gold">Boshqaruv</div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-columns"></i></div>
                        Faoliyat
                        <div class="sb-sidenav-collapse-arrow text_gold"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="faoliyat.php">Maxsulotlarni ko'rish</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-users"></i></div>
                        Hodimlar
                        <div class="sb-sidenav-collapse-arrow text_gold"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="users.php">
                                Barcha Hodimlar
                            </a>
                            <a class="nav-link" href="users.php?source=add_user">
                                Yangi Ishchi Hodim
                            </a>
                            <a class="nav-link" href="transport.php?transport=add_transport">
                                <div class="sb-nav-link-icon text_gold"><i class="fas fa-truck"></i></div>
                                Transport Qo'shish
                            </a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading text_gold">Bo'limlar</div>
                    <a class="nav-link" href="savdo.php?savdo=add_mijoz">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-table"></i></div>
                        Savdo Bo'limi
                    </a>


                    <a class="nav-link" href="buyurtmalar.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                        Buyurtmalar Bo'limi <?php if($buyurtma != 0){ echo "<span class='bil_num'>".$buyurtma."</span>";} ?>
                    </a>
                    <?php 
    if($the_user_role == 'admin'){

  
// buyurtma 
$query = "SELECT * FROM buyurtma WHERE buyurtma_status = 'b_olindi' && haydovchi_id = '$the_user_id'";
$select = mysqli_query($connection, $query);
$absolyut_buyurtma=mysqli_num_rows($select);
          }
                    ?>
                    <a class="nav-link" href="buyurtmalar.php?buyurtma=only_haydovchi_view&absolyut_haydovchi=<?php echo $the_user_id ?>">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-truck"></i></div>
                        Aniq transportga buyurtma <?php if($absolyut_buyurtma != 0){ echo "<span class='bil_num'>".$absolyut_buyurtma."</span>";} ?>
                    </a>
                    <a class="nav-link" href="taminotchi.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                        Taminotchi
                    </a>
                    <a class="nav-link" href="nasiya.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-money-bill"></i></div>
                        Nasiya bo'limi<?php if($num_nasiya != 0){ echo "<span class='bil_num'>".$num_nasiya."</span>";}?>
                    </a>
                    <!--
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages00" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-home"></i></div>
                        Ombor<?php if($num_topshirish != 0){ echo "<span class='bil_num'>".$num_topshirish."</span>";}?>
                        <div class="sb-sidenav-collapse-arrow text_gold"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages00" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link" href="ombor.php?source=ombor_topshiruv">
                                <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                                Topshiruv Ombori Bo'limi<?php if($num_topshirish != 0){ echo "<span class='bil_num'>".$num_topshirish."</span>";}?>
                            </a>
                            <a class="nav-link" href="ombor.php?source=tayyor_mah_ombor">
                                <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                                Tayyor Mahsulot Ombor Bo'limi
                            </a>
                            <a class="nav-link" href="ombor.php?source=raw_warehouse">
                                <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                                Homashyo Ombori Bo'limi
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link" href="transport.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-truck"></i></div>
                        Transport Bo'limi<?php if($num_transport != 0){echo "<span class='bil_num'>".$num_transport."</span>";}?>
                    </a>
                    <a class="nav-link collapsed" href="production.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                        Ishlab Chiqarish Bo'limi
                    </a>
                    <a class="nav-link" href="taminotchi.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-chart-area"></i></div>
                        Ta'minotchi
                    </a>

					 <a class="nav-link" href="accounting.php">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-money-bill"></i></div>
                        Hisob-kitob bo'limi<?php if($num_kirim != 0){ echo "<span class='bil_num'>".$num_kirim."</span>";}?>
                    </a>

                    <a class="nav-link mb-4" href="trade.php?source=main_chiqimlar">
                        <div class="sb-nav-link-icon text_gold"><i class="fas fa-money-bill-wave"></i></div>
                        Chiqimlar Bo'limi
                    </a>
-->

                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
