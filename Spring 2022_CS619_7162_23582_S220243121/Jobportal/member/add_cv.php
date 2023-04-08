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
<?php if($user_role == 'job seeker') { ?>






    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/job_seeker_sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Applied Jobs</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">



<?php 

$check = "SELECT * FROM job_cv WHERE user_id = '{$user_id}' ";
$result_ch = $db->query($check);
$num = $result_ch->num_rows;
if($num == 0){
?>






                     
<form method="post" action="">


<div class="form-group">
  <input type="text" class="form-control" name="last_edu" placeholder="Your Last Exam .e.g MBA" required />
</div>
  



<div class="form-group">
  <input type="text" class="form-control" name="skills" placeholder="PHP, Java" required />
</div>
  


  <div class="form-group">
    

    <textarea name="experience" class="form-control" placeholder="Your Experiences" required></textarea>
  </div>



<input type="submit" name="cv" value="Add Cv" class="btn btn-warning">

</form>


<?php 


if(isset($_POST['cv'])){

  $last_edu = $_POST['last_edu'];
  $last_edu = $db->real_escape_string($last_edu);
  $skills = $_POST['skills'];
  $skills = $db->real_escape_string($skills);
  $experience = $_POST['experience'];
  $experience = $db->real_escape_string($experience);


  $query = "INSERT INTO job_cv(user_id,last_edu,skills,experience) VALUES ('{$user_id}','{$last_edu}','{$skills}','{$experience}') ";
  $result = $db->query($query);

  if($result){

    header("Location: add_cv.php");

  }

}

 ?>




<?php }else{

if(isset($_GET['edit'])){


$edit_q = "SELECT * FROM job_cv WHERE user_id = '{$user_id}' ";
$edit_result = $db->query($edit_q);

$fet = $edit_result->fetch_assoc();


$edit_edu = $fet['last_edu'];
$edit_skil = $fet['skills'];
$edit_exp = $fet['experience'];


  ?>





<a href="add_cv.php" class="btn btn-warning" style="margin-bottom:10px">X</a>

       
<form method="post" action="">


<div class="form-group">
  <input type="text" class="form-control" value="<?php if(isset($edit_edu)){echo $edit_edu; } ?>" name="last_edu" placeholder="Your Last Exam .e.g MBA" required />
</div>
  



<div class="form-group">
  <input type="text" class="form-control" value="<?php if(isset($edit_skil)){echo $edit_skil; } ?>" name="skills" placeholder="PHP, Java" required />
</div>
  


  <div class="form-group">
    

    <textarea name="experience" class="form-control" placeholder="Your Experiences" required><?php if(isset($edit_exp)){echo $edit_exp; } ?></textarea>
  </div>



<input type="submit" name="update" value="Update Cv" class="btn btn-info">

</form>



<?php 



if(isset($_POST['update'])){

  $last_edu = $_POST['last_edu'];
  $last_edu = $db->real_escape_string($last_edu);
  $skills = $_POST['skills'];
  $skills = $db->real_escape_string($skills);
  $experience = $_POST['experience'];
  $experience = $db->real_escape_string($experience);

  $update_q = "UPDATE job_cv SET last_edu = \"$last_edu\", skills = \"$skills\", experience = \"$experience\" WHERE user_id = '{$user_id}' ";
  $update_result = $db->query($update_q);
  if($update_result){
    header("Location: add_cv.php");
  }


}


 ?>





  <?php
}else{





$row_ch = $result_ch->fetch_assoc();
$last_edu = $row_ch['last_edu'];
$skills = $row_ch['skills'];
$experience = $row_ch['experience'];

?>

<a href="add_cv.php?edit=True" class="btn btn-danger">Edit</a>
<br>
<h3 class="alert alert-info">Last Exam You Passed</h3>
<h6 class="alert alert-success"><?php echo $last_edu; ?></h6>



<h3 class="alert alert-info">Skills</h3>
<h6 class="alert alert-success"><?php echo $skills; ?></h6>



<h3 class="alert alert-info">Experience</h3>
<h6 class="alert alert-success"><?php echo nl2br($experience); ?></h6>



<?php
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