<?php include("connect.php"); ?>
<?php
$url = 'http://cluebase.lukelav.in/clues/random'; // API endpoint
// Initialize cURL object
$cobj = curl_init($url);

//call the functions
for ($i = 0; $i < 100; $i++) {
    doGet($cobj);
}

function doGet($cobj)
{
    global $con;
    curl_setopt($cobj, CURLOPT_RETURNTRANSFER, true); //return the response as a string
    //execute the request
    $response = curl_exec($cobj);
    $myData = json_decode($response, true);

    $data = $myData['data'][0];
    $id = $data['id'];
    $game_id = $data['game_id'];
    $value = $data['value'];
    $daily_double = $data['daily_double'];
    $round = $data['round'];
    $category = $data['category'];
    $question = $data['clue'];
    $answer = $data['response'];

    $sql = "SELECT * FROM `categories` WHERE title = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $category); // Bind $category as a string parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Get category id from DB using category title
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $catId = $row['id'];
    } else {
        // If the category doesn't exist, insert it into the DB
        $sql = "INSERT INTO `categories`(`title`) VALUES (?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $category);
        $stmt->execute();
    
        // Retrieve the ID of the newly inserted category
        $catId = $con->insert_id;
    }

    //will insert question into DB with its own id question answer score value and the category id we queried for before
    $sql = "INSERT INTO `questions`(`id`, `question`, `answer`, `value`, `catId`) VALUES (?, ?, ?, ?, ? )";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('isssi', $id, $question, $answer, $value, $catId);
    $stmt->execute();
    $stmt->close();
} //end get
curl_close($cobj);
?>