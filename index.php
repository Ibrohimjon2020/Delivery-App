<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dostavka</title>
    <link href="img/olmazorLogo3.png" rel="icon">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="back/css/style.css" rel="stylesheet" />
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <center>
                                        <img width="50%" src="img/Onyup.jpg" alt="">
                                    </center>
                                    <h3 class="text-center text_gold font-weight-light my-4">Kirish</h3>
                                </div>
                                <div class="card-body">
                                    <form action="includes/login.php" method="post">
                                        <div class="form-group">
                                            <label class=" small mb-1" for="username">Login</label>
                                            <input class="form-control py-4" id="username" type="text" name="username" placeholder="Loginni Kiriting" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="user_password">Parol</label>
                                            <input class="form-control py-4" id="user_password" name="user_password" type="password" placeholder="Parolni Kiriting" />
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-block" name="enter" type="submit" style="background-color:#1a2954;  color:white;">Kirish</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!--logindan kelgan habarlar uchun-->
        <?php

if(isset($_GET['message'])){
    $message = $_GET['message'];
} else {
    $message = '';
}
 switch($message){
         
    case 'none_username';
    echo "<script>alert('Iltimos, Foydalanuvchi loginini kiriting')</script>";
    break;
          
    case 'error_user';
    echo "<script>alert('Iltimos, Foydalanuvchi logini yoki paroli noto`g`ri kiritilgan')</script>";
    break;

         }
?>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Only Up Group 2020</div>
                        <div>
                            <img width="25px" src="img/onlyup%20logo.png" alt="">
                            <a target="_blank" href="https:www.onlyup.uz">onlyup.uz</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
