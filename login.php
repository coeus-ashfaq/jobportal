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
//        die(var_dump(true));

        $found_user = User::authanticate($username,$password) ;
//        die(var_dump($found_user));

        if ($found_user){
            $session->login($found_user);
            header("Location:  index.php");
        } else{
            $message = "Username or Password is Incorrect";
        }
    } else{
        $username = "";
        $password = "";
    }
?>

    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Job Portal | A job Of Your Desire</title>
        <meta name="author" content="Ashfaq Ahmad">
        <meta name="description" content="Assignment Project for the assessment of Php and MySQL Training">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>

    <body>

    <div class="banner">

        <div class="form-box">
            <h1 class="login-heading"> Login </h1>

            <label class="log-error"><?php echo ($message)?></label>

            <form id="form" action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <span id="emaillabel" for="email"></span>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo htmlentities($username)?>" onchange="validateInput(this)">
                </div>

                <div class="form-group">
                    <span id="passwordlabel" for="password"></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo htmlentities($password)?>" onchange="validateInput(this)">
                </div>
                <a href="signup.php">Click here For Signup</a>
                <button id="submit" name="submit" type="submit" class="btn btn-primary">Login</button>

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