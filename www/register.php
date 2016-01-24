<?php

require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
    'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
use Parse\ParseUser;
use Parse\ParseFile;
use Parse\ParseObject;


//Initialize error message.
$errorMessage = "";

/*if page is accessed after attempt */
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //grab sign up info from POST request
	$email = $_POST['email'];
    $name = $_POST['name'];
	$pass = $_POST['pass'];
    
    //make sure all fields are set
    if ((!empty($email) && !empty($pass) && !empty($name)) && isset($_POST['submit'])){

        /* strip of any sketchy characters */
        $email = htmlspecialchars($email);
        $company_name = htmlspecialchars($name);
        $pass = htmlspecialchars($pass);

        $target_dir = "assets/uploads/";
        $name = $_FILES['file']['name'];
        $tempFile = $_FILES['file']['tmp_name'];

        if (isset($name)){
            move_uploaded_file($tempFile,$target_dir.$name);
        }

        $file = ParseFile::createFromFile($target_dir.$name, "logo");
        $file->save();

        // create new user object
        $user = new ParseUser();
        $user->set("username", $email);
        $user->set("password", $pass);
        $user->set("email", $email);
        $user->set("corporate", true);
        $user->set("name", $company_name);
        $user->set("logo", $file);
        // try signup
        try {
            $user->signUp();
            // Hooray! Let them use the app now.
            $_SESSION['login'] = "1";
            $_SESSION['email'] = $email;
            $_SESSION['userid'] = $user->getObjectId();
            header("Location: index.php");
        } catch (ParseException $ex) {
            // Show the error message somewhere and let the user try again.
            echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
        }
    }
}
?>
<?=include("assets/templates/header.php"); ?>
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
                          <form action="register.php" method="post" class="intro text-center" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="username" class=control-label">Logo</label>
                                  <input type="file" name="file" id="file" class="inputs">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="username" class="control-label">Company Name</label>
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

                              <input type="submit" class="btn btn-theme btn-block" value="submit" name="submit">
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php include("assets/templates/footer.php"); ?>