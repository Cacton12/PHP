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