<?php include 'server.php'?>
<!DOCTYPE html>
<html>
<head>
  <title>Login system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2> Forget Passowrd </h2>
  </div>


  <form method="post" action="">
  	<h2>Forgot Password?</h2>
  	<p>Please enter your email address and we will send you a link to reset your password.</p>
  	<?php include 'errors.php';?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="email">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="forgot_password">Reset Password</button>
  	</div>
  </form>

</body>
</html>
