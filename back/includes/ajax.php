<?php include "db.php";?>
   <?php 
    if(isset($_POST['olchov'])){
    // mashina id si keladi
        $olchov = $_POST['olchov'];
    // maxsulot id si 
        $product = $_POST['product'];
    
        $hajim = $_POST['hajim'];
        
    }
if(empty($olchov)){
  echo"<script>alert('Mashinani tanlang !!!! ')</script>" ;
}
else{
#########################################// maxsulotni id sidan nomini olib kelish  #############################
$query1 = "SELECT maxsulot_nomi FROM maxsulot_turi WHERE maxsulot_turi_id = $product";
$select_maxsulot_turi = mysqli_query($connection, $query1);
$row=mysqli_fetch_assoc($select_maxsulot_turi);
$maxsulot_nomi = $row['maxsulot_nomi'];

// mashina id sidan nomini olib kelish
$query2 = "SELECT car_type_nomi FROM moshina_turlari WHERE car_type_id  = $olchov";
$select_mashina_turi = mysqli_query($connection, $query2);
$row=mysqli_fetch_assoc($select_mashina_turi);
$car_type_nomi = $row['car_type_nomi'];

//#######################// shunday mashina lar qancha kimda bor ligini bilish ###########################
//$query = "SELECT car_user_id FROM moshina WHERE moshina_turi = $car_type_nomi";
//$select_mashinalar = mysqli_query($connection, $query);
//$row=mysqli_fetch_assoc($select_mashinalar);
//// shu mashinani hozirda kim minyatganini bilish
//$car_user_id = $row['car_user_id'];
    
//#####################################// shu haydovchi ismi familyasi bilish uchun   ###############################
//$query = "SELECT user_firstname, user_lastname FROM users WHERE user_id = $car_user_id";
//$select_users = mysqli_query($connection, $query);
//while($row=mysqli_fetch_assoc($select_users)){
// $user_firstname = $row['user_firstname'];   
// $user_lastname = $row['user_lastname'];  
//}
//    
##################################// maxsulot uchun narx olib kelish  ###################################
$query = "SELECT * FROM maxsulotlar WHERE olchov = '{$car_type_nomi}' && maxsulot_nomi = '{$maxsulot_nomi}'";
$select = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($select)){
$price = $row['price'];
$min_price = $row['min_price'];
    
$tan_narxi = $min_price * $hajim;
$narxi = $price * $hajim;
    }

//echo $narxi;
    echo number_format($narxi) ." so'm";
}
?>


















