<h3>Latest Jobs</h3>
	   	  	<ul class="list_1">




<?php 

$query = "SELECT * FROM jobs WHERE status = 1 ORDER BY id DESC LIMIT 10";
$result = $db->query($query);
$num_rows = $result->num_rows;
if($num_rows == 0){
	echo "<li><a href='#'>No Job is currently open.</a></li>";
}else{

	while($row = $result->fetch_assoc()){

		$id = $row['id'];
		$name = $row['name'];
		$location = $row['location'];
		$job_date = $row['job_date'];
		$budger = $row['budget'];
		$details = $row['details'];

?>



	   	  		<li><a href="job_details.php?job=<?php echo $id ?>"><?php echo "<h3 style='backgroud-color:black !important'>" . ucwords($name) . '</h3>'; ?></a></li>


<?php


	}
}


 ?>


	   	  							
	   	  	</ul>