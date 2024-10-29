<?php include("connect.php"); ?>
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
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

    <div class="container mt-5">
        <h1 class="text-center text-warning">Submit Your File</h1>
        <form action="edit_photo_proc.php" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="mb-3 text-center">
                <label for="file-upload" class="form-label">Choose a file</label>
                <input class="form-control w-50 mx-auto" type="file" id="file-upload" name="file" required>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
            </div>
        </form>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="includes/bootstrap.min.js"></script>

</body>

</html>