<?php include "../includes/header.php"?>

<?php include "../includes/admin_sidebar.php"?>

<h3 class="mt-4">Taminotchi Bo'limi</h3>
<div class="justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-1 rounded-lg">
            <?php 
            if(isset($_GET['taminotchi'])){
                $taminotchi = $_GET['taminotchi'];
            }
            else{
                $taminotchi = '';
                
            }
            switch($taminotchi){
                    
default:
include "../includes/add_taminotchi.php";
break;
            }
            ?>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"?>