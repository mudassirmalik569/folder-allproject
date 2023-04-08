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

	

<div class="new-arrivals-w3agile">
<div class="container">
<h2 class="tittle" title="All Products From Top to Oldest">ALL Top Products</h2>
<div class="arrivals-grids">




<?php 

$top_query = "SELECT * FROM product ORDER BY pro_view DESC ";
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

<div class="col-md-4 arrival-grid simpleCart_shelfItem">

<div class="grid-arr">
<div  class="grid-arrival">
<figure>		
<a href="product_details.php?product=<?php echo $pro_id; ?>" class="new-gri" data-toggle="modal">
<div class="grid-img">
<img  src="member/images/<?php echo $pro_image; ?>" style="width: 100% !important;height: 300px !important" class="img-responsive" alt="">
</div>
<div class="grid-img">
<img  src="member/images/<?php echo $pro_image_side; ?>" style="width: 100% !important;height: 300px !important" class="img-responsive" alt="">
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


<div class="clearfix"></div>
</div>
</div>
</div>



</div> <!--  Main Content Div-->
</div>





</div>
<?php include_once "footer.php"; ?>
