<?php
	session_start();
    include 'databh.php';

    $id = $_GET['id'];
    if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
       echo "<script>
        window.location.href = 'formnowlogin.php'
        </script>";
  }
    $uid = $_SESSION['uid'];
    $sql1 = "SELECT * FROM bookdetails WHERE id = '$id'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $user = $row1['uid'];

    if($uid!=$user){
        echo "<script>
        window.location.href = 'logout.php'
        </script>";
    }
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title> Artymys - Update Book </title>
		<link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<meta name="theme-color" content="#1A237E">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	 	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
 	 	
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
          					<a class="navbar-brand" href="#">Artymys</a>
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
                                    <ul class="dropdown-menu" style="background-color: #1A237E;">
                                    <li><a href="formnow.php">Sign Up</a></li>
                                    <li><a href="formnowlogin.php">Login</a></li>
                                    <li><a href="changepassword.php">Change Password</a></li>
                                    <li><a href="delete.php">Delete Account</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
							</ul>
        				</div><!--/.nav-collapse -->
        			</div>
			    </nav>
            </div>
                <div class="container">
                <br><br><br><br>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM bookchaps WHERE bookid='$id'";
                            $result = $conn->query($sql);
                            $num = mysqli_num_rows($result);
                            $chap = 1;
                            echo "<h1 style='color: #E64A19;'>".$row1['title']."</h1><br>";
                            while($row = $result->fetch_assoc()){
                                $bid = $row['bookid'];
                                echo "<br><br><h4> Chapter: ".$row['chapno']." </p>";
                                $title = $row['title'];
                                $chapno = $row['chapno'];
                                echo "<a href='addchap.php?bid=".$bid."&ch=".$chapno."'>".$title."</a>";
                                echo "<p>".$row['descript']."</p>";
                                $chap = $chap +1;
                            }
                            if($num == 0){
                                echo "<br><h4> You have not uploaded any Chapters yet. You can do so now. </h4>";
                            }
                        ?>
                        <br>
                        <a href="addchap.php?bid=<?php echo $id;?>" class="btn btn-default">Add New Chapter </a> 
                        
                    </div>
                </div>