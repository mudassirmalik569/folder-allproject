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
<h1 class="page-head-line">View Products</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">



<div class="col-xs-12">


<?php 

$r_query = "SELECT * FROM product WHERE user_id = '{$user_id}' ";
$result_r = $db->query($r_query);
$num_row = $result_r->num_rows;
if($num_row == 0){

echo "<p class='text-center row col-md-12'>No Product Found.</p>";

} else{
?>

<table class="table table-bordered table-hover text-center">
<thead>
<tr class="text-center">
<th class="text-center">Id</th>
<th class="text-center">Product Name</th>
<th class="text-center">Product Image</th>

<th class="text-center">Price</th>

<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>






<?php
$counter = 0;
while($rows = $result_r->fetch_assoc()){
$pro_id = $rows['id'];
$pro_name = $rows['pro_name'];
$pro_image = $rows['image'];

$pro_price= $rows['price'];


$counter++;

?>


<tr class="text-center">
<td><?php echo $counter ?></td>
<td><?php echo $pro_name ?></td>
<td><img src="images/<?php echo $pro_image ?>" class="img-circle" width="20px" height="20px"></td>

<td><?php echo $pro_price ?></td>

<td><a class="btn btn-danger btn-sm" href="customer_view_product.php?delete=<?php echo $pro_id ?>">Delete</a></td>

</tr>


<?php

}


  


?>

</tbody>    

</table>




<?php

}


?>




<?php 

if(isset($_GET['delete'])){

$del_product = $_GET['delete'];
$del_pro = "DELETE FROM product WHERE id = '{$del_product}' ";
$result_del = $db->query($del_pro);
if($result_del){

echo "<p class='text-center row col-md-12'>Product Has been Deleted.</p>";

}



}

?>





</div>


<div class="col-xs-12">

<?php 

if(isset($_GET['edit'])){

$edit_id = $_GET['edit'];


$edit_ress = "SELECT * FROM product WHERE id = '{$edit_id}' ";
$result_edit = $db->query($edit_ress);
$edit_row = $result_edit->fetch_assoc();



$edit_name = $edit_row['pro_name'];

$edit_image = $edit_row['image'];

$edit_detail = $edit_row['pro_detail'];
$edit_tags = $edit_row['tags'];
$edit_price = $edit_row['price'];
$discount = $edit_row['discount'];


?>




<form method="post" action="" enctype="multipart/form-data">


<div class="form-group">
<label for="cat-title">Product Name</label>
<input type="text" class="form-control" id="rs-name" value="<?php if(isset($edit_name)){echo $edit_name; } ?>" placeholder="Your Product Name" name="pro_name" required>

</div>









<div class="form-group">
<label for="cat-image">Product Image</label>
<input type="file" name="image" class="form-control" id="cat-image" placeholder="Your Image" />
</div>






<div class="form-group">
<label for="res_tags">Product Tags</label>
<input type="text" class="form-control" id="res_tags" value="<?php if(isset($edit_tags)){echo $edit_tags; } ?>" placeholder="Tags. e.g. Bed " name="tags" required>

</div>


<div class="form-group">
<label for="des">Product Description</label>
<textarea class="form-control" id="des" name="description" rows="3" placeholder="Product Description"><?php if(isset($edit_detail)){echo $edit_detail; } ?></textarea>
</div>

<div class="form-group">
<label for="price">Product Price</label>
<input type="number" class="form-control" value="<?php if(isset($edit_price)){echo $edit_price; } ?>" id="price" placeholder="Price e.g. 1588" name="price" required>

</div>


<div class="form-group">
<label for="discount">Product Discount</label>
<input type="number" class="form-control" value="<?php if(isset($discount)){echo $discount; } ?>" id="discount" placeholder="Discount e.g. 15 %" name="discount" required>

</div>


<div class="form-group">

<input class="btn btn-primary" type="submit" name="update" value="Update Product">

</div>
</form>






<?php 


if(isset($_POST['update'])){



$pro_name = $_POST['pro_name'];
$pro_name = $db->real_escape_string($pro_name);



if($_FILES['image']['name'] == ''){
$image = $edit_image;
}
else{



$destination = __DIR__ . "/images/";
$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$_FILES['image']['name']);

$image = $_FILES['image']['name'];



}






$tags = $_POST['tags'];

$description = $_POST['description'];
$description = $db->real_escape_string($description);
$price = $_POST['price'];
$discount = $_POST['discount'];



$update_query = "UPDATE product SET pro_name = \"$pro_name\", image = \"$image\", pro_detail = \"$description\", tags = \"$tags\", price = \"$price\", discount = \"$discount\" WHERE id = '{$edit_id}' ";






$result_res = $db->query($update_query);
if(!$result_res){

die($db->error);

}else{

echo "<p class='alert alert-warning'>Product Has been Updated.</p>";

}



}



?>







<?php

}


?>

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