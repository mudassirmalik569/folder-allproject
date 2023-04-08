<?php
try {
  include_once "includes/connect.php";
   session_start();
   ob_start();

   
   $user_id = $_SESSION['id'];
   $user_name = $_SESSION['name'];
   $user_email = $_SESSION['email'];
   $user_role = $_SESSION['role'];
   $user_number = $_SESSION['contact'];




} catch (Exception $e) {
  $error = $e->getMessage();
}

if(isset($error)){
  echo $error;
} // checking for connection

?>

<?php include_once "includes/header.php"; ?>
<?php if($user_role == 'admin') { ?>





    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/admin_sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Admin Page</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                
                        






<form class="w3-container" action="" method="post">

<div class="form-group">
<label style="color:black" class="w3-label" for="search">Search:</label>
<input class="w3-input w3-border w3-animate-input" class="form-control" type="email" name="search" id="search" placeholder="e.g admin@yahoo.com" style="width:60%" autocomplete="off" required>
</div>

    <button style="display:none" type="submit" name="submit"></button>


</form>
 



 <?php

    if(!isset($_POST['submit'])){

        ?>




        <table class="table table-bordered table-responsive">
            <thead class='bg-primary'>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Phone</th>
                
                <th class="text-center">Area</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Role</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>


            </tr>
            </thead>

            <tbody>
            <?php

            $user_query = "SELECT * FROM users WHERE role != 'admin' ORDER BY id LIMIT 15 ";
            if($db->error){
                echo $error = $db->error;
            }else{

                $result_user = $db->query($user_query);
                $counter = 0;
                while($row = $result_user->fetch_assoc()){
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['contact'];
                      $area = $row['functional_area'];
                      $gender = $row['gender'];
                        
                    $role = $row['role'];
                    $counter = $counter + 1;
                    ?>

                    <tr class="text-center">

                        <td><?php echo $counter ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $email ?></td>
                        <td><?php echo $phone ?></td>
                        <td><?php echo $area ?></td>
                        <td><?php echo $gender ?></td>
                        <td><?php echo $role ?></td>
                        
                        <td><a  class="btn btn-success btn-block" href="admin_edit.php?edit=<?php echo $id ?>">Edit</a></td>
                        <td><a  class="btn btn-danger btn-block" href="index.php?del=<?php echo $id ?>">Delete</a></td>


                    </tr>


                    <?php
                }
            }

            ?>


            </tbody>
        </table>


    <?php }elseif(isset($_POST['submit'])){

        $search = $_POST['search'];
        $search = $db->real_escape_string($search);



        $sql = "SELECT * FROM users WHERE email = '{$search}' AND role != 'admin' ";
        $result = $db->query($sql);
        $num_rows = $result->num_rows;
        if($num_rows <= 0){
            echo "No Record Found.";
        }else{ ?>


            <table class="table table-bordered table-responsive">
                <thead class='bg-primary'>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
<th class="text-center">Area</th>
<th class="text-center">Gender</th>
                    <th class="text-center">Role</th>
                    
                    <th class="text-center">Edit</th>
                    
                    <th class="text-center">Delete</th>

                </tr>
                </thead>

                <tbody>
                <?php
                $search = $_POST['search'];
                $user_query = "SELECT * FROM users WHERE email = '{$search}' ";
                if($db->error){
                    echo $error = $db->error;
                }else{

                    $result_user = $db->query($user_query);
                    $counter = 0;
                    while($row = $result_user->fetch_assoc()){
                        $id = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['contact'];
                        $area = $row['functional_area'];
                        $gender = $row['gender'];
                        $role = $row['role'];
                        $counter = $counter + 1;
                        ?>

                        <tr class="text-center">

                            <td><?php echo $counter ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $phone ?></td>
                            <td><?php echo $area ?></td>
                            <td><?php echo $gender ?></td>
                            <td><?php echo $role ?></td>

                            
                            <td><a  class="btn btn-success btn-block" href="admin_edit.php?edit=<?php echo $id ?>">Edit</a></td>
                            
                            <td><a  class="btn btn-danger btn-block" href="index.php?del=<?php echo $id ?>">Delete</a></td>


                        </tr>


                        <?php
                    }
                }

                ?>


                </tbody>
            </table>





        <?php } // else of line 167



    }


    ?>



           <?php

           if(isset($_GET['del'])){
               $del_id = $_GET['del'];
               $del_query = "DELETE FROM users WHERE id = '{$del_id}'";
               $result_del = $db->query($del_query);
               if($result_del){
                   header("Location: index.php");
               }else{
                  die(mysqli_error($db));
               }
           }


           ?>









                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



    <?php include_once "includes/footer.php"; ?>


<?php }elseif($user_role == 'job seeker'){   ?>




    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/job_seeker_sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Job Seeker</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                
                   

                        <?php

                        // fetching user record from database

                        $sql = "SELECT * FROM users WHERE id = '{$user_id }'";
                        if($db->error){
                            $error = $db->error;
                            echo $error;
                        }

                        $result = $db->query($sql);
                        while($row = $result->fetch_assoc()){


                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['contact'];
                        $image = $row['image'];
                        $area = $row['functional_area'];
                        $gender = $row['gender'];
                        $role = $row['role'];
                            
                            
                            


                            ?>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="images/<?php echo $image ?>" alt="user DP" width="200px" height="200px" class="img-circle w3-card-4">
                                    </div>

                                    <div class="col-sm-8">
                                        <ul class="w3-ul w3-card-4" style="margin-top:0px">


            <li><span style="font-weight:bold">Name : </span><?php echo $name ?></li>
            <li><span style="font-weight:bold">Email : </span><?php echo $email ?></li>
            <li><span style="font-weight:bold">Phone : </span><?php echo $phone ?></li>
            <li><span style="font-weight:bold">Area : </span><?php echo $area ?></li>
            <li><span style="font-weight:bold">Gender : </span><?php echo $gender ?></li>
            <li><span style="font-weight:bold">Role : </span><?php echo $role ?></li>


                                            <br>

                                        </ul>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="settings.php"><button type="button" style="margin-left:25px" name="button" class="btn btn-warning">Change Settings</button></a>
                                    </div>
                                </div>
                                <br>

                            </div>





                            <?php }// end of while loop ?>





                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



    <?php include_once "includes/footer.php"; ?>


<?php }elseif($user_role == 'employeer'){  ?>




    <div id="wrapper">
    <?php include_once "includes/top_navbar.php"; ?>
    <?php include_once "includes/employeer_sidebar_nav.php"; ?>     
        
        
        
        
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">employeer</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                          <?php

                        // fetching user record from database

                        $sql = "SELECT * FROM users WHERE id = '{$user_id }'";
                        if($db->error){
                            $error = $db->error;
                            echo $error;
                        }

                        $result = $db->query($sql);
                        while($row = $result->fetch_assoc()){


                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['contact'];
                        $image = $row['image'];
                        $area = $row['functional_area'];
                        $gender = $row['gender'];
                        $role = $row['role'];
                            
                            
                            


                            ?>

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="images/<?php echo $image ?>" alt="user DP" width="200px" height="200px" class="img-circle w3-card-4">
                                    </div>

                                    <div class="col-sm-8">
                                        <ul class="w3-ul w3-card-4" style="margin-top:0px">


            <li><span style="font-weight:bold">Name : </span><?php echo $name ?></li>
            <li><span style="font-weight:bold">Email : </span><?php echo $email ?></li>
            <li><span style="font-weight:bold">Phone : </span><?php echo $phone ?></li>
            <li><span style="font-weight:bold">Area : </span><?php echo $area ?></li>
            <li><span style="font-weight:bold">Gender : </span><?php echo $gender ?></li>
            <li><span style="font-weight:bold">Role : </span><?php echo $role ?></li>


                                            <br>

                                        </ul>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="emp_settings.php"><button type="button" style="margin-left:25px" name="button" class="btn btn-warning">Change Settings</button></a>
                                    </div>
                                </div>
                                <br>

                            </div>





                            <?php }// end of while loop ?>


                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



    <?php include_once "includes/footer.php"; ?>

<?php }else{ header("location:logout.php"); } ?>