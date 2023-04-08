<nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div" width="140px" heigh="140px">
                          <?php 

                          $image_query = "select image from users where id = '{$user_id}' ";
                          $result_image = $db->query($image_query);
                          $row = $result_image->fetch_assoc();
                          $image = $row['image'];

                           ?>
                            <img src="images/<?php echo $image ?>" width="140px" heigh="140px" class="img-circle" />

                           
                        </div>

                    </li>
                                      

                      <li>
                        <a class="<?= ($activePage == 'index') ? 'active-menu':''; ?>" href="index.php"><i class="fa fa-dashcube "></i>index</a>
                      </li>

                      

                      <li>
                        <a class="<?= ($activePage == 'post_job') ? 'active-menu':''; ?>" href="post_job.php"><i class="fa fa-dashcube "></i>Post Job</a>
                      </li>


                      <li>
                      <a class="<?= ($activePage == 'emp_jobs') ? 'active-menu':''; ?>" href="emp_jobs.php"><i class="fa fa-dashcube "></i>Your Jobs</a>
                      </li>




                      <li>
                      <a class="<?= ($activePage == 'job_req') ? 'active-menu':''; ?>" href="job_req.php"><i class="fa fa-dashcube "></i>Job Requests</a>
                      </li>



                      <li>
                        <a class="<?= ($activePage == 'emp_settings') ? 'active-menu':''; ?>" href="emp_settings.php"><i class="fa fa-dashcube "></i>Settings</a>
                      </li>


                      <li>
                      <a class="<?= ($activePage == 'front') ? 'active-menu':''; ?>" href="../index.php"><i class="fa fa-dashcube "></i>Front View</a>
                      </li>


                      <li>
                        <a class="<?= ($activePage == 'logout') ? 'active-menu':''; ?>" href="logout.php"><i class="fa fa-dashcube "></i>Logout</a>
                      </li>



                </ul>
            </div>

        </nav>