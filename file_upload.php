<?php
require_once ("users.php");
require_once ("sessions.php");
require_once ("database.php");


$target_dir = __DIR__ ."/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) and $session->is_logged_in()) {


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
    if (!in_array($imageFileType, ['jpg','jpeg','png','gif'])){
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    try {
        $output = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            $user = User::find_by_id($session->user_id);
            $name=$_FILES['fileToUpload']['name'];
            $database->query("UPDATE user set picture = '$name' where id = $session->user_id");
            header("Location: profile.php");

//        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    } catch(\Exception $e) {
        echo "<pre>";
        var_dump($e);
        exit();
//        echo "Sorry, there was an error uploading your file.";
    }
}
}
else{
    header("Location: profile.php");
}
?>
<html>
<body>



</body>
</html>

