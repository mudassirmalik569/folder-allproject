<?php
include 'connect.php';

$id = $_POST['id'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$city = $_POST['city'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "UPDATE employe set fullname='$name', contact='$contact', city='$city', email='$email', password='$password' where id='$id'";

mysqli_query($link,$query);
header('location:viewemploye.php');

?>

