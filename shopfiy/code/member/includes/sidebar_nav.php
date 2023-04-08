<nav  class="navbar-default navbar-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav" id="main-menu">




<li>
<a class="<?= ($activePage == 'index') ? 'active-menu':''; ?>" href="index.php"><i class="fa fa-dashcube "></i>Home</a>
</li>


<li>
<a class="<?= ($activePage == 'add_product') ? 'active-menu':''; ?>" href="customer_product.php"><i class="fa fa-dashcube "></i>Add Products</a>
</li>


<li>
<a class="<?= ($activePage == 'view_product') ? 'active-menu':''; ?>" href="customer_view_product.php"><i class="fa fa-dashcube "></i>Manage Products</a>
</li>



<li>
<a class="<?= ($activePage == 'user_orders') ? 'active-menu':''; ?>" href="user_orders.php"><i class="fa fa-dashcube "></i>Your Orders</a>
</li>


<?php 

if(isset($_GET['view'])){
$view = $_GET['view'];
?>

<li>
<a class="<?= ($activePage == 'user_view_product') ? 'active-menu':''; ?>" href="user_view_product.php?view=<?php echo $view ?>"><i class="fa fa-dashcube "></i>Product Detail</a>
</li>

<?php
}

?> 


<li>
<a class="<?= ($activePage == 'log_history') ? 'active-menu':''; ?>" href="log_history.php"><i class="fa fa-dashcube "></i>Notice</a>
</li>


<li>
<a class="<?= ($activePage == 'u_feedback') ? 'active-menu':''; ?>" href="u_feedback.php"><i class="fa fa-dashcube "></i>Feedback</a>
</li>


<li>
<a class="<?= ($activePage == 'main_page') ? 'active-menu':''; ?>" href="../index.php"><i class="fa fa-dashcube "></i>Front</a>
</li>


<li>
<a class="<?= ($activePage == 'settings') ? 'active-menu':''; ?>" href="settings.php"><i class="fa fa-dashcube "></i>Settings</a>
</li>


<li>
<a class="<?= ($activePage == 'logout') ? 'active-menu':''; ?>" href="logout.php"><i class="fa fa-dashcube "></i>Logout</a>
</li>



</ul>
</div>

</nav>