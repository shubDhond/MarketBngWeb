<?php

require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;

/*
$currentUser = ParseUser::getCurrentUser();

$survey = new ParseObject("surveys");


try {
    $survey->set("userid", $currentUser->getObjectId());
    $survey->save();

} catch (ParseException $ex) {
    // Execute any logic that should take place if the save fails.
    // error is a ParseException object with an error code and message.
    echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}
*/
include("assets/templates/header.php");
?>


<br>
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Upload some pictures dawg</h4>
        </div>
        <div class="modal-body">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </div>
</div>

