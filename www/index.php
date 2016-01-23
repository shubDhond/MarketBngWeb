<?php
require 'vendor/autoload.php';
use Parse\ParseClient;
session_start();
ParseClient::initialize('6OsMY7JbzoLcCpP1UBgMUJdc4Ol68kDskzq8b3aw',
	'B7llkQxaYdCqUlFENwTCEeavarSvQp4It25a0kpH', '7QwWggaRtzFsNniqlgrXwtRqkLaXmW2BzOJMv6O9');
include("assets/templates/header.php")
?>
	<!-- Main -->
	<div id="headerwrap">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<h1>Welcome to MarketBang!</h1>
					<h4>Marketing tool which uses brain waves of users viewing advertisements
						from muse wearable device to provide useful analytic information to companies.</h4>
				</div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <p><br/><a href="create.php" class="btn btn-theme">Create a Survey</a></p>
                    </div>
                    <div class="col-lg-6">
                        <p><br/><a href="profile.php" class="btn btn-theme">View Submissions</a></p>
                    </div>
                </div>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /headerwrap -->
	<!-- Info -->

	 <div id="service">
	 	<div class="container">
 			<div class="row centered">
 				<div class="col-md-4">
 					<i class="fa fa-pencil-square-o"></i>
 					<h4>Create a Survey</h4>
 					<p>Sign up and create your own survey or advertisement.</p>
 					
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-list"></i>
 					<h4>Gather Brain Activity Data</h4>
 					<p>Gather Data about user's brain stimulation throughout the survey.</p>
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-puzzle-piece"></i>
 					<h4>Analyze Data</h4>
 					<p>Draw conclusions and imporve your app based on brain stimulation data.</p>
 				</div>		 				
	 		</div>
	 	</div><!--/container -->
	 </div><!--/service -->
	
<?php include("assets/templates/footer.php"); ?>
	
