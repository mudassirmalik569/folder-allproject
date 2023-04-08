
<?php include_once "includes/connect.php";

	error_reporting(0);
    session_start();
    ob_start();

   
   $user_id = $_SESSION['id'];
   $user_name = $_SESSION['name'];
   $user_email = $_SESSION['email'];
   $user_role = $_SESSION['role'];
   $user_number = $_SESSION['contact'];



 ?>
<?php include_once "includes/header.php"; ?>
<?php include_once "includes/navbar.php"; ?>





	



<div class="container">

	 <div class="single">  

	   <div class="col-md-12"> <!-- Content Goes Here -->
	   


	   	  <div class="col_3 col-md-4">
	   	  	<?php include_once "today_jobs.php"; ?>
	   	  </div>


		<div class="col-md-8">
			
<?php 


if(isset($_GET['job'])){
	$job_id = $_GET['job'];

?>




<?php 


$query = "SELECT * FROM jobs WHERE id = '{$job_id}' ";
$result = $db->query($query);
$num = $result->num_rows;
if($num == 0){

	echo "<p class='text-center'>Nothing Available Right Now.</p>";
}else{


	while($row = $result->fetch_assoc()){

		$id = $row['id'];
		$name = $row['name'];
		$location = $row['location'];
		$job_date = $row['job_date'];
		$budget = $row['budget'];
		$details = $row['details'];
		$skills = $row['skills'];

		$auther_id = $row['user_id'];

		$check_user = "SELECT name,image FROM users WHERE id = '$auther_id' ";
		$result_ch = $db->query($check_user);
		$rows = $result_ch->fetch_assoc();
		$u_name = $rows['name'];
		$u_image = $rows['image'];

?>






			 <div class="tab_grid">
			    <div class="jobs-item with-thumb">
				    <div class="thumb"><a href="job_details.php?job=<?php echo $id ?>"><img src="member/images/<?php echo $u_image; ?>" style="width: 300px;height: 300px" class="img-responsive" alt=""/></a></div>
				    <div class="jobs_right">
						
						<div class="date"><?php echo $job_date ?><span><?php echo $u_name ?></span></div>
						



						<div class="date_desc"><h2 class="title"><a href="job_details.php?job=<?php echo $id ?>"><?php echo ucwords($name); ?></a></h2>

<?php 

if(!isset($user_name)){

	echo "<a href='#' class='btn btn-warning' onClick=\"alert('Please Login Before Apply.')\">Apply For Job</a><br><br>";

}else{



$chek = "SELECT * FROM seeker_jobs WHERE user_id = '{$user_id}' AND job_id = '{$job_id}' ";
$che_re = $db->query($chek);
$count = $che_re->num_rows;
if($count > 0){

	echo "<a href='#' class='btn btn-danger' onClick=\"alert('Already Applied.')\">Applied</a><br><br>";

}else{



	?>


<a class="btn btn-success" href="job_details.php?job=<?php echo $job_id ?>&apply=<?php echo $job_id; ?>">Apply For This Job</a><br><br>
	<?php

 }
}

 ?>
						  


						  <span class="meta" style="font-weight: bold;font-size: 1.2em">Location: <?php echo $location; ?></span><br><hr>
						  <span class="meta" style="font-weight: bold;font-size: 1.2em">Budget : <?php echo $budget; ?></span><br><hr>
						  <span class="meta" style="font-weight: bold;font-size: 1.2em">Skills :</span> <br><hr> <?php echo $skills; ?> <br><hr>
						</div>


						<div class="clearfix"> </div>
                 		<span class="meta" style="font-weight: bold;font-size: 1.2em">Details :</span> <br><hr>

						<p class="description" style="column-count:3"><?php echo $details; ?> <a href="job_details.php?job=<?php echo $id ?>" class="read-more"></a></p>
                    </div>
					<div class="clearfix"> </div>
				</div>
			 </div>


			 


<?php
	}
}


 ?>



<?php } ?>






<?php 

if(isset($_GET['apply'])){
	$job_ids = $_GET['apply'];


	$check = "SELECT user_id FROM jobs WHERE id = '{$job_ids}' ";
	$re = $db->query($check);
	$fet = $re->fetch_assoc();

	$emp_id = $fet['user_id'];




	$ap_query = "INSERT INTO seeker_jobs(user_id,job_id,emp_id) VALUES('{$user_id}','{$job_ids}','{$emp_id}') ";
	$ap_result = $db->query($ap_query);
	if($ap_result){

		header("Location: job_details.php?job=$job_ids");
	}



}



 ?>



		</div>

	   	  



	   	  
	 </div> <!-- End of Main Content -->
	 




	   <div class="clearfix"> </div>

	 </div>

</div> <!-- container -->

<?php include_once "includes/footer.php"; ?>