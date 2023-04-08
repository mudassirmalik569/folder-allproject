<?php
include 'header.php';
?>

                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Employees</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="main.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Employees</li>
                        </ol>

    <?php
    include 'connect.php';
    $query = "SELECT * FROM employe";
    $result = mysqli_query($link,$query);
    $no_of_rows = mysqli_num_rows($result);
    ?>
    

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Employees Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Full Name</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th colspan="2">Actions</th>
                                            </tr>
                                        </thead>
    <?php
    for ($check_variable=1; $check_variable<=$no_of_rows ; $check_variable++) { 
    $rs = mysqli_fetch_array($result);
    ?>
    <tr>
        <td><?php echo $check_variable; ?></td>
        <td><?php echo $rs['fullname']; ?></td>
        <td><?php echo $rs['contact']; ?></td>
        <td><?php echo $rs['city']; ?></td>
        <td><?php echo $rs['email']; ?></td>
        <td><?php echo $rs['password']; ?></td>
        <td><button class="btn btn-primary"><a style="color: #fff; text-decoration: none;" href="editemploye.php?id=<?php echo $rs['id']; ?>">edit</a></button></td>
        <td><button class="btn btn-danger"><a style="color: #fff; text-decoration: none;" href="deleteemploye.php?id=<?php echo $rs['id']; ?>">delete</a></button></td>
    </tr>
    <?php
    }
    ?>
                                    </table>
                                </div>
                        </div>
                    </div>
                </main>
                


                <?php
                include 'footer.php';
                ?>