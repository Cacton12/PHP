<?php
include("connect.php");
include("Users.php");
include("tweet.php");
?>
<?php
//3 types of vulnerabilities
//1. Software (servers, programming languages, OS etc.)
//2. Poorly protected data (DB protected by a weak password or 
//admin console wide open with easy URL)
//3. User input- Hackers will exploit vulnerabilities due to clumsy 
//processing of user input
session_start();
$currentUserId = $_SESSION['user_id'];
$searchTerm = "%" . $_GET["search"] . "%";
//$sql = "select * from users where first_name like '%$searchTerm%' or last_name 
//    like '%$searchTerm%'";
$sqlUser = "SELECT u.*,
            EXISTS(SELECT 1 FROM follows WHERE from_id = ? AND to_id = u.user_id) AS is_following,
            EXISTS(SELECT 1 FROM follows WHERE from_id = u.user_id AND to_id = ?) AS follows_you
            FROM users u
            WHERE (u.first_name LIKE ? OR u.last_name LIKE ? OR u.screen_name LIKE ?)
            AND u.user_id != ?";
$sqlTweet =  "SELECT t.*, u.first_name, u.last_name, u.profile_pic, u.screen_name
        FROM tweets t
        JOIN users u ON t.user_id = u.user_id
        WHERE t.tweet_text LIKE ?
        ORDER BY t.date_created DESC";


$stmtUser = $con->stmt_init(); //initialize the prepared statement
$stmtTweet = $con->stmt_init();

//users
$stmtUser->prepare($sqlUser);
$stmtUser->bind_param('iisssi', $currentUserId, $currentUserId, $searchTerm, $searchTerm, $searchTerm, $currentUserId);
$stmtUser->execute();
$resultsUser = $stmtUser->get_result();

//tweets
$stmtTweet->prepare($sqlTweet);
$stmtTweet->bind_param('s', $searchTerm);
$stmtTweet->execute();
$resultsTweet = $stmtTweet->get_result();

$stmtUser->close(); //close the statement
$stmtTweet->close(); //close the statement

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
    <style>
        table {
            margin: auto;
            width: 50%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr {
            border-bottom: 1px solid;
        }

        tr:first-child {
            border: 1px solid;
        }

        h1 {
            text-align: center;
        }

        .tweets {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Screen Name</th>
                <th>Following</th>
                <th>Follows You</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultsUser as $user):
                $followingStatus = $user['is_following'];
                $followsYouStatus = $user['follows_you'];
            ?>
                <tr>
                    <td><?= $user['first_name'] ?></td>
                    <td><?= $user['last_name'] ?></td>
                    <td>
                        <a href="userpage.php?user_id=<?= htmlspecialchars($user['user_id']) ?>">
                            <?= htmlspecialchars($user['screen_name']) ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($followingStatus): ?>
                            Following
                        <?php else: ?>
                            <a href="Follow_proc.php?user_id=<?= htmlspecialchars($user['user_id']) ?>">Follow</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $followsYouStatus ? 'Yes' : 'No' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <h1>Tweets</h1>
    <div class="tweets">
        <?php
        $LoopCounter = 0;

        while ($rowProd = mysqli_fetch_array($resultsTweet)) {

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
</body>

</html>