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
<h1 class="page-head-line">Admin-Backend</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">








<form class="w3-container" action="" method="post">

<div class="form-group">

<input class="w3-input w3-border w3-animate-input form-control" type="email" name="search" id="search" placeholder="Search Any User Through Email e.g admin@yahoo.com" style="width:100%" autocomplete="off" required>
</div>

<button style="display:none" type="submit" name="submit"></button>


</form>




<?php

if(!isset($_POST['submit'])){

?>




<table class="table table-striped table-responsive">
<thead class='bg-primary'>
<tr style="bakcground-color:red">
<th class="text-center">ID</th>
<th class="text-center">Name</th>
<th class="text-center">Email</th>
<th class="text-center">Phone</th>
<th class="text-center">Role</th>
<th class="text-center">Edit</th>
<th class="text-center">Delete</th>


</tr>
</thead>

<tbody>
<?php

$user_query = "SELECT * FROM users WHERE role != 'admin' ORDER BY id LIMIT 15 ";
if($db->error){
echo $error = $db->error;
}else{

$result_user = $db->query($user_query);
$counter = 0;
while($row = $result_user->fetch_assoc()){
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['contact'];

$role = $row['role'];
$counter = $counter + 1;
?>

<tr class="text-center">

<td><?php echo $counter ?></td>
<td><?php echo $name ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>

<td><?php echo $role ?></td>

<td><a class="btn btn-success btn-sm" href="admin_edit.php?edit_user=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger btn-sm" href="index.php?del=<?php echo $id ?>">Delete</a></td>


</tr>


<?php
}
}

?>


</tbody>
</table>


<?php }elseif(isset($_POST['submit'])){

$search = $_POST['search'];
$search = $db->real_escape_string($search);



$sql = "SELECT * FROM users WHERE email = '{$search}' AND role != 'admin' ";
$result = $db->query($sql);
$num_rows = $result->num_rows;
if($num_rows <= 0){
echo "No Record Found.";
}else{ ?>


<table class="table table-bordered table-responsive">
<thead class='bg-primary'>
<tr>
<th class="text-center">ID</th>
<th class="text-center">Name</th>
<th class="text-center">Email</th>
<th class="text-center">Phone</th>

<th class="text-center">Role</th>

<th class="text-center">Edit</th>

<th class="text-center">Delete</th>

</tr>
</thead>

<tbody>
<?php
$search = $_POST['search'];
$user_query = "SELECT * FROM users WHERE email = '{$search}' ";
if($db->error){
echo $error = $db->error;
}else{

$result_user = $db->query($user_query);
$counter = 0;
while($row = $result_user->fetch_assoc()){
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$phone = $row['contact'];

$role = $row['role'];
$counter = $counter + 1;
?>

<tr class="text-center">

<td><?php echo $counter ?></td>
<td><?php echo $name ?></td>
<td><?php echo $email ?></td>
<td><?php echo $phone ?></td>

<td><?php echo $role ?></td>


<td><a  class="btn btn-success btn-block" href="admin_edit.php?edit=<?php echo $id ?>">Edit</a></td>

<td><a  class="btn btn-danger btn-block" href="index.php?del=<?php echo $id ?>">Delete</a></td>


</tr>


<?php
}
}

?>


</tbody>
</table>





<?php } // else of line 167



}


?>



<?php

if(isset($_GET['del'])){
$del_id = $_GET['del'];
$del_query = "DELETE FROM users WHERE id = '{$del_id}'";
$result_del = $db->query($del_query);
if($result_del){
header("Location: index.php");
}else{
die(mysqli_error($db));
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


<?php }elseif($user_role == 'user'){   ?>




<div id="wrapper">
<?php include_once "includes/top_navbar.php"; ?>
<?php include_once "includes/sidebar_nav.php"; ?>     




<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">User Page</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">

<table class="table table-bordered">
	
<?php 

$query_data = "SELECT * from users WHERE id = '{$user_id}' ";
$result = $db->query($query_data);
$row = $result->fetch_assoc();

$name = $row['name'];
$email = $row['email'];
$contact = $row['contact'];
$role = $row['role'];



?>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Role</th>
	</tr>

	<tr>

		<td><?php echo $name; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $contact; ?></td>
		<td><?php echo $role; ?></td>
		
	</tr>

</table>


</div>
</div>

</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->



<?php include_once "includes/footer.php"; ?>


<?php }elseif($user_role == 'chef'){  ?>




<div id="wrapper">
<?php include_once "includes/top_navbar.php"; ?>
<?php include_once "includes/chef_sidebar_nav.php"; ?>     




<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">Chef Page</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">
Welcome To The Company Section !! 
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