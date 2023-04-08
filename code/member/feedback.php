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
<?php if($user_role == 'admin') { ?>






<div id="wrapper">
<?php include_once "includes/top_navbar.php"; ?>
<?php include_once "includes/admin_sidebar_nav.php"; ?>     




<div id="page-wrapper" class="page-wrapper-cls">
<div id="page-inner">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">Customer Feedbackss</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">


<div class="col-md-12">



<table class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Name</th>
<th class="text-center">Message</th>
<th class="text-center">Delete</th>
</tr> 

</thead>

<tbody>


<?php 

$cat_fetch = "SELECT * FROM feedback";
$result_fetch = $db->query($cat_fetch);

$num_rows = $result_fetch->num_rows;
if($num_rows == 0){

echo "<td>Nothing Found.</td>";
}else{

$count = 0;
while($rows = $result_fetch->fetch_assoc()){

  $id = $rows['id'];
  $u_id = $rows['user_id'];

  $u_query = "SELECT name from users where id = '{$u_id}' ";
$result_u = $db->query($u_query);
$u_row = $result_u->fetch_assoc();
$u_name = $u_row['name'];


  
  $message = $rows['feedback'];
  $message = explode('.', $message);
 

  $count++;

?>
<tr class="text-center">
  <td><?php echo $count ?></td>
  <td><?php echo $u_name ?></td>
  <td><?php  
  
  foreach ($message as $mess) {
    echo $mess . '<br>';
  } 

  ?></td>
  


<td><a href="feedback.php?delete=<?php echo $id ?>">Delete</a></td>

</tr>

<?php



}



}


?>



</tbody>    

</table>













</div>




<?php 

if(isset($_GET['delete'])){

$del_id = $_GET['delete'];

$del_cat = "DELETE FROM feedback WHERE id = '{$del_id}' ";
$result_del = $db->query($del_cat);
if($result_del){

header("Location: feedback.php");

}else{

die(mysqli_error($db));

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