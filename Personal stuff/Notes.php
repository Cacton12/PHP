<?php
include("connect.php");
// Fetch all notes from the database
$sql = "SELECT NoteID, Title FROM notes";
$result = $con->query($sql);

$notes = [];
if ($result && $result->num_rows > 0) {
    // Fetch all notes into an array
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <style>
        /* Styling */
        body {
            font-family: 'Georgia', serif;
            background-color: #f5f5dc;
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
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notes-list {
            width: 250px;
            background-color: #faf0e6;
            border-right: 2px solid #d2b48c;
            overflow-y: auto;
            max-height: 100%;
        }

        .notes-list h2 {
            color: #8b4513;
            font-size: 20px;
            margin-bottom: 10px;
            text-align: left;
            border-bottom: 2px solid #d2b48c;
            padding-bottom: 2px;
            padding-left: 20px;
        }

        .note-title {
            background-color: #deb887;
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
        }

        .note-content {
            flex-grow: 1;
            padding: 20px;
            padding-right: 20px;
            /* Add space between the content and the right side */
            background-color: #fff;
            color: #8b4513;
            overflow-y: auto;
        }


        .note-content h3 {
            margin-top: 0;
        }

        .note-content p {
            font-size: 16px;
        }

        .notes-list {
            width: 250px;
            background-color: #faf0e6;
            border-right: 2px solid #d2b48c;
            display: flex;
            flex-direction: column;
            height: 100%;
            /* Ensure it occupies full height */
        }

        .notes-scrollable {
            flex-grow: 1;
            /* Make it expand to occupy available space */
            overflow-y: auto;
            /* Enable scrolling when content overflows */
            padding: 10px 20px;
        }

        .create-note-container {
            padding: 10px;
            text-align: center;
            border-top: 2px solid #d2b48c;
            background-color: #faf0e6;
        }

        .create-note-btn {
            background-color: #deb887;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .create-note-btn:hover {
            background-color: #cdaa7d;
        }
    </style>
    <script>
        // JavaScript to fetch note content dynamically
        function loadNoteContent(noteId) {
            fetch(`Notes_Proc.php?NoteID=${noteId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    const noteContent = document.querySelector('.note-content');
                    noteContent.innerHTML = `
                        <h3>${data.Title}</h3>
                        <p>${data.Content}</p>
                    `;
                })
                .catch(error => {
                    console.error('Error fetching note:', error);
                });
        }
        function createNewNote() {
            const noteContent = document.querySelector('.note-content');

            // Add padding or margin to create space from the right side
            noteContent.style.paddingRight = "20px"; // Adds space inside the container

            // Display a form for creating a new note
            noteContent.innerHTML = `
        <h3>Create a New Note</h3>
        <form id="create-note-form">
            <label for="note-title">Title:</label>
            <input type="text" id="note-title" name="title" placeholder="Enter note title" style="width: 100%; margin-bottom: 10px;" required>

            <label for="note-content">Content:</label>
            <textarea id="note-content" name="content" placeholder="Write your note here..." style="width: 100%; height: 200px; margin-bottom: 10px;" required></textarea>

            <button type="button" onclick="saveNote()" style="padding: 10px 20px; background-color: #deb887; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Save Note</button>
        </form>
    `;
        }

    </script>
</head>

<body>
    <div class="notes-container">
        <!-- Notes List Section -->
        <div class="notes-list">
            <h2>My Notes</h2>
            <!-- Notes list container -->
            <div class="notes-scrollable">
                <?php
                // Loop through the notes and display each as a button
                foreach ($notes as $note) {
                    echo "<button class='note-title' onclick='loadNoteContent(" . $note['NoteID'] . ")'>" . htmlspecialchars($note['Title']) . "</button>";
                }
                ?>
            </div>
            <!-- Create Note Button -->
            <div class="create-note-container">
                <button class="create-note-btn" onclick="createNewNote()">Create Note</button>
            </div>
        </div>


        <!-- Note Content Section -->
        <div class="note-content">
            <h3>Welcome to the Notes App</h3>
            <p>Select a note from the left to view its content here.</p>
        </div>
    </div>
</body>

</html>