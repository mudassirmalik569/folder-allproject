<?php
try {
include_once "../database.php";

session_start();
ob_start();


$user_id = $_SESSION['id'];
$user_role = $_SESSION['role'];





} catch (Exception $e) {
$error = $e->getMessage();
}

if(isset($error)){
echo $error;
} // checking for connection

?>

<?php include_once "includes/header.php"; ?>
<?php if($user_role == 'user') { ?>






<div id="wrapper">
<?php include_once "includes/top_navbar.php"; ?>
<?php include_once "includes/sidebar_nav.php"; ?>     




<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">Your Feedback</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">




<form method="post" action=""> 


<div class="form-group">
	
	<textarea rows="3" required name="feedback" placeholder="Your Feedback" class="form-control"></textarea>


</div>

<div class="form-group">
	<input class="btn btn-info" type="submit" name="submit" value="Send">
</div>


</form>

<?php 



if(isset($_POST['submit'])){

$feedback = $_POST['feedback'];
$feedback = $db->real_escape_string($feedback);



$f_query = "INSERT INTO feedback (user_id, feedback) VALUES ('{$user_id}','{$feedback}')";


$result_f = $db->query($f_query);

if($result_f){

echo "<p class='alert alert-info'>Thanks for Feedback.</p>";

}else{

	die($db->error);
}












}



?>






</div>
</div>

</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->



<?php include_once "includes/footer.php"; ?>

<?php }else{ header("location:logout.php"); } ?>