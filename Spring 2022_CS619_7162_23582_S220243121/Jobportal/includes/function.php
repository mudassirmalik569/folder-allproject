<?php 

function insertion($query,$message){

	global $db;
	$result = $db->query($query);
	if($result){
		echo "<h3 class='text-center alert alert-success'>$message</h3>";
	}else{
		die($db->error);
	}


}



function update_query($query){

	global $db;
	$result = $db->query($query);
	if($result){
		$page = $_SERVER['PHP_SELF'];
		header("Location: $page ");
	}else{
		die($db->error);
	}


}









?>