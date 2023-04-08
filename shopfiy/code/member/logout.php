<?php

include_once "../database.php";

session_start();
ob_start();


$_SESSION['id'] = null;
$_SESSION['role'] = null;



 header("Location:../index.php");



 ?>
