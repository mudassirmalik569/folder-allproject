<div class="heder-bottom">
<div class="container">
<div class="logo-nav">
<div class="logo-nav-left">
<h1><a href="index.php">Shopify your products online </a></h1>
</div>
<div class="logo-nav-left1">
<nav class="navbar navbar-default">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header nav_2">
<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div> 
<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
<ul class="nav navbar-nav">

<li><a href="index.php" class="act">Home</a></li>



<?php 

$category = "SELECT * FROM categories";
$restult_ = $db->query($category);
$row_ = $restult_->num_rows;
if($row_ == 0){


}else{

while ($cat_rows = $restult_->fetch_assoc()) {

$cat_id = $cat_rows['cat_id'];
$cat_name = $cat_rows['cat_name'];


?>

<li><a href="main_categories.php?sub=<?php echo $cat_id; ?>"><?php echo $cat_name; ?></a></li>


<?php }} ?>

<li><a href="top_prod.php" class="act">Top</a></li>



</ul>
</div>
</nav>
</div>
<div class="logo-nav-right">
<ul class="cd-header-buttons">
<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
</ul> <!-- cd-header-buttons -->
<div id="cd-search" class="cd-search">
<form action="products.php" method="post">
<input name="search" type="search" placeholder="Search..." required>

<input type="submit" name="sub" style="display: none">

</form>


</div>	
</div>



<div class="header-right2">
<div class="cart box_1">



<?php   
if(!empty($_SESSION["shopping_cart"])){  
$arr_count = count($_SESSION["shopping_cart"]);
?>

<a href="cart.php">
<h3 style="font-size: 24px !important"> <div class="total">
<span class=""></span> (<span id="simpleCart_quantity" class=""><?php echo number_format($arr_count); ?></span> items)</div>
<img src="images/bag.png" />
</h3>
</a>
<div class="clearfix"> </div>		






<?php
}else{

?>


<a href="cart.php">
<h3 style="font-size: 24px !important"> <div class="total">
<span class=""></span> (<span id="simpleCart_quantity" class="">0</span> items)</div>
<img src="images/bag.png" />
</h3>
</a>
<div class="clearfix"> </div>		


<?php
}
?>










</div>
</div>




<div class="clearfix"> </div>
</div>
</div>
</div>