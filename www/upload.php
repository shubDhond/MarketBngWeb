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


$query = new ParseQuery("surveys");
$survey_id = $_SESSION['survey'];

$survey = $query->get($survey_id);

$i = 1;
while (($survey->get("img".$i)) != null){
    $i++;
}


//look for empty space

$ds          = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'assets/';   //2

if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    move_uploaded_file($tempFile,$targetFile); //6

    $file = ParseFile::createFromFile($targetFile, "img".$i);
    $file->save();

    //$survey->add("images", $file);
    $survey->set("img".$i, $file);
    $survey->save();

    unlink($targetFile);

}
?>
