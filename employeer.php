
<?php

if (!$session->is_logged_in()){
    header("Location:  login.php");

}
else{
    require_once ("job.php");

    if (isset($_POST["submit"])){
        $job = new Job();

        $job->company_name = (trim($_POST["company"]));
        $job->industry = (trim($_POST["industry"]));
        $job->designation = (trim($_POST["designation"]));
        $job->offered_salary = (trim($_POST["salary"]));
        $job->experience_required = (trim($_POST["experience"]));
        $job->shift = (trim($_POST["shift"]));

        $job->job_type = (trim($_POST["jobtype"]));
        $job->slots = (trim($_POST["positions"]));
        $job->user_id = ($session->user_id);


        if ($job::create($job)){


            header("Location:  index.php");
        }


    }

    require_once ("header.php");
    ?>


    <div class="container">

        <!-- Trigger the modal with a button -->
        <a type="button" class="new-button btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">+ Add New Job</a>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Add New Job</h4>
                    </div>
                    <div class="modal-body">

                        <form id="form" method="post" enctype="multipart/form-data">
                            <input type="text" id="jobid" name="jobid" hidden>
                            <div class="form-group">
                                <span id="companylabel" for="company"></span>
                                <input type="text" class="form-control" id="company" name="company" aria-describedby="emailHelp" placeholder="Enter Company Name" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="industrylabel" for="industry"></span>
                                <input type="text" class="form-control" id="industry" name="industry" aria-describedby="emailHelp" placeholder="Enter Industry Name" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="designationlabel" for="designation"></span>
                                <input type="text" class="form-control" id="designation" name="designation" aria-describedby="emailHelp" placeholder="Enter Designation" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="salarylabel" for="salary"></span>
                                <input type="text" class="form-control" id="salary" name="salary" aria-describedby="emailHelp" placeholder="Enter Salary Offer" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="experiencelabel" for="experience"></span>
                                <input type="text" class="form-control" id="experience" name="experience" aria-describedby="emailHelp" placeholder="Enter Required Experience" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="shiftlabel" for="shift"></span>
                                <input type="text" class="form-control" id="shift" name="shift" aria-describedby="emailHelp" placeholder="Enter Job Shift   e.g. Day/Evening/Night" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="jobtypelabel" for="jobtype"></span>
                                <input type="text" class="form-control" id="jobtype" name="jobtype" aria-describedby="emailHelp" placeholder="Enter Job Type   e.g. Permanent/Cotractual" onchange="validateInput(this)">
                            </div>

                            <div class="form-group">
                                <span id="positionslabel" for="positions"></span>
                                <input type="text" class="form-control" id="positions" name="positions" aria-describedby="emailHelp" placeholder="Enter # of Positions" onchange="validateInput(this)">
                            </div>

                            <button id="submit" name="submit" type="submit" class="btn btn-primary">Add Job</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="job-container">
            <?php


            $result = Job::find_by_sql("SELECT * FROM `job` WHERE `user_id`='$session->user_id' ORDER BY `ID` DESC");


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

