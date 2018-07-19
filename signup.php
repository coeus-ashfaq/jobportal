<?php

require_once ("sessions.php");
require_once ("database.php");
require_once ("users.php");


if ($session->is_logged_in()){

    header("Location:  index.php");
}

if (isset($_POST["submit"])){
    $username = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $found_user = User::authanticate($username,$password) ;

    if ($found_user){
        $message = "User Already Registered with this Email";
    } else{

        $user = new User();

        $user->email = (trim($_POST["email"]));
        $user->first_name = (trim($_POST["fname"]));
        $user->last_name = (trim($_POST["lname"]));
        $user->type = (trim($_POST["usertype"]));
        $user->password = (trim($_POST["password"]));
//        die(var_dump($user));

        if ($user::create($user)){

            header("Location:  index.php");
        }

    }
} else{
    $username = "";
    $password = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Job Portal | A job Of Your Desire</title>
    <meta name="author" content="Ashfaq Ahmad">
    <meta name="description" content="Assignment Project for the assessment of Php and MySQL Training">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

<div class="banner">

    <div class="form-box">

        <h1 class="login-heading"> Sign Up </h1>
        <label class="log-error"><?php echo ($message)?></label>
        <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

            <div class="form-group">
                <span id="emaillabel" for="email"></span>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" onchange="validateInput(this)">
            </div>

            <div class="form-group">
                <span id="fnamelabel" for="fname"></span>
                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp" placeholder="Enter First Name" onchange="validateInput(this)">
            </div>

            <div class="form-group">
                <span id="lnamelabel" for="lname"></span>
                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp" placeholder="Enter Last Name" onchange="validateInput(this)">
            </div>

            <div class="form-group">
                <label class="radio-inline"><input type="radio" name="usertype" value="applicant">Job Seeker</label>
                <label class="radio-inline"><input type="radio"  name="usertype" value="employer">Employeer</label>
            </div>
            <div class="form-group">
                <span id="passwordlabel" for="password"></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" onchange="validateInput(this)">
            </div>

            <div class="form-group">
                <span id="repasswordlabel" for="re_password"></span>
                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Confirm Password" onchange="validateInput(this)">
                <label id="okpasswordlabel" for="re_password">* Password and Confirm Password didn't match</label>

            </div>
            <a href="login.php">Click for Login If Already Signed Up!</a>
            <button id="submit" name="submit" type="submit" class="btn btn-primary">Signup</button>

        </form>

    </div>

</div>


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom_script.js"></script>

</body>
</html>

<?php
if (isset($database)){
$database->close_connection();
}