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
<h1 class="page-head-line">Manage Sub-Category</h1>



<div class="col-xs-6">



<form method="post" action="">



<div class="form-group">

<select class="form-control" required name="cat_id">
<option value="" disabled selected>Choose Category</option>

<?php 

$cate_fetch = "SELECT * FROM categories";
$result_cate = $db->query($cate_fetch);
if($result_cate){

while($rows = $result_cate->fetch_assoc()){

$cat_id 	= $rows['cat_id'];
$cat_title 	= $rows['cat_name'];

?>

<option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>


<?php

}
}


?>




</select>

</div>



<div class="form-group">
<input type="text" class="form-control" id="cat-title" placeholder="Sub Name" name="sub_name" required>

</div>





<div class="form-group">

<input class="btn btn-primary" type="submit" name="submit" value="Add Sub">

</div>
</form>




<?php 


if(isset($_POST['submit'])){



$cat_id = $_POST['cat_id'];

$sub_name = $_POST['sub_name'];
$sub_name = $db->real_escape_string($sub_name);



$sub_query = "INSERT INTO sub_category (cat_id ,sub_name) VALUES ('{$cat_id}' ,'{$sub_name}') ";

$result_sub = $db->query($sub_query);

	if(!$result_sub){

		die($db->error);

	}else{

	header("Location: admin_sub_cat.php");

	}



}



?>









</div>



<div class="col-xs-6">



<table class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Category</th>
<th class="text-center">Sub-Name</th>


<th class="text-center">Edit</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$cat_fetch = "SELECT * FROM sub_category";
$result_fetch = $db->query($cat_fetch);

$num_rows = $result_fetch->num_rows;
if($num_rows == 0){

echo "<td>No Category Found.</td>";
}else{

$count = 0;
while($rows = $result_fetch->fetch_assoc()){

$id = $rows['id'];
$cat_id = $rows['cat_id'];

$check = "SELECT cat_name FROM categories WHERE cat_id = '{$cat_id}' ";
$result_c = $db->query($check);
$row_ch = $result_c->fetch_assoc();
$cat_name = $row_ch['cat_name'];


$sub_name = $rows['sub_name'];



$count++;


?>
<tr class="text-center">
<td><?php echo $count ?></td>
<td><?php echo $cat_name ?></td>
<td><?php echo $sub_name ?></td>


<td><a class="btn btn-warning" href="admin_sub_cat.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="admin_sub_cat.php?delete=<?php echo $id ?>">Delete</a></td>

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

$edit_query = "SELECT * FROM sub_category WHERE id = '{$edit_id}' ";
$result_edit = $db->query($edit_query);
$row = $result_edit->fetch_assoc();


$cat_id = $row['cat_id'];
$sub_name = $row['sub_name'];



?>






<form method="post" action="">


<div class="form-group">
<label for="cat-title">Choose Category</label>

<select class="form-control" required name="cat_id">
<option value="<?php if(isset($cat_id)){echo $cat_id; } ?>">Choose Category</option>

<?php 

$cate_fetch = "SELECT * FROM categories";
$result_cate = $db->query($cate_fetch);
if($result_cate){

while($rows = $result_cate->fetch_assoc()){

$cat_id 	= $rows['cat_id'];
$cat_title 	= $rows['cat_name'];

?>

<option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>


<?php

}
}


?>




</select>

</div>



<div class="form-group">
<label for="cat-title">Sub Name</label>
<input type="text" class="form-control" id="cat-title" value="<?php if(isset($sub_name)){echo $sub_name; } ?>" name="cat_name" required>
</div>





<div class="form-group">

<input class="btn btn-danger btn-block" type="submit" name="update" value="Update Category">

</div>
</form>


<?php 

if(isset($_POST['update'])){

$cat_id = $_POST['cat_id'];
$e_name = $_POST['cat_name'];




$update_query = "UPDATE sub_category SET sub_name = \"$e_name\", cat_id = \"$cat_id\" WHERE id = '{$edit_id}' ";

$result_update = $db->query($update_query);
if($result_update){

header("Location: admin_sub_cat.php");

}else{

	die($db->error);
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

$del_cat = "DELETE FROM sub_category WHERE id = '{$del_id}' ";
$result_del = $db->query($del_cat);
if($result_del){

header("Location: admin_sub_cat.php");

}else{

die($db->error);

}





}


?>





   


  





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