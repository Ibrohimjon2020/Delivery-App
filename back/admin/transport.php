<?php include "../includes/header.php"; ?>
<?php include "../includes/admin_sidebar.php"; ?>

<?php
    
    if(isset($_GET['transport'])) {
        
        $transport = $_GET['transport'];        
        
    } else {
        $transport = '';
    }
    
    switch($transport) {
  
// faqat mashina turlari qo'shish misol --> kamaz, zil, jumong, porter        
          case 'add_car_type':           
            include "../includes/add_car_type.php";
            break;
            
// mashinalar qoshish hammasi nomerlari bilan rasimi holati         
          case 'add_transport':
            include "../includes/add_transport.php";
            break;
            
// barcha mashinalarni o'zgartirish   
        case 'edit_transport':
            include "../includes/edit_transport.php";
            break;
            

        default:
            include "../includes/view_transport.php";
            break;
       
    }


    
    ?>


<?php include "../includes/footer.php"; ?>