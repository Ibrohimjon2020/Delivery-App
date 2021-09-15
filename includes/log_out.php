<?php session_start(); ?>
<?php include "data.php"; ?>
<?php
 if(isset($_SESSION['user_id'])){
     $the_user_id = $_SESSION['user_id'];
 }
?>

<?php


             
        $_SESSION['username'] = null;
        $_SESSION['user_firstname'] = null;
        $_SESSION['user_lastname'] = null;
        $_SESSION['user_role'] = null;
        $_SESSION['user_id'] = null;
        header("Location: ../index.php");
       
        





?>
