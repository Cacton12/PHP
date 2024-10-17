<?php include("connect.php"); ?>
<!DOCTYPE html>
<td?php
//4U2DO - add code here to get the message that gets passed back from the yoga_proc.php page
?>
<html lang="en">
<head>
<title>Path of Light Yoga Studio</title>
<meta charset="utf-8">
<link rel="stylesheet" href="yoga.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<header>
<h1>Path of Light Yoga Studio</h1>
</header>
<main>
<img src="yogadoor2.jpg" alt="door to yoga studio" width="225" height="300" class="floatleft">
<h2>Book a Class for today. Keep in mind that you can only do 1 class per day.</h2>
<p><span class="studio">Path of Light Yoga Studio</span> provides all levels of yoga practice in a tranquil, peaceful environment. Whether you are new to yoga or an experienced practitioner, our dedicated instructors can develop a practice to meet your needs. Let your inner light shine at the <span class="studio">Path of Light Yoga Studio</span>.</p>
<form method="post" action="yoga_proc.php">
<table>
  <tr>
    <td>Name</td> 
    <td><input name="txtName" type="text"/></td>
  </tr>
  <tr>
    <td>Email</td> 
	<td><input name="txtEmail" type="text"/></td>
  </tr>
  <tr>
    <td>Choose a class</td> 
    <td>
        <select name="cboClass">
            <option></option>      
            <option>6:00AM</option>
            <option>noon</option>
            <option>5:30PM</option>
        </select>
    </td>
  </tr> 
  <tr>
      <td colspan="2">
        <input id="mySubmit" type="submit"/>
      </td>
  </tr>
</table>
    
</form>
<table>
            <caption>Current list of signups</caption>
			<tr>
                <th>Name</th>
                <th>Class</th>
            </tr>
<?php
//4U2DO - add code here that will query the signup table of the DB and display an HTML table row for each record in the DB
//		Display an HTML row that says "No users signed up yet" if no users found
session_start();
//wanted me to initalize these
$sqlSelect = "SELECT * FROM `signup`";
$result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result) >= 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $class = $row['class'];
        
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["class"] = $class;

        if (empty($name) || empty($email) || empty($class)) {
            echo "<td colspan='2'>No users signed up yet</td>";
        } else {
            echo "<tr>
                    <td>" . $name . "</td>
                    <td>" . $class . "</td>
                  </tr>";
        }
    }
} else {
    echo "<script>
            alert('ahhhhh');
          </script>";
}

?>
            </table>
<div class="clear">
<span class="studio">Path of Light Yoga Studio</span><br>
612 Serenity Way<br>
El Dorado, CA 96162<br><br>
<a id="mobile" href="tel:888-555-5555">888-555-5555</a><span id="desktop">888-555-5555</span><br><br>
</div>
</main>
<footer>
<small><i>Copyright &copy; 2024 Path of Light Yoga Studio<br>
<a href="mailto:guru@pathoflight.com">guru@pathoflight.com</a>
</i></small>
</footer>
</div>
</body>
</html>
