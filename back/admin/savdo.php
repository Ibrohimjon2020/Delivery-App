<?php include "../includes/header.php"; ?>
<?php include "../includes/admin_sidebar.php"; ?>

                        <?php
    
    if(isset($_GET['savdo'])) {
        
        $savdo = $_GET['savdo'];        
        
    } else {
        $savdo = '';
    }
    
    switch($savdo) {

            case 'add_mijoz';            
            include "../includes/add_mijoz.php";
            break; 
            
            case 'buyurtma_olish';            
            include "../includes/buyurtma_olish.php";
            break;  
            
            case 'view_mijoz';            
            include "../includes/view_mijoz.php";
            break; 
            
            default:
             include "../includes/all_mijozalr.php";       
             break;
       
    }


    
    ?>
                        
        
        <?php include "../includes/footer.php"; ?>
        