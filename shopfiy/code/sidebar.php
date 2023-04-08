<div class="col-md-3 product-agileinfo-grid" >
<div class="top-rates">
<br><h3>Top Rated products</h3>



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