<?php
include("assets/templates/header.php");
require 'vendor/autoload.php';
use Parse\ParseUser;

//Initialize error message.
$errorMessage = "";
/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$email = $_POST['email'];
  $name = $_POST['name'];
	$pass = $_POST['pass'];
    
  //make sure all fields are set
  if (!empty($email) && !empty($pass) && !empty($name)){
        
	  /* strip of any sketchy characters */
    $email = htmlspecialchars($email);
    $name = htmlspecialchars($name);
    $pass = htmlspecialchars($pass);
    
    
    $user = new ParseUser();
    $user->set("username", $email);
    $user->set("password", $pass);
    $user->set("email", $email);
    
    try {
      $user->signUp();
      // Hooray! Let them use the app now.
    } catch (ParseException $ex) {
      // Show the error message somewhere and let the user try again.
      echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
    }
    
    $_SESSION['login'] = "1";
    $_SESSION['email'] = $email;
    header ("Location: index.php");
    
  }
}
?>
<br>
<br>

    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Register</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-12">
                      <div class="well">
                          <h3 class="title text-center"><?PHP print $errorMessage;?> </h3>
                          <form action="register.php" method="post" class="intro text-center">
                              <div class="form-group">
                                  <label for="username" class="control-label">Name</label>
                                  <input  class="form-control" type="text" name="name" placeholder="Name" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="username" class="control-label">Email</label>
                                  <input  class="form-control" type="text" name="email" placeholder="Email" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input  class="form-control" type="password" name="pass" placeholder="Password" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Re-enter Password</label>
                                  <input class="form-control" type="password" name="pass2" placeholder="Re-enter Password" class="inputs" required><br>
                                  <span class="help-block"></span>
                              </div>
                              <button type="submit" class="btn btn-theme btn-block">Register</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.php"); ?>