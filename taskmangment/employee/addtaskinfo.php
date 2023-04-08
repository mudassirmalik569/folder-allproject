<?php
include 'connect.php';

$id = $_POST['id'];
$progress = $_POST['progress'];
$status = $_POST['status'];
$feedback = $_POST['feedback'];

$query = "UPDATE tasks set daily_progress='$progress', status='$status', feedback='$feedback' where id='$id'";

mysqli_query($link,$query);
header('location:view-tasks.php');

?>

