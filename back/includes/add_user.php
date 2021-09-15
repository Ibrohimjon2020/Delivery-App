<div class="justify-content-center">
    <div class="col-lg-12">
        <h1 class="mt-4">Hodimlar bo'limi.</h1>
        <div class="card shadow-lg border-1 rounded-lg">
            <div class="card-header">
                <h3 class="text-center font-weight-light"> Yangi ishchi hodim qo'shish</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="row col-md-6 mt-2">
                                <div class="col-md-2">
                                    <img src="../images/avatar.jpg" width="100%" alt="user_logo">
                                </div>
                                <div class="col-md-7">
                                    <label for="user_image">Hodim rasmi:</label>
                                    <input type="file" name="user_image" class="form-control" id="user_image">
                                </div>
                            </div>
                            <div class="row col-md-6 mt-2">
                                <div class="col-md-2 ml-3">
                                    <img src="../images/pasport.jpg" width="100%" alt="passport_logo">
                                </div>
                                <div class="col-md-7 mt-2">
                                    <label for="user_passport">Hodim pasporti:</label>
                                    <input type="file" name="user_passport" class="form-control" id="user_passport" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="user_login">Login:</label>
                                <input type="text" name="user_login" class="form-control" id="user_login" placeholder="Yangi foydalanuvchi loginini kiriting" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="user_parol">Parol:</label>
                                <input type="password" name="user_parol" class="form-control" id="user_parol" placeholder="Yangi foydalanuvchi parolini kiriting" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="user_firstname">Ismi:</label>
                                <input type="text" name="user_firstname" class="form-control" id="user_firstname" placeholder="Yangi foydalanuvchi ismini kiriting" required>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="user_lastname">Familiya:</label>
                                <input type="text" name="user_lastname" class="form-control" id="user_lastname" placeholder="Yangi foydalanuvchi familiyasini kiriting" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_phone">Telefon raqami:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+998</span>
                                    </div>
                                    <input type="number" min="0" name="user_phone" class="form-control" id="user_phone" placeholder="Yangi foydalanuvchini telefon raqamini kiriting" required>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_phone">Hodim uchun maosh</label>
                                <div class="input-group">
                                    <input type="number" min="0" name="user_maosh" class="form-control" placeholder="Hodim maoshini kiriting" required>
                                    
                                <div class="input-group-append">
                                    <span class="input-group-text">so'm</span>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="">Hodim bo'limi:</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value=""></option>
                                    <option value="admin">admin</option>                                   
                                    <option value="haydovchi">haydovchi</option>
                                    <option value="kassir">kassir</option>
                                    <option value="sotuvchi">sotuvchi</option>
                                </select>
                            </div>


                            <button class="btn btn-success btn-block mt-3" type="submit" name="add_users">Qo'shish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['add_users'])){
    
 // hodim rasimi   
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../../img/user/$user_image");
    
 // hodim passaport   
    $user_passport = $_FILES['user_passport']['name'];
    $user_passport_temp = $_FILES['user_passport']['tmp_name'];
    move_uploaded_file($user_passport_temp, "../../img/user/$user_passport");
    
// rasim yo'q bolsa
     if(empty($user_image)){
    $user_image = "avatar.jpg";
    }   
    
    $user_login = $_POST['user_login'];
    $user_parol = $_POST['user_parol'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_phone = $_POST['user_phone'];
    $user_maosh = $_POST['user_maosh'];
    $user_role = $_POST['user_role'];
           
//passwordni crypt qilish    
    $query = "SELECT user_randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($select_randsalt_query);
    
    $salt = $row['user_randSalt'];
        
    $user_password = crypt($user_parol, $salt);
    
 // user telefoni uchun validatsiya
$query = "SELECT user_phone FROM users WHERE user_phone = '{$user_phone}'";
$select_user_phone = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_user_phone);
$num_user_phone = mysqli_num_rows($select_user_phone);
if($num_user_phone>0){
    echo "<script>alert('Bunday telfon raqam bazada bor.')</script>";
}   
    
    else{
         // hodimlar qo'shish
$query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_image, user_role, user_work_date, user_phone, user_passport, user_maosh)";
$query .= "VALUES('{$user_login}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_image}', '{$user_role}', now(), '{$user_phone}', '{$user_passport}', '{$user_maosh}')";
$insert_query = mysqli_query($connection , $query);
if($insert_query){
   header ("Location: users.php");
}
        
   }
    
}

?>