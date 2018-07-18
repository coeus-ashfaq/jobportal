
<?php

if (!$session->is_logged_in()){
    header("Location:  login.php");

}
else{

    ?>
    <nav class="navbar navbar-inverse navbar-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">COEUS JobPortal</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Dashboard</a></li>
                <li><a href="job_applications.php">Received Applications</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="logout.php">
                        <i class="fas white fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

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

                        <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
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

    </div>

    <?php

}

