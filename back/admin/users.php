<?php include "../includes/header.php"; ?>
<?php include "../includes/admin_sidebar.php"; ?>

<?php
    
    if(isset($_GET['source'])) {
        
        $source = $_GET['source'];        
        
    } else {
        $source = '';
    }
    
    switch($source) {
  
            
//          case 'view_users':           
//            include "../includes/view_users.php";
//            break;
            
          case 'add_user':
            include "../includes/add_user.php";
            break;
            
     
        case 'edit_user':
            include "../includes/edit_user.php";
            break;
            

        default:
            include "../includes/view_users.php";
            break;
       
    }


    
    ?>


<?php include "../includes/footer.php"; ?>