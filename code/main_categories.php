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

	
<?php if(isset($_GET['sub'])){ 
	$cat_id = $_GET['sub'];
?>



<div class="col-md-3 product-agileinfo-grid" >



<div class="brand-w3l"><br><br>
<h3 title="Relevent Sub Categories">Relevent Sub</h3>
<ul>


<?php 

$top_query = "SELECT * FROM sub_category WHERE cat_id = '{$cat_id}' ";
$top_result = $db->query($top_query);
$top_num = $top_result->num_rows;
if($top_num == 0){
echo "Nothing Found";
}else{
while($top_rows = $top_result->fetch_assoc()){

$sub_id = $top_rows['id'];
$sub_name = $top_rows['sub_name'];
?>


<li><a href="products.php?sub_id=<?php echo $sub_id ?>"><?php echo $sub_name; ?></a></li>



<?php }} ?>




</ul>
</div>

<div class="top-rates">
<h3>Top Products</h3>



<?php 

$top_query = "SELECT * FROM product ORDER BY pro_view DESC";
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



<div class="col-md-9 product-agileinfon-grid1 w3l">

<h2 class="tittle">Category ALL Products</h2><br>





<?php 

$top_query = "SELECT * FROM product WHERE cat_id = '{$cat_id}' ORDER BY id DESC ";
$top_result = $db->query($top_query);
$top_num = $top_result->num_rows;
if($top_num == 0){
echo "Nothing Found.";
}else{
while($top_rows = $top_result->fetch_assoc()){

$pro_id = $top_rows['id'];
$pro_name = $top_rows['pro_name'];
$pro_image = $top_rows['image'];
$pro_image_side = $top_rows['side_image'];
$pro_price = $top_rows['price'];

$type = $top_rows['type'];

$get_type = "SELECT name FROM types WHERE id = '{$type}' ";
$result_type = $db->query($get_type);
$row_type = $result_type->fetch_assoc();
$type_name = $row_type['name'];

?>


<div class="col-md-4 product-tab-grid simpleCart_shelfItem">

<div class="grid-arr">
<div  class="grid-arrival">
<figure>		
<a href="product_details.php?product=<?php echo $pro_id; ?>" class="new-gri" data-toggle="modal">
<div class="grid-img">
<img  src="member/images/<?php echo $pro_image; ?>" style="width: 100% !important;height: 247px !important" class="img-responsive" alt="">
</div>
<div class="grid-img">
<img  src="member/images/<?php echo $pro_image_side; ?>" style="width: 100% !important;height: 247px !important" class="img-responsive" alt="">
</div>			
</a>		
</figure>	
</div>
<div class="block">

</div>
<div class="women">
<h6><a href="product_details.php?product=<?php echo $pro_id; ?>"><?php echo $pro_name; ?></a></h6>
<span class="size">
<a style="color: #AF1D0D !important; text-decoration: underline;" href="products.php?type=<?php echo $type ?>">
<?php echo ucfirst($type_name); ?>  
</a>
</span>

<p ><em class="item_price"><?php echo number_format($pro_price); ?></em></p>
<a href="product_details.php?product=<?php echo $pro_id; ?>" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
</div>
</div>
</div>


<?php }} ?>
















</div>


<?php } ?>	


</div> <!--  Main Content Div-->
</div>





</div>
<?php include_once "footer.php"; ?>
