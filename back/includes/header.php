<?php include"db.php";?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php 
if (isset($_SESSION['user_role'])){
    $the_user_role = $_SESSION['user_role'];
    $the_user_firstname = $_SESSION['user_firstname'];
    $the_user_lastname = $_SESSION['user_lastname'];
    $the_user_id = $_SESSION['user_id'];
}

$the_user_fullname = $the_user_lastname." ".$the_user_firstname;
$query = "SELECT * FROM users WHERE user_id = $the_user_id";
$select_query = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($select_query);
$the_user_image = $row['user_image'];
$the_username = $row['username'];
$the_user_phone = $row['user_phone'];
$the_user_work_date = $row['user_work_date'];
$the_filial_id = $row['filial_id'];
                       

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="Only Up Group" content="" />
    <title>Dostavka</title>

    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/icomoon.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="../../img/Onyup.jpg" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-light" style="background-color:#2c4690">
        <a class="navbar-brand" href="admin_index.php" style="background-color:#2c4690;">
            <img class="cover" width="20%"src="../../img/Onyup.jpg" alt="OnlyUp">
        </a>
        <button class="btn btn-link btn-lg order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fa fa-bars text_gold"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto mr-md-0">
            <li class="nav-item">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalb">Sozlamalar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../../includes/log_out.php">Chiqish</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <center>
                                
                            <img width="80px" height="80px" class="cover ml-3 mr-2 my-3 img_prf" style="border-radius:100px" src="../../img/user/<?php echo $the_user_image;?>" alt="">
                            </center>
                        </div>
                        <div class="col-md-8">
                            <h4 class="text_gold text-center text_prf"><?php echo  $the_user_fullname;?></h4>
                            <h5 class="text_gold text-center">
                                <?php echo "+998".$the_user_phone."--@".$the_username;?>
                            </h5>
                            <h6 class="text-center text-secondary">
                                Ish boshlagan sana: <?php echo $the_user_work_date;?>
                            </h6>
                                            
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <a href="users.php?source=edit_user&u_id=<?php echo $the_user_id?>" class="btn btn_blue btn-block btn-sm"><i class="fa fa-pen mr-3"></i>Ma'lumotlarni o'zgartirish</a>
                </div>
            </div>
        </div>
    </div>
<!--  ./ Modal -->