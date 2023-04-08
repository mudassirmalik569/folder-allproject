<?php 

$db = new mysqli('localhost','root','','portal');
if($db->connect_error){
	$error = $db->connect_error;
}




 ?>