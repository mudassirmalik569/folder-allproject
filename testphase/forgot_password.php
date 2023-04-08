<?php include 'server.php'?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Reset Password</h2>
  </div>

  <form method="post" action="resetpassword.php">
  	<?php include 'errors.php';?>
  	<input type="hidden" name="token" value="<?php echo $token ?>">
  	<div class="input-group">
  		<label>New Password</label>
  		<input type="password" name="new_password_1">
  	</div>
  	<div class="input-group">
  		<label>Confirm New Password</label>
  		<input type="password" name="new_password_2">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="reset_password">Reset Password</button>
  	</div>
  </form>

<?php
// Check if the form has been submitted
if (isset($_POST['reset_password'])) {
    // Retrieve the user's token from the form
    $token = mysqli_real_escape_string($db, $_POST['token']);

    // Retrieve the user's email address from the token
    $query = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    // Validate the new password fields
    $new_password_1 = mysqli_real_escape_string($db, $_POST['new_password_1']);
    $new_password_2 = mysqli_real_escape_string($db, $_POST['new_password_2']);

    if (empty($new_password_1)) {
        array_push($errors, "New password is required");
    }
    if ($new_password_1 != $new_password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // If there are no errors, update the user's password in the database
    if (count($errors) == 0) {
        $password = md5($new_password_1);
        $query = "UPDATE users SET password='$password', token='' WHERE email='" . $user['email'] . "'";
        mysqli_query($db, $query);
        $_SESSION['success'] = "Your password has been reset";
        header('location: index.php');
    }
}
?>

</body>
</html>
