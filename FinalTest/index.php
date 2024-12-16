<!DOCTYPE html>
<?php

?>
<html lang="en">

<head>
  <title>Path of Light Yoga Studio</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="yoga.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

  <script>
    $(document).ready(function () {
      $("#mySubmit").hide(); //hide the submit button page load
    });
  </script>
  <script>
    function CheckUser() {
      fetch("CheckUser.php?email=" + $("#txtEmail").val())
        .then(response => response.text())
        .then(text => {
        console.log(text) 
  })
      return true;
    }
  </script>
</head>

<body>
  <div id="wrapper">
    <header>
      <h1>Path of Light Yoga Studio</h1>
    </header>
    <main>
      <img src="yogadoor2.jpg" alt="door to yoga studio" width="225" height="300" class="floatleft">
      <h2>Upload your consent form.</h2>
      <p> In order to participate in <span class="studio">Path of Light Yoga Studio</span> classes, you must complete
        and sign a consent form. Please upload the form here in PDF format.</p>
      <form method="post" action="yoga_proc.php" enctype="multipart/form-data">
        <table>
          <tr>
            <td id="test">Customer Name</td>
            <td><input name="txtName" type="text" /></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><input name="txtEmail" id="txtEmail" onkeyup="CheckUser()" type="text" /><span id="spnError"></span></td>
          </tr>
          <tr>
            <td>Please upload the form here in PDF format:</td>
            <td>
              <input type="file" accept="application/pdf" name="consentForm" required="required"><br>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input id="mySubmit" type="submit" />
            </td>
          </tr>
        </table>

      </form>
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