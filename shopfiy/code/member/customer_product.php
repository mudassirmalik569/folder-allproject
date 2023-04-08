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
<h1 class="page-head-line">Add Product</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">





<div class="col-xs-12">



<form method="post" action="" enctype="multipart/form-data">



<div class="form-group">

<label for="cat-title">Product Type</label>
<select class="form-control" required name="type">
<option value="" disabled selected> Choose</option>

<?php 

$types = "SELECT * FROM types";
$type_result = $db->query($types);
if($type_result){

while($rows = $type_result->fetch_assoc()){

$type_id = $rows['id'];
$type_name = $rows['name'];


echo "<option value=\"$type_id\">$type_name</option>";


}
}


?>




</select>

</div>




<div class="form-group">

<label for="cat-title">Categories</label>
<select class="form-control" required name="cat_id">
<option value="" disabled selected> Please Choose Category</option>

<?php 

$cate_fetch = "SELECT * FROM categories";
$result_cate = $db->query($cate_fetch);
if($result_cate){

while($rows = $result_cate->fetch_assoc()){

$cat_id = $rows['cat_id'];
$cat_name = $rows['cat_name'];


echo "<option value=\"$cat_id\">$cat_name</option>";


}
}


?>




</select>

</div>






<div class="form-group">

<label for="cat-title">Sub Category</label>
<select class="form-control" required name="sub_id">
<option value="" disabled selected> Please Choose Sub Category</option>

<?php 

$cate_fetch = "SELECT * FROM sub_category";
$result_cate = $db->query($cate_fetch);
if($result_cate){

while($rows = $result_cate->fetch_assoc()){

$id = $rows['id'];
$sub_title = $rows['sub_name'];
$cat_id = $rows['cat_id'];


$check_cat = "SELECT cat_name FROM categories WHERE cat_id = '{$cat_id}' ";
$result_cat = $db->query($check_cat);
$row = $result_cat->fetch_assoc();
$cat_title = $row['cat_name'];

echo "<option value=\"$id\">$cat_title  => $sub_title</option>";


}
}


?>




</select>

</div>




<div class="form-group">
<label for="cat-title">Product Name</label>
<input type="text" class="form-control" id="rs-name" placeholder="Your Product Name" name="pro_name" required>

</div>









<div class="form-group">
<label for="cat-image">Product Image</label>
<input type="file" name="image" class="form-control" id="cat-image" placeholder="Your Image" required />
</div>





<div class="form-group">
<label for="res_tags">Product Tags</label>
<input type="text" class="form-control" id="res_tags" placeholder="Product Tags. e.g. Bed " name="tags" required>

</div>


<div class="form-group">
<label for="des">Product Description</label>
<textarea class="form-control" id="des" name="description" rows="3" placeholder="Product Description"></textarea>
</div>

<div class="form-group">
<label for="price">Product Price</label>
<input type="number" class="form-control" id="price" placeholder="Prodeuct Price e.g. 1599 " name="price" required>

</div>


<div class="form-group">
<label for="discount">Product Discount</label>
<input type="number" class="form-control" id="discount" placeholder="Prodeuct Discount e.g. 15% " name="discount" required>

</div>








<div class="form-group">

<input class="btn btn-primary" type="submit" name="submit" value="Add Product">

</div>
</form>




<?php 


if(isset($_POST['submit'])){

$cat_id = $_POST['cat_id'];
$sub_id = $_POST['sub_id'];
$pro_name = $_POST['pro_name'];
$pro_name = $db->real_escape_string($pro_name);


$destination = __DIR__ . "/images/";
$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$_FILES['image']['name']);

$image = $_FILES['image']['name'];





$tags = $_POST['tags'];
$new_tags = $tags . " , $pro_name ";

$description = $_POST['description'];
$description = $db->real_escape_string($description);
$price = $_POST['price'];

$discount = $_POST['discount'];
$type = $_POST['type'];


 
 


$prodcut_query = "INSERT INTO product (type,cat_id,sub_id,pro_name,image, pro_detail,tags,price, discount, user_id) VALUES ('{$type}','{$cat_id}','{$sub_id}','{$pro_name}','{$image}','{$description}','{$new_tags}','{$price}', '{$discount}', '{$user_id}') ";

$result_product = $db->query($prodcut_query);
if(!$result_product){

die($db->error);

}else{

echo "<p class='alert alert-info'>Product Has Been Added.</p>";

}



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