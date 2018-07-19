<?php
/**
 * Created by PhpStorm.
 * User: ashfa
 * Date: 7/15/2018
 * Time: 5:42 PM
 */

//require_once ("database.php");
//require_once ("users.php");
require_once ("sessions.php");


if (!$session->is_logged_in()){

    header("Location:  login.php");
//    echo "Not Logged In";
}

?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | A job Of Your Desire</title>
    <meta name="author" content="Ashfaq Ahmad">
    <meta name="description" content="Assignment Project for the assessment of Php and MySQL Training">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

<div class="banner-main">

    <?php
    if ($session->is_logged_in()) {


        if (isset($session->type) and $session->type == 'employer'){

            include('employeer.php');
        }
        elseif (isset($session->type) and $session->type == 'applicant'){

            include('jobseeker.php');
        }
        else{
            include('logout.php');
        }

    }
    else{

        echo "<script> window.location.assign('login.php') </script>";
    }
    ?>

</div>


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="js/custom_script.js"></script> -->

<script>

    $("#submit").html("Add Job");
    $("#submit").val("");
    function editJob(key) {

        $.ajax({
            type:"POST",
            url: "job_edit.php",
            data: {edit: "true", ID: key},
            success: function(result){
                result = JSON.parse(result);
                debugger;

                $("#jobid").val(result["ID"]);
                $("#company").val(result["company_name"]);
                $("#industry").val(result["industry"]);
                $("#designation").val(result["designation"]);
                $("#experience").val(result["experience_required"]);
                $("#jobtype").val(result["job_type"]);
                $("#salary").val(result["offered_salary"]);
                $("#shift").val(result["shift"]);
                $("#positions").val(result["slots"]);
                $("#submit").html("Update");
                $("#submit").val("edit");


            }
        });
        $('#myModal').modal("show");

    }

    function delJob(key) {

        var check = confirm("Are You Sure, You want to Delete ?");

        if (check == true) {

            $.ajax({
                type:"POST",
                url: "del_job.php",
                data: {delete: "true", ID: key},
                success: function(result){
                    debugger;
                    window.location.assign("index.php");

                }
            });
        }

    }

    function applyJob(element,jobID,userID) {
        $.ajax({
            type:"POST",
            url: "apply_jobs.php",
            data: {job_id: jobID, user_id: userID},
            success: function(result){
                if(result){
                    debugger;
                    element.parentElement.innerHTML="Applied";
                    setTimeout(function(){
                        window.location.assign("index.php");
                    }, 2000);
                }


            }
        });
    }

</script>

</body>

</html>
