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
<h1 class="page-head-line">Shopping History</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">




<?php

$recipe_query = "SELECT * FROM log_history WHERE user_id = '{$user_id}' ";
$result_recipe = $db->query($recipe_query);
$num_row = $result_recipe->num_rows;
if($num_row == 0){

echo "<p class='text-center'>No Purchase So Far.</p>";

} else{
?>

<table class="table table-bordered table-hover text-center">
<thead>
<tr class="text-center">
<th class="text-center">Id</th>
<th class="text-center">Topic (item) </th>
<th class="text-center">Message</th>
<th class="text-center">DateTime</th>

</tr> 

</thead>

<tbody>






<?php
$counter = 0;
while($rows = $result_recipe->fetch_assoc()){

$topic = $rows['topic'];
$message = $rows['message'];
$log_date = $rows['log_date'];

$log_date = new DateTime($log_date);
$log_date = $log_date->format('d M Y');


$counter++;

?>


<tr class="text-center">
<td><?php echo $counter ?></td>
<td><?php echo $topic ?></td>

<td><?php echo $message ?></td>
<td><?php echo $log_date ?></td>

</tr>


<?php

}


}  


?>

</tbody>    

</table>




<?php 

if(isset($_GET['delete'])){

$del_recipe = $_GET['delete'];
$del_res = "DELETE FROM recipe WHERE id = '{$del_recipe}' ";
$result_del = $db->query($del_res);
if($result_del){

header("Location: user_recipes.php");

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