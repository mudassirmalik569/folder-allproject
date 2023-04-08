<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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
	 
</div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="error success">
            <h3>
                <?php echo $_SESSION['success'];
unset($_SESSION['success']);
?>
            </h3>
        </div>
    <?php endif?>

    <!-- logged in user information -->
    <?php if (isset($_SESSION['username'])): ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php endif?>
</div>

</body>
</html>
