<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'testpahse');

// get current user's data from database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);

// initialize variables with current user's data
$username = $user['username'];
$email = $user['email'];

// if update button is clicked
if (isset($_POST['update'])) {
    // get new data from form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // update user's data in database
    $query = "UPDATE users SET name='$name', email='$email' WHERE username='$username'";
    mysqli_query($db, $query);

    // redirect to home page
    $_SESSION['success'] = "Profile updated successfully";
    header('location: index.php');
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<style>
/* Style the header with a grey background and some padding */
.header {
  overflow: hidden;
  width:97%;
    /* margin: 50px auto 0px; */
    color: white;
    background: #5F9EA0;
    text-align: center;
    border: 1px solid #B0C4DE;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
}

/* Style the header links */
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
}
 .content {
    width: 50%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    background: white;
    border-radius: 0px 0px 10px 10px;
  }
  .input-group {
    margin: 10px 0px 10px 0px;
  }
  .input-group label {
    display: block;
    text-align: left;
    margin: 3px;
  }
  .input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
  }
  .btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #5F9EA0;
    border: none;
    border-radius: 5px;
  }

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: dodgerblue;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
	</style>
</head>
<body>

<div class="header">
  <a href="#default" class="logo">TestPhase</a>
  <div class="header-right">
    <a href="update_profile.php">Update Profile</a>
	<a href="delete_profile.php?delete=true" onclick="return confirm('Are you sure you want to delete your account?')">Delete Profile</a>
    <a href="index.php?logout='1'">Logout</a>
  </div>
</div>
<div class="content">
	<!-- profile  update form -->
	<form method="post" action="index.php">
		<div class="input-group">
			<!-- hidden fild id -->
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Update</button>
		</div>
	</form>
</div>


</div>

</body>
</html>
