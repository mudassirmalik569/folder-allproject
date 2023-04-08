<?php
try {
  include_once "includes/connect.php";
  include_once "../includes/function.php";
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
<?php if($user_role == 'employeer') { ?>






    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/employeer_sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Post Job</h1>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                     


<form method="post" action="">
  

<div class="form-group">  
<input type="text" name="name" class="form-control" placeholder="Job Name" required autofocus>
</div>



<div class="form-group">  
  <select name="location" required class="form-control">

    <option value="" selected disabled>Choose Location.....</option>
    <option value="gujranwala">Gujranwala</option>
    <option value="lahore">Lahore</option>
    <option value="karachi">Karachi</option>
    <option value="other">Other</option>
    
  </select>
</div>


<div class="form-group">  
<input type="date" name="date" class="form-control" placeholder="Due Date" title="Job Due Date" required>
</div>


<div class="form-group">  
<input type="number" name="budget" class="form-control" placeholder="Budget e.g. 70,000/Month" required>
</div>




<div class="form-group">  
<input type="text" name="skills" class="form-control" placeholder="Skills e.g. PHP, JAVA" required>
</div>



<div class="form-group">
  
  <textarea name="details" placeholder="Job Description" class="form-control" rows="3" style="height: 100%" required></textarea>

</div>


<input type="submit" name="submit" class="btn btn-info">

</form>


<?php 


if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $name = $db->real_escape_string($name);

  $location = $_POST['location'];
  $date = $_POST['date'];

  $budget = $_POST['budget'];
  $skills = $_POST['skills'];
  $skills = $db->real_escape_string($skills);

  $details = $_POST['details'];
  $details = $db->real_escape_string($details);

  $query = "INSERT INTO jobs (user_id,name,location,job_date,budget,skills,details ) VALUES ('{$user_id}','{$name}','{$location}','{$date}','{$budget}','{$skills}','{$details}')";
  $message = "Job has been created.";
  insertion($query,$message);
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