<?php
include 'connect.php';

$name = $_POST['name'];
$contact = $_POST['contact'];
$city = $_POST['city'];
$email = $_POST['email'];
$password = $_POST['password'];


if(!empty($_POST['name']) && !empty($_POST['contact']) && !empty($_POST['city']) && !empty($_POST['email']) && !empty($_POST['password']))
{
   $validate = "select * from employe where fullname='$name'";
   $rsvalidate = mysqli_query($link,$validate);
   $value = mysqli_num_rows($rsvalidate);

   if($value==0){
   $query = "INSERT INTO employe (fullname,contact,city,email,password) 
          VALUES ('".$name."','".$contact."','".$city."','".$email."','".$password."')";

    $rs = mysqli_query($link,$query);
  
    echo '<script>alert("Data added successfully")</script>'; 
    header('location:viewemploye.php');
   }

   else{
   echo '<script>alert("No duplicate data allowed")</script>';
   echo "<script>window.open('employees.php','_self')</script>";
   }
}
else{
   echo '<script>alert("Fill all fields first")</script>';
   echo "<script>window.open('employees.php','_self')</script>";
   }

?>