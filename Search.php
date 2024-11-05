<?php
echo "COMING SOON";
/*3 types of vulnerabilities
1. software(servers, programming languages. OS etc.)
2. Poorly protected data (DB protected by a weak password)
 admin console wide open with easy url
 3. User input- Hackers will explor vulnerabilities due to clumsy 
*/
include("connect.php");
$searchTerm = "%" . $_GET["search"] . "%";
// $sql = "SELECT * FROM users WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
$sql = "select * from users where first_name like ? or last_name like ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss",  $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
while ($row= $result->fetch_assoc()) {
    echo $row['first_name'] . " " . $row['last_name'] . "<br>";
}
echo $sql . "<br>";
$stmt->close();
$con->close();

// echo phpinfo();
?>