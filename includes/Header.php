<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li>
        <a class="navbar-brand" href="#"><img alt="Y Logo" src="images/y_logo.png" class="logo"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="index.php">
          <img class="bannericons" alt="Home Icon" src="images/home.jfif">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <img class="bannericons" alt="Trending Icon" src="images/lightning.png">Moments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <img class="bannericons" alt="notification icon" src="images/bell.png">Notifications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <img class="bannericons" alt="Messages Icon" src="images/messages.png">Messages</a>
      </li>


      <li class="nav-item dropdown right">
        <a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          $sql = "SELECT `profile_pic` FROM `users` WHERE `user_id`='$userId'";
          $rsProd = mysqli_query($con, $sql) or die("failed" . mysqli_error($con));

          $rowProd = mysqli_fetch_array($rsProd);

          if (!empty($rowProd["profile_pic"])) {
            $profile_pic = "images/profilepics/" . $rowProd["profile_pic"];
          } else {
            $profile_pic = "images/profilepics/ElonSilouette.jpg";
          }
          echo '<img class="bannericons" alt="Profile pic" src="' . $profile_pic . '">';

          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="logout.php">Logout</a>
          <a class="dropdown-item" href="edit_photo.php">Edit Profile Picture</a>

        </div>
      </li>
    </ul>

    <form class="form-inline my-2 my-lg-0" action="search.php">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>