<?php

require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseException;

$currentUser = ParseUser::getCurrentUser();
$survey = new ParseObject("surveys");
$survey->set("userid", $currentUser->getObjectId());
$survey->set("logo_url", $currentUser->get("logo_url"));
$survey->save();

$_SESSION['survey'] = $survey->getObjectId();

include("assets/templates/header.php");
?>

<link href="assets/css/dropzone.css" type="text/css" rel="stylesheet" />
<script src="assets/js/dropzone.js"></script>


<br>
<div id="login-overlay" class="modal-dialog">
    <div class="well">
        <h3 class="title text-center">Upload your images here! </h3>
            <div class="form-group">
                <form action="upload.php" method="post" class="dropzone" id="my-awesome-dropzone">
                </form>
                <span class="help-block"></span>
            </div>

        <a href="survey.php?id=<?=$survey->getObjectId()?>" class="btn btn-theme btn-block">Done</a>
    </div>
</div>

