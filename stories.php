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
        $sql = "SELECT * FROM stories WHERE sto = '$uid'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $id = $row['contentid'];
            $tye = $row['tye'];
            if($tye == 1 || $tye == 4){
                $idarr = explode(" ", $id);
                $id1 = $idarr[1];
                $sql1 = "SELECT * FROM blogdata2 WHERE id = '$id1'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $applaud = $row1['applaud'];
                $censure = $row1['censure'];
                $reads = $row1['totalreads'];
                $dbdatetime = $row1['dateadd'];//datetime from database: "2014-05-18 18:10:18"
                date_default_timezone_set("Asia/Kolkata"); //setting default timezone based on your location
                $curdatetime = date("Y-m-d H:i:s"); //current datetime

                if($curdatetime > $dbdatetime){
                    $diff = abs(strtotime($curdatetime) - strtotime($dbdatetime));
                }else{
                    $diff = abs(strtotime($dbdatetime) - strtotime($curdatetime));
                }
                $diff = $diff/60;

                $diff = $diff/60;
                                
                $diff1 = $diff/60;
                $diff1 = round($diff1,2);
            //  $applaud = $applaud / 24;
                $censure = $censure * 1.5;
                $reads = $reads / 5;
                $score = 10;
                $score = $score + $applaud - $censure + $reads;
            //  $score = $score * 100;
            //  $rating = $rating*4;
            //  $score = $score + $rating;
                $score = round($score,2);
                $score = $score + 1;
                $pow = pow($diff1+2,0.2);
                $feedscore = $score / $pow;
            //    $feedscore = $feedscore + 10; // To give weightage to the following content.
                $feedscore = round($feedscore,2);
                $sql2 = "UPDATE stories SET score = '$feedscore' WHERE contentid = '$id' AND sto = '$uid'";
                $result2 = $conn->query($sql2);
            }
            if($tye == 2){
                $idarr = explode(" ", $id);
                $id1 = $idarr[1];
                $id2 = $idarr[2];
                $sql1 = "SELECT * FROM bookchaps WHERE bookid = '$id1' AND chapno = '$id2'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $applaud = $row1['applaud'];
                $censure = $row1['censure'];
                $reads = $row1['readcount'];
                $rating = $row1['rating'];
                $feedscore = 0;
                $dbdatetime = $row1['dateadd'];//datetime from database: "2014-05-18 18:10:18"
                date_default_timezone_set("Asia/Kolkata"); //setting default timezone based on your location
                $curdatetime = date("Y-m-d H:i:s"); //current datetime

                if($curdatetime > $dbdatetime){
                    $diff = abs(strtotime($curdatetime) - strtotime($dbdatetime));
                }else{
                    $diff = abs(strtotime($dbdatetime) - strtotime($curdatetime));
                }
                $diff = $diff/60;

                $diff = $diff/60;
                                
                $diff1 = $diff/60;
                $diff1 = round($diff1,2);
            //  $applaud = $applaud / 24;
                $censure = $censure *1.5;
                $reads = $reads / 5;
                $score = 10;
                $score = $score + $applaud - $censure + $reads;
            //  $score = $score * 100;
            //  $rating = $rating*4;
            //  $score = $score + $rating;
                $score = round($score,2);
                $pow = pow($diff1+2,0.2);
                $feedscore = $score / $pow;
            //    $feedscore = $feedscore + 10; // To give weightage to the following content.
                $feedscore = round($feedscore,2);
                $sql2 = "UPDATE stories SET score = '$feedscore' WHERE contentid = '$id' AND sto = '$uid'";
                $result2 = $conn->query($sql2);
            }
            if($tye == 3){
                $idarr = explode(" ", $id);
                $id1 = $idarr[1];
                $sql1 = "SELECT * FROM blogdata2 WHERE id = '$id1'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $applaud = $row1['applaud'];
                $censure = $row1['censure'];
                $reads = $row1['totalreads'];
                $dbdatetime = $row['date1'];//datetime from database: "2014-05-18 18:10:18"
                date_default_timezone_set("Asia/Kolkata"); //setting default timezone based on your location
                $curdatetime = date("Y-m-d H:i:s"); //current datetime

                if($curdatetime > $dbdatetime){
                    $diff = abs(strtotime($curdatetime) - strtotime($dbdatetime));
                }else{
                    $diff = abs(strtotime($dbdatetime) - strtotime($curdatetime));
                }
                $diff = $diff/60;

                $diff = $diff/60;
                                
                $diff1 = $diff/60;
                $diff1 = round($diff1,2);
            //  $applaud = $applaud / 24;
                $censure = $censure * 1.5;
                $reads = $reads / 5;
                $score = 10;
                $score = $score + $applaud - $censure + $reads;
            //  $score = $score * 100;
            //  $rating = $rating*4;
            //  $score = $score + $rating;
                $score = round($score,2);
                $score = $score + 1;
                $pow = pow($diff1+2,0.2);
                $feedscore = $score / $pow;
            //    $feedscore = $feedscore + 10; // To give weightage to the following content.
                $feedscore = round($feedscore,2);
                $sql2 = "UPDATE stories SET score = '$feedscore' WHERE contentid = '$id' AND sto = '$uid'";
                $result2 = $conn->query($sql2);
            }
        }
	}else{
		header('location: formnowlogin.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Stories - Artymys</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/jquery3.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
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
    top:12px;
    left: 17px;
    padding:5px 10px;
    z-index: 2;
   
}
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
.backgr{
    background-image: url('images/paper2.png');
    background-attachment: fixed;
    background-size: cover;
}
    			</style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
    		$(".loader").fadeOut("slow");
		})
		function loadDoc(a){
			var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("readl"+a).innerHTML = this.responseText;

                    }
                }
                xhttp.open("GET", "mark.php?id="+a, true);
                xhttp.send();
		}
        function loadDoc1(a){
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                       var divs = document.getElementsByClassName("readll"+a);
                        var number = divs.length;
                        for(var i=0; i<number; i++){
                            divs[i].innerHTML = this.responseText;
                        }
                    }
                }
                xhttp.open("GET", "plib.php?id="+a, true);
                xhttp.send();
        }
	</script>
	<script type="text/javascript">
        function getDocHeight() {
            var D = document;
            return Math.max(
            D.body.scrollHeight, D.documentElement.scrollHeight,
            D.body.offsetHeight, D.documentElement.offsetHeight,
            D.body.clientHeight, D.documentElement.clientHeight
        );
    }
        $(document).ready(function(){
            var flag = 0;
            $.ajax({
                type: "GET",
                url: "get_data.php",
                data: {
                    'offset': 0,
                    'limit': 5
                },
                success: function(data){
                    $('.stoplace').append(data);
                    flag += 5;
                }
            });
                $(window).scroll(function() {
                    if($(window).scrollTop() + $(window).height() > $(document).height() - 1) {
                        console.log('Hey');
                        $.ajax({
                            type: "GET",
                            url: "get_data.php",
                            data: {
                                'offset': flag,
                                'limit': 5
                            },
                            success: function(data){
                                $('.stoplace').append(data);
                                flag += 5;
                            }
                        });
                    }
                }); 
    
        });  

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
        <div class="container-block backgr" style="height: 100%;">
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
                <div class="col-sm-8 col-lg-8 col-md-8">
                    <br>
                    <div class="stoplace">
                    </div>
                </div>
                <div class="col-sm-2 col-lg-2 col-md-2">
                    <br>
                    <?php
                        $sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                        $result14 = $conn->query($sql14);
                        $row14 = $result14->fetch_assoc();
                        if(isset($row14['articlelaterlist']) && !empty($row14['articlelaterlist'])){
                            echo "<h4> Saved Stories </h4><br>";
                        }
                        $all = $row14['articlelaterlist'];
                        $allarr = explode(" ", $all);
                        $num15 = count($allarr);
                        for($z=$num15-1; $z>=0; $z--){
                            $id15 = $allarr[$z];
                            $sql15 = "SELECT title FROM blogdata2 WHERE id = '$id15'";
                            $result15 = $conn->query($sql15);
                            $row15 = $result15->fetch_assoc();
                            $title1 = $row15['title'];
                            echo "<a href='readspecific.php?id=".$id15."' style='color: #636363; text-decoration: none;'>".$title1."</a>";
                            echo "<br><br>";
                        }
                    ?>
                </div>
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