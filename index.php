<?php include("connect.php"); ?>
<?php
session_start();

if(!isset($_SESSION["user_id"])){
	header("location: Login.php");
	exit();
}
$userId = $_SESSION['user_id'];


//this is the main page for our Y website, 
//it will display all posts from those we are trolling
//as well as recommend people we should be trolling.
//you can also post from here

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="DESC MISSING">
    <meta name="author" content="Nick Taggart, nick.taggart@nbcc.ca">
    <link rel="icon" href="favicon.ico">

    <title>Y - Why use X when you can use Y!</title>

    <!-- Bootstrap core CSS -->
    <link href="includes\bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	<script>
	//just a little jquery to make the textbox appear/disappear like the real Twitter website does
	$(document).ready(function() {
		//hide the submit button on page load
		$("#button").hide();
		$("#tweet_form").submit(function() {
			
			$("#button").hide();
		});
		$("#myTweet").click( function() {			
			this.attributes["rows"].nodeValue = 5;
			$("#button").show();
			
		});//end of click event
		$("#myTweet").blur( function() {			
			this.attributes["rows"].nodeValue = 1;
                        //$("#button").hide();

		});//end of click event
	});//end of ready event handler
    
	</script>
  </head>

  <body>
  <?php include("Includes/header.php"); ?>
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
				<img class="bannericons" alt="Elon Musk Silouette" src="images/profilepics/ElonSilouette.jpg">
				<a href="userpage.php?user_id=">Jimmy Jones</a><BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>0</td><td>0</td><td>0</td>
				</tr></table><BR><BR><BR><BR><BR>
				</div><BR><BR>
				<div class="trending img-rounded">
				<div class="bold">Trending</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					<form method="post" id="tweet_form" action="tweet_proc.php">
					<div class="form-group">
						<textarea class="form-control" name="myTweet" id="myTweet" rows="1" placeholder="What's on your mind?"></textarea>
						<input type="submit" name="button" id="button" value="Send" class="btn btn-primary btn-lg btn-block login-button">
						
					</div>
					</form>
				</div>
				<div class="img-rounded">
				<!--display list of tweets here-->
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
				<!-- display people you may know here-->
				 <?php
				 	$sql = $sql = "SELECT * FROM users WHERE user_id != '$userId' AND user_id NOT IN (SELECT to_id FROM follows WHERE from_id = '$userId') ORDER BY RAND() LIMIT 3";
					 $rsProd = mysqli_query($con, $sql) or die();
					 while ($rowProd = mysqli_fetch_array($rsProd)){
						 $first_name = $rowProd["first_name"];
						 $last_name = $rowProd["last_name"];
						 $screen_name = $rowProd["screen_name"];
						 if($rowProd["profile_pic"] != ""){
							 $profile_pic = $rowProd["profile_pic"];
						 }
						 else{
							 $profile_pic = 'Images\profilepics\ElonSilouette.jpg';
						 }
						 echo '<img  class="bannericons" src=' ."$profile_pic" . ' alt="">' . '<a href="userpage.php?user_id=' . $rowProd['user_id'] . '">' . $first_name . " " .$last_name . " " . '@' .$screen_name .'</a>' . '<br>'
						 .'<form action="Follow_proc.php?user_id='. $rowProd['user_id'].'" method="post">' . '<button type="submit" class="follow">Follow</button>' . '</form>' . '<br>';;
					 }
				 ?>
				<!--don't need this div for now 
				<div class="trending img-rounded">
				© 2024 Y
				</div>-->
			</div>
		</div> <!-- end row -->
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="includes/bootstrap.min.js"></script>
    
  </body>
</html>