<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

// Handle account deletion
if (isset($_GET['delete'])) {
    // Connect to your database or storage mechanism
    // Delete the user's account and any related data
    // Destroy the user's session
    session_destroy();
    unset($_SESSION['username']);
    $_SESSION['success'] = "Your account has been deleted";
    // Redirect the user to the login page
    header("location: login.php");
    exit();
}
?>
