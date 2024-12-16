<?php 
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5dc;
            /* Beige background for notepad feel */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
        }

        .notes-container {
            display: flex;
            width: 100%;
            height: 100%;
            background-color: #fff8dc;
            /* Light beige background */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notes-list {
            width: 250px;
            background-color: #faf0e6;
            /* Light linen color */
            border-right: 2px solid #d2b48c;
            /* Tan border */
            overflow-y: auto;
            max-height: 100%;
        }

        .notes-list h2 {
            color: #8b4513;
            font-size: 20px;
            margin-bottom: 10px;
            text-align: Left;
            border-bottom: 2px solid #d2b48c;
            padding-bottom: 2px;
            padding-left: 20px;
        }

        .note-title {
            background-color: #deb887;
            /* BurlyWood background for titles */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            text-align: left;
            font-size: 16px;
            margin-left: 20px;
        }

        .note-title:hover {
            background-color: #cdaa7d;
            /* Darker beige on hover */
        }

        .note-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
            /* White background for content */
            color: #8b4513;
            overflow-y: auto;
        }

        .note-content h3 {
            margin-top: 0;
        }

        .note-content p {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="notes-container">
        <!-- Notes List Section -->
        <div class="notes-list">
            <h2>My Notes</h2>
            <?php
            // Loop through the notes and display each as a button
            foreach ($notes as $note) {
                echo "<button class='note-title' onclick='loadNoteContent(" . $note['id'] . ")'>" . htmlspecialchars($note['title']) . "</button>";
            }
            ?>
        </div>

        <!-- Note Content Section -->
        <div class="note-content">
            <h3>Welcome to the Notes App</h3>
            <p>Select a note from the left to view its content here.</p>
        </div>
    </div>
</body>

</html>