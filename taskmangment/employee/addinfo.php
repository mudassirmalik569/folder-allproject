<?php
include 'header.php'; 
?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<?php
include 'connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM tasks where id = '$id'";
$result = mysqli_query($link,$query);
$rs = mysqli_fetch_array($result);
?>

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Additional Info About Task</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <form action="addtaskinfo.php" method="POST">
<div class="form-group">
    <input type="hidden" name="id" class="style" value="<?php echo $rs['id']; ?>">
</div>
                                                            <div class="mb-3">
                                                                <label for="simpleinput" class="form-label">Daily Progress</label>
                                                                <input type="text" id="simpleinput" class="form-control" name="progress" value="<?php echo $rs['daily_progress']; ?>">
                                                            </div>
        
                                                            <div class="mb-3">
                                                                <label for="example-email" class="form-label">Status</label>
                                                                <input type="text" id="example-email" name="status" class="form-control" value="<?php echo $rs['status']; ?>">
                                                            </div>
        
                                                            <div class="mb-3">
                                                                <label for="example-password" class="form-label">Feedback</label>
                                                                <input type="text" id="example-password" class="form-control" name="feedback" value="<?php echo $rs['feedback']; ?>">
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                
                                                        </form>
                                                    </div> <!-- end col -->
                                                </div>
                                                <!-- end row-->                      
                                            </div> <!-- end preview-->
                                        </div> <!-- end tab-content-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

<?php
include 'footer.php'; 
?>
