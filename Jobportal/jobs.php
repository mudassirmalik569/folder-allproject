
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



            $per_page  = 10;
            
             
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }else{

            $page = "";
            }

            if ($page == "" || $page == 1) {
            $page_1 = 0;
            }else{

              $page_1 = ($page * $per_page) - $per_page;
            }


           $post_query_count = "SELECT * FROM jobs WHERE status = 1";
           $find_count = $db->query($post_query_count);
           $count = $find_count->num_rows;
           $count = ceil($count / $per_page);
                 








$query = "SELECT * FROM jobs WHERE status = 1 ORDER BY id ASC LIMIT $page_1, $per_page";
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
				    <div class="thumb"><a href="job_details.php?job=<?php echo $id ?>"><img src="member/images/<?php echo $u_image; ?>" style="width: 120px;height: 90px" class="img-responsive" alt=""/></a></div>
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

<center>


    <ul class="pagination pagination-lg" style="box-shadow: 0px 0px 15px black">
    
    <?php 

    for ($i=1; $i <= $count ; $i++) { 
    
    if($i == $page){
        echo "<li class='active'><a class='active_link' href='jobs.php?page={$i}'>{$i}</a></li>";
    
    }else{
        
        echo "<li><a href='jobs.php?page={$i}'>{$i}</a></li>";
    }
    

}

?>
    
    
    </ul>
    
    
    </center>
    




</div>



  	  <div class="col_3 col-md-4">
	   	  	<?php include_once "today_jobs.php"; ?>
	   	  </div>






	   	  
	 </div> <!-- End of Main Content -->
	 




	   <div class="clearfix"> </div>

	 </div>

</div> <!-- container -->

<?php include_once "includes/footer.php"; ?>