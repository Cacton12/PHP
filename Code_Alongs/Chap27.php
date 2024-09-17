<!DOCTYPE html>
<?php
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    echo "<script>alert('$message')</script>";
}
?>
<html>
    <head>
        <!-- Don't worry about the HTML specifics, this is a PHP course-->
    </head>    
    <body>
        <!--method="get" is the default -->
        <form method="post" action="Chap27_proc.php">
            <label>Product ID:</label><input type="text" name="txtProdId"><br>
            <label>Category: </label><input type="text" name="txtCategory"><br>
            <label>Description: </label><input type="text" name="txtDesc"><br>
            <label>Price: </label><input type="text" name="txtPrice"><br>
            <input type="submit">
            <!--<button type="submit">Go</button>  -->           
        </form>        
    </body>
</html>