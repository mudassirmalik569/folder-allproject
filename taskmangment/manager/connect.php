<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "task";

$link = mysqli_connect($servername,$username,$password);
mysqli_select_db($link,$database);

?>


