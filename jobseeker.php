<?php

if (!$session->is_logged_in()){
    header("Location:  login.php");
}
else{
    require_once ("job.php");
    ?>
    <nav class="navbar navbar-inverse navbar-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">COEUS JobPortal</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="job_applications.php">Applied Jobs</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><i class="fas white fa-sign-out-alt"></i> Logout</a></li>
            </ul>

        </div>
    </nav>

    <div class="container">

        <div class="job-container">
            <?php



            $result = Job::find_all();

            if($result){

                foreach($result as $job){

                    ?>
                    <div class="main-div">
                        <a class="del-btn btn btn btn-danger" onclick="delJob(<?php echo $job->id ?>)" >Delete</a>
                        <a class="edit-btn btn btn-success" onclick="editJob(<?php echo $job->id ?>)">Edit</a>
                        Company Name: <label><?php echo $job->company_name ?></label><br>
                        Industry Type: <label><?php echo $job->industry ?></label><br>
                        Designation: <label><?php echo $job->designation ?></label><br>
                        Offered Salary: <label><?php echo $job->offered_salary ?></label><br>
                        Required Experience: <label><?php echo $job->experience_required ?></label><br>
                        Job Shift: <label><?php echo $job->shift ?></label><br>
                        Job Type: <label><?php echo $job->job_type ?></label><br>
                        Positions: <label><?php echo $job->slots ?></label><br>
                    </div>

                    <br>
                    <?php
                }

            }

            ?>
        </div>


    </div>

    <?php


}

