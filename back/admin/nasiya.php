<?php include "../includes/header.php"?>
<?php include "../includes/admin_sidebar.php"?>

<h3 class="mt-4 ml-3">Nasiya Bo'limi</h3>
<div class="justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-1 rounded-lg">
            <?php 
            if(isset($_GET['nasiya'])){
                $nasiya = $_GET['nasiya'];
            }
            else{
                $nasiya = '';
                
            }
            switch($nasiya){
default:
include "../includes/nasiyachilar.php";
break;
            }
            ?>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"?>