
<?php include "../includes/header.php"; ?>
<?php include "../includes/admin_sidebar.php"; ?>

<h1 class="mt-4">Faoliyat Bo'limi.</h1>
<div class="justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-1 rounded-lg">
                <?php
    if(isset($_GET['faoliyat'])) {
        
        $faoliyat = $_GET['faoliyat'];        
        
    } else {
        $faoliyat = '';
    }
    
        switch($faoliyat) {  
    // maxsulotni o'zgartirish            
            case 'edit_maxsulot';            
                include "../includes/edit_maxsulot.php"; ;
            break;
    // ./  maxsulotni o'zgartirish        
                
    // maxsulotni narxini o'zgartirish
            case 'edit_maxsulot_price';            
                include "../includes/edit_maxsulot_price.php"; ;
            break;
    // ./  maxsulotni narxini o'zgartirish
          
            default:
                include "../includes/add_maxsulot.php";                          
            break;
       
    }
               ?>
            </div>
        </div>
    </div>


<?php include "../includes/footer.php"; ?>
