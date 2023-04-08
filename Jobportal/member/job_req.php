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
                        <h1 class="page-head-line">Job Requests</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

   <table class="table table-striped table-borderd">
     

     <tr>
       
       <th>ID</th>
       <th>Seeker Name</th>
       <th>View CV</th>
       <th>Job Name</th>
       <th>Rank</th>
       <th>Assign Rank</th>

     </tr>
   


<?php 


$query = "SELECT * FROM seeker_jobs WHERE emp_id = '{$user_id}' ";
$result = $db->query($query);
$num = $result->num_rows;
if($num == 0){

  echo "Nothing Found.";

}else{

  $count = 0;
   while($row = $result->fetch_assoc()){

      $req_id = $row['id'];
      $seeker_id = $row['user_id'];
      $ch_se = "SELECT name FROM users WHERE id = '{$seeker_id}' ";
      $re_ch = $db->query($ch_se);
      $ch_f = $re_ch->fetch_assoc();
      $seeker_name = $ch_f['name'];





      $job_id = $row['job_id'];


      $jo_se = "SELECT name FROM jobs WHERE id = '{$job_id}' ";
      $j_ch = $db->query($jo_se);
      $j_f = $j_ch->fetch_assoc();
      $job_name = $j_f['name'];







      $rank = $row['rank'];

      $count++;

      ?>

<tr>
  
  <td><?php echo $count ?></td>
  <td><?php echo ucwords($seeker_name); ?></td>
  <td><a class="btn btn-success" href="job_req.php?view=<?php echo $seeker_id ?>">View</a></td>
  <td><?php echo ucwords($job_name); ?></td>
  <td><?php if($rank == 0){
    echo "Pending";
    }elseif($rank == 10){ echo "Reject"; }else{echo $rank; } ?></td>
  <td><a class="btn btn-warning" href="job_req.php?rank=<?php echo $req_id ?>">Assign</a></td>

</tr>

      <?php

  } // end of while 


if(isset($_GET['view'])){
  $view_id = $_GET['view'];

$check = "SELECT * FROM job_cv WHERE user_id = '{$view_id}' ";
$result_ch = $db->query($check);


$row_ch = $result_ch->fetch_assoc();
$last_edu = $row_ch['last_edu'];
$skills = $row_ch['skills'];
$experience = $row_ch['experience'];

?>


<a href="job_req.php" class="btn btn-danger">X</a>
<br>
<h3 class="alert alert-info">Last Passed Exam</h3>
<h6 class="alert alert-success"><?php echo $last_edu; ?></h6>



<h3 class="alert alert-info">Skills</h3>
<h6 class="alert alert-success"><?php echo $skills; ?></h6>



<h3 class="alert alert-info">Experience</h3>
<h6 class="alert alert-success"><?php echo nl2br($experience); ?></h6>



<?php
}







if(isset($_GET['rank'])){
$rank_id = $_GET['rank'];


?>



<form method="post" action="">
  
  <div class="form-group col-md-8">
    <select name="ranks" class="form-control" required>
      
      <option value="" selected disabled>Assign Rank......</option>
      <option value="0">Pending</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">Reject</option>
    </select>
  </div>

  <div class="col-md-4">
  <input type="submit" name="submit" value="Assign" class="btn btn-info">
  <a href="job_req.php" class="btn btn-danger">X</a>
  </div>
</form>


<?php 


if(isset($_POST['submit'])){

  $ranks = $_POST['ranks'];
  $quer = "UPDATE seeker_jobs SET rank = '{$ranks}' WHERE id = '{$rank_id}' ";
  $re_rank = $db->query($quer);
  if($re_rank){
    header("Location: job_req.php");
  }
}


 ?>



<?php

}






}


 ?>

</table> 
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