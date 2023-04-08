<?php include_once "header.php"; ?>

<!--header-->
<div class="header">

<?php include_once "top.php"; ?>
<?php include_once "nav.php"; ?>

</div>

<?php include_once "banner.php"; ?>


<div class="content">



<div class="new-arrivals-w3agile">
<div class="container">

<?php include_once "sidebar.php"; ?>



<h2 class="tittle">Shopping Cart</h2><br>
<div class="col-md-9">					

<table class="table table-bordered">
<thead>
<tr>
<th>Remove</th>
<th>Image</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Unit Price</th>

</tr>
</thead>
<tbody>




<?php   
if(!empty($_SESSION["shopping_cart"]))  
{  
$total = 0;  
$arr_count = count($_SESSION["shopping_cart"]);
foreach($_SESSION["shopping_cart"] as $keys => $values)  
{  
?>  
<tr> 




<tr>

<td class="text-center"><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
<td class="text-center"><a href="product_details.php?product=<?php echo $values["item_id"]; ?>"><img width="100px" height="100px" style="1px solid black;box-shadow:0px 2px 5px black" alt="" src="member/images/<?php echo $values["item_image"]; ?>" ></a></td>
<td class="text-center"><?php echo $values["item_name"]; ?></td> 
<td class="text-center"><?php echo $values["item_quantity"]; ?></td> 
<td class="text-center">Rs. <?php echo $values["item_price"]; ?></td>


</tr>	




</tr>  
<?php  
$total = $total + ($values["item_quantity"] * $values["item_price"]);  
}  
?>  
<tr>  









 
</tr> 





<?php 



if(isset($_GET["action"]))  
{  
if($_GET["action"] == "delete")  
{  
foreach($_SESSION["shopping_cart"] as $keys => $values)  
{  
if($values["item_id"] == $_GET["id"])  
{  
unset($_SESSION["shopping_cart"][$keys]);  

echo '<script>window.location="cart.php"</script>';  
}  
}  
}  
}  



?>



<?php  

}else{



}

?>  





</tbody>
</table>

<p class="pull-right">Total Price : <?php
	
	if(isset($total)){

		echo number_format($total); 

	}else{

		echo 0;

	}

 


 ?></p> 


<div style="margin-bottom: 2em !important">
<p class="buttons center">				


<?php 

if(!empty($_SESSION['shopping_cart']) AND isset($user_id)){

?>

<div class="pull-left">
<a href="checkout.php"><button class="btn btn-info" type="submit" id="checkout">Proceed</button></a>
</div>
<?php

}else{

?>

<p class="pull-left">Cart is Empty OR You Are Not Login.</p>

<?php
}

?>

</p>
</div>


</div>




</div> <!--  Main Content Div-->
</div>





</div>
<?php include_once "footer.php"; ?>
