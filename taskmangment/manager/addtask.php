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
                                    <h4 class="page-title">Add new tasks</h4>
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
                                                        <form action="addnewtask.php" method="POST">
                                                            <div class="mb-3">
                                                                <label for="simpleinput" class="form-label">Task Name</label>
                                                                <input type="text" id="simpleinput" class="form-control" name="name">
                                                            </div>
        
                                                            <div class="mb-3">
                                                                <label for="example-email" class="form-label">Start Date</label>
                                                                <input type="text" id="example-email" name="startdate" class="form-control">
                                                            </div>
        
                                                            <div class="mb-3">
                                                                <label for="example-password" class="form-label">End Date</label>
                                                                <input type="text" id="example-password" class="form-control" name="enddate">
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
