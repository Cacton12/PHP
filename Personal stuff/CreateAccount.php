<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App - Create Account</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5dc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .create-account-container {
            background-color: #fff8dc;
            border: 2px solid #d2b48c;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }

        .create-account-container h1 {
            font-size: 24px;
            color: #8b4513;
            margin-bottom: 20px;
        }

        .create-account-container label {
            font-size: 16px;
            color: #8b4513;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .create-account-container input[type="text"],
        .create-account-container input[type="password"],
        .create-account-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d2b48c;
            border-radius: 5px;
            background-color: #faf0e6;
            font-family: 'Georgia', serif;
            box-sizing: border-box;
        }

        .create-account-container button {
            width: 100%;
            padding: 10px;
            background-color: #deb887;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        .create-account-container button:hover {
            background-color: #cdaa7d;
        }

        .create-account-container a {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #8b4513;
            text-decoration: none;
        }

        .create-account-container a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Initialize errors array
                const validationErrors = [];
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirm = document.getElementById('confirm-password').value;
                const username = document.getElementById('username').value;

                const emailPattern = /^(([^<>()\[\]\\.,;:\s@\"]+(\.[^<>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                const emailIsValid = emailPattern.test(email);

                if (password.length > 50 || confirm.length > 50 || password !== confirm) {
                    validationErrors.push('Please make sure both passwords are the same and less than 50 characters\n');
                }
                if (!emailIsValid || email.length > 50 || email === "") {
                    validationErrors.push('Please enter a proper email less than 50 characters in length\n');
                }
                if (username.length > 50 || username === "") {
                    validationErrors.push('Please enter a username less than 50 characters in length\n');
                }
                if (validationErrors.length > 0) {
                    alert(validationErrors.join(''));
                } else {
                    form.submit();
                }
            });
        });
    </script>

</head>

<body>
    <div class="create-account-container">
        <h1>Create Your Account</h1>
        <form action="CreateAccount_proc.php" method="post" id="form" name="createForm">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your password" required>
            <button type="submit" id="submitButton" name="submitButton">Create Account</button>
        </form>
        <a href="LoginPage.php">Already have an account? Login here.</a>
    </div>
</body>

</html>
