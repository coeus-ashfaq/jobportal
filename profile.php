<?php
require_once ("sessions.php");
require_once ("database.php");
require_once ("users.php");

$target_dir = __DIR__ ."/upload/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["picture_submit"]) and $session->is_logged_in()) {

    $picture_error = "";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
        $picture_error .= "File is not an Actual image.";
        $uploadOk = 0;
    }


// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $picture_error .= "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if (!in_array($imageFileType, ['jpg','JPG','jpeg','png','gif'])){
        $picture_error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $picture_error .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        try {
            $output = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            $user = User::find_by_id($session->user_id);
            $name=$_FILES['fileToUpload']['name'];
            $database->query("UPDATE user set picture = '$name' where id = $session->user_id");

        } catch(\Exception $e) {

            $picture_error .= "Sorry, there was an error uploading your file.";
        }
    }
}




if ($session->is_logged_in()) {


    if (isset($session->type) and $session->type == 'employer') {

        ?>
        <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Portal | A job Of Your Desire</title>
        <meta name="author" content="Ashfaq Ahmad">
        <meta name="description" content="Assignment Project for the assessment of Php and MySQL Training">

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css"
              href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

    </head>
    <?php require_once ("header.php"); ?>
    <div class="container profile-div">



        <h1 class="login-heading"> Personel Information </h1>
        <?php

        $user = User::find_by_id($session->user_id);

        if ($user) { // if user exists


        ?>
        <div class="col-sm-2">

            <?php
            echo $picture_error;

                if ($user->picture){
                    ?>
                    <img src="upload/images/<?php echo $user->picture ?>" class="img-responsive img-thumbnail">
                    <?php
                } else{
                    ?>
                    <img src="upload/images/profile.png" class="img-responsive img-thumbnail">
                <?php
                    }

                ?>

            <form method="post" enctype="multipart/form-data">
                <br>
                Change Profile Picture:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br>
                <input type="submit" class="btn btn-primary" value="Upload Image" name="picture_submit">
            </form>
        </div>
        <form id="form" method="post" enctype="multipart/form-data">


                <div class="col-sm-10">


                    <div class="col-sm-6  form-group">
                        <span id="fnamelabel" for="fname"></span>
                        <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp"
                               placeholder="Enter First Name" value="<?php echo $user->first_name ?>"
                               onchange="validateInput(this)">
                    </div>

                    <div class="col-sm-6 form-group">
                        <span id="lnamelabel" for="lname"></span>
                        <input type="text" class="form-control" id="lname" name="lname" aria-describedby="emailHelp"
                               placeholder="Enter Last Name" value="<?php echo $user->last_name ?>"
                               onchange="validateInput(this)">
                    </div>


                    <div class="col-sm-4 form-group">
                        <span id="emaillabel" for="email"></span>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                               placeholder="Enter email" value="<?php echo $user->email ?>" onchange="validateInput(this)"
                               disabled>
                    </div>

                    <div class="col-sm-4 form-group">
                        <span id="passwordlabel" for="password"></span>
                        <input type="text" class="form-control" id="dob" name="dob"
                               placeholder="Enter Date Of Birth" value="<?php echo $user->dob ?>"
                               onchange="validateInput(this)">
                    </div>

                    <div class="col-sm-4 form-group">
                        <span id="repasswordlabel" for="re_password"></span>
                        <input type="text" class="form-control" id="age" name="age"
                               placeholder="Enter Age in Years" value="<?php echo $user->age ?>"
                               onchange="validateInput(this)">

                    </div>

                    <div class="col-sm-4 form-group">
                        <span id="passwordlabel" for="password"></span>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter Phone #" value="<?php echo $user->phone ?>"
                               onchange="validateInput(this)">
                    </div>

                    <div class="col-sm-8 form-group">
                        <span id="addresslabel" for="re_password"></span>
                        <textarea class="form-control" id="address" name="address"
                                  placeholder="Enter You Address" rows="5">
                                <?php if ($user->address != null) {
                                    echo $user->address;
                                }
                                ?>
                            </textarea>

                    </div>
                </div>

                <button id="submit" name="submit" type="submit" class="btn btn-primary" value="personnel">Save Changes
                </button>

                <?php
            }

            if (isset($database)) {
                $database->close_connection();
            }

            ?>

        </form>


    </div>


        <?php

        if (isset($_POST["submit"])){


            User::find_by_id($session->user_id) ;
//            die(var_dump($user));

            if ($user){

                $user->dob = (trim($_POST["dob"]));
                $user->first_name = (trim($_POST["fname"]));
                $user->last_name = (trim($_POST["lname"]));
                $user->age = (trim($_POST["age"]));
                $user->phone = (trim($_POST["phone"]));
                $user->address = (trim($_POST["address"]));

//                            die(var_dump($user));

                if (User::save($user)){

                    header("Location:  profile.php");
                }

            }
        }

    } elseif (isset($session->type) and $session->type == 'applicant') {

        echo "Applicant Profile";

    } else {
        require_once('logout.php');
    }

}
else{

    echo "<script> window.location.assign('login.php') </script>";
}



