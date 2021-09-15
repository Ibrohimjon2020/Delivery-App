<div class="justify-content-center">
    
   <div class="col-md-12">
    <div class="card shadow-lg border-1 mt-3 rounded-lg">
        <div class="card_heder">
        <h5 class="text-center text-bold"> Barcha mashina turlarini ko'rish</h5>
        </div>
        <div class="card-body">
           <div class="row">
               <?php 
               $query = "SELECT car_type_nomi, car_type_id FROM moshina_turlari";
               $select_car_type = mysqli_query($connection, $query);
               while($row=mysqli_fetch_assoc($select_car_type)){
                $car_type_id = $row['car_type_id'];   
                $car_type_nomi = $row['car_type_nomi'];   
              
               ?>
           
           <div class="col-md-3">
               <form action="" method="post"> 
             <div class="card shadow-lg border-1 mt-1 rounded-lg">
                <div class="card-body">
                 <h4 class="text-center"> <?php echo $car_type_nomi;?></h4>
                </div>
                 <button class="btn btn-block btn-success" type="button" data-toggle="modal" data-target="#exampleModal<?php echo $car_type_id ?>"><i class="fa fa-pen"></i> O'zgartirish</button>
                 <button class="btn btn-block btn-danger mt-1" name="delete" value="<?php echo $car_type_id ?>"><i class="fa fa-trash"></i> O'chirish</button>
                 
             </div>  
             <!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $car_type_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mashina turlari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="text" name="edit_type" class="form-control" value="<?php echo $car_type_nomi ?>">
      </div>
      <div class="modal-footer">
        <button type="submit" name="edit" value="<?php echo $car_type_id ?>" class="btn btn-primary">O'zgarishni saqlash</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </form>
           </div>
           

           
           <?php  } ?>
           
           </div>
        </div>
    </div>
</div>
</div>
<?php 
if(isset($_POST['edit'])){
 $car_type_id = $_POST['edit'];
 $car_type_nomi = $_POST['edit_type'];
$query = "UPDATE moshina_turlari SET car_type_nomi = '{$car_type_nomi}' WHERE car_type_id = '{$car_type_id}'";
$select_moshina_turlari = mysqli_query($connection, $query);
if($select_moshina_turlari){
     header("Location: transport.php?transport=add_car_type");   
}
}
?>
<!--##################################################  DELETE   ##############################################-->
<?php 
if(isset($_POST['delete'])){
$car_type_id = $_POST['delete'];
$query = "DELETE FROM moshina_turlari WHERE car_type_id = $car_type_id";
$delete = mysqli_query($connection, $query);
if($delete){
    header("Location: transport.php?transport=add_car_type");
}
}
?>