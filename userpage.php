<?php
//displays all the details for a particular Y user
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Y - Why use X when you can use Y!</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/starter-template.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-1.10.2.js" ></script>
	
	
  </head>

  <body>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     

      <ul class="navbar-nav mr-auto">
		<li>
		  <a class="navbar-brand" href="#"><img alt="Y Logo" src="images/y_logo.png" class="logo"></a>
		  </li>
          <li class="nav-item">
            <a class="nav-link active" href="index.php">
			<img class="bannericons" alt="Home Icon" src="images/home.jfif">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" alt="Trending Icon" src="images/lightning.png">Moments</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" alt="notification icon" src="images/bell.png">Notifications</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#">
			<img class="bannericons" alt="Messages Icon" src="images/messages.png">Messages</a>
          </li>
          
		  
		  <li class="nav-item dropdown right">
            <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<img class="profilepic" alt="Elon Musk Silouette" src="images/profilepics/ElonSilouette.jpg">
			</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="logout.php">Logout</a>
              <a class="dropdown-item" href="edit_photo.php">Edit Profile Picture</a>
              
            </div>
          </li>  
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
	
	<BR><BR>
    <div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="mainprofile img-rounded">
				<div class="bold">
				<img class="bannericons" src="images/profilepics/ElonSilouette.jpg">
				Jimmy Jones<BR></div>
				<table>
				<tr><td>
				tweets</td><td>following</td><td>followers</td></tr>
				<tr><td>0</td><td>0</td><td>0</td>
				</tr></table>
				<img class="icon" src="images/location_icon.jpg">New Brunswick
				<div class="bold">Member Since:</div>
				<div>jan 1, 2001</div>
				</div><BR><BR>
				
				<div class="trending img-rounded">
				<div class="bold">0 &nbsp;Followers you know<BR>
				
				</div>
				</div>
				
			</div>
			<div class="col-md-6">
				<div class="img-rounded">
					
				</div>
				<div class="img-rounded">
				
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
				<div class="bold">Who to Troll?<BR></div>
								
				
				</div><BR>
				
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
