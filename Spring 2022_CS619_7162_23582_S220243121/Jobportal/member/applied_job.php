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

                     

<table class="table table-bordered table-striped"> 

<tr>
  
  <th>ID</th>
  <th>Job Name</th>
  <th>Location</th>
  <th>Budget</th>
  <th>Details</th>
  <th>Rank</th>
</tr>


<?php 


$query = "SELECT * FROM seeker_jobs WHERE user_id = '{$user_id}' ";
$result = $db->query($query);
$num_rows = $result->num_rows;
if($num_rows == 0){
  echo "Nothing Applied.";
}else{
$count = 0;
  while($rows = $result->fetch_assoc()){

    $id = $rows['id'];
    $job_id = $rows['job_id'];
    $rank = $rows['rank'];


    $check = "SELECT * FROM jobs WHERE id = '{$job_id}' ";
    $result_ch = $db->query($check);
    $row_result = $result_ch->fetch_assoc();

    $name = $row_result['name'];
    $location = $row_result['location'];
    $budget = $row_result['budget'];
    $count++;

?>



<tr>
  
    <td><?php echo $count ?></td>
    <td><?php echo $name ?></td>
    <td><?php echo $location ?></td>
    <td><?php echo $budget ?></td>
    <td><a class="btn btn-success" href="applied_job.php?view=<?php echo $id ?>">View</a></td>
    <td><?php  if($rank == 0){

        echo "Pending";

      }elseif($rank == 10){echo "Reject"; }else{ echo $rank; } ?></td>

</tr>

<?php  

  }




if(isset($_GET['view'])){
  $view_id = $_GET['view'];
  echo "<a class='btn btn-danger' href='applied_job.php'>Close</a>";

  $view_query = "SELECT skills,details FROM jobs WHERE id = '{$view_id}' ";
  $result_view = $db->query($view_query);
  $result_row = $result_view->fetch_assoc();
  $skills = $result_row['skills'];
  $details = $result_row['details'];

  ?>

  <h4 class="alert alert-info">Skills</h4>
  <p><?php echo $skills ?></p>

  <h4 class="alert alert-warning">Details</h4>
  <p><?php echo $details ?></p>



  <?php

} // end of view-isset




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