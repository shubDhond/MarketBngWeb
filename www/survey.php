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
$survey_id = $_GET['id'];

$query = new ParseQuery("surveys");
$survey = $query->get($survey_id);

if ($survey->get("userid") != $currentUser->getObjectId()){
    header("Location: index.php");
}

?>

<?php include("assets/templates/header.php"); ?>

<br>
<div id="login-overlay" class="modal-dialog">
    <div class="well">
        <h3 class="title text-center">Survey id: <?=$survey->getObjectId()?> </h3>
        <h4 class="title text-center">Created by: <?=$currentUser->get("name")?></h4>
        <div class="form-group">
            <form action="upload.php" method="post" class="dropzone" id="my-awesome-dropzone">
            </form>
            <span class="help-block"></span>
        </div>

    </div>
</div>
