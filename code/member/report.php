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

<h3 align="center">Generate Reports</h3>
<hr>

			<div class="tool-tips widget-shadow">
				<form method="POST">
					<label>From</label>
					<input type="date" name="date_1" class="form-control">
					<br>
					<label>To</label>
					<input type="date" name="date_2" class="form-control">
					<br>
					<input type="submit" name="date" value="Generate" class="btn btn-primary">
				</form>
			</div>
<hr>



<?php 

if (isset($_POST['date'])) {
	?>



			<div class="tool-tips widget-shadow">
				
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total Price</th>
							<th>Date</th>
						
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php

							$date_1 = $_POST['date_1'];
							$date_2 = $_POST['date_2'];

							$get = mysqli_query($db, "SELECT * FROM orders WHERE `tran_date` >= '$date_1' && `tran_date` <= '$date_2'");

							if (mysqli_num_rows($get)) {

								$check = 0;

								while ($a = mysqli_fetch_assoc($get)) {
									
									$product_id = $a['product_id'];
									$qty 		= $a['qty'];

									$product 	= mysqli_query($db, "SELECT * FROM product WHERE id = '$product_id'");
									if (mysqli_num_rows($product)) {
										
										

										while ($p = mysqli_fetch_assoc($product)) {

											

											?>

								<td><img src="images/<?php echo $p['image']; ?>" width="50px" width="50px"></td>
								<td><?php echo $p['pro_name']; ?></td>
								<td><?php echo $qty; ?></td>
								<td><?php echo $p['price']; ?></td>
								<td><?php echo $total_price = $qty * $p['price']; ?></td>
								<td><?php echo $a['tran_date']; ?></td>
								
								<?php $check = $check + $total_price; ?>


						</tr>
										<?php } } }	} ?>
					</tbody>
					<tfoot>
			<td colspan="5" align="center"><br><b>Total</b></td>
			<td align="center"><br><b><?php if(isset($check)){ echo $check; }else{ echo "No Order Found."; } ?></b></td>

		</tfoot>
				</table>
			
			<?php }  ?>


			</div>

		</div>
	</div>















<?php include("includes/footer.php"); ?>
<?php }else { header("Location: logout.php"); } ?>