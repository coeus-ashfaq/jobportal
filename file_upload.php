<?php
/**
 * Created by PhpStorm.
 * User: coeus
 * Date: 7/17/18
 * Time: 12:05 PM
 */
//if (isset($_FILES["image"])){
//    $errors = array();
//
//    $file_name = $_FILES["image"]["name"];
//    $file_size = $_FILES["image"]["size"];
//    $file_temp = $_FILES["image"]["tmp_name"];
//    $file_type = $_FILES["image"]["type"];
//    $file_ext = strtolower(end(explode('.',$_FILES["image"]['name'])));
//
//    $expensions = array("jpeg","jpg","png");
//
//    if (in_array($file_ext,$expensions) === false){
//        $errors[] = "Extension not alowed, please choose JPEG, JPG or PNG extension file.";
//    }
//
//    if ($file_size > 2097152){
//        $errors[] = "Fle size must be Exactly 2 MB.";
//    }
//
//    if (empty($errors) == true){
//        if(move_uploaded_file($file_temp,"/images/".$file_name)){
//            echo "<br>Success <br>";
//        }
//        else{
//            echo "<br>Failure <br>";
//        }
//    }
//    else{
//        echo $errors;
//    }
//}


//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["file"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["file"]["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = 1;
//        echo "<br>".$target_file;
//        echo "<br>".$target_dir;
//        if (file_exists($target_file)) {
//            echo "Sorry, file already exists.";
//            $uploadOk = 0;
//        }
//        else{
//            echo "<br>New File";
//        }
//
//    } else {
//        echo "File is not an image.";
//        $uploadOk = 0;
//    }
//}



$target_dir = __DIR__ ."/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
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
        echo "<pre>";
        var_dump($output);
        exit();
//        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } catch(\Exception $e) {
        echo "<pre>";
        var_dump($e);
        exit();
//        echo "Sorry, there was an error uploading your file.";
    }
}}
?>
<html>
<body>

<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

