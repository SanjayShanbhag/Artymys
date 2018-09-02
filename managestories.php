<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
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
    <title> Manage Your Stories - Artymys</title>
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
            .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('images/box.gif') 50% 50% no-repeat rgb(249,249,249);
}
html,
body {
  margin: 0;
  height: 100%;
}
body {
  min-height: 100%;
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
                .feedcard{
    box-shadow: 2px 2px 2px #EDE7F6;
    background-color: #FFFFFF;
    border-radius: 2px;
    border: solid;
    border-width: 1px;
    border-color: #E0E0E0;
}
.feedcard p{
    margin-left: 10px; 
}
.bton{
	background-color: #0D47A1;
	height: 40px;
	border-radius: 3px;
	text-align: center;
	cursor: pointer;
	padding: 10px;
	box-shadow: 1px 1px 4px #000000;
	color: #FAFAFA;
	text-decoration: none;
}
.bton:hover{
	color: #FAFAFA;
	text-decoration: none;
}
.bton1{
	background-color: #1E88E5;
	height: 40px;
	border-radius: 3px;
	text-align: center;
	cursor: pointer;
	padding: 10px;
	box-shadow: 1px 1px 4px #000000;
	color: #FAFAFA;
	text-decoration: none;
}
.bton1:hover{
	color: #FAFAFA;
	text-decoration: none;
}
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            bottom: 0;
            background: #212121;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            z-index: 100;
        }
        #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            background: #F5F5F5;
            width: 500px;
            height: 270px;
            margin-left: -250px; /*Half the value of width to center div*/
            margin-top: -250px; /*Half the value of height to center div*/
            z-index: 200;
            border-radius: 5px;
        }
        #popupclose {
            float: right;
            padding: 10px;
            cursor: pointer;
        }
        .popupcontent {
            padding: 10px;
        }
        .notihead{
            background-color: #D50000;
            padding: 3px;
            box-shadow: 0px 4px 4px #636363;
        }
            </style>
    		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script type="text/javascript">
				$(window).load(function() {
    				$(".loader").fadeOut("slow");
				})
			</script>
			<script type="text/javascript">
				$(document).ready(function(){
            		$.ajax({
                		type: "GET",
                		url: "get_mydata.php",
                		data: {
                    		'tye': 1,
                		},
                		success: function(data){
                    		$('.stoplace').append(data);
                		}
            		});
            	});
			</script>
			<script type='text/javascript'>
				function loadstories(){
					document.getElementById('stoplace').innerHTML = "";
					$.ajax({
                		type: "GET",
                		url: "get_mydata.php",
                		data: {
                  		'tye': 1,
                		},
                		success: function(data){
                    		$('.stoplace').append(data);
                		}
            		});
            		bton1.style.backgroundColor = '#1E88E5';
            		bton.style.backgroundColor = '#0D47A1';
				}
				function loadBooks(){
					document.getElementById('stoplace').innerHTML = "";
					$.ajax({
                		type: "GET",
                		url: "get_mydata.php",
                		data: {
                    		'tye': 2,
                		},
                		success: function(data){
                    		$('.stoplace').append(data);
                		}
            		});
            		bton1.style.backgroundColor = '#0D47A1';
            		bton.style.backgroundColor = '#1E88E5';
				}
                function loadPopup(b){
                    alert("Sanjay "+b);
                    // Initialize Variables
                    var closePopup = document.getElementById("popupclose");
                    var overlay = document.getElementById("overlay");
                    var popup = document.getElementById("popup");
                    // Close Popup Event
                    closePopup.onclick = function() {
                        overlay.style.display = 'none';
                        popup.style.display = 'none';
                    };
                    // Show Overlay and Popup
                    overlay.style.display = 'block';
                    popup.style.display = 'block';
                    var a = document.getElementById('yes');
                    a.href = "deletestory.php?id="+b;
                }
                function closePop(){
                    overlay.style.display = 'none';
                        popup.style.display = 'none';
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
                            <a class="navbar-left" href="index.php"><img src="images/s.png" style="height: 35px; width: 120px; margin-top: 8px;"></a>
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
        <div class="container-fluid" style="background-color: #FAFAFA; min-height: 100%; margin: 0;">
        <br><br><br><br>
        <div class="container">
        	<div class="row">
        		<div class="col-lg-2 device-lg visible-lg">
                <div class="feedside" style="position: fixed; float: left;">
        		<h2 style="color: #636363;"> Feed </h2>
        		<hr>
        			<a href="feed.php"><img src="images/feed.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Artymys Feed </a>
        			<br><br>
        			<a href="addnovel.php"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Book </a>
        			<br><br>
        			<a href="addcontent.php" class="center-block"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Post </a>
                    <br>
                    <a href="mynotifs.php" style="text-decoration: none;"><img src="images/notification.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Notifications <span style="background-color: #4FC3F7; min-width: 20px; min-height: 10px; color: #FFFFFF; display: inline-block; border-radius: 3px; text-align: center;"> <?php echo $notno;?> </span></a>
                    <br><br>
                    <a href="wyri.php" style="text-decoration: none;"><img src="images/wyri.png" style="width: 20px; height: 20px; margin-right: 5px;"/>  Would You Read It? </a>
                    </div>
        		</div>

        		<div class="col-lg-7 col-md-7 col-sm-7">
					<div class="device-sm visible-sm device-xs visible-xs device-md visible-md ">
                    	<div>
                        	<h2 style="color: #636363;"> Feed </h2>
                        	<hr>
                        	<a href="feed.php"><img src="images/feed.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Artymys Feed </a>
                        	<br><br>
                        	<a href="addnovel.php"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Book </a>
                        	<br><br>
                        	<a href="addcontent.php" class="center-block"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Add Post </a>
                        	<br>
                        	<a href="mynotifs.php" style="text-decoration: none;"><img src="images/notification.png" style="width: 20px; height: 20px; margin-right: 5px;"/> Notifications <span style="background-color: #4FC3F7; min-width: 20px; min-height: 10px; color: #FFFFFF; display: inline-block; border-radius: 3px; text-align: center;"> <?php echo $notno;?> </span></a>
                        	<br><br>
                        	<a href="wyri.php" style="text-decoration: none;"><img src="images/wyri.png" style="width: 20px; height: 20px; margin-right: 5px;"/>  Would You Read It? </a>
                    	</div>
                    	<br>
                	</div>
        			<div class='stoplace' id='stoplace'>

        			</div>
        		</div>
        		<div class = 'col-sm-3 col-lg-3 col-md-3'>
        			<br>
        			<a class='bton center-block' id='bton' onclick='loadstories()'>Your Stories</a>
        			<br>
        			<a class='bton1 center-block' id='bton1' onclick='loadBooks()'>Your Books</a>
        		</div>
        	</div>
        </div>
       </div>
       <div id="overlay"></div>
            <div id="popup">
                <div class="notihead">
                    <div class="popupcontrols">
                        <span id="popupclose">X</span>
                    </div>
                    <h2 style="text-align: center; color: #EEEEEE;">Delete Story</h2>
                </div>
                <br>
                    <div class="popupcontent">
                        <h4> Are you sure, you want to delete this story?</h4>
                        <h4> This is not reversible as all records of this story will be deleted by us.</h4>
                        <br>
                        <div class="row">
                            <div class="col-sm-4 col-lg-4 col-md-4">
                            </div>
                            <div class="col-sm-2 col-lg-2 col-md-2">
                                <a class='bton1 center-block' id="yes"> Yes </a>
                            </div>
                            <div class="col-sm-2 col-lg-2 col-md-2">
                                <a class='bton1 center-block' onclick="closePop()"> No </a>
                            </div>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                            </div>
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