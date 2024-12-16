<?php 
include("connect.php");


$noteId = isset($_GET['NoteID']) ? (int)$_GET['NoteID'] : 0;

if ($noteId > 0) {
    // Fetch the content of the note by ID
    $sql = "SELECT Title, Content FROM notes WHERE NoteID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $noteId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $note = $result->fetch_assoc();
        echo json_encode($note);  // Return the note data as JSON
    } else {
        echo json_encode(['title' => 'Error', 'content' => 'Note not found.']);
    }
}
?>