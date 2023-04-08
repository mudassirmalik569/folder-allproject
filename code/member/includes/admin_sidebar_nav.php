<nav  class="navbar-default navbar-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav" id="main-menu">
<li>

</li>


<li>
<a class="<?= ($activePage == 'index') ? 'active-menu':''; ?>" href="index.php"><i class="fa fa-dashcube "></i>Home</a>
</li>



<li>
<a class="<?= ($activePage == 'mange_types') ? 'active-menu':''; ?>" href="mange_types.php"><i class="fa fa-dashcube "></i>Manage Types</a>
</li>

<li>
<a class="<?= ($activePage == 'admin_add_cat') ? 'active-menu':''; ?>" href="admin_add_cat.php"><i class="fa fa-dashcube "></i>Add Category</a>
</li>

<li>
<a class="<?= ($activePage == 'admin_sub_cat') ? 'active-menu':''; ?>" href="admin_sub_cat.php"><i class="fa fa-dashcube "></i>Sub Category</a>
</li>



<li>
<a class="<?= ($activePage == 'admin_product') ? 'active-menu':''; ?>" href="admin_product.php"><i class="fa fa-dashcube "></i>Add Product</a>
</li>
<li>
<a class="<?= ($activePage == 'admin_view_product') ? 'active-menu':''; ?>" href="admin_view_product.php"><i class="fa fa-dashcube "></i>View Products</a>
</li>

<li>
<a class="<?= ($activePage == 'admin_order') ? 'active-menu':''; ?>" href="admin_order.php"><i class="fa fa-dashcube "></i>All Orders</a>
</li>









<?php 

if(isset($_GET['view'])){
$view = $_GET['view'];
?>

<li>
<a class="<?= ($activePage == 'admin_product_view') ? 'active-menu':''; ?>" href="admin_product_view.php?view=<?php echo $view ?>"><i class="fa fa-dashcube "></i>Product Detail</a>
</li>

<?php
}

?> 




<li>
<a class="<?= ($activePage == 'feedback') ? 'active-menu':''; ?>" href="feedback.php"><i class="fa fa-dashcube "></i>Feedback</a>
</li>


<li>
<a class="<?= ($activePage == 'admin_settings') ? 'active-menu':''; ?>" href="admin_settings.php"><i class="fa fa-dashcube "></i>Settings</a>
</li>




<?php 

if(isset($_GET['edit_user'])){
$view = $_GET['edit_user'];
?>

<li>
<a class="<?= ($activePage == 'admin_edit') ? 'active-menu':''; ?>" href="admin_edit.php?edit_user=<?php echo $view ?>"><i class="fa fa-dashcube "></i>Edit User</a>
</li>

<?php
}

?> 



<li><a href="../index.php"><i class="fa fa-dashcube "></i>Front</a></li>

<li><a href="report.php"><i class="fa fa-dashcube "></i>Generate Reports</a></li>


<li>
<a class="<?= ($activePage == 'logout') ? 'active-menu':''; ?>" href="logout.php"><i class="fa fa-dashcube "></i>Logout</a>
</li>


</ul>
</div>

</nav>