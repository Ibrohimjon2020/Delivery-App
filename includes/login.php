<?php include "data.php"; ?>
<?php session_start(); ?>

<?php


    if(isset($_POST['enter'])){
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        
$username = mysqli_real_escape_string($connection, $username);   
$user_password = mysqli_real_escape_string($connection, $user_password);
        
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_username_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_username_query)){
    $db_user_id = $row['user_id'];
    $db_username = $row['username'];
    $db_user_image = $row['user_image'];
    $db_user_password = $row['user_password'];
    $db_user_firstname = $row['user_firstname'];
    $db_user_lastname = $row['user_lastname'];
    $db_user_role = $row['user_role'];
    $db_user_lastonline = $row['user_lastonline'];
            
        }
        
$user_password = crypt($user_password, $db_user_password);
        
    if(empty($username)){
        header("Location: ../index.php?message=none_username");
        
    } elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'admin'){
        
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        
   
            
        header("Location: ../back/admin/admin_index.php");
      
        
        
    }elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'savdo_admin'){
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        
     
                    header("Location: ../back/trade_admin/savdo_admin_index.php");

      
        
        
    }elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'production_admin'){
        
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        
       
        header("Location: ../back/production_admin/production_admin_index.php");

        
        
        
    }elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'production'){
        
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
       
        header("Location: ../back/production/production_index.php");

     
        
        
        
    }elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'savdo'){
        
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        
      
        header("Location: ../back/savdo/savdo_index.php");

        
    }elseif($username === $db_username && $user_password === $db_user_password && $db_user_role === 'transport'){
        $_SESSION['user_image'] = $db_user_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        
       
        header("Location: ../back/transport/transport.php");

        
        
        
    }else{
         header("Location: ../index.php?message=error_user");
    } 


    }

?>