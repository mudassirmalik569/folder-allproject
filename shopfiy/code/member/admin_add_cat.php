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
<?php if($user_role == 'admin') { ?>






<div id="wrapper">
<?php include_once "includes/top_navbar.php"; ?>
<?php include_once "includes/admin_sidebar_nav.php"; ?>     




<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">Add Category</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">
  






  



<div class="col-xs-6">



<form method="post" action="" enctype="multipart/form-data">


<div class="form-group">

<input type="text" class="form-control" id="cat-title" placeholder="Category Name" name="cat_name" required>

</div>



<div class="form-group">

<input type="file" class="form-control" id="cat-title" title="Image File" name="cat_image" required>

</div>




<div class="form-group">

<input class="btn btn-primary" type="submit" name="submit" value="Add Category">

</div>
</form>




<?php 


if(isset($_POST['submit'])){

$cat_name = $_POST['cat_name'];
$cat_name = $db->real_escape_string($cat_name);

$cat_image = $_FILES['cat_image']['name'];
$cat_image_cat = $_FILES['cat_image']['tmp_name'];
move_uploaded_file($cat_image_cat, "images/$cat_image");


$cat_insert = "INSERT INTO categories (cat_name,cat_image) VALUES ('{$cat_name}','{$cat_image}') ";
$result_cat = $db->query($cat_insert);

if(!$result_cat){

die("Query Failed. <br> " . mysqli_error($db));

}else{
header("Location: admin_add_cat.php");
}



}



?>









</div>



<div class="col-xs-6">



<table class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Category Name</th>
<th class="text-center">Image</th>
<th class="text-center">Edit</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$cat_fetch = "SELECT * FROM categories";
$result_fetch = $db->query($cat_fetch);

$num_rows = $result_fetch->num_rows;
if($num_rows == 0){

echo "<td>No Category Found.</td>";
}else{

$count = 0;
while($rows = $result_fetch->fetch_assoc()){

$id = $rows['cat_id'];
$name = $rows['cat_name'];
$cat_image = $rows['cat_image'];


$count++;


?>
<tr class="text-center">
<td><?php echo $count ?></td>
<td><?php echo $name ?></td>
<td><img style="width:60px;height: 30px" src="images/<?php echo $cat_image ?>"></td>

<td><a class="btn btn-warning" href="admin_add_cat.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="admin_add_cat.php?delete=<?php echo $id ?>">Delete</a></td>

</tr>

<?php



}



}


?>



</tbody>    

</table>



<?php 


if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];
$edit_query = "SELECT * FROM categories WHERE cat_id = '{$edit_id}' ";
$result_edit = $db->query($edit_query);
$row = $result_edit->fetch_assoc();

$edit_title = $row['cat_name'];
$edit_cat_image = $row['cat_image'];


?>






<form method="post" action="" enctype="multipart/form-data">


<div class="form-group">
<label for="cat-title">Category Name</label>
<input type="text" class="form-control" id="cat-title" value="<?php if(isset($edit_title)){echo $edit_title; } ?>" name="cat_name" required>

</div>


<div class="form-group">

<input type="file" name="cat_image" title="Cat Image" class="form-control">

</div>



<div class="form-group">

<input class="btn btn-danger btn-block" type="submit" name="update" value="Update Category">

</div>
</form>


<?php 

if(isset($_POST['update'])){

$e_name = $_POST['cat_name'];

$user_image_1 = $_FILES['cat_image']['name'];
if($user_image_1 != ""){

$user_image_temp = $_FILES['cat_image']['tmp_name'];
move_uploaded_file($user_image_temp, "images/$user_image_1");

}else{
$user_image_1 = $cat_image;
}



$update_query = "UPDATE categories SET cat_name = \"$e_name\", cat_image = \"$user_image_1\" WHERE cat_id = '{$edit_id}' ";

$result_update = $db->query($update_query);
if($result_update){

header("Location: admin_add_cat.php");

}else{

die(mysqli_error($db));
}


}



?>







<?php

}


?>












</div>




<?php 

if(isset($_GET['delete'])){

$del_id = $_GET['delete'];

$del_cat = "DELETE FROM categories WHERE cat_id = '{$del_id}' ";
$result_del = $db->query($del_cat);
if($result_del){

header("Location: admin_add_cat.php");

}else{

die(mysqli_error($db));

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