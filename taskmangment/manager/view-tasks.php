<?php
include 'header.php'; 
?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Tasks</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <?php
    include 'connect.php';
    $query = "SELECT * FROM tasks";
    $result = mysqli_query($link,$query);
    $no_of_rows = mysqli_num_rows($result);
    ?>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">Tasks Assigned</h4>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="striped-rows-preview">
                                                <div class="table-responsive-sm">
                                                    <table class="table table-striped table-centered mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr No</th>
                                                                <th>Task Name</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Daily Progress of employee</th>
                                                                <th>Status by employee</th>
                                                                <th>Feedback by employee</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
    <?php
    for ($check_variable=1; $check_variable<=$no_of_rows ; $check_variable++) { 
    $rs = mysqli_fetch_array($result);
    ?>
    <tr>
        <td><?php echo $check_variable; ?></td>
        <td><?php echo $rs['task_name']; ?></td>
        <td><?php echo $rs['start_date']; ?></td>
        <td><?php echo $rs['end_date']; ?></td>
        <td><?php echo $rs['daily_progress']; ?></td>
        <td><?php echo $rs['status']; ?></td>
        <td><?php echo $rs['feedback']; ?></td>
    </tr>
    <?php
    }
    ?>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive-->                     
                                            </div> <!-- end preview-->
                    </div> <!-- container -->

                </div> <!-- content -->

<?php
include 'footer.php'; 
?>
