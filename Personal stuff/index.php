<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        header {
            background-color: #4267B2;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .sidebar, .feed {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar {
            width: 25%;
        }
        .feed {
            width: 70%;
        }
        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-info img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }
        .user-info h3 {
            margin: 10px 0;
        }
        .post-box {
            margin-bottom: 20px;
        }
        .post-box textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .post-box button {
            padding: 10px 20px;
            background-color: #4267B2;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .post-box button:hover {
            background-color: #365899;
        }
        .post {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .post h4 {
            margin-bottom: 10px;
        }
        .post p {
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f0f2f5;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        My Social Media
    </header>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-info">
                <img src="https://via.placeholder.com/100" alt="User Profile Picture">
                <h3>John Doe</h3>
                <p>@johndoe</p>
            </div>
            <div class="options">
                <p><a href="#">Edit Profile</a></p>
                <p><a href="#">Friends</a></p>
                <p><a href="#">Settings</a></p>
            </div>
        </div>

        <!-- Feed -->
        <div class="feed">
            <!-- Post Creation Box -->
            <div class="post-box">
                <h3>Create a Post</h3>
                <textarea placeholder="What's on your mind?" rows="4"></textarea>
                <button type="submit" name="post">Post</button>
            </div>

            <!-- Posts -->
            <div class="post">
                <h4>John Doe</h4>
                <p>Had a great day at the park! The weather was perfect.</p>
            </div>

            <div class="post">
                <h4>Jane Smith</h4>
                <p>Just finished a new project at work. Feeling accomplished!</p>
            </div>

            <div class="post">
                <h4>Michael Johnson</h4>
                <p>Loving the new restaurant downtown! Highly recommend the pasta.</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 My Social Media. All rights reserved.</p>
    </div>
</body>
</html>