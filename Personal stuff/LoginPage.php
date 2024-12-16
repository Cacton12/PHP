<?php 
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App - Login</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5dc;
            /* Beige background for notepad feel */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff8dc;
            /* Lighter beige for contrast */
            border: 2px solid #d2b48c;
            /* Tan border for a rustic vibe */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 24px;
            color: #8b4513;
            /* SaddleBrown for title text */
            margin-bottom: 20px;
        }

        .login-container label {
            font-size: 16px;
            color: #8b4513;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d2b48c;
            border-radius: 5px;
            background-color: #faf0e6;
            /* Linen color for input fields */
            font-family: 'Georgia', serif;
            box-sizing: border-box;
            /* Ensures padding is included in width */
        }


        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #deb887;
            /* BurlyWood button color */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        .login-container button:hover {
            background-color: #cdaa7d;
            /* Darker beige for hover */
        }

        .login-container a {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #8b4513;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login to Notes</h1>
        <form action="login_proc.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Login</button>
        </form>
        <a href="CreateAccount.php">Don't have an account? Register here.</a>
    </div>
</body>

</html>