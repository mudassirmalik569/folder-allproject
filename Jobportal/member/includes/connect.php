<?php

$db = new mysqli('localhost', 'root', '', 'portal');

if($db->connect_error){
	echo $error = $db->connect_error;
}

 ?>
