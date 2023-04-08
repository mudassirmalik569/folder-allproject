<?php
try {
include_once "../database.php";

session_start();
ob_start();


$user_id = $_SESSION['id'];
$user_role = $_SESSION['role'];





} catch (Exception $e) {
  $error = $e->getMessage();
}

if(isset($error)){
  echo $error;
} // checking for connection

?>

<?php include_once "includes/header.php"; ?>
<?php if($user_role == 'user') { ?>






    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Product Details</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                     
<?php 
    
    if(isset($_GET['view'])){
      $product_id = $_GET['view'];

          $edit_ress = "SELECT * FROM product WHERE id = '{$product_id}' ";
          $result_edit = $db->query($edit_ress);
          $edit_row = $result_edit->fetch_assoc();
          


          $edit_name = $edit_row['pro_name'];
    
          $edit_image = $edit_row['image'];
   
          $edit_detail = $edit_row['pro_detail'];
          $edit_tags = $edit_row['tags'];
          $edit_price = $edit_row['price'];
          $discount = $edit_row['discount'];
          $edit_view = $edit_row['pro_view'];


          $discount = ($discount/100) * $edit_price;
          $edit_price = $edit_price - $discount;


    }

 ?>



<div class="col-xs-6">
  <img src="images/<?php echo $edit_image ?>" style="border:1px solid black;box-shadow:0px 3px 5px black; margin-bottom:15px" class="img-response" width="100%" height="80%" />

  
  
</div>

<div class="col-xs-6">

  <h2 class="alert text-center"><?php echo $edit_name ?></h2>

   
 
  <p style="margin-top:5px;padding: 5px"><span style="font-size:20px; color:red">Tags : </span><?php echo $edit_tags ?></p>
  <p style="margin-top:5px;padding: 5px"><span style="font-size:20px; color:red">View : </span><?php echo $edit_view ?></p>
  <p style="margin-top:5px;padding: 5px"><span style="font-size:20px; color:red">Price : </span><?php echo $edit_price ?> Rs</p>


    <h3 style="margin-top:5px;padding: 5px"><span style="font-size:30px; color:red">Detail </span></h3>
    <p><?php echo $edit_detail; ?></p>

   

</div>









                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



    <?php include_once "includes/footer.php"; ?>

<?php }else{ header("location:logout.php"); } ?>