<?php
//REST APIs use standard HTTP methods to specify the action:
//    GET: Retrieve data (e.g., get a user).
//    POST: Create a new item (e.g., add a new user).
//    PUT: Update or replace an existing item (e.g., update user details).
//    DELETE: Remove a item (e.g., delete a user).

//Each request is stateless; the server doesn’t remember previous requests. 
//REST APIs typically exchange data in formats like JSON or XML
header("Content-Type: application/json");
// fake data for this demo, you could query a DB to get real data
$users = [
    1 => ['id' => 1, 'name' => 'Nick', 'email' => 'nick@nbcc.ca'],
    2 => ['id' => 2, 'name' => 'Joe', 'email' => 'joe@joe.com'],
    3 => ['id' => 3, 'name' => 'Jimmy', 'email' => 'jimmy@gmail.com']
];

// Parse the HTTP request
$requestMethod = $_SERVER['REQUEST_METHOD']; //get, post, put or delete

$requestUri = explode('?', trim($_SERVER['REQUEST_URI'], '/')); //get the querystring
$resourceArray = explode("/", $requestUri[1]);//split on slash

$resource = $resourceArray[0] ?? null; // e.g. "users"
$id = $resourceArray[1] ?? null;       // e.g. 3

// Handle the API request
if ($resource === 'users') {
    //ADD CODE TO PROCESS THE REQUEST
} else {
    echo json_encode(['error' => 'Invalid request']);
}
switch ($requestMethod){
    case 'GET':
        if($id){
            echo json_encode($users[$id]);
        }
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        $newId = count($users) + 1;
        $users[$newId] = ['id'=> $newId] + $input;
        echo json_encode(['message' => 'User Created']);
        break;
    case 'PUT':
        $input = json_decode(file_get_contents("php://input"), true);
        $users[$id] = ['id'=> $id] + $input;
        echo json_encode(['message' => 'User updated worked','<br>', 'user' => $users[$id]]);
        break;
    case 'DELETE': 
        unset($users[$id]);
        echo json_encode(['message' => 'User deleted']);
        break;
    default:
        echo json_encode(['error' => 'invalid request']);
        break;
}