
<?php include_once "includes/connect.php"; ?>
<?php 

session_start();
ob_start();

 ?>
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
                    <form method="post" action="">
                        <div class="section-title">
                            <h3>LogIn to your Account</h3>
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
                                <input type="password" name="password" required="required" class="form-control " placeholder="Your Password">
                            </div>
                        </div>
            
                     
					<div class="login-btn">
					   <input type="submit" name="login" value="Log in">
					</div>

         </form>
				
<?php 


if(isset($_POST['login'])){

 $login_email  = $_POST['email'];
 $login_password  = $_POST['password'];


$login_email = $db->real_escape_string($login_email);
$login_password = $db->real_escape_string($login_password);


$query = "SELECT * FROM users WHERE email = '{$login_email}' AND password = '{$login_password}' ";

$result = $db->query($query);
$num_rows = $result->num_rows;
if($num_rows == 0){
   echo "<p style='color:red;font-size:20px'>InCorrect Email OR Password !!</p>";
}else{
while($row = $result->fetch_assoc()){

$db_id = $row['id'];
$db_name = $row['name'];
$db_email = $row['email'];
$db_password = $row['password'];

$db_mobile = $row['contact'];
$db_image = $row['image'];
$db_bio = $row['bio'];
$db_role = $row['role'];




  if($login_email !== $db_email && $login_password !== $db_password){

  

  }elseif($login_email == $db_email && $login_password == $db_password){


    $_SESSION['id'] = $db_id;
    $_SESSION['name'] = $db_name;
    $_SESSION['email'] = $db_email;
    $_SESSION['role'] = $db_role;
    $_SESSION['contact'] = $db_mobile;
    $_SESSION['image'] = $db_image;
    $_SESSION['password'] = $db_password;


    
    

        header("Location:member/index.php");


    




    

  }else{ header("Location:member/logout.php"); }

  }// end of the while loop

}



} // end of the main if - isset




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