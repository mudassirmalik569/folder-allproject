<div class="header-top">
<div class="container">
<div class="top-left">
<a href="#"> </a>
</div>
<div class="top-right">
<ul>

<?php if(isset($user_id)){

?>

<li><a href="member/index.php">Backend</a></li>

<li><a href="member/logout.php">Logout</a></li>

<?php }else{ ?>



<li><a href="login.php">Login</a></li>
<li><a href="register.php"> Create Account </a></li>


<?php } ?>



</ul>
</div>
<div class="clearfix"></div>
</div>
</div>