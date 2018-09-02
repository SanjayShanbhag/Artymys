<?php
	session_start();
	include 'databh.php';
    if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
        header('location: formnowlogin.php');
    }
	
	$sql = "SELECT * FROM bookdetails";
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
		<title> Artymys - Read Books </title>
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
        <style type="text/css">
        p{
          color: #808080;
        }
        .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/box.gif') 50% 50% no-repeat rgb(249,249,249);
}
.item {
    position:relative;
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    top:40px;
    left: 17px;
    padding:5px 10px;
    z-index: 2;
   
}
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
</script>
    </head>
<body>
<div class="loader"></div>
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
                                    <ul class="dropdown-menu">
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
  <h2>Read Articles</h2>
  
 <div class="row">
 	<div class="col-sm-12 col-lg-12 col-md-12">
        <?php
        $counter1 = 0;
        $sql = "SELECT * FROM bookdetails";
        $result = $conn->query($sql);
        



        
            $counter=0;
        ?>
        <br><br>
        <div class="row">
            <?php
            while($counter<3){
                while($row = $result->fetch_assoc()){
            ?>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <?php
                echo "<div class='custo center-block' onclick='location.href=\"selectchapter.php?id=".$row['id']."\"' style='background-color: #FFFFFF; width: 80%; height: 400px; box-shadow: 4px 4px 4px #EDE7F6; cursor: pointer;'>";
                ?>
                    <?php
                        echo "<h4 style='color: #E64A19; text-align: center; margin-top: 50px;'>".$arrayContent[$counter1]['title']."</h4><br>";
                        if(isset($row['articleImage'])){
                            echo "<img src='".$row['articleImage']."' style='width: 100%; height: 150px;'>";
                        }else{
                            echo"<img src='images/Alternate.png' style='width: 100%; height: 150px; opacity: 0.85'>";
                        }
                        $sql2 = "SELECT * FROM blogsignup WHERE uid='".$arrayContent[$counter1]['uid']."'";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                    
                                $sql2 = "SELECT * FROM blogsignup WHERE uid='".$row['uid']."'";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        if($row2['verified'] == 1){
                                $check1 = 1;
                            }else{
                                $check1 = 0;
                            }
                            if($check1 == 1){
                                ?>
                            <div class="item">
                            
                                <span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                <?php
                    
                                if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px; z-index: 1;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }
                            
                            ?>
                            </div>
                            <?php
                        }else{
                            if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }
                        }
                                echo "<h5 style='text-align: right; color: #E64A19; display: inline; position: relative; left: 15px; top: 10px;'>".$arrayContent[$counter1]['uid']."</h5>";
                                echo "<div class='row'>";
                                    echo "<hr style='width: 100px; border-width: 2px; border-color: #1A237E; border-radius: 10px;'>";
                                    echo "<div class='col-sm-6 col-md-6 col-lg-6'>";
                                        echo "<img src='images/applaud1.png' style='width: 20px; height: 20px;' class='center-block'>";
                                        if(isset($arrayContent[$counter1]['applaud'])){
                                            echo "<p style='text-align: center;'>".$arrayContent[$counter1]['applaud']." Applauds</p>";
                                        }else{
                                            echo "<p style='text-align: center;'> No Applauds Yet </p>";
                                        }
                                    echo "</div>";
                                    echo "<div class='col-sm-6 col-md-6 col-lg-6'>";
                                        echo "<img src='images/censure1.png' style='width: 20px; height: 20px;' class='center-block'>";
                                        if(isset($arrayContent[$counter1]['censure'])){
                                            echo "<p style='text-align: center;'>".$arrayContent[$counter1]['censure']." Censures</p>";
                                        }else{
                                            echo "<p style='text-align: center;'> No Censures Yet </p>";
                                        }
                                    echo "</div>";
                                echo "</div>";
                    ?>
                </div>
            </div>
            <?php
                $counter1++;
                }
            ?>

        </div>
        <?php
                echo "<br>";
               $counter++; 
                }
            ?>

    


    </div>
</div>
  <br><br><br>
  
  </div>

</body>
</html>