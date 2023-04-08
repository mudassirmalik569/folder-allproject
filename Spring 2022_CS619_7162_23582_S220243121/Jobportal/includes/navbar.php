
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	    <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
	        </button>
	   
	        <a style="font-size: 2em;font-weight: bold;color:white;margin-top:0.3em" class="navbar-brand" href="index.php">Online Job Portal</a>
	    </div>
	    <!--/.navbar-header-->
	    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
	        <ul class="nav navbar-nav">
		        
		        
		        <li><a href="index.php">Home</a></li>
		        <li><a href="jobs.php">Jobs</a></li>

<?php 

if(isset($user_name)){

	?>

<li><a href="member/index.php">My Account</a></li>
<li><a href="member/logout.php">Logout</a></li>

	<?php
}else{
	?>


				<li><a href="login.php">Login</a></li>		
		        <li><a href="register.php">Register</a></li>

	<?php
}


 ?>

		        
	        </ul>
	    </div>
	    <div class="clearfix"> </div>
	  </div>
	    <!--/.navbar-collapse-->
	</nav>


<div class="banner">
	<div class="container">
		<div id="search_wrapper">
		 <div id="search_form" class="clearfix">
		 <h1>Start your job search</h1>
		    <p>



<form method="post" action="job_search.php">


			 <input type="text" name="skill" class="text" placeholder=" " value="Enter Keyword(s)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Keyword(s)';}">


			 <input type="text" name="location" class="text" placeholder=" " value="Location" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Location';}">


			 <label class="btn2 btn-2 btn2-1b"><input type="submit" name="job" value="Find Jobs"></label>
			
</form>

			</p>
            
         </div>


		 
       </div>
   </div> 
</div>