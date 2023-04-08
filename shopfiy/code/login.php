<?php include_once "header.php"; ?>

<!--header-->
<div class="header">

<?php include_once "top.php"; ?>
<?php include_once "nav.php"; ?>

</div>



<div class="content">
	
<div class="login">
<div class="main-agileits">
<div class="form-w3agile form1">
<h3>Login</h3>

<form action="" method="post">



<div class="key">
<i class="fa fa-user" aria-hidden="true"></i>
<input  type="email" placeholder="Email" name="email"  required>
<div class="clearfix"></div>
</div>



<div class="key">
<i class="fa fa-user" aria-hidden="true"></i>
<input  type="password" placeholder="Password" name="password"  required>
<div class="clearfix"></div>
</div>


<input type="submit" value="Submit" name="submit">
</form>



<?php 

if(isset($_POST['submit'])){

$email  = $_POST['email'];
$password  = $_POST['password'];


$email = $db->real_escape_string($email);
$password = $db->real_escape_string($password);

$query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' ";


$result = $db->query($query);
$num_row = $result->num_rows;

if($num_row == 0){


echo "<div class='alert text-center col-sm-12'>Email or Password is not Correct.</div>";

}else{

$row = $result->fetch_assoc();

$row_id = $row['id'];
$row_role = $row['role'];


$_SESSION['id'] = $row_id;
$_SESSION['role'] = $row_role;

header("Location: member/index.php"); 
    

  }

} 




?>


</div>

</div>
</div>




</div>
<?php include_once "footer.php"; ?>
