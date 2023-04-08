<!DOCTYPE html>
<html>
<body>

<h1>The pdf reader</h1>

<form action="{{url('store')}}" method="post" enctype="multipart/form-data">
@csrf
  <label for="fname">PDf file</label>
  <input type="file" id="file" name="file"><br><br>

  <input type="submit" value="Submit">
</form>

</body>
</html>
