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
			<div class="col-md-8">
<?php 
if(isset($_POST['job'])){
	$skill = $_POST['skill'];
	$location = $_POST['location'];
	?>
<?php 
$query = "SELECT * FROM jobs WHERE name LIKE '%$skill%' AND location LIKE '%$location%' ";
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
		$budger = $row['budget'];
		$details = $row['details'];
		$auther_id = $row['user_id'];
		$check_user = "SELECT name,image FROM users WHERE id = '$auther_id' ";
		$result_ch = $db->query($check_user);
		$rows = $result_ch->fetch_assoc();
		$u_name = $rows['name'];
		$u_image = $rows['image'];

?>
			 <div class="tab_grid">
			    <div class="jobs-item with-thumb">
				    <div class="thumb">
					<a href="job_details.php?job=<?php echo $id ?>"><img src="member/images/<?php echo $u_image; ?>" style="width: 120px;height: 90px" class="img-responsive" alt=""/></a></div>
				    <div class="jobs_right">
						<div class="date"><?php echo $job_date ?><span><?php echo $u_name ?></span></div>
						<div class="date_desc"><h6 class="title"><a href="job_details.php?job=<?php echo $id ?>"><?php echo ucwords($name); ?></a></h6>
						  <span class="meta"><?php echo $location; ?></span>
						</div>
						<div class="clearfix"> </div>
						<p class="description"><?php echo substr($details,0,100); ?> <a href="job_details.php?job=<?php echo $id ?>" class="read-more">Read More</a></p>
                    </div>
					<div class="clearfix"> </div>
				</div>
			 </div>
<?php
	}
}
 ?>
</div>
  	  <div class="col_3 col-md-4">
	   	  	<?php include_once "today_jobs.php"; ?>
	   	  </div>
<?php } ?>
	 </div> <!-- End of Main Content -->
	   <div class="clearfix"> </div>
	 </div>
</div> <!-- container -->

<?php include_once "includes/footer.php"; ?>