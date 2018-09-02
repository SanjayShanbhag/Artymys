<?php
	session_start();
    include 'databh.php';
  $id = $_GET['bid'];
  if(isset($_GET['ch'])){
        $chno = $_GET['ch'];
        $sql1 = "SELECT title, descript, content FROM bookchaps WHERE bookid ='$id' AND chapno = '$chno'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
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
    <script type="text/javascript" src="javascript/wysiwyg.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
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
                <br><br><br><br>
                <div class="container">
                <?php
                    if(isset($_GET['ch'])){
                        echo "<h2> Edit Chapter: </h2><br><br>";
                    }else{
                ?>
  <h2>Add Chapter: </h2><br><br>
  <?php
    }
  ?>
  
  <form class="form-horizontal" name="myform" id="myform" action="addchaprocess.php?bid=<?php echo $id; if(isset($_GET['ch'])){echo '&ch='.$chno;}?>" method="POST">
    <div class="form-group">
      <h4>Add Title:</h4><br>
      <div class="col-sm-12 col-lg-12 col-md-12">
        <?php
            if(isset($_GET['ch'])){
                echo '<input type="text" class="form-control" name="title" placeholder="Enter Content Title" value="'.$row1['title'].'">';
            }else{
        ?>
        <input type="text" class="form-control" name="title" placeholder="Enter Content Title">
        <?php
        }
        ?>
      </div>
    </div>
    <div class="form-group">
        <br><br>
        <h4> Add Chapter Description </h4>
        <div class="col-sm-12 col-lg-12 col-md-12">
        <?php
            if(isset($_GET['ch'])){
                echo '<input type="text" class="form-control" name="descript" placeholder="Description" value="'.$row1['descript'].'">';
            }else{
        ?>
        <input type="text" class="form-control" name="descript" placeholder="Add Description">
        <?php
            }
        ?>
        </div>
    </div>
    <div class="form-group">
        <br>
      <h4>Add Content:</h4><br>
      
      <div class="col-sm-12 col-lg-12 col-md-12">      
      <?php
            if(isset($_GET['ch'])){
                echo '<TEXTAREA  class="tinymce" name="content" id="content">'.$row1['content'].'</TEXTAREA>';
            }else{
        ?>    
        <TEXTAREA  class="tinymce" name="content" id="content"></TEXTAREA>
        <?php 
            }
        ?>
       </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"> Submit</button>
      </div>
    </div>
  </form>

  </div>

</body>
</html>
	