<?php
include 'header.php';
?>

<div class="container">
		<div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-6" style="padding-top: 20px; margin-bottom: 20px;">

<div class="form-body" style="border: 1px solid #ccc; box-shadow: 2px 2px 12px #8591b9; padding: 40px 40px;">
<form action="addemploye.php" method="POST">
  <h2 style="color: #212529"><b>Add New Employee</b></h2><br>

  <div class="form-group">
    <label for="inputAddress">Full Name</label>
    <input type="text" class="form-control" id="inputAddress" name="name">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Contact</label>
      <input type="text" class="form-control" id="inputCity" name="contact">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">City</label>
      <input type="text" class="form-control" id="inputZip" name="city">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Email</label>
      <input type="text" class="form-control" id="inputCity" name="email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Password</label>
      <input type="text" class="form-control" id="inputZip" name="password">
    </div>
  </div>

  <button type="submit" class="btn btn-primary btn btn-block" style=" margin-top: 20px; ">Submit</button>
</form>
</div>

		</div>
	</div>
</div>


<?php
include 'footer.php';
?>

