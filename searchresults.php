<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$dp = $row['dp'];
		if($_POST['query']){
			$query = $_POST['query'];
		}else{
			header('location: flw.php');
		}
	}else{
		header('location: formnowlogin.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $query." - Artymys Search Results"?></title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <style type="text/css">
     html{
        position: relative;
        min-height: 100%;
    }
    html,body{
  margin:0;
  padding:0;
}
                .footer{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background:#ccc;
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
				.left{
    				float: left;
				}
				.right{
    				float: right;
				}
				#custom-search-input {
        			margin:0;
        			margin-top: 0px;
        			margin-bottom: 0px;
        			padding: 0;
    			}
 
    			#custom-search-input .search-query {
        			padding-right: 3px;
        			padding-right: 4px \9;
        			padding-left: 3px;
        			padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        			margin-bottom: 0;
                    -webkit-border-radius: 3px;
                    -moz-border-radius: 3px;
        			border-radius: 3px;
    			}
 
    			#custom-search-input button {
        			border: 0;
        			background: none;
        /** belows styles are working good */
        			padding: 2px 5px;
        			margin-top: 2px;
        			position: relative;
        			left: -28px;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        			margin-bottom: 0;
                   -webkit-border-radius: 3px;
                   -moz-border-radius: 3px;
                   border-radius: 3px;
        			color:#D9230F;
    			}
    			#search input[type=text]{width:430px !important;}
    			.item {
    				position:relative;
    				padding-top:20px;
    				display:inline-block;
				}
				.notify-badge{
    				position: absolute;
    				top:30px;
    				left: 11px;
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
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #1565C0; border: none;">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-left" href="index.php"><img src="images/s.png" style="height: 35px; margin-top: 8px;"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-left">
                                <div id="custom-search-input">
                                <form class="navbar-form navbar-left" method="POST" action="searchresults.php" id="search">
                                    <div class="input-group">
                                        <input type="text" class="search-query form-control" placeholder="Search" id="query" name="query"/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="submit">
                                                <span class=" glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                </div>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <?php
                                if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
                                echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><img src='".$dp."' style='width: 20px; height: 20px; border-radius: 50px; margin-right: 10px;'/>" .$_SESSION['uid']."<span class='caret'></span></a>";
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
        </div>
        <br><br><br><br>
        <div class="container">
        	<div class="row">
        		<div class="col-sm-3 col-md-3 col-lg-3" style="border-right: solid; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;">
        		<h2 style="color: #636363;"> Feed </h2>
        		<hr>
        			<a href="addnovel.php"><img src="images/feed.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Artymys Feed </a>
        			<br><bR>
        			<a href="addnovel.php"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Book </a>
        			<br><bR>
        			<a href="addcontent.php" class="center-block"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Post </a>
        		</div>
        		<div class="col-lg-9 col-md-9 col-sm-9">
        			<h2 style="color: #636363;"> Search Results for <?php echo $query;?>: </h2>
        			<hr style="border-width: 3px;">
        			<?php
        				$sql = "SELECT * FROM blogsignup WHERE uid LIKE '".$query."%' ORDER BY followercount DESC";
        				$result = $conn->query($sql);
        				$num = mysqli_num_rows($result);
        				if($num == 0){
        					echo "<h5 style='color: #636363;'>No Users Found for ".$query."</h5>";
        				}
        				while($row = $result->fetch_assoc()){
        					echo "<div class='row'>";
        						echo "<div class='col-sm-1 col-lg-1 col-md-1'>";
        							if($row['verified'] == 1){
                                		$check1 = 1;
                            			}else{
                                			$check1 = 0;
                            			}
                            			if($check1 == 1){
                    ?>
                            		<div class="item">
                            
                                		<span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                		<?php
                    
                                			if(isset($row['dp'])){
                                    			echo"<img src='".$row['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; z-index: 1;'>";
                                			}else{
                                    			echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative;'>";
                                			}
                            
                            			?>
                            		</div>
                            		<?php
                        				}else{
                            				if(isset($row['dp'])){
                                    			echo"<img src='".$row['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative;'>";
                                			}else{
                                    			echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative;'>";
                                			}
                        				}
                       		 	echo "</div>";
                        		echo "<div class='col-sm-11 col-md-11 col-lg-11'>";
        							echo "<h4 style='color: #636363; '>".$row['uid']."</h4>";
        							if(isset($row['emp']) && !empty($row['emp'])){
        								echo "<p style='color: #636363;'><img src='images/emp.png' style='width: 20px; height: 20px; margin-right: 10px;'/>".$row['emp']."</p>";
        							}
        							if(isset($row['descript']) && !empty($row['descript'])){
        								echo "<p style='color: #636363;'><img src='images/descript.png' style='width: 20px; height: 20px; margin-right: 10px;'/>".$row['descript']."</p>";
        							}
        							$applauds = $row['applaudsuser'];
                            		$censures = $row['censuresuser'];
                            		$followers = $row['followercount'];
                            		$reads = $row['totalreads'];
                            		$popularitypoints = $applauds/5;
                            		$censures1 = $censures/3;
                            		$popularitypoints = $popularitypoints - $censures1;
                            		$popularitypoints = $popularitypoints + ($followers/4);
                            		$popularitypoints = $popularitypoints + ($reads/13);
                            		$popularitypoints = round($popularitypoints, 2);
                            		if($popularitypoints > 1000){
                                		$popularitypoints = $popularitypoints/1000;
                                		$popularitypoints = round($popularitypoints,1);
                                		$popularitypoints = $popularitypoints."k";
                            		}
                            		echo "<p style='color: #636363;'><img src='images/pop.png' style='width: 20px; height: 20px; margin-right: 10px;'/>".$popularitypoints." Popularity Stats</p>";
                            		$num = $row['followercount'];
                            		if(!isset($num)){
                                		$num = 0;
                            		}
                            		if($num > 1000){
                                		$num = $num/1000;
                                		$num = round($num,1);
                                		$num = $num."k";
                            		}
                            		echo "<p style='color: #636363;'><img src='images/follower.png' style='width: 20px; height: 20px; margin-right: 10px;'/>".$num." Followers</p>";
                            		echo "<a href='userprofile.php?user=".$row['uid']."'>Visit Profile</a>";
        						echo "</div>";
        					echo "</div>";
        					echo "<hr>";
        				}
        			?>
        			<?php
        				$sql = "SELECT * FROM blogdata2 WHERE title LIKE '".$query."%' ORDER BY applaud DESC";
        				$result = $conn->query($sql);
        				$num = mysqli_num_rows($result);
        				if($num > 0){
        					echo "<h4 style='color: #636363;'> Search results from stories for search query ".$query.":</h4>";
        				}
        				while($row = $result->fetch_assoc()){
        					echo "<a href='readspecific.php?id=".$row['id']."' style='color: #000000; font-size: 20px;'>".$row['title']."</a>";
        					if(isset($row['articleImage']) && !empty($row['articleImage'])){
        						echo "<img src='".$row['articleImage']."' style='width: 100%; height: 200px;' class='center-block'/>";
        					}
        					$body = $row['content'];
                            if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                                $whitespaceposition = strpos($body," ",295); 
                                $body = substr($body, 0, $whitespaceposition);
                             }
                             echo "<p>".$body." ...</p>";
                             echo "<div class='row'>";
                             	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                             		echo "<img src='images/applaud1.png' style='width: 20px; height: 20px;' class='center-block'/>";
                             		echo "<p style='text-align: center;'>".$row['applaud']." Applauds</p>";
                             	echo "</div>";
                             	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                             		echo "<img src='images/censure.png' style='width: 20px; height: 20px;' class='center-block'/>";
                             		echo "<p style='text-align: center;'>".$row['censure']." Censures</p>";
                             	echo "</div>";
                             	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                             		echo "<img src='images/reads.png' style='width: 20px; height: 20px;' class='center-block'/>";
                             		echo "<p style='text-align: center;'>".$row['totalreads']." Reads</p>";
                             	echo "</div>";
                             	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                             		echo "<img src='images/rated.png' style='width: 20px; height: 20px;' class='center-block'/>";
                             		echo "<p style='text-align: center;'>".$row['rating']." Stars</p>";
                             	echo "</div>";
                             echo "</div>";
                             echo "<hr>";
        				}
        			?>
        		</div>
        	</div>
        </div>
        <br><br><br>
        <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
    </body>
</html>
