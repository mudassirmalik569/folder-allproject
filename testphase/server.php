<?php
session_start();

// initializing variables
$username = "";
$email = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'testpahse');

if (isset($_POST['forgot_password'])) {
    // Retrieve the user's email from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $results = mysqli_query($db, $query);
    // echo mysqli_num_rows($results);
    // return;

    if (mysqli_num_rows($results) == 1) {
      // Generate a random token and store it in the database
      $token = bin2hex(random_bytes(50));
      $query = "UPDATE users SET token='$token' WHERE email='$email'";
      mysqli_query($db, $query);
  
      // Send a password reset email to the user
      $to = $email;
      $subject = 'Reset your password';
      $message = 'Please click on the following link to reset your password:
    http://localhost/testphase/forgot_password.php?email=' . $email . '&token=' . $token;
  
      // Set the SMTP configuration
      $smtp_host = 'smtp.gmail.com';
      $smtp_port = 587; // For STARTTLS encryption
      $smtp_username = 'bc170404524@gmail.com';
      $smtp_password = 'Safimalik@5699.';
  
      // Create a new PHPMailer instance
      require_once 'path/to/PHPMailerAutoload.php';
      $mailer = new PHPMailer;
  
      // Enable SMTP debugging
      $mailer->SMTPDebug = 2;
  
      // Set the SMTP settings
      $mailer->isSMTP();
      $mailer->Host = $smtp_host;
      $mailer->SMTPAuth = true;
      $mailer->Username = $smtp_username;
      $mailer->Password = $smtp_password;
      $mailer->SMTPSecure = 'tls';
      $mailer->Port = $smtp_port;
  
      // Set the email content
      $mailer->From = $smtp_username;
      $mailer->FromName = 'Your Name';
      $mailer->addAddress($to);
      $mailer->Subject = $subject;
      $mailer->Body = $message;
  
      // Send the email
      if ($mailer->send()) {
          // Redirect the user to a confirmation page if the email was sent successfully
          header('location: resetpassword.php');
      } else {
          // Display an error message if the email could not be sent
          array_push($errors, 'An error occurred while sending the password reset email: ' . $mailer->ErrorInfo);
      }
  } else {
      // Display an error message if the email does not exist in the database
      array_push($errors, 'This email address does not exist.');
  }
  

}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {array_push($errors, "Username is required");}
    if (empty($email)) {array_push($errors, "Email is required");}
    if (empty($password_1)) {array_push($errors, "Password is required");}
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}