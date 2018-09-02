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
        $to = $_GET['to'];
	}else{
		header('location: formnowlogin.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $to." - Send Message"?></title>
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
  min-height: 100%;
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
    top:56px;
    left: 61px;
    padding:5px 10px;
    z-index: 2;
   
}
.messagesDiv{
    background-color: #E53935;
    display: inline-block;
    float: right;
    clear: right;
    border: none;
    border-radius: 5px;
    color: #EDE7F6;
    margin-top: 10px;
}
.messagesDiv p{
    float: right;
    clear: right;
    color: #EDE7F6;
    padding-left: 8px;
    padding-right: 8px;
}
.messagesDiv h4{
    padding-left: 8px;
    padding-right: 8px;
}
.messagesDiv1 h4{
    padding-left: 8px;
    padding-right: 8px;
}
.messagesDiv1{
    background-color: #5C6BC0;
    display: inline-block;
    float: left;
    clear: left;
    border: none;
    border-radius: 5px;
    color: #EDE7F6;
    margin-top: 10px;
    padding-left: 8px;
    padding-right: 8px;
}
.messagesDiv1 p{
    float: left;
    clear: left;
    color: #EDE7F6;
}
.style-5 textarea {
  padding: 10px;
  border: solid 2px #fff;
  box-shadow: inset 1px 1px 2px 0 #707070;
  transition: box-shadow 0.3s;
  resize: none;
  width: 52%;
}
.style-5 textarea:focus,
.style-5 textarea.focus {
    outline: none;
  box-shadow: inset 1px 1px 2px 0 #c9c9c9;
}
    			</style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
    		$(".loader").fadeOut("slow");
		})
		function sendPM(){
            var message = $("#message");
            var sendto = $("#sendto");
            var url = "sendmes.php";
            $.post(url,{message: message.val(), to: sendto.val()}, function(data){
                 $('.stoplace').append(data);
            });
        }
        setInterval(function() {
  // method to be executed;
            var to = "<?php echo $to; ?>";
            $.ajax({
                type: "GET",
                url: "get_message.php",
                data: {
                    'to': to
                },
                success: function(data){
                    $('.stoplace').append(data);
                }
            });
        }, 5000);
	</script>
	
	</head>
	<body>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
        <br><br><br><br>
        <div class="container">
        	<div class="row">
        		<div class="col-sm-2 col-md-2 col-lg-2">
                <div class="feedside" style="position: fixed;">
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
                <div class="col-sm-1 col-lg-1 col-md-1">
                </div>
                <div class="col-sm-8 col-lg-8 col-md-8">
                    <div class="stoplace">
                    <br>
                    <?php
                        $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$to'";
                                $result12 = $conn->query($sql12);
                                $row12 = $result12->fetch_assoc();
                        if($row12['verified'] == 1){
                                    $check1 = 1;
                                }else{
                                    $check1 = 0;
                                }
                                if($check1 == 1){
                                ?>
                                    <div class="item">
                            
                                        <span class="notify-badge"><img src="images/verified1.png" style="width: 30px; height: 30px;"></span>
                                <?php
                    
                                        if(isset($row12['dp'])){
                                            echo"<img src='".$row12['dp']."' style='height: 90px; width: 90px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                        }else{
                                            echo "<img src='uploads/alternate2.png' style='height: 90px; width: 90px; border-radius: 50px; position: relative; left: 10px;'>";
                                        }
                                ?>
                                    </div>
                                <?php
                                }else{
                                    if(isset($row12['dp'])){
                                        echo"<img src='".$row12['dp']."' style='height: 90px; width: 90px; border-radius: 50px; position: relative; left: 10px;'>";
                                    }else{
                                        echo "<img src='uploads/alternate2.png' style='height: 90px; width: 90px; border-radius: 50px; position: relative; left: 10px;'>";
                                    }
                                }
                                echo "<h1 style='display: inline; margin-left: 30px; color: #636363;'>".$to."</h1>";
                                echo "<br><br>";
                                $uid = $_SESSION['uid'];
                                $sql = "SELECT * FROM message1 WHERE to1 = '$uid' AND fr = '$to' OR fr = '$uid' AND to1 = '$to' ORDER BY id ASC";
                                $result = $conn->query($sql);
                                if(mysqli_num_rows($result) > 0){
                                     while($row = $result->fetch_assoc()){
                                            echo "<div class='row'>";
                                            if($row['fr'] == $uid){
                                                
                                                echo "<div align='right' class='messagesDiv'>";
                                                    
                                                        echo "<h4>".$row['messag']."</h4>";
                                                        echo "<p>".$row['date1']."</p>";
                    
                                                echo "</div>";
                                            }else{

                                                echo "<div align='left' class='messagesDiv1'>";
                                                    
                                                        echo "<h4>".$row['messag']."</h4>";
                                                        echo "<p>".$row['date1']."</p>";
                    
                                                echo "</div>";
                                            }
                                            echo "</div>";
                                            $idmes = $row['id'];
                                            $stat = 0;
                                            $sql2 = "UPDATE message1 SET seenstat = '$stat' WHERE id = '$idmes'";
                                            $result2 = $conn->query($sql2);
                                        }
                                    }
                    ?>
                    </div>
                    <div class="style-5">
                    <form action="javascript:sendPM();" name="mess" id="mess" action="POST">
                        <br><br>
                        <textarea name="message" id="message" class="center-block"></textarea><br>
                        <input type="hidden" value="<?php echo $to; ?>" id="sendto"/>
                        <input type="submit" class="btn btn-default center-block" value="Send">
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
        <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>