<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Record</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <nav class="navbar navbar-inverse" style="border: none;">
          <div class="row">
          <div class="col-sm-4 col-lg-4 col-md-4">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="#" style="font-size: 20px;">WebSiteName</a>
          </div>
          </div>
          <div class="col-sm-8 col-lg-8 col-md-8">
          <div class="collapse navbar-collapse first" id="myNavbar">
              <ul class="nav nav-pills nav-justified">
                <li><a href="formnow.php">SignUp</a></li>
                <li><a href="formnowlogin.php">Login</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
                <li  class="active"><a href="deleterecord.php">Delete Record</a></li>
                <li><a href="addcontent.php">Add Content</a></li>
                <li><a href="readcontent.php">Read Writeups</a></li>
              </ul>
          </div>
          </div>
          </div>
        </nav>
      
<h1>Delete Record</h1>
<p style="text-align: right;"> <?php 
  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
    echo $_SESSION['uid'];
  }
  else{
  echo "Please Log In";
  }
  ?></p>
  <form action="delete.php" method="POST">
  <button type="submit" class="btn btn-default">Delete yourself from our records.</button>
  </form><br>

  <br><br>
  <form action="logout.php" method="POST">
  <button type="submit" class="btn btn-default">Logout</button>
  </form>
</div>
</body>
</html>