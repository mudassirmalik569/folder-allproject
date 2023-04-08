<?php include_once "header.php"; ?>

<!--header-->
<div class="header">

<?php include_once "top.php"; ?>
<?php include_once "nav.php"; ?>

</div>

<div class="content">


<?php 

if(isset($_GET['product'])){

$product_id = $_GET['product'];

$view_incre = "UPDATE product SET pro_view = pro_view + 1 WHERE id = '{$product_id}' ";
$result_view = $db->query($view_incre);


$product = "SELECT * from product WHERE id = '{$product_id}' ";
$result = $db->query($product);

$row = $result->fetch_assoc();

$pro_id = $row['id'];
$sub_id = $row['sub_id'];
$pro_name = $row['pro_name'];

$pro_image = $row['image'];

$pro_detail = $row['pro_detail'];
$pro_tags = $row['tags'];
$pro_price = $row['price'];
$pro_view = $row['pro_view'];

$type = $row['type'];

$get_type = "SELECT name FROM types WHERE id = '{$type}' ";
$result_type = $db->query($get_type);
$row_type = $result_type->fetch_assoc();
$type_name = $row_type['name'];


$discount = $row['discount'];
$discount_price = ($discount/100) * $pro_price;

$new_price = $pro_price - $discount_price;




}


?>


	
<br><h2 class="text-center tittle">Product Details</h2><br>


<div class="single-grids">
<div class="col-md-9 single-grid">
<div clas="single-top">
<div class="single-left">
<div class="flexslider">
<ul class="slides">



<li data-thumb="member/images/<?php echo $pro_image; ?>">
<div class="thumb-image"> <img style='width: 100%;height: 510px !important' src="member/images/<?php echo $pro_image; ?>" data-imagezoom="true" class="img-responsive"> </div>
</li>



</ul>
</div>
</div>
<div class="single-right simpleCart_shelfItem">
<h4><?php echo $pro_name ?> <small title="No. of Views">(<?php echo $pro_view; ?>)</small></h4>
<div class="block">


</div>
<p class="price item_price">Rs. <?php echo number_format($new_price); ?>
	
<span style="color:black !important; font-size: 45px !important">

<?php echo $discount . '% OFF'; ?>

</span>


<small><del><?php echo number_format($pro_price); ?></del></small>


</p>

<div class="color-quality">

<h6>Type : <a style="color: #AF1D0D !important; text-decoration: underline;" href="products.php?type=<?php echo $type ?>"><?php echo ucfirst($type_name); ?></a></h6>



</div>

<div class="description">
<p><span>Quick Overview : </span> <?php echo $pro_detail; ?></p>
</div>
<div class="color-quality">
<h6>Quality :</h6>

<form method="post" action="">
	
<input type="number" name="quantity" min="0" required placeholder="Quantity">

<input type="hidden" name="hidden_name" value="<?php echo $pro_name; ?>" />  
<input type="hidden" name="hidden_price" value="<?php echo $new_price; ?>" /> 
<input type="hidden" name="hidden_image" value="<?php echo $pro_image; ?>" />




</div>
<div class="women">




<input type="submit" name="add_to_cart" value="Add to Cart" data-text="Add To Cart" class=" my-cart-b item_add">

</form>

<?php 




if(isset($_POST["add_to_cart"]))  
{  
if(isset($_SESSION["shopping_cart"]))  
{  
$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
if(!in_array($_GET["product"], $item_array_id))  
{  
$count = count($_SESSION["shopping_cart"]);  
$item_array = array(  
'item_id'               =>     $_GET["product"],  
'item_name'               =>   $_POST["hidden_name"],  
'item_price'          =>       $_POST["hidden_price"],
'item_image'          =>       $_POST['hidden_image'],  
'item_quantity'          =>    $_POST["quantity"]  
);  
$_SESSION["shopping_cart"][$count] = $item_array;  
}  
else  
{  
echo '<script>alert("Item Already Added")</script>';  
echo "<script>window.location=\"product_details.php?product=$product_id\"</script>";  
}  

 
}  
else  
{  
$item_array = array(  
'item_id'               =>     $_GET["product"],  
'item_name'               =>     $_POST["hidden_name"],  
'item_price'          =>     $_POST["hidden_price"],  
'item_image'          =>       $_POST['hidden_image'],
'item_quantity'          =>     $_POST["quantity"]  
); 

$_SESSION["shopping_cart"][0] = $item_array;

}  

echo "<script>window.location=\"product_details.php?product=$product_id\"</script>";  
}  





?>

</div>



<div class="social-icon">
<a href="#"><i class="icon"></i></a>
<a href="#"><i class="icon1"></i></a>
<a href="#"><i class="icon2"></i></a>
<a href="#"><i class="icon3"></i></a>
</div>
</div>
<div class="clearfix"> </div>
</div>
</div>
<div class="col-md-3 product-agileinfo-grid" style="margin-top: -60px !important">
<div class="top-rates">
<br><h3>Related products</h3>

<?php 

$top_query = "SELECT * FROM product WHERE id != '{$product_id}' AND sub_id = '{$sub_id}'  ORDER BY id DESC LIMIT 7";
$top_result = $db->query($top_query);
$top_num = $top_result->num_rows;
if($top_num == 0){
echo "Nothing Found.";
}else{
while($top_rows = $top_result->fetch_assoc()){

$pro_id = $top_rows['id'];
$pro_name = $top_rows['pro_name'];
$pro_image = $top_rows['image'];
$pro_price = $top_rows['price'];


?>


<div class="recent-grids">
<div class="recent-left">
<a href="product_details.php?product=<?php echo $pro_id; ?>"><img style="width: 49px !important;height: 77px !important" class="img-responsive " src="member/images/<?php echo $pro_image ?>"></a>
</div>
<div class="recent-right">
<h6 class="best2"><a href="product_details.php?product=<?php echo $pro_id; ?>"><?php echo $pro_name; ?> </a></h6>
<p> <em class="item_price"><?php echo number_format($pro_price); ?></em></p>
</div>	
<div class="clearfix"> </div>
</div>


<?php }} ?>





</div>
</div>


<div class="clearfix"> </div>
</div>






<!-- End -->
</div>
<?php include_once "footer.php"; ?>
