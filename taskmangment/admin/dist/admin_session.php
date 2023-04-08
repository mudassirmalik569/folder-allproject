<?php
session_start();
include 'connect.php';

if (isset($_POST['login'])) 
{
	$email=$_POST['email'];
	$password=$_POST['pass'];

	if(!empty($_POST['email']) && !empty($_POST['pass']))
	{
	$query="SELECT * FROM admin WHERE username='$email' && password='$password'";
	$result= mysqli_query($link,$query);
	$value= mysqli_num_rows($result);
	
	if ($value==1) 
	{	
		$array= mysqli_fetch_array($result);
		$_SESSION['email']=$array['email'];
		header('location:dashboard.php');
	}

	else{
		echo '<script>alert("Username or Password Incorrect")</script>';
	    echo "<script>window.open('login.php','_self')</script>";
	}
	} 
	else{
		echo '<script>alert("Fill all fields first")</script>';
	    echo "<script>window.open('login.php','_self')</script>";
	}
}
?>
