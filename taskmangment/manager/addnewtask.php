<?php
include 'connect.php';

$name = $_POST['name'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];


if(!empty($_POST['name']) && !empty($_POST['startdate']) && !empty($_POST['enddate']))
{
   $validate = "select * from tasks where name='$name'";
   $rsvalidate = mysqli_query($link,$validate);
   $value = mysqli_num_rows($rsvalidate);

   if($value==0){
   $query = "INSERT INTO tasks (task_name,start_date,end_date) 
          VALUES ('".$name."','".$startdate."','".$enddate."')";

    $rs = mysqli_query($link,$query);
  
    echo '<script>alert("Data added successfully")</script>'; 
    header('location:View-tasks.php');
   }

   else{
   echo '<script>alert("No duplicate data allowed")</script>';
   echo "<script>window.open('addtask.php','_self')</script>";
   }
}
else{
   echo '<script>alert("Fill all fields first")</script>';
   echo "<script>window.open('addtask.php','_self')</script>";
   }

?>