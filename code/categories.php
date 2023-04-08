<div class="latest-w3">
<div class="container">
<h3 class="tittle1">Top Categories</h3>
<div class="latest-grids">

<?php 

$cat = "SELECT * FROM categories";
$restult_cat = $db->query($cat);
$no_row = $restult_cat->num_rows;
if($no_row == 0){


}else{

while ($cat_rows = $restult_cat->fetch_assoc()) {

$cat_id = $cat_rows['cat_id'];
$cat_name = $cat_rows['cat_name'];
$cat_image = $cat_rows['cat_image'];

?>

<div class="col-md-4 latest-grid">
<div class="latest-top">
<a href="main_categories.php?sub=<?php echo $cat_id ?>">
<img  src="member/images/<?php echo $cat_image ?>" class="img-responsive" style="width: 100% !important;height: 240px !important">
</a>
<div class="latest-text">
<h4><?php echo $cat_name; ?></h4>
</div>
<div class="latest-text2 hvr-sweep-to-top">

<?php  

	$count  = "SELECT * FROM product WHERE cat_id = '{$cat_id}' ";
	$result_c = $db->query($count);
	$nums = $result_c->num_rows;

?>

<h4 title="No. of Items"><?php echo $nums; ?></h4>
</div>
</div>
</div>





<?php }} ?>










</div>
</div>