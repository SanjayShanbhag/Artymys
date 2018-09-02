<?php
	session_start();
	include 'databh.php';
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM bookdetails WHERE uid = '$uid'";
	$result = $conn->query($sql);

	$arrayContent = array();

	$index = 0;

	while($row = $result->fetch_assoc()){
     $arrayContent[$index] = $row;
     $index++;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Artymys </title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<meta name="theme-color" content="#1A237E">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	 	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
 	 	<link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
    	<script src="javascript/ninja-slider.js" type="text/javascript"></script>
    </head>
<body>

<div class="container">
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #1A237E; border: none;">
    				<div class="container">
        				<div class="navbar-header">
          					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            				<span class="sr-only">Toggle navigation</span>
            				<span class="icon-bar"></span>
            				<span class="icon-bar"></span>
            				<span class="icon-bar"></span>
          					</button>
          					<a class="navbar-brand" href="index.php">Artymys</a>
        				</div>
        				<div id="navbar" class="navbar-collapse collapse">
          					<ul class="nav navbar-nav navbar-right">
            					<li><a href="index.php">Home</a></li>
            					<li><a href="addnovel.php">Add Book</a></li>
            					<li><a href="readcontent.php">Read Content</a></li>
            					<li><a href="addcontent.php">Add Content</a></li>
            					<li><a href="#">Contact</a></li>
            					<?php
            					if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
                                echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>" .$_SESSION['uid']."<span class='caret'></span></a>";
                                }
                                else{
                                	echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>User<span class='caret'></span></a>";
                                	}
                                	?>
                                    <ul class="dropdown-menu">
                                    <li><a href="formnow.php">Sign Up</a></li>
                                    <li><a href="formnowlogin.php">Login</a></li>
                                    <li><a href="changepassword.php">Change Password</a></li>
                                    <li><a href="delete.php">Delete Account</a></li>
                                    <li><a href="logout.php">Logout </a></li>
                                    </ul>
                                </li>
							</ul>
        				</div><!--/.nav-collapse -->
        			</div>
			    </nav>
          <div class="row">
  
  <div class="col-sm-8 col-lg-8 col-md-8">
  <br><br><br><br>
  <h4> Please Select the Book to update:</h4><br><br>
   <?php
   if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
  $counter1 = 0;
  $uid = $_SESSION['uid'];
  $sql = "SELECT * FROM bookdetails WHERE uid='$uid'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    echo "<a style='color: #E64A19; font-size: 30px;' href='updatebook.php?id=".$row['id']."'>".$arrayContent[$counter1]['title']."</a><br>";
    echo nl2br("<br><p style='color: #808080'>".$arrayContent[$counter1]['descript']."</p><br>");
    echo "<p>Date Added: ".$arrayContent[$counter1]['dateadd']."</p><hr>";
    $counter1++;
  }
}else{
  $message = "Please Log In";
      echo "<script type ='text/javascript'>
    alert('$message');
    window.location.href='formnowlogin.php';
    </script>";
      $result = false;
}
  ?>
  </div>

  <br><br><br>
  <div class="col-sm-4 col-md-4 col-lg-4">
    <h3 style="color: #000000;"> Popular Titles </h3><br><br>
    <?php
      $counter1 = 0;
      $sql = "SELECT * FROM blogdata2";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc()){

        echo "<a style='color: #E64A19;' href='readspecific.php?id=".$row['id']."'>".$row['title']."</a>";
        $counter1++;
        echo "<br><br><br>";
            }
      ?>
  </div>
  </div>

</body>
</html>