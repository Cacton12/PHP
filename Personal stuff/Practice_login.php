<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & File Upload</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Hide the error message by default */
        .error-messages {
            display: none;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>

        <!-- Error Message Example (You can display or hide this section as needed) -->
        <div class="error-messages" id="error-message">
            <p id="error-text">Invalid login credentials</p>
        </div>

        <!-- Login Form -->
        <div class="login-form">
            <h2>Login</h2>
            <form id="login-form" action="login_proc.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <button type="submit" name="login">Login</button>
            </form>
        </div>

        <!-- File Upload Form -->
        <div class="upload-form">
            <h2>Upload a File</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <button type="submit" name="upload">Upload</button>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Listen for form submit and show error if validation fails
            document.getElementById('login-form').addEventListener('submit', function(e) {
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                // Example of basic validation - customize as needed
                if (username == '' || password == '') {
                    e.preventDefault(); // Stop form submission

                    // Display the error message
                    var errorMessageDiv = document.getElementById('error-message');
                    var errorText = document.getElementById('error-text');

                    errorMessageDiv.style.display = 'block'; // Show the error div
                    errorText.textContent = 'Username and password cannot be blank'; // Customize the error message
                }
            });
        };
    </script>
</body>
</html>