<?php
require 'vendor/autoload.php';
use Parse\ParseClient;
use Parse\ParseUser;
use Parse\ParseQuery;

session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');




//This variable needs to be declared outside of the if block so that it is not undefined when people initially load the login page.
$errorMessage = "";
/*if page is accessed after attempt */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $email = strtolower($email);
    $pass = $_POST['pass'];
    
    /* strip of any sketchy characters */
    $email = htmlspecialchars($email);
    $pass = htmlspecialchars($pass);
    
    try {
      $user = ParseUser::logIn($email, $pass);
        if (!$user->get("corporate")) {
            ParseUser::logOut();
            session_destroy();
            $errorMessage = "Sorry please create a Corporate Account to access this Portal.";
        } else {
            $_SESSION['login'] = "1";
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $user->getObjectId();
            header ("Location: index.php");   // redirect
        }

    } catch (ParseException $error) {
      $errorMessage = "Incorrect email or password!"; 
    }
}
?>
<?php include("assets/templates/header.php"); ?>
<br>
<br>
<br>
<br>
    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                          <form action="login.php" method="post" class="intro text-center">
                              <div class="form-group">
                                  <label for="username" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" value="" required title="Please enter your email" placeholder="example@gmail.com">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="pass" value="" required title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-theme btn-block">Login</button>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register</p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> Create ideas!</li>
                          <li><span class="fa fa-check text-success"></span> Like & Comment on other ideas!</li>
                          <li><span class="fa fa-check text-success"></span> Keep track of your own ideas!</li>
                          <li><span class="fa fa-check text-success"></span> Takes only 2 minutes</li>
                      </ul>
                      <p><a href="register.php" class="btn btn-info btn-block">Register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.php"); ?>