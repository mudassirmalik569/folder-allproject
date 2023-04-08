<?php  
include 'connect.php';

$id = $_GET['id'];

$query = "DELETE FROM employe  WHERE id='$id'"

mysqli_query($link,$query);

header('location:viewemploye.php');

?>