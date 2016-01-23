<?PHP
require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseUser;
ParseUser::logOut();

session_destroy();
header ("Location: index.php");
?>