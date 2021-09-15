<?php 
if(isset($_POST['add_car_type'])){
    
 $car_type = $_POST['car_type'];
 $car_type = mysqli_real_escape_string($connection, $car_type);
$query = "INSERT INTO moshina_turlari(car_type_nomi) VALUES('{$car_type}')";
$query_insert = mysqli_query($connection, $query);
if($query_insert){
    header("Location: transport.php?transport=add_car_type");
}
}
?>
   <div class="col-md-12">
    <form action="" method="post">
        <div class="card shadow-lg border-1 rounded-lg mt-2">
            <div class="card-header">
                       <a href="transport.php?transport=add_transport" class="btn btn-dark" style="float-right"><i class="fas fa-angle-left mr-1"></i>Orqaga</a>
                <h4 class="text-center">Mashina turlari</h4>
            </div>
            <div class="card-body">
               <lable><h6>Mashina turlarini kiriting</h6></lable>
                <input type="text" class="form-control my-2" name="car_type" required placeholder="Mislo: Kamaz, Zil, Jumong">
                <button class="btn btn-info btn-block" name="add_car_type">Qo'shish</button>
            </div>
        </div>
    </form>
</div>
<?php include "view_car_type.php"; ?>