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
<h1 class="page-head-line">Manage Types</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">
  






  



<div class="col-xs-6">



<form method="post" action="" enctype="multipart/form-data">


<div class="form-group">

<input type="text" class="form-control" id="cat-title" placeholder="Type Name e.g. Package" name="type_name" required>

</div>




<div class="form-group">

<input class="btn btn-primary" type="submit" name="submit" value="Add Type">

</div>
</form>




<?php 


if(isset($_POST['submit'])){

$type_name = $_POST['type_name'];
$type_name = $db->real_escape_string($type_name);


$insert_type = "INSERT INTO types (name) VALUES ('{$type_name}')";
$result_types = $db->query($insert_type);

if(!$result_types){

die($db->error);

}else{

	header("Location: mange_types.php");
}



}



?>









</div>



<div class="col-xs-6">



<table class="table table-bordered">
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Name</th>

<th class="text-center">Edit</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$cat_fetch = "SELECT * FROM types";
$result_fetch = $db->query($cat_fetch);

$num_rows = $result_fetch->num_rows;
if($num_rows == 0){

echo "<td>No Type Found.</td>";
}else{

$count = 0;
while($rows = $result_fetch->fetch_assoc()){

$id = $rows['id'];
$name = $rows['name'];



$count++;


?>
<tr class="text-center">
<td><?php echo $count ?></td>
<td><?php echo $name ?></td>


<td><a class="btn btn-warning" href="mange_types.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="mange_types.php?delete=<?php echo $id ?>">Delete</a></td>

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
$edit_query = "SELECT * FROM types WHERE id = '{$edit_id}' ";
$result_edit = $db->query($edit_query);
$row = $result_edit->fetch_assoc();

$edit_title = $row['name'];



?>






<form method="post" action="" >


<div class="form-group">
<label for="cat-title">Type Name</label>
<input type="text" class="form-control" id="cat-title" value="<?php if(isset($edit_title)){echo $edit_title; } ?>" name="cat_name" required>

</div>






<div class="form-group">

<input class="btn btn-danger btn-block" type="submit" name="update" value="Update Type">

</div>
</form>


<?php 

if(isset($_POST['update'])){

$e_name = $_POST['cat_name'];



$update_query = "UPDATE types SET name = \"$e_name\" WHERE id = '{$edit_id}' ";

$result_update = $db->query($update_query);
if($result_update){

header("Location: mange_types.php");

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

$del_cat = "DELETE FROM types WHERE id = '{$del_id}' ";
$result_del = $db->query($del_cat);
if($result_del){

header("Location: mange_types.php");

}else{

die($db->error);

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