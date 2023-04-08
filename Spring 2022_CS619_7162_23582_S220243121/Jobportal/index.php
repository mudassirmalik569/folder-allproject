
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
	   


	   	  <div class="col_3 col-md-6">
	   	  	<?php include_once "today_jobs.php"; ?>
	   	  </div>



	  <div class="col_3 col-md-6">
	  	<h3 class='text-center'>Online Job Portal 2</h3>
	  	<p>The online Job portal will help both the Job Seekers and Employers in posting and searching the job. In fact it will be an online HR solution for Employers short listing the suitable candidates while job seeker can have job searching options with maintaining its CV.</p>
	  </div>


	   	  
	 </div> <!-- End of Main Content -->
	 




	   <div class="clearfix"> </div>

	 </div>

</div> <!-- container -->

<?php include_once "includes/footer.php"; ?>