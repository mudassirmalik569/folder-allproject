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
<h1 class="page-head-line">Settings</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">



<?php



$sql = "SELECT * FROM users WHERE id = '{$user_id}'";
if($db->error){
$error = $db->error;
echo $error;
}

$result = $db->query($sql);
while($row = $result->fetch_assoc()){

$name = $row['name'];
$email = $row['email'];
$password = $row['password'];
$phone = $row['contact'];




}// end of while loop





?>




<form class="form-horizontal" action="admin_settings.php" method="post" enctype="multipart/form-data">

<div class="form-group">
<label class="sr-only" for="username">User Name</label>
<input type="text" name="username" placeholder="Your Name" value="<?php if(isset($name)){echo $name; } ?>" class="form-first-name form-control" id="username" autofocus>
</div>


<div class="form-group">
<label class="sr-only" for="form-email">Email</label>
<input type="email" name="email" placeholder="Your Email" class="form-email form-control" value="<?php if(isset($email)){echo $email; } ?>" id="form-email" >
</div>


<div class="form-group">
<label class="sr-only" for="form-password">Password</label>
<input type="password" name="password" placeholder="Your Password" class="form-email form-control" value="<?php if(isset($password)){echo $password; } ?>" id="form-email" >
</div>

<div class="form-group">
<label class="sr-only" for="form-password">Phone</label>
<input type="text" name="phone" placeholder="Your Number" class="form-number form-control" value="<?php if(isset($phone)){echo $phone; } ?>" id="form-email" >
</div>







<div class="form-group">
<button type="submit" name="update" class="btn btn-info">Update</button>
</div>
</form>



<?php
// This coding is for updating user profile

if(isset($_POST['update'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];







$sql = "UPDATE users SET name = \"$username\", email = \"$email\", password = \"$password\", contact = \"$phone\" WHERE id = \"$user_id\"  ";
if($db->error){
$error = $db->error;
echo $error;
}
$result = $db->query($sql);
if($result){
echo "<script> alert('Your Profile has been Updated.'); </script>";
}else{
die("Something went wrong." . mysqli_error($db));
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