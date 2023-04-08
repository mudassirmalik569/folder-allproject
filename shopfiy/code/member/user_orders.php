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
<h1 class="page-head-line">Your Orders</h1>
<p>Cancel Your Order Within 24 Hours.</p>
</div>
</div>
<div class="row">
<div class="col-md-12">




<?php

$order_user = "SELECT * FROM orders WHERE user_id = '{$user_id}' ";
$rr = $db->query($order_user);
$num_row = $rr->num_rows;
if($num_row == 0){

echo "<p class='text-center'>No Order is Available.</p>";

} else{
?>

<table class="table table-bordered table-hover text-center">
<thead>

<tr class="text-center">
<th class="text-center">Order Id</th>
<th class="text-center">Product Name</th>
<th class="text-center">Product Image</th>
<th class="text-center">Quantity</th>
<th class="text-center">Price</th>
<th class="text-center">Total</th>
<th class="text-center">Date</th>
<th class="text-center">View</th>
<th class="text-center">Process</th>
<th class="text-center">Delete</th>



</tr> 

</thead>

<tbody>






<?php
$counter = 0;
while($rows = $rr->fetch_assoc()){

$order 		= $rows['id'];
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
<td ><a class="btn btn-info" href="user_view_product.php?view=<?php echo $pro_id ?>">View</a></td>


<?php if($status == 1){ ?>

<td>Done</td>

<?php
	
}else{ ?>

<td><a class="btn btn-warning btn-sm" href="user_orders.php?con=<?php echo $order; ?>">Confirm</a></td>


<?php } ?>




<?php 



$dates = new DateTime($pro_date);
$nows = new DateTime(); 

$differents = $nows->diff($dates);
$diffs = (int)$differents->format("%r%a");

if($diffs < 0){

	echo '<td>Expire</td>';

}else{

	?>

<td><a class="btn btn-danger btn-sm" href="user_orders.php?del=<?php echo $order; ?>">Delete</a></td>


<?php } ?>






</tr>


<?php

}


}  





if(isset($_GET['con'])){

	$id = $_GET['con'];
	$query = "UPDATE orders SET status = 1 WHERE id = '{$id}' AND user_id = '{$user_id}' ";

	$result = $db->query($query);
	if($result){

		header("Location: user_orders.php");
	}
}


if(isset($_GET['del'])){

	$id = $_GET['del'];
	$query = "DELETE FROM orders WHERE id = '{$id}' AND user_id = '{$user_id}' ";
	$result = $db->query($query);
	if($result){

		header("Location: user_orders.php");
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