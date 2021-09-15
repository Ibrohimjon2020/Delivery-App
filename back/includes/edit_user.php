<?php
// user id ni wiewdan olib kelish
if(isset($_GET['u_id'])){
 $user_id = $_GET['u_id'];   
}

$query = "SELECT * FROM users WHERE user_id = $user_id";
$select_user_query = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($select_user_query)){
    $user_image = $row['user_image'];
    $user_passport = $row['user_passport'];
    $user_login = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_phone = $row['user_phone'];

}

?>
<?php
if(isset($_POST['edit_user'])){
    
    $user_image_post = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
            
    move_uploaded_file($user_image_temp, "../../img/users/$user_image_post");
    
    $user_passport_post = $_FILES['user_passport']['name'];
    $user_passport_temp = $_FILES['user_passport']['tmp_name'];
            
    move_uploaded_file($user_passport_temp, "../../img/users/passport/$user_passport_post");
    
    if(empty($user_image_post)){
        $user_image_post = $user_image;
    }
    
    if(empty($user_passport_post)){
        $user_passport_post = $user_passport;
    }
             
    $user_login = $_POST['user_login'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_phone = $_POST['user_phone'];
    
    $user_login = mysqli_real_escape_string($connection, $user_login);
    $user_firstname = mysqli_real_escape_string($connection, $user_firstname);
    $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
    $user_image = mysqli_real_escape_string($connection, $user_image);
    $user_passport = mysqli_real_escape_string($connection, $user_passport);
    
    $query = "UPDATE users SET username = '{$user_login}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_image = '{$user_image_post}', user_role = '{$user_role}', user_phone = '{$user_phone}', user_passport = '{$user_passport_post}' WHERE user_id = $user_id";
        
    $update_users_query = mysqli_query($connection , $query);
    if(!$update_users_query){
            echo "Query Failed".mysqli_error($connection);
        } else {
               header("Location: admin_index.php");
        }
    
}

?>
<div class="justify-content-center">
    <div class="col-lg-12">
        <h1 class="mt-4">Hodimlar bo'limi.</h1>
        <div class="card shadow-lg border-1 rounded-lg">
            <div class="card-header">
                <h3 class="text-center font-weight-light"><?php echo $user_firstname." ". $user_lastname?> to'g'risidagi ma'lumotlarini o'zgartirish</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="row col-md-6 mt-2">
                                <div class="col-md-3">
                                    <img src="../../img/user/<?php echo $user_image;?>" width="100%" alt="user_logo">
                                </div>
                                <div class="col-md-7">
                                    <label for="user_image">Hodim rasmi:</label>
                                    <input type="file" name="user_image" class="form-control">
                                </div>
                            </div>
                            <div class="row col-md-6 mt-2">
                                <div class="col-md-3 ml-3">
                                    <img src="../../img/user/<?php echo $user_passport; ?>" width="100%">
                                </div>
                                <div class="col-md-7 mt-2">
                                    <label for="user_passport">Hodim pasporti:</label>
                                    <input type="file" name="user_passport" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_login">Login:</label>
                                <input type="text" name="user_login" class="form-control" id="user_login" value="<?php echo $user_login; ?> " required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_login">Parol:</label>
                                <input type="password" name="user_password" class="form-control">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_firstname">Ismi:</label>
                                <input type="text" name="user_firstname" class="form-control" id="user_firstname" value="<?php echo $user_firstname; ?> " required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_lastname">Familiya:</label>
                                <input type="text" name="user_lastname" class="form-control" id="user_lastname" value="<?php echo $user_lastname; ?>" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="user_phone">Telefon raqami:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+998</span>
                                    </div>
                                    <input type="text" name="user_phone" class="form-control" id="user_phone" value="<?php echo $user_phone;?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="">Hodim bo'limi:</label>
                                <select name="user_role" id="user_role" class="form-control">
                                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?> </option>
                                    <option value="admin">admin</option>                                   
                                    <option value="haydovchi">haydovchi</option>
                                    <option value="kassir">kassir</option>
                                    <option value="sotuvchi">sotuvchi</option>
                                </select>
                            </div>


                            <button class="btn btn-success btn-block mt-3" type="submit" name="edit_user">Tasdiqlash</button>
                        </div>
                    </div>
                </form>
                <?php include "../includes/footer.php"; ?>
