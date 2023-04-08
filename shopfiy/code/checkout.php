<?php include_once "header.php"; ?>

<!--header-->
<div class="header">

<?php include_once "top.php"; ?>
<?php include_once "nav.php"; ?>

</div>

<?php

if(isset($_SESSION['id'])){

	$user_id = $_SESSION['id'];
	$query_name = "select * from users WHERE id = '{$user_id}' ";


	$result_q = $db->query($query_name);
	$row_q = $result_q->fetch_assoc();
	$your_name = $row_q['name'];
	$user_email = $row_q['email'];
	$your_contact = $row_q['contact'];

	  if(!isset($user_id) OR empty($_SESSION['shopping_cart'])){

   		header("Location: index.php");

   }
}else{

	header("Location: index.php");
}




/*

function send_mail_with_swift($mails,$subject,$message){


$smtp_server = 'smtp.gmail.com';


$username = 'waqas.dawahsoft@gmail.com';
$password = 'waqas@786';

$to = (string)$mails;
$sub = (string)$subject;
$mes = (string)$message;

try {
    
  // port 465  

 $transport = \Swift_SmtpTransport::newInstance($smtp_server, 465,'ssl')->setUsername($username)->setPassword($password);

$mailer = \Swift_Mailer::newInstance($transport);
$messag = \Swift_Message::newInstance("$sub")
   ->setFrom(array('no-reply@Furniture.com' => 'Furniture Shop: Transaction'))
   ->setTo(array($to => $to))
   ->setBody("$mes", 'text/html');


return $mailer->send($messag);


} catch (Exception $e) {
 
   echo "<br><h5 class='alert alert-danger'>".$e->getMessage()."</h5>";
}





	
}



*/


?>


<div class="container">
<div class="col-md-12">
<h2 class="tittle">Checkout</h2><hr><br>




<form action="" method="post">



<div class="form-group">

<div class="controls">
<input type="text" style="width:80%" name="name" value="<?php echo $your_name; ?>" placeholder="Enter Receiver Name" class="form-control" disabled>
</div>
</div>


<div class="form-group">

<div class="controls">
<input type="number" style="width:80%" name="contact" value="<?php echo $your_contact; ?>" placeholder="Enter Receiver Mobile No." class="form-control" disabled>
</div>
</div>


<div class="form-group">

<select class="form-control" required name="province" style="width:80%">
<option value="" disabled selected>Your Province</option>

<option value="punjab">Punjab</option>
<option value="sindh">Sindh</option>
<option value="blochi">Blochistan</option>
<option value="sarhad">Sarhad</option>

</select>


</div>




<div class="form-group">

<select class="form-control" required name="city" style="width:80%">
<option value="" disabled selected> Your City</option>

<option value="sialkot">Sialkot</option>
<option value="karachi">Karachi</option>
<option value="lahore">Lahore</option>
<option value="multan">Multan</option>
<option value="gujranwala">Gujranwala</option>

</select>


</div>



<div class="form-group">

<div class="controls">
<textarea style="width:80%" class="form-control" name="street" rows="3" name="bio" placeholder="Write Your Address.." required></textarea>
</div>
</div>



<div class="form-group">
	<div class="controls">
		
		
<select required id="mode" class="form-control" name="payment_mode" style="width:80%">
<option value="" disabled selected>Choose</option>

<option value="Cash">Cash on Delivery</option>
<option value="Credit">Through Card</option>
</select>


	</div>
</div>



<div class="form-group" id="bank">
	<div class="controls">
		


	</div>
</div>


<div class="form-group" id="account">
<div class="controls">
		


	</div>
</div>





<div class="form-group pull-left">
<input tabindex="3" class="btn btn-danger large" type="submit" name="ship" value="Check Out">


</div>

</form>	
<script type="text/javascript">
	
$('document').ready(function(){

	$('#mode').change(function(){

	if( $(this).val() == 'Credit'){


	$('#bank').append('<ul><input id="bank_name" class="form-control" name="bank" style="width:80%" type="text" placeholder="Your Bank Name" required /></ul>');


	$('#account').append('<ul><input id="bank_account" name="bank_account" class="form-control" style="width:80%" type="text" placeholder="Your Bank Account" required /></ul>');


	}else{

		$('#bank_name').remove();
		$('#bank_account').remove();
		

	}


	});

});





</script>

<?php 

if(isset($_POST['ship'])){

$province = $_POST['province'];
$city = $_POST['city'];
$street = $_POST['street'];



$payment_mode = $_POST['payment_mode'];
$payment_mode = $db->real_escape_string($payment_mode);


switch ($payment_mode) {
	case 'Cash':
	$bank_account = 'None';
	$bank = 'None';
		break;
	
	case 'Credit':
	$bank_account = $_POST['bank_account'];
	$bank = $_POST['bank'];
		break;
}





$ship_query = "INSERT INTO order_location (user_id,province,city,street) VALUES ('{$user_id}','{$province}','{$city}','{$street}') ";
$result_ship = $db->query($ship_query);
if($result_ship){








if(!empty($_SESSION["shopping_cart"])){



$ex = "INSERT INTO orders (user_id,product_id,qty,price,tran_date,payment_mode,bank_name,account_no) VALUES ";
$value = array();

foreach ($_SESSION["shopping_cart"] as $row) {


$id = $row['item_id'];
$name = $row['item_name'];
$quantity = $row['item_quantity'];
$price = $row['item_price'];

$total = $price * $quantity;
$total = round($total);

$message_t = <<<EOD
<html>
    <head>
    <title>Furniture Shop</title>
    <style type="text/css">
	
table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}

table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
		
    </style>
    </head>
<body>
<h1>Furniture Shop: Transaction For $name</h1>
<h3>Thanks For Shopping.</h3>



	<table class="blueTable">
		<thead>
		<tr>
			<th>Product</th>
			<th>Quantity</th>
			<th>Price</th>
	
			<th>Phone</th>
			<th>Province</th>
			<th>City</th>
			<th>Address</th>

			<th>Pay Mode</th>
			
			<th>Account</th>
			<th>Bank</th>
			<th>Total</th>
			
		</tr>
		</thead>

		<tfoot>
		<tr>
	

			<td>$name</td>
			<td>$quantity</td>
			<td>$price</td>
			<td>$your_contact</td>
			<td>$province</td>

			<td>$city</td>
			<td>$street</td>
			<td>$payment_mode</td>
			<td>$bank_account</td>
			<td>$bank</td>
			<td>$total</td>

		</tr>
		</tfoot>
	</table>



    </body>
</html>
EOD;

/**
$sub = "Furniture Shop: Transaction For $name";
$send = send_mail_with_swift($user_email,$sub,$message_t);


if($send){



$message = "Transaction Done.";
*/

$log_history = "INSERT INTO log_history (user_id,topic,message,log_date) VALUES ('{$user_id}','{$name}','{$message}',now()) ";
$result_log = $db->query($log_history); 




$value[] = "('{$user_id}','{$id}','{$quantity}','{$price}',now(),'{$payment_mode}','{$bank}','{$bank_account}') ";


}

$ex .= implode(',', $value);

$rs = $db->query($ex);

if($rs){


echo "<script>alert('Transaction Done Successfully,.');</script>";

unset($_SESSION["shopping_cart"]);

echo '<script>window.location="index.php"</script>';  

}else{

	die(mysqli_error($db));
}


}


}






}



?>






</div>



</div> <!--  Main Content Div-->
</div>





</div>


<div class="clearfix"> </div>
</div>






<!-- End -->
</div>
<?php include_once "footer.php"; ?>

