<?php 
include 'header.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>

<body>


<?php
include 'connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM employe where id = '$id'";
$result = mysqli_query($link,$query);
$rs = mysqli_fetch_array($result);
?>


<div class="container" style="margin-bottom:30px;">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="padding-top: 20px;">

        
<form action="updateemploye.php" method="post">
  <div class="form-group">
    <input type="hidden" name="id" class="style" value="<?php echo $rs['id']; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Full Name</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="name" value="<?php echo $rs['fullname']; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Contact</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="contact" value="<?php echo $rs['contact']; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">City</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="city" value="<?php echo $rs['city'];?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Email</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="email" value="<?php echo $rs['email'];?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="text" class="form-control" id="formGroupExampleInput2" name="password" value="<?php echo $rs['password'];?>">
  </div>

  <button type="submit" class="btn btn-primary btn btn-block">Submit</button>
</form>

		</div>
		<div class="col-md-3"></div>
	</div>
</div>

</body>
</html>

<?php 
include 'footer.php';
?>
