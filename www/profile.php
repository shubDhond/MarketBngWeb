<?php
require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseUser;
use Parse\ParseObject;
use Parse\ParseQuery;
$currentUser = ParseUser::getCurrentUser();

$query = new ParseQuery("surveys");
$query->equalTo("userid", $currentUser->getObjectId());

$results = $query->find();



include("assets/templates/header.php");
?>

<br>
<div id="login-overlay" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel"> Your surveys</h4>
        </div>
        <div class="modal-body">
            <?php
                for ($i = 0; $i < count($results); $i++) {
                    $object = $results[$i];
                    echo "Survey id: " . $object->getObjectId() . '<br>';
                }
            ?>
        </div>
    </div>
</div>




