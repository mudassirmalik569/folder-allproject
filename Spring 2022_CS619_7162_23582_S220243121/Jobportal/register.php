
<?php include_once "includes/connect.php"; ?>
<?php include_once "includes/header.php"; ?>
<?php include_once "includes/navbar.php"; ?>
<?php include_once "includes/function.php"; ?>






	



<div class="container">

	 <div class="single">  

	   <div class="col-md-12"> <!-- Content Goes Here -->
	   


	   	  <div class="col_3 col-md-4">
	   	  	<?php include_once "today_jobs.php"; ?>
	   	  </div>




<div class="col-md-8 single_right">
	 	   <div class="login-form-section">
                <div class="login-content">
                    

                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="section-title">
                            <h3>Register Form</h3>
                        </div>
                       
                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <input type="text" name="name" required="required" class="form-control" placeholder="Your Name">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" required="required" class="form-control" placeholder="Your Email">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-key"></i></span>
                                <input type="password" name="passowrd" required="required" class="form-control " placeholder="Your Password">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-phone"></i></span>
                                <input type="number" name="contact" required="required" class="form-control " placeholder="Your Contact">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user-md"></i></span>
                                <input type="file" name="image" class="form-control " placeholder="Your Image">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-fire"></i></span>
                                <input type="date" name="dob" class="form-control " placeholder="Your Date of Birth">
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-users"></i></span>
                                <select name="gender" required class="form-control">
                                	
                                	<option value="" selected disabled>Choose Gender.....</option>
                                	<option value="men">Men</option>
									<option value="women">Women</option>
                                </select>
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-map-marker"></i></span>
                                <select name="location" required class="form-control">
                                	
                                	<option value="" selected disabled>Choose Location.....</option>
                                	<option value="gujranwala">Gujranwala</option>
									<option value="lahore">Lahore</option>
									<option value="karachi">Karachi</option>
									<option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                   




						<div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-flag"></i></span>
                                <select name="functional_area" required class="form-control">
                                	
                                	<option value="" selected disabled>Choose Functional Area.....</option>
                                	<option value="computer science">Computer Science</option>
									<option value="teaching">Teaching</option>
									<option value="business">Business</option>
									<option value="other">Other</option>
                                </select>
                            </div>
                        </div>


                        <div class="textbox-wrap">
                            <div class="input-group">
                                <span class="input-group-addon "><i class="fa fa-user"></i></span>
                                <select name="role" required class="form-control">
                                	
                                	<option value="" selected disabled>Choose Role.....</option>
                                	<option value="job seeker">Job Seeker</option>
									<option value="employeer">Employeer</option>
									
                                </select>
                            </div>
                        </div>

                     
					<div class="login-btn">
					   <input type="submit" name="register" value="Register">
					</div>
					  </form>

<?php 


if(isset($_POST['register'])){

	
	$name = $_POST['name'];
	$email = $_POST['email'];


	$sql = "SELECT email FROM users WHERE email = '{$email}'";
	$result = $db->query($sql);
	$rows = $result->num_rows;
	if($rows > 0){
		echo "<p style='color:red;font-size:20px'>Try Again !! Email has been already Choosen !!</p>";
	}else{



		$passowrd = $_POST['passowrd'];
		$contact = $_POST['contact'];


	
  if($_FILES['image']['name'] == ''){
    $image = "default.jpg";
  }else{



  $destination = __DIR__ . "/member/images/";
  $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination.$_FILES['image']['name']);

  $image = $_FILES['image']['name'];
  


  }
		


		$dob = $_POST['dob'];
		$gender = $_POST['gender'];
		$location = $_POST['location'];
		$functional_area = $_POST['functional_area'];
		$role = $_POST['role'];



		$query = "INSERT INTO users (name,email,password,contact,image,dob,gender,location,functional_area,role,reg_date) VALUES ('{$name}','{$email}','{$passowrd}','{$contact}','{$image}','{$dob}','{$gender}','{$location}','{$functional_area}','{$role}', now()) ";

		$message = "Success ! Account has been Created.";

		insertion($query,$message);


	} // else of email-check

}// end of main isset


 ?>





                </div>
         </div>
   </div>
  <div class="clearfix"> </div>
	






	   	  
	 </div> <!-- End of Main Content -->
	 




	   <div class="clearfix"> </div>

	 </div>

</div> <!-- container -->

<?php include_once "includes/footer.php"; ?>