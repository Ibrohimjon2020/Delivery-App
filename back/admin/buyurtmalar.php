<?php 
include "../includes/header.php";
include "../includes/admin_sidebar.php";
?>
<h2 class="mt-4 ml-2">Buyurtmalar Bo'limi</h2>
<div class="justify-content-center">
    <div class="col-md-12">
        <div class="card shadow-lg border-1 rounded-lg">

            <?php          
            if(isset($_GET['buyurtma'])){
    $buyurtma = $_GET['buyurtma'];
}
            else{
                $buyurtma = '';
            }
            switch($buyurtma){
                    
################# // buyurtmadan aniq (ayni bir) haydovchiga jonatilgan tavaralr shunga tushadi. ########################                
case 'only_haydovchi';
include "../includes/only_haydovchi.php";
break;
######################  // ./ buyurtmadan aniq (ayni bir) haydovchiga jonatilgan tavaralr shunga tushadi.  ################
                    
################# // buyurtmadan aniq (ayni bir) haydovchiga jonatilgan barcha tavaralr shunga tushadi. ########               
case 'only_haydovchi_view';
include "../includes/only_haydovchi_view.php";
break;
######################  // ./ buyurtmadan aniq (ayni bir) haydovchiga jonatilgan barcha tavaralr shunga tushadi.  ########
                    
default:
include "../includes/buyurtmalar_view.php";
break;
                    
            }
  ?>
        </div>
    </div>
</div>
<?php include "../includes/footer.php"?>
