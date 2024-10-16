<?php
    if (isset($_GET["msg"])) {
        //display an alert message
        echo "<script>alert('" . $_GET["msg"] . "')</script>";
    }
?>
<html>
<head>
<title>Chapter 15-File uploading</title>
<body>
<form action="Chap15_proc.php" method="post" enctype="multipart/form-data" >
    Please select your image (must be under 5MB):
    <input type="file" name="photo" required="required"><br>
    <input type="submit" name="submit" value="UPLOAD">
    
</form>
</body>
</html>
