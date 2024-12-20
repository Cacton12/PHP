<?php
include("connect.php");
include("Users.php");
include("tweet.php");
?>
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
	header("location: Login.php");
	exit();
}
$userId = $_SESSION['user_id'];

$sqlUser = "select * from users where user_id = $userId";
$sqlTweet =  "SELECT t.*, u.first_name, u.last_name, u.profile_pic, u.screen_name
        FROM tweets t
        JOIN users u ON t.user_id = u.user_id
        WHERE u.user_id = $userId
        ORDER BY t.date_created DESC";


$stmtUser = $con->stmt_init(); //initialize the prepared statement
$stmtTweet = $con->stmt_init();

//users
$stmtUser->prepare($sqlUser);
$stmtUser->execute();
$resultsUser = $stmtUser->get_result()->fetch_assoc();;

//tweets
$stmtTweet->prepare($sqlTweet);
$stmtTweet->execute();
$resultsTweet = $stmtTweet->get_result();


$stmtUser->close(); //close the statement
$stmtTweet->close(); //close the statement

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
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<script>
		//just a little jquery to make the textbox appear/disappear like the real Twitter website does
		$(document).ready(function() {
			//hide the submit button on page load
			$("#button").hide();
			$("#tweet_form").submit(function() {

				$("#button").hide();
			});
			$("#myTweet").click(function() {
				this.attributes["rows"].nodeValue = 5;
				$("#button").show();

			}); //end of click event
			$("#myTweet").blur(function() {
				this.attributes["rows"].nodeValue = 1;
				//$("#button").hide();

			}); //end of click event
		}); //end of ready event handler
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
						<?php
						$sql = "SELECT `profile_pic` FROM `users` WHERE `user_id`='$userId'";
						$rsProd = mysqli_query($con, $sql) or die("failed" . mysqli_error($con));

						$rowProd = mysqli_fetch_array($rsProd);

						if (!empty($rowProd["profile_pic"])) {
							$profile_pic = "images/profilepics/" . $rowProd["profile_pic"];
						} else {
							$profile_pic = "images/profilepics/ElonSilouette.jpg";
						}
						echo '<img class="bannericons" alt="Profile pic" src="' . $profile_pic . '">';

						?>
						<?php echo "<a href='userpage.php?user_id=" . $resultsUser["user_id"] . "'>" . $resultsUser["first_name"] . " " . $resultsUser["last_name"] . "</a>"; ?>
					</div>
					<table>
						<tr>
							<td>
								tweets</td>
							<td>following</td>
							<td>followers</td>
						</tr>
						<tr>
							<td>
								<?php
								$sqlTweetCount = "SELECT COUNT(*) AS tweet_count FROM tweets WHERE user_id = " . $resultsUser['user_id'];


								$stmtTweetCount = $con->prepare($sqlTweetCount);
								$stmtTweetCount->execute();
								$resultTweetCount = $stmtTweetCount->get_result()->fetch_assoc();
								$tweetCount = $resultTweetCount['tweet_count'];
								$stmtTweetCount->close();

								echo $tweetCount;
								?>
							</td>
							<td>
								<?php
								$sqlFollowing = "SELECT COUNT(*) AS following FROM follows WHERE from_id = " . $resultsUser['user_id'];
								$stmtFollowing = $con->prepare($sqlFollowing);
								$stmtFollowing->execute();
								$resultFollowing = $stmtFollowing->get_result()->fetch_assoc();
								$Following = $resultFollowing['following'];
								$stmtFollowing->close();

								echo $Following;
								?>
							</td>
							<td>
								<?php
								$sqlFollowers = "SELECT COUNT(*) AS followers FROM follows WHERE to_id = " . $resultsUser['user_id'];


								$stmtFollowers = $con->prepare($sqlFollowers);
								$stmtFollowers->execute();
								$resultFollowers = $stmtFollowers->get_result()->fetch_assoc();
								$Followers = $resultFollowers['followers'];
								$stmtFollowers->close();

								echo $Followers;
								?>
							</td>
						</tr>
					</table>
					<img class="icon" src="images/location_icon.jpg">
					<?php
					$sqlProvince = "SELECT province FROM users WHERE user_id = " . $resultsUser['user_id'];


					$stmtProvince = $con->prepare($sqlProvince);
					$stmtProvince->execute();
					$resultProvince = $stmtProvince->get_result()->fetch_assoc();
					$Province = $resultProvince['province'];
					$stmtProvince->close();

					echo $Province;
					?>
					<div class="bold">Member Since:</div>
					<div>
						<?php
						$sqlDate = "SELECT date_created FROM users WHERE user_id = " . $resultsUser['user_id'];


						$stmtDate = $con->prepare($sqlDate);
						$stmtDate->execute();
						$resultDate = $stmtDate->get_result()->fetch_assoc();
						$Date = $resultDate['date_created'];
						$stmtDate->close();

						$dateTime = new DateTime($Date);
						$formattedDate = $dateTime->format('F j, Y');

						echo $formattedDate;
						?>
					</div>
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
					<?php
					$LoopCounter = 0;

					$sql = "SELECT t.*, u.first_name, u.last_name, u.profile_pic, u.screen_name
						FROM `tweets` t
						JOIN `users` u ON t.user_id = u.user_id
						ORDER BY t.date_created DESC";
					//main querry
					$rsProd = mysqli_query($con, $sql) or die(mysqli_error($con));
					while ($rowProd = mysqli_fetch_array($rsProd)) {

						if ($LoopCounter > 10) {
							break;
						}

						$user = new users(
							$rowProd['user_id'],
							null,
							$rowProd['first_name'],
							$rowProd['last_name'],
							$rowProd['screen_name'],
							null,
							null,
							null,
							null,
							null,
							null,
							$rowProd['profile_pic'],
							null,
							null
						);
						$tweet = new tweet(
							$rowProd['tweet_id'],
							$rowProd['tweet_text'],
							$rowProd['user_id'],
							$rowProd['date_created'],
							$rowProd['original_tweet_id'],
							$rowProd['reply_to_tweet_id']
						);
						//querry for original user id and tweet text
						if ($tweet->originalTweetId != null) {
							$sql2 = "SELECT `tweet_text`, `user_id`FROM `tweets` WHERE `tweet_id` = $tweet->originalTweetId";
							$rsProd2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
							if (mysqli_num_rows($rsProd2) > 0) {
								$rowProd2 = mysqli_fetch_array($rsProd2);
								$originalUserId = $rowProd2['user_id'];
								$originalTweetText = $rowProd2['tweet_text'];
							}
							//querry for first name, last name, screen name from original post
							$sql3 = "SELECT `first_name`, `last_name`, `screen_name`FROM `users` WHERE `user_id` = $originalUserId";
							$rsProd3 = mysqli_query($con, $sql3) or die(mysqli_error($con));
							if (mysqli_num_rows($rsProd3) > 0) {
								$rowProd3 = mysqli_fetch_array($rsProd3);
								$original_first_name = $rowProd3['first_name'];
								$original_last_name = $rowProd3['last_name'];
								$original_screen_name = $rowProd3['screen_name'];
							}
						}

						if (!empty($rowProd["profile_pic"])) {
							$profile_pic = "images/profilepics/" . $rowProd["profile_pic"];
						} else {
							$profile_pic = "images/profilepics/ElonSilouette.jpg";
						}
						$date_created = $user->DateAdded;
						$tweet_time = new DateTime($date_created);
						$now = new DateTime();
						$interval = date_diff($now, $tweet_time);
						// I stuggled with this but i ended up using this method of breaking down the DateInterval
						//into year month day hour and minute so essentially it will go through the ifs for example
						// if it is 5 years ago it will stop at the fist if, years, then hit the second if being
						// ($interval->y > 1 ? "s" : "") which adds a s if it was more than one year ago 
						if ($interval->y > 0) {
							$time_text = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
						} elseif ($interval->m > 0) {
							$time_text = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
						} elseif ($interval->d > 0) {
							$time_text = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
						} elseif ($interval->h > 0) {
							$time_text = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
						} elseif ($interval->i > 0) {
							$time_text = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
						} else {
							$time_text = "Just now";
						}
						echo '<div class="tweet">' .
							'<img class="bannericons" src="' . $profile_pic . '" alt="Profile Picture">' .
							'<strong>' . htmlspecialchars($user->FirstName . ' ' . $user->LastName) . '</strong> ' .
							'<a href="userpage.php?user_id=' . $user->userId . '">@' . htmlspecialchars($user->UserName) . '</a><br>' .
							'<p>' .
							($tweet->originalTweetId != null ? htmlspecialchars($originalTweetText) : htmlspecialchars($tweet->tweetText)) .
							'</p>' .
							'<span class="tweet-time">' . $time_text . '</span><br>';

						if ($tweet->originalTweetId != null || $tweet->originalTweetId > 0) {
							echo '<span class="original-tweet">Original by: <strong>' .
								'<a href="userpage.php?user_id=' . $originalUserId . '">' . $original_first_name . ' ' . $original_last_name . '</a>' .
								'</strong> <a href="userpage.php?user_id=' . $originalUserId . '">@' . $original_screen_name . '</a></span><br>';
						}

						echo '<div class="tweet-icons">' .
							'<a href="#"><img src="images/like.ico" alt="Like Icon" class="tweet-icon" style="width: 24px; height: 24px;"></a>' .
							'<a href="#"><img src="images/reply.png" alt="Reply Icon" class="tweet-icon" style="width: 24px; height: 24px;"></a>' .
							'<a href="retweet.php?tweet_id=' . $tweet->tweetId . '"><img src="images/retweet.png" alt="Retweet Icon" class="tweet-icon" style="width: 24px; height: 24px;"></a>' .
							'</div>' .
							'</div>' .
							'<hr>';

						$LoopCounter++;
					}
					?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="whoToTroll img-rounded">
					<div class="bold">Who to Troll?<BR></div>
					<!-- display people you may know here-->
					<?php
					$sql = "SELECT * FROM users WHERE user_id != '$userId' AND user_id NOT IN (SELECT to_id FROM follows WHERE from_id = '$userId') ORDER BY RAND() LIMIT 3";
					$rsProd = mysqli_query($con, $sql) or die();
					while ($rowProd = mysqli_fetch_array($rsProd)) {
						$first_name = $rowProd["first_name"];
						$last_name = $rowProd["last_name"];
						$screen_name = $rowProd["screen_name"];
						if (!empty($rowProd["profile_pic"])) {
							$profile_pic = "images/profilepics/" . $rowProd["profile_pic"];
						} else {
							$profile_pic = "images/profilepics/ElonSilouette.jpg";
						}

						echo '<img class="bannericons" src="' . $profile_pic . '" alt="Profile Picture">' .
							'<a href="userpage.php?user_id=' . $rowProd['user_id'] . '">' .
							$first_name . " " . $last_name . " @" . $screen_name .
							'</a><br>' .
							'<form action="Follow_proc.php?user_id=' . $rowProd['user_id'] . '" method="post">' .
							'<button type="submit" class="follow">Follow</button>' .
							'</form><br>';
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