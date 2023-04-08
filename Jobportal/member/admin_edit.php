<?php
try {
  include_once "includes/connect.php";
   session_start();
   ob_start();

   
   $user_id = $_SESSION['id'];
   $user_name = $_SESSION['name'];
   $user_email = $_SESSION['email'];
   $user_role = $_SESSION['role'];
   $user_number = $_SESSION['contact'];




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
                        <h1 class="page-head-line">Admin Settings</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">



<?php

  if(isset($_GET['edit'])){
    $user_main_id = $_GET['edit'];
    ?>




<?php



$sql = "SELECT * FROM users WHERE id = '{$user_main_id}'";
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
$image = $row['image'];


$dob = $row['dob'];
$gender = $row['gender'];
$location = $row['location'];
$functional_area = $row['functional_area'];
$role = $row['role'];



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
          <label class="sr-only" for="form-file">Image</label>
          <input type="file" name="image" placeholder="Your Image" class="form-file form-control" value="<?php if(isset($image)){echo $image; } ?>" id="form-email">
        </div>



        <div class="form-group">
          <label class="sr-only" for="form-file">DOB</label>
          <input type="date" name="dob" placeholder="DOB" class="form-file form-control" value="<?php if(isset($dob)){echo $dob; } ?>" id="form-email">
        </div>
        


      <div class="form-group">
      

      <select name="gender" class="form-control" required>
        
        <option value="<?php if(isset($gender)){echo $gender; } ?>" selected><?php if(isset($gender)){echo ucwords($gender); } ?></option>
        <option value="women">Women</option>
        <option value="men">Men</option>

      </select>


      </div>





      <div class="form-group">
      

      <select name="location" class="form-control" required>
        
        <option value="<?php if(isset($location)){echo $location; } ?>" selected><?php if(isset($location)){echo ucwords($location); } ?></option>
        <option value="gujranwala">Gujranwala</option>
        <option value="lahore">Lahore</option>
        <option value="karachi">Karachi</option>
        <option value="other">Other</option>

      </select>


      </div>



  
      <div class="form-group">
      

      <select name="functional_area" class="form-control" required>
        
        <option value="<?php if(isset($functional_area)){echo $functional_area; } ?>" selected><?php if(isset($functional_area)){echo ucwords($functional_area); } ?></option>
        <option value="computer science">Computer Science</option>
        <option value="teaching">Teaching</option>
        <option value="business">Business</option>
        <option value="other">Other</option>

      </select>


      </div>




    <div class="form-group">
      

      <select name="role" class="form-control" required>
        
        <option value="<?php if(isset($role)){echo $role; } ?>" selected><?php if(isset($role)){echo ucwords($role); } ?></option>
       <option value="job seeker">Job Seeker</option>
                                    <option value="employeer">Employeer</option>
        <option value="admin">Admin</option>                                    

      </select>


      </div>


    

        <button type="submit" name="update" class="btn btn-warning">Update</button>

    </form>



<?php
// This coding is for updating user profile

if(isset($_POST['update'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

$user_image_1 = $_FILES['image']['name'];
if($user_image_1 != ""){

$user_image_temp = $_FILES['image']['tmp_name'];
move_uploaded_file($user_image_temp, "images/$user_image_1");

}else{
  $user_image_1 = $image;
}


$dob = $_POST['dob'];
$gender = $_POST['gender'];
$location = $_POST['location'];
$functional_area = $_POST['functional_area'];

$role = $_POST['role'];






$sql = "UPDATE users SET name = \"$username\", email = \"$email\", password = \"$password\", contact = \"$phone\", image = \"$user_image_1\", dob = \"$dob\", gender = \"$gender\", location = \"$location\", functional_area = \"$functional_area\", role = \"$role\" WHERE id = \"$user_main_id\"  ";
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





<?php } ?>








                     


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