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
<h3>Register</h3>

<form action="" method="post">
<div class="key">
<i class="fa fa-user" aria-hidden="true"></i>
<input  type="text" placeholder="Username" name="name"  required>
<div class="clearfix"></div>
</div>



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



<div class="key">
<i class="fa fa-user" aria-hidden="true"></i>
<input  type="number" placeholder="Contact" name="contact"  required>
<div class="clearfix"></div>
</div>

<div class="key">
<i class="fa fa-user" aria-hidden="true"></i>
<input  type="text" placeholder="City" name="city"  required>
<div class="clearfix"></div>
</div>

<input type="submit" value="Submit" name="submit">




</form>
<?php 



if(isset($_POST['submit'])){


$email = $_POST['email'];


$check = "SELECT email FROM users WHERE email = '{$email}'";


$result = $db->query($check);
$rows = $result->num_rows;
if($rows > 0){

echo "<div class='alert text-center col-sm-12'>Choose Another Email.</div>";

}else{

$name = $_POST['name'];
$password = $_POST['password'];
$phone = $_POST['contact'];
$city = $_POST['city'];


$reg_query = "INSERT INTO users (name,email,password,contact, city) VALUES ('{$name}','{$email}','{$password}','{$phone}', '{$city}')";


$result_reg = $db->query($reg_query);

if($result_reg){

echo "<div class='alert text-center col-sm-12'>Success, Account is Created.</div>";

}else{

	die($db->error);
}








} 

}





?>


</div>

</div>
</div>




</div>
<?php include_once "footer.php"; ?>
