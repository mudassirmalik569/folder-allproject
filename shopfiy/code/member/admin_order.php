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
<h1 class="page-head-line">All Orders</h1>
</div>
</div>
<div class="row">
<div class="col-md-12">




<?php

$orders_q = "SELECT * FROM orders ORDER BY id DESC";
$result_t = $db->query($orders_q);
$num_row = $result_t->num_rows;
if($num_row == 0){

echo "<p class='text-center'>No Order is Available.</p>";

} else{
?>

<table class="table table-bordered table-hover text-center">
<thead>

<tr class="text-center">
<th class="text-center">Order Id</th>
<th class="text-center">User</th>
<th class="text-center">Product Name</th>
<th class="text-center">Product Image</th>
<th class="text-center">Quantity</th>
<th class="text-center">Price</th>
<th class="text-center">Total</th>
<th class="text-center">Date</th>
<th class="text-center">View</th>

<th class="text-center">Status</th>


<th class="text-center" colspan="3">Action</th>



</tr> 

</thead>

<tbody>






<?php
$counter = 0;
while($rows = $result_t->fetch_assoc()){

$order = $rows['id'];
$u_id = $rows['user_id'];


$check_ = "SELECT name FROM users WHERE id = '{$u_id}' ";
$result_ch 	= $db->query($check_);
$row_check 	= $result_ch->fetch_assoc();
$u_name 	= $row_check['name'];


$pro_id 	= $rows['product_id'];
$pro_image 	= $rows['product_id'];
$pro_qty 	= $rows['qty'];
$pro_price 	= $rows['price'];
$pro_date 	= $rows['tran_date'];
$pro_date 	= new DateTime($pro_date);
$pro_date 	= $pro_date->format('d M Y');


$status 	= $rows['status'];





$counter++;

?>


<tr class="text-center">
<td><?php echo $counter ?></td>
<td><?php echo $u_name ?></td>

<?php 

$check_product = "SELECT pro_name,image FROM product WHERE id = '{$pro_id}' ";
$result_check = $db->query($check_product);
$rows = $result_check->fetch_assoc();

$pro_name = $rows['pro_name'];
$pro_image = $rows['image'];

?>


<td><?php echo $pro_name ?></td>
<td><img src="images/<?php echo $pro_image ?>" class="img-circle" width="20px" height="20px"></td>
<td><?php echo $pro_qty ?></td>
<td><?php echo $pro_price ?></td>
<td><?php echo $pro_qty * $pro_price . ' Rs' ; ?></td>
<td><?php echo $pro_date ?></td>

<td ><a class="btn btn-info" href="admin_product_view.php?view=<?php echo $pro_id ?>">View</a></td>


<td><?php echo $status ?></td>

<td ><a class="btn btn-info" href="admin_order.php?approve=<?php echo $order ?>">Approve</a></td>

<td ><a class="btn btn-warning" href="admin_order.php?reject=<?php echo $order ?>">Reject</a></td>



<td ><a class="btn btn-danger" href="admin_order.php?del=<?php echo $order ?>">Delete</a></td>


</tr>


<?php

}


} 


if(isset($_GET['del'])){

	$del_id = $_GET['del'];
	$query  = "DELETE FROM orders WHERE id = '{$del_id}' "; 
	$result = $db->query($query);
	if($result){

		header("Location: admin_order.php");
	}
}




if(isset($_GET['approve'])){

	$del_id = $_GET['approve'];
	$query  = "Update orders set status='Approved' WHERE id = '{$del_id}' "; 
	$result = $db->query($query);
	if($result){

		header("Location: admin_order.php");
	}
}





if(isset($_GET['reject'])){

	$del_id = $_GET['reject'];
	$query  = "Update orders set status='Rejected' WHERE id = '{$del_id}' "; 
	$result = $db->query($query);
	if($result){

		header("Location: admin_order.php");
	}
}





?>

</tbody>    

</table>




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