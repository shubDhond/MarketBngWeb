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

$currentUser = ParseUser::getCurrentUser();
$survey = new ParseObject("surveys");
$survey->set("userid", $currentUser->getObjectId());

$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$path = "assets/"; // Upload directory
$count = 0;
$message = "";
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
    // Loop $_FILES to execute all files
    foreach ($_FILES['files']['name'] as $f => $name) {
        if ($count == 5){
            break;
        }
        if ($_FILES['files']['error'][$f] == 4) {
            continue; // Skip file if any error found
        }
        if ($_FILES['files']['error'][$f] == 0) {

            if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                $message = "$name is not a valid format";
                continue; // Skip invalid file formats
            }
            else{ // No error found! Move uploaded files
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)){
                    $count++; // Number of successfully uploaded file

                    try {
                        $localFilePath = "assets/".$name;
                        $file = ParseFile::createFromFile($path.$name, $name);
                        $survey->set("img".$count, $file);

                    } catch (ParseException $ex) {
                        // Execute any logic that should take place if the save fails.
                        // error is a ParseException object with an error code and message.
                        $message= 'Failed to create new object, with error message: ' . $ex->getMessage();
                    }

                }


            }
        }
    }
    $survey->save();
}



include("assets/templates/header.php");
?>

<br>
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"> <?=$message?>!</h4>
        </div>
        <div class="modal-body">
            <h1>Thanks dude</h1>
        </div>
    </div>
</div>

