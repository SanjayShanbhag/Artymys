<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
        $sql = "SELECT id FROM wyri WHERE uid = '$uid'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        if($num < 1){
            header('Location: profile.php');
        }
		$sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$dp = $row['dp'];
        $val1 = 1;
        $sql = "SELECT id FROM notifs WHERE seenstats = '$val1' AND nto = '$uid'";
        $result = $conn->query($sql);
        $notno = mysqli_num_rows($result);
	}else{
		header('Location: formnowlogin.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Would You Read It? - Artymys</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style type="text/css">
       p{
          font-family: 'Montserrat', sans-serif;
          font-size: 15px;
        }
    </style>
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
    padding-top:0px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    top:12px;
    left: 17px;
    padding:5px 10px;
    z-index: 2;
   
}
.dert p{
    margin-left: 55px;
}
.cont p{
    margin-left: 55px;
    margin-right: 10px;
}
.cont{
    background-color: #EFEBE9;
    border-radius: 5px;
    box-shadow: 4px 4px 4px #EDE7F6;
}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
    		$(".loader").fadeOut("slow");
		})
	</script>
    <script type="text/javascript">
    function loadDoc(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var foo = JSON.parse(xhttp.responseText);
                        document.getElementById("reacs").innerHTML = foo[0];
                        document.getElementById("like").innerHTML = foo[1];

                    }
                }
                xhttp.open("GET", "wyrisyes.php?id="+<?php echo $id;?>, true);
                xhttp.send();
            }
            function loadDoc1(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var foo = JSON.parse(xhttp.responseText);
                        document.getElementById("ulike").innerHTML = foo[1];
                        document.getElementById("reacs").innerHTML = foo[0];
                    }
                }
                xhttp.open("GET", "wyrino.php?id="+<?php echo $id;?>, true);
                xhttp.send();
            }
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
                                    if(isset($dp) && !empty($dp)){
                                       echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><img src='".$dp."' style='width: 20px; height: 20px; border-radius: 50px; margin-right: 10px;'/>" .$_SESSION['uid']."<span class='caret'></span></a>"; 
                                   }else{
                                    echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><img src='uploads/alternate2.png' style='width: 20px; height: 20px; border-radius: 50px; margin-right: 10px;'/>" .$_SESSION['uid']."<span class='caret'></span></a>";
                                   }
                                
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
        			<a href="feed.php" style="text-decoration: none;"><img src="images/feed.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Artymys Feed </a>
        			<br><br>
        			<a href="addnovel.php" style="text-decoration: none;"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Book </a>
        			<br><br>
        			<a href="addcontent.php" style="text-decoration: none;"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Post </a>
      				<br><br>
        			<a href="mynotifs.php" style="text-decoration: none;"><img src="images/notification.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Notifications <span style="background-color: #4FC3F7; min-width: 20px; min-height: 10px; color: #FFFFFF; display: inline-block; border-radius: 3px;"> <?php echo $notno;?> </span></a>
                    <br><br>
                    <a href="wyri.php" style="text-decoration: none;"><img src="images/wyri.png" style="width: 20px; height: 20px; margin-right: 5px;"/>  Would You Read It? </a>
        		</div>
                <div class="col-sm-1 col-lg-1 col-md-1">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <br>
                    <?php
                        $sql = "SELECT * FROM wyri WHERE uid = '$uid'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()){
                            $id = $row['id'];
                            $sql1 = "SELECT dp,verified FROM blogsignup WHERE uid = '$uid'";
                            $result1 = $conn->query($sql1);
                            $row1 = $result1->fetch_assoc();
                            echo "<a href='wyrisr.php?id=".$id."' style='text-decoration: none;'>";
                                echo "<div class='cont'>";
                                    if($row1['verified'] == 1){
                                        $check1 = 1;
                                    }else{
                                        $check1 = 0;
                                    }
                                    if($check1 == 1){
                                ?>
                                    <div class="item">
                            
                                        <span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                    <?php
                    
                                        if(isset($row1['dp'])){
                                            echo"<img src='".$row1['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                        }else{
                                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                        }
                                    ?>
                                    </div>
                                <?php
                                    }else{
                                        if(isset($row1['dp'])){
                                            echo"<img src='".$row1['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                        }else{
                                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                        }
                                    }
                                    echo "<h4 style='display: inline; margin-left: 20px; color: #000000;'>".$uid."</h4>";
                                    $body = $row['content'];
                                    $check = 0;
                                    if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                                        $whitespaceposition = strpos($body," ",295); 
                                        $body = substr($body, 0, $whitespaceposition);
                                        $check = 1;
                                    }
                                    if($check == 0){
                                        echo "<p>".$body."</p>";
                                    }else{
                                        echo "<p>".$body." ...</p>";
                                    }
                                    $yes = $row['yes1'];
                                    $no = $row['no1'];
                                    $time = $row['date1'];
                                    date_default_timezone_set("Asia/Kolkata"); //setting default timezone based on your location
                                    $curdatetime = date("Y-m-d H:i:s"); //current datetime

                                    if($curdatetime > $time){
                                        $diff = abs(strtotime($curdatetime) - strtotime($time));
                                    }else{
                                        $diff = abs(strtotime($time) - strtotime($curdatetime));
                                    }
                                    $diff = $diff/60;
                                    $diff = $diff/60;
                                    $diff = round($diff,2);
                                    if($diff <= 24){
                                        $datetime = explode(" ",$time);
                                        $time1 = $datetime[1];
                                        $timearr = explode(":", $time1);
                                        $time1 = $timearr[0].":".$timearr[1];

                                        $timedisp = $time1;
                                    }else{
                                        $datetime = explode(" ",$time);
                                        $date = $datetime[0];
                                        $time1 = $datetime[1];
                                        $datearr = explode("-", $date);
                                        $date = $datearr[2]."/".$datearr[1]."/".$datearr[0];
                                        $timearr = explode(":", $time1);
                                        $time1 = $timearr[0].":".$timearr[1];

                                        $timedisp = $time1." ".$date;
                                    }
                                    $reactions = $yes + $no;
                                    echo "<p class='right'>".$timedisp."</p>";
                                    echo "<p class='left'>".$reactions." Reactions </p>";
                                    echo "<br><br>";
                                echo "</div>";
                            echo "</a>";
                        }

                    ?>
                </div>
            </div>
        </div>
        <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
    </body>
</html>