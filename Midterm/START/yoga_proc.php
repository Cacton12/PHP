<?php include("connect.php"); ?>
<?php
//4U2DO - write that will connect to the DB. Then grab the user's form data from the post.
//		then insert a record into the signup table of the database and redirect the user back to index.php
//		then add logic that will query the signup table to see if any records already exist for that email address
//these are defined as constants
  session_start();
  if (isset($_POST["txtName"], $_POST["txtEmail"], $_POST["cboClass"])) {
      $name = $_POST["txtName"];
      $email = $_POST["txtEmail"];
      $class = $_POST["cboClass"];
      AddRecord($con, $name, $email, $class);
  }

      function AddRecord($con, $name, $email, $class) {

        $sqlSelect = "SELECT `name`, `email`, `class` FROM `signup` WHERE `email` = '$email'";
    
        $result = mysqli_query($con, $sqlSelect);
        if (mysqli_affected_rows($con) == 1) {
            $row = mysqli_fetch_assoc($result);
            $dbclass = $row['class'];
            if($dbclass == $class){
                echo "<script>
                alert('User already signed up');
                window.location.href = 'index.php';
            </script>";
            }
        }
        else{
    //insert statement
            $sql = "INSERT INTO `signup`(`name`, `email`, `class`) VALUES ('$name','$email','$class')";
        
            //run the sql
            mysqli_query($con, $sql);
            if (mysqli_affected_rows($con) == 1) {
                echo "<script>
                window.location.href = 'index.php'
                alert('SIGNUP SUCCESSFUL');
                    </script>";
            }
            else {
                echo "<script>
                    window.location.href = 'index.php'
                        alert('SIGNUP FAILED');
                    </script>";
            }
            
        }
}
    