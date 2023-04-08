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
                        <h1 class="page-head-line">Your Jobs</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                     



<table class="table table-bordered table-striped"> 

<tr>
  <th class="text-center">ID</th>
  <th class="text-center">Name</th>
  <th class="text-center">Location</th>
  <th class="text-center">Date</th>
  <th class="text-center">Budget</th>
  <th class="text-center">Status</th>
  <th class="text-center">Detail</th>
  <th class="text-center">Close</th>
  <th class="text-center">Edit</th>
  <th class="text-center">Delete</th>
</tr>
  
<?php 


$query = "SELECT * FROM jobs WHERE user_id = '{$user_id}' ";

$result = $db->query($query);
$num = $result->num_rows;
if($num == 0){
  echo "You don't have any Job.";
}else{

  $count = 0;
  while($row = $result->fetch_assoc()){

      
      $id = $row['id'];
      $name = $row['name'];
      $location = $row['location'];
      $job_date = $row['job_date'];
      $budget = $row['budget'];
      $status = $row['status'];
      switch ($status) {
        case 1:
          $status = 'Open';
          break;
        
        

        case 0:
          $status = 'Close';
          break;
        


        default:
          $status = 'Unknown';
          break;
      }
     
      
      
      $count++;

      ?>


<tr class="text-center">
  

<td><?php echo $count ?></td>
<td><?php echo $name ?></td>
<td><?php echo $location ?></td>
<td><?php echo $job_date ?></td>
<td><?php echo $budget ?></td>
<td><?php echo $status ?></td>
<td><a class="btn btn-success" href="emp_jobs.php?view=<?php echo $id ?>">View</a></td>
<td><a class="btn btn-warning" href="emp_jobs.php?close=<?php echo $id ?>">Close</a></td>
<td><a class="btn btn-info" href="emp_jobs.php?edit=<?php echo $id ?>">Edit</a></td>
<td><a class="btn btn-danger" href="emp_jobs.php?delete=<?php echo $id ?>">Delete</a></td>

</tr>


      <?php

  }// end of while loop




if(isset($_GET['view'])){
  $view_id = $_GET['view'];
  echo "<a class='btn btn-danger' href='emp_jobs.php'>Close</a>";

  $view_query = "SELECT skills,details FROM jobs WHERE user_id = '{$user_id}' AND id = '{$view_id}' ";
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





if(isset($_GET['close'])){

  $close_id = $_GET['close'];
  $close_query = "UPDATE jobs SET status = 0 WHERE id = '{$close_id}' AND user_id = '{$user_id}' ";
  $result_close = $db->query($close_query);
  if($result_close){
    header("Location: emp_jobs.php");
  }
}






if(isset($_GET['delete'])){

  $del_id = $_GET['delete'];
  $del_query = "DELETE FROM jobs WHERE id = '{$del_id}' AND user_id = '{$user_id}' ";
  $result_del = $db->query($del_query);
  if($result_del){
    header("Location: emp_jobs.php");
  }

}



if(isset($_GET['edit'])){
$edit_id = $_GET['edit'];


 echo "<a class='btn btn-danger' href='emp_jobs.php'>Close</a><br>";

$edit_query = "SELECT * FROM jobs WHERE id = '{$edit_id}' AND user_id = '{$user_id}' ";
$result_edit = $db->query($edit_query);
$rows = $result_edit->fetch_assoc();

  $name = $rows['name'];
  $location = $rows['location'];
  $date = $rows['job_date'];
  $budget = $rows['budget'];
  $skills = $rows['skills'];
  $details = $rows['details'];
  $status = $rows['status'];
   



?>



<br>
<form method="post" action="">
  

<div class="form-group">  
<input type="text" name="name" value="<?php if(isset($name)){echo $name; } ?>" class="form-control" placeholder="Job Name" required autofocus>
</div>



<div class="form-group">  
  <select name="location" required class="form-control">

    <option value="<?php if(isset($location)){echo $location; } ?>"><?php if(isset($location)){echo $location; } ?></option>
    <option value="gujranwala">Gujranwala</option>
    <option value="lahore">Lahore</option>
    <option value="karachi">Karachi</option>
    <option value="other">Other</option>
    
  </select>
</div>


<div class="form-group">  
<input type="date" name="date" value="<?php if(isset($date)){echo $date; } ?>" class="form-control" placeholder="Due Date" title="Job Due Date" required>
</div>


<div class="form-group">  
<input type="number" name="budget" value="<?php if(isset($budget)){echo $budget; } ?>" class="form-control" placeholder="Budget e.g. 70,000/Month" required>
</div>




<div class="form-group">  
<input type="text" name="skills" value="<?php if(isset($skills)){echo $skills; } ?>" class="form-control" placeholder="Skills e.g. PHP, JAVA" required>
</div>



<div class="form-group">
  
  <textarea name="details" placeholder="Job Description" class="form-control" rows="3" style="height: 100%" required><?php if(isset($details)){echo $details; } ?></textarea>

</div>



<div class="form-group">  
  <select name="status" required class="form-control">

    <option value="" selected disabled>Choose Status.......</option>
    <option value="1">Open</option>
    <option value="0">Close</option>
    
    
  </select>
</div>



<input type="submit" name="update" value="Update" class="btn btn-warning"><br>

</form>
<br>


<?php 



if(isset($_POST['update'])){

  $name = $_POST['name'];
  $name = $db->real_escape_string($name);

  $location = $_POST['location'];
  $date = $_POST['date'];

  $budget = $_POST['budget'];
  $skills = $_POST['skills'];
  $skills = $db->real_escape_string($skills);

  $details = $_POST['details'];
  $details = $db->real_escape_string($details);
  $status = $_POST['status'];


  $update_query = "UPDATE jobs SET name = \"$name\", location = \"$location\", job_date = \"$date\", budget = \"$budget\", skills = \"$skills\", details = \"$details\", status = \"$status\" WHERE id = '{$edit_id}' AND user_id = '{$user_id}' ";
  $result_update = $db->query($update_query);
  if($result_update){

    header("Location: emp_jobs.php");
  }else{
    die($db->error);
  }



}



 ?>





<?php


} // end of edit_id







} // end of else



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