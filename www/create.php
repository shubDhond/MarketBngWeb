<?php

require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseUser;

$currentUser = ParseUser::getCurrentUser();
$survey = new ParseObject("surveys");
$survey->set("userid", $currentUser->getObjectId());
$survey->save();

$_SESSION['survey'] = $survey->getObjectId();

include("assets/templates/header.php");
?>

<link href="assets/css/dropzone.css" type="text/css" rel="stylesheet" />
<script src="assets/js/dropzone.js"></script>


<br>
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Upload some pictures dawg</h4>
        </div>
        <div class="modal-body">
            <form action="upload.php" method="post" class="dropzone" id="my-awesome-dropzone">

            </form>
        </div>
    </div>
</div>

