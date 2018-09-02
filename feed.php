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
		header('location: formnowlogin.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Feed - Artymys</title>
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
        <div class="container-block" style="background-color: #FAFAFA; height: 100%;">
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
                </div>
        			<br>
        			<?php
        				$sql = "SELECT followed FROM follow WHERE uid = '$uid'";
        				$result = $conn->query($sql);
        				$i = 0;
        				while($row = $result->fetch_assoc()){
        					$user = $row['followed'];
        					$sql1 = "SELECT id, applaud, censure, totalreads, rating, dateadd FROM blogdata2 WHERE uid = '$user' ORDER BY dateadd DESC";
        					$result1 = $conn->query($sql1);
        					while($row1 = $result1->fetch_assoc()){
        						$applaud = $row1['applaud'];
        						$censure = $row1['censure'];
        						$reads = $row1['totalreads'];
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
							//	$applaud = $applaud / 24;
								$censure = $censure * 1.5;
								$reads = $reads / 5;
                                $score = 10;
								$score = $score + $applaud - $censure + $reads;
							//	$score = $score * 100;
							//	$rating = $rating*4;
							//	$score = $score + $rating;
								$score = round($score,2);
                                $score = $score + 1;
								$pow = pow($diff1+2,0.8);
								$feedscore = $score / $pow;
								$feedscore = $feedscore + 10; // To give weightage to the following content.
								$feedscore = round($feedscore,2);
								$rankid[$i] = $row1['id'];
								$rank[$i] = $feedscore;
								$rankpart[$i] = 1;
								$i = $i + 1;
        					}
        				}
        				$sql = "SELECT followed FROM follow WHERE uid = '$uid'";
        				$result = $conn->query($sql);
        				while($row = $result->fetch_assoc()){
        					$user = $row['followed'];
        					$sql3 = "SELECT id FROM bookdetails WHERE uid = '$user'";
        					$result3 = $conn->query($sql3);
        					while($row3 = $result3->fetch_assoc()){
        						$bid = $row3['id'];
        						$sql4 = "SELECT * FROM bookchaps WHERE bookid = '$bid' ORDER BY dateadd DESC LIMIT 1";
        						$result4 = $conn->query($sql4);
        						while($row4=$result4->fetch_assoc()){
        							$applaud = $row4['applaud'];
        							$censure = $row4['censure'];
        							$reads = $row4['readcount'];
        							$rating = $row4['rating'];
        							$feedscore = 0;
        							$dbdatetime = $row4['dateadd'];//datetime from database: "2014-05-18 18:10:18"
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
								//	$applaud = $applaud / 24;
									$censure = $censure *1.5;
									$reads = $reads / 5;
                                    $score = 10;
									$score = $score + $applaud - $censure + $reads;
								//	$score = $score * 100;
								//	$rating = $rating*4;
								//	$score = $score + $rating;
									$score = round($score,2);
									$pow = pow($diff1+2,0.8);
									$feedscore = $score / $pow;
									$feedscore = $feedscore + 10; // To give weightage to the following content.
									$feedscore = round($feedscore,2);
									$rankid[$i] = $row4['bookid'];
									$rank[$i] = $feedscore;
									$rankpart[$i] = 2;
									$i = $i + 1;
        						}
        					}
        				}
                        if(isset($rank)){
                            $num = count($rank);
                        
        				for($c=0;$c<$num;$c++){
        					for($d=0;$d<$num;$d++){
								if($rank[$c]>$rank[$d]){
        							$temp = $rank[$c];
        							$rank[$c] = $rank[$d];
        							$rank[$d] = $temp;
        							$temp = $rankid[$c];
        							$rankid[$c] = $rankid[$d];
        							$rankid[$d] = $temp;
        							$temp = $rankpart[$c];
        							$rankpart[$c] = $rankpart[$d];
        							$rankpart[$d] = $temp;
        						}
        					}
        				}
        				for($c=0;$c<$num;$c++){
        					$id = $rankid[$c];
        					$part = $rankpart[$c];
                        ?>
                        <div class='feedcard'>
                            <br>
                            <?php
        					if($part == 1){
                                echo $rank[$c];
        						$sql2 = "SELECT * FROM blogdata2 WHERE id = '$id'";
        						$result2 = $conn->query($sql2);
        						$row2 = $result2->fetch_assoc();
        						echo "<a href='readspecific.php?id=".$row2['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' rel='noopener norefferer'>".$row2['title']."</a>";
        						echo "<br>";
        						if(isset($row2['articleImage']) && !empty($row2['articleImage'])){
        							echo "<img src='".$row2['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
        							echo "<br>";
        						}
        						$writ = $row2['uid'];
        						$sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writ'";
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
                            
                                		<span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                <?php
                    
                                		if(isset($row12['dp'])){
                                    		echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                		}else{
                                    		echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                		}
                            	?>
                            		</div>
                            	<?php
                        		}else{
                            		if(isset($row12['dp'])){
                                    	echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                	}else{
                                    	echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                	}
                       		 	}
                       		 	echo "<p style='display: inline; margin-left: 20px;'>".$writ."</p>";
                       		 	echo "<br>";
                       		 	$body = $row2['content'];
                                $flag1 = 0;
                            	if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                                	$whitespaceposition = strpos($body," ",295); 
                                	$body = substr($body, 0, $whitespaceposition);
                                    $flag1 = 1;
                             	}
                                if($flag1 == 0){
                                    echo "<p>".$body."</p>";    
                                }else{
                                    echo "<p>".$body." ...</p>";
                                }
                             	
                             	echo "<div class='row'>";
                                    echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                             		echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                             			echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             			echo "<p style='display: inline;'>".$row2['applaud']."</p>";
                             		echo "</div>";
                             		echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                             			echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             			echo "<p style='display: inline;'>".$row2['censure']."</p>";
                             		echo "</div>";
                             		echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                             			echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             			echo "<p style='display: inline;'>".$row2['totalreads']."</p>";
                             		echo "</div>";
                             		echo "<div class='col-md-2 col-sm-2 col-lg-2'>";
                             		echo "</div>";
                             		echo "<div class='class='col-sm-3 col-lg-3 col-md-3'>";
                             			$sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                                        $result14 = $conn->query($sql14);
                             			$row14 = $result14->fetch_assoc();
                                        $list = $row14['articlelaterlist'];
                                        $listarr = explode(" ", $list);
                                        $num14 = count($listarr);
                                        $flag = 1;
                                        for($j=0; $j<$num14; $j++){
                                            if($listarr[$j] == $id){
                                                $flag = 0;
                                            }
                                        }
                                        if($flag == 1){
                             			    echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addlater.png' style='width:30px; height:20px;' class='center-block'/></a></span>";
                                        }else{
                                            echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addedlater.png' style='width:30px; height:20px;' class='center-block'/></a></span>";
                                        }
                             		echo "</div>";
                             	echo "</div><br>";
        					}
        					else if($part == 2){
                             //   echo $rank[$c];
        						$sql2 = "SELECT * FROM bookdetails WHERE id = '$id'";
        						$result2 = $conn->query($sql2);
        						$row2 = $result2->fetch_assoc();
        						echo "<a href='selectchapter.php?id=".$row2['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;'>".$row2['title']."</a>";
        						echo "<br>";
        						if(isset($row2['articleImage']) && !empty($row2['articleImage'])){
        							echo "<img src='".$row2['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
        							echo "<br>";
        						}
        						$writ = $row2['uid'];
        						$id = $row2['id'];
        						$sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writ'";
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
                            
                                		<span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                <?php
                    
                                		if(isset($row12['dp'])){
                                    		echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                		}else{
                                    		echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                		}
                            	?>
                            		</div>
                            	<?php
                        		}else{
                            		if(isset($row12['dp'])){
                                    	echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                	}else{
                                    	echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                	}
                       		 	}
                       		 	echo "<p style='display: inline; margin-left: 20px;'>".$writ."</p>";
                       		 	echo "<br>";
                       		 	$sql12 = "SELECT * FROM bookchaps WHERE bookid='$id' ORDER BY chapno DESC LIMIT 1";
                       		 	$result12 = $conn->query($sql12);
                       		 	$row12 = $result12->fetch_assoc();
                       		 	echo "<p>New Chapter! - ".$row12['title']."</p>";
                       		 	$body = $row12['content'];
                            	$flag1 = 0;
                                if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                                    $whitespaceposition = strpos($body," ",295); 
                                    $body = substr($body, 0, $whitespaceposition);
                                    $flag1 = 1;
                                }
                                if($flag1 == 0){
                                    echo "<p>".$body."</p>";    
                                }else{
                                    echo "<p>".$body." ...</p>";
                                }
                             	if(!isset($row12['applaud']) || empty($row12['applaud'])){
                                    $row12['applaud'] = 0;
                                }
                                if(!isset($row12['censure']) || empty($row12['censure'])){
                                    $row12['censure'] = 0;
                                }
                                if(!isset($row12['readcount']) || empty($row12['readcount'])){
                                    $row12['readcount'] = 0;
                                }
                             	echo "<div class='row'>";
                                    echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                             		echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                                        echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                                        echo "<p style='display: inline;'>".$row12['applaud']."</p>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                                        echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                                        echo "<p style='display: inline;'>".$row12['censure']."</p>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                                        echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                                        echo "<p style='display: inline;'>".$row12['readcount']."</p>";
                                    echo "</div>";
                             	echo "</div><br>";
        					}
                            ?>
                            </div>
                            <br>
                            <?php
        				}
                        echo "<h5 style='color: #636363; text-align: center;'> It seems you have reached the end. Follow more people.</h5>";
                    }else{
                        echo "<h4 style='color: #636363; text-align: center;'><img src='images/feederror.png' style='width: 40px; height: 40px;'/> Follow more people and topics to get your customised feed. </h4>";
                    }
        			?>
        		</div>
                <div class="col-sm-3 col-lg-3 col-md-3">
                    <br>
                    <div class='likeadd' style="min-width: 100%; min-height: 40px; background-color: #d8dfea; box-shadow: 2px 2px 2px #EDE7F6; border-radius: 2px;">
                        <br>
                        <h4 style="margin-left: 10px; margin-top: 5px;"> Find Us on Facebook</h4>
                        <img src="images/logolike.jpg" style="width: 90%; height: 50px;" class="center-block" />
                        <br>
                        <div class="fb-like" data-href="https://www.facebook.com/LeoMessi/" data-width="20" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true" style="margin-left: 10px;"></div>
                        <br><br><br>
                    </div>
                    <br>
                    <?php
                        $sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                        $result14 = $conn->query($sql14);
                        $row14 = $result14->fetch_assoc();
                        if(isset($row14['articlelaterlist']) && !empty($row14['articlelaterlist'])){
                            echo "<h4> Saved Articles </h4><br>";
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
        <br>
        <br>
    </div>
        <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
    </body>
</html>
