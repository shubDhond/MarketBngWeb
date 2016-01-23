<?php

require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseFile;

$error_msg = "";
$target_dir = "assets/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $error_msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $error_msg = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $error_msg = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $error_msg = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $error_msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error_msg = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $error_msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $error_msg = "Sorry, there was an error uploading your file.";
    }
}

$localFilePath = "assets/".basename( $_FILES["fileToUpload"]["name"]);
$file = ParseFile::createFromFile($localFilePath, basename( $_FILES["fileToUpload"]["name"]));
$file->save();

$currentUser = ParseUser::getCurrentUser();

$survey = new ParseObject("surveys");

try {
    $survey->set("userid", $currentUser->getObjectId());
    $survey->set("img", $file);
    $survey->save();

} catch (ParseException $ex) {
    // Execute any logic that should take place if the save fails.
    // error is a ParseException object with an error code and message.
    echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}

include("assets/templates/header.php");
?>

<br>
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"> <?=$error_msg?>!</h4>
        </div>
        <div class="modal-body">
            <h1>Thanks dude</h1>
        </div>
    </div>
</div>

