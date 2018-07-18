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
                <li><a href="job_applications.php">Applied Jobs</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><i class="fas white fa-sign-out-alt"></i> Logout</a></li>
            </ul>

        </div>
    </nav>

    <div class="container">



    </div>

    <?php


}

