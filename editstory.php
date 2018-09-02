<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
		exit();
	}
	$uid = $_SESSION['uid'];
	if(!isset($_GET['id']) || empty($_GET['id'])){
		header('Location: managestories.php');
		exit();
	}
	$id = $_GET['id'];
	$sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$dp = $row['dp'];
    $val1 = 1;
    $sql = "SELECT id FROM notifs WHERE seenstats = '$val1' AND nto = '$uid'";
    $result = $conn->query($sql);
    $notno = mysqli_num_rows($result);
    $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $writer = $row['uid'];
    if($writer != $uid){
    	header('Location: managestories.php');
    	exit();
    }
    $title = $row['title'];
    $story = $row['content'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Edit <?php echo $title; ?> - Artymys</title>
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
                .bton1{
	background-color: #1E88E5;
	height: 40px;
	border-radius: 3px;
	text-align: center;
	cursor: pointer;
	padding: 10px;
	box-shadow: 1px 1px 2px #EDE7F6;
	color: #FAFAFA;
	text-decoration: none;
}
.bton1:hover{
	color: #FAFAFA;
	text-decoration: none;
}
            </style>
    		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
			<script type="text/javascript">
				$(window).load(function() {
    				$(".loader").fadeOut("slow");
				})
			</script>
		<script type='text/javascript'>
			function sendupdate(){
				document.getElementById('stoplace').innerHTML = "";
				var title = document.getElementById('title').value;
				var story = tinyMCE.get('story').getContent();
				var description = document.getElementById('message').value;
				var id = document.getElementById('id').value;
    			$.ajax({
              	type: "POST",
            	url: "editstoryprocess.php",
    	      	data: {
                	    'title': title,
                  		'story': story,
                    	'id': id,
                 	  	'message': description
                	},
                	success: function(data){
                    	$('.stoplace').append(data);
                	}
            	});
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
        		<div class="col-sm-1 col-lg-1 col-md-1">
        		</div>
        		<div class="col-lg-9 col-md-9 col-sm-9">
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
                	<h3 style="color: #636363;"> Edit Story - <?php echo $title; ?></h3>
                	<br>
                	<form id="editform">
                		<h4> Title </h4>
                		<input type="text" class="form-control" name="title" id="title" placeholder="Enter Content Title" value="<?php echo $title; ?>">
                		<br>
                		<h4> Story </h4>
                		<TEXTAREA  class="tinymce" name="story" id="story"><?php echo $story; ?></TEXTAREA>
                		<br>
                		<h4> Description </h4>
                		<TEXTAREA  name="message" id="message" style="width: 100%; height: 200px; resize: none; box-shadow: inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3), inset 0px -1px 1px 1px rgba(0, 0, 0, 0.2); outline: none;" Placeholder="Less than 150 characters." maxlength="150"><?php if(isset($row['messtoread']) && !empty($row['messtoread'])){ echo $row['messtoread']; }?></TEXTAREA>
                		<br><br>
                		<input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
                		<input onclick="sendupdate()" type="button" class="center-block bton1" value = "Update">
                	</form>
                	<br>
                	<div class="stoplace" id="stoplace"></div>
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
</body>
</html>