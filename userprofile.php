<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$dp = $row['dp'];
        $uid1 = $_GET['user'];
        $sql = "SELECT penName,id FROM blogsignup WHERE uid = '$uid1'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $pn = $row['penName'];
        $id1 = $row['id'];
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
    <title> <?php echo $pn; ?> - Artymys</title>
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
.navbar {
    -webkit-box-shadow: 0 8px 6px -6px #999;
    -moz-box-shadow: 0 8px 6px -6px #999;
    box-shadow: 0 8px 6px -6px #999;

    /* the rest of your styling */
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
                .footer{
                    position: relative;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background:#ccc;
                }
                .userData{
                    background-color: #FFFFFF;
                    min-height: 275px;
                    box-shadow: 3px 3px 3px #EDE7F6;
                    border-radius: 3px; 
                    position: relative;
                }
                .item {
                    position:relative;
                    padding-top:0px;
                    display:inline-block;
                    width: 100%;
                }
                .notify-badge{
                    position: absolute;
                    top:12px;
                    left: 17px;
                    padding:5px 10px;
                    z-index: 2;
                }
                .proimg img {
                    border:4px solid #E53935;
                }
                .card{
                    background-color: #FFFFFF;
                    box-shadow: 2px 2px 2px #EDE7F6;   
                }
            </style>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script type="text/javascript">
                $(window).load(function() {
                    $(".loader").fadeOut("slow");
                })
            </script>
            <script type="text/javascript">
                var b = "<?php echo $uid1; ?>";
                $(document).ready(function(){
                    $.ajax({
                        type: "GET",
                        url: "get_profiledata.php",
                        data: {
                            'tye': 1,
                            'uid1': b,
                        },
                        success: function(data){
                            $('.stoplace').append(data);
                        }
                    });
                });
            </script>
            <script type="text/javascript">
                function loadDoc(){
                    var a = "<?php echo $id1; ?>";
                    var c = "<?php echo $uid1; ?>";
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            var foo = JSON.parse(xhttp.responseText);
                            document.getElementById("as"+c).innerHTML = foo[1];
                            document.getElementById("folcount").innerHTML = foo[0];
                        }
                    }
                    xhttp.open("GET", "testgfollow1.php?user="+a, true);
                    xhttp.send();
                }
                function loadBooks(){
                    var b = "<?php echo $uid1; ?>";
                    document.getElementById('stoplace').innerHTML="";
                    $.ajax({
                        type: "GET",
                        url: "get_profiledata.php",
                        data: {
                            'tye': 2,
                            'uid1': b,
                        },
                        success: function(data){
                            $('.stoplace').append(data);
                        }
                    });
                    document.getElementById('bk').style.color="#009AFF";
                    document.getElementById('stro').style.color="#757575";
                    document.getElementById('lb').style.color="#757575";
                    document.getElementById('bk1').src="images/probookactive.png";
                    document.getElementById('stro1').src="images/prostory.png";
                    document.getElementById('lb1').src="images/prolibrary.png";
                }
                function loadStories(){
                    var b = "<?php echo $uid1; ?>";
                    document.getElementById('stoplace').innerHTML="";
                    $.ajax({
                        type: "GET",
                        url: "get_profiledata.php",
                        data: {
                            'tye': 1,
                            'uid1': b,
                        },
                        success: function(data){
                            $('.stoplace').append(data);
                        }
                    });
                    document.getElementById('bk').style.color="#757575";
                    document.getElementById('stro').style.color="#009AFF";
                    document.getElementById('lb').style.color="#757575";
                    document.getElementById('bk1').src="images/probook.png";
                    document.getElementById('stro1').src="images/prostoryactive.png";
                    document.getElementById('lb1').src="images/prolibrary.png";
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
        <div class="container-fluid" style="background-color: #FAFAFA; min-height: 100%;">
            <div class="container">
                <br><br><br><br><br>
                <div class="userData">
                    <div class="row">
                        <div class="col-sm-3 col-lg-3 col-md-3 proimg">
                        <br>
                        <?php
                            $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$uid1'";
                            $result12 = $conn->query($sql12);
                            $row12 = $result12->fetch_assoc();
                            if($row12['verified'] == 1){
                                $check1 = 1;
                            }else{
                                $check1 = 0;
                            }
                            if($check1 == 1){
                                if(isset($row12['dp'])){
                                    echo"<img src='".$row12['dp']."' style='height: 170px; width: 170px; border-radius: 80px; position: relative; z-index: 1;' class='center-block'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 170px; width: 170px; border-radius: 80px; position: relative; left: 10px;' class='center-block'>";
                                }
                            }else{
                                if(isset($row12['dp'])){
                                    echo"<img src='".$row12['dp']."' style='height: 170px; width: 170px; border-radius: 80px; position: relative;' class='center-block'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 170px; width: 170px; border-radius: 80px; position: relative; left: 10px;' class='center-block'>";
                                }
                            }
                        ?>
                        </div>
                        <div class="col-sm-5 col-lg-5 col-md-5">
                            <?php
                                $sql = "SELECT penName,descript,applaudsuser,censuresuser,followercount,emp,totalreads FROM blogsignup WHERE uid = '$uid1'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $penName = $row['penName'];
                                if($check1 == 1){
                                    echo "<h2>".$penName." <img src='images/verified1.png' style='margin-left: 5px; width: 25px; height: 25px;'></h2>";
                                }else{
                                    echo "<h2>".$penName."</h2>";
                                }
                                if(isset($row['descript']) && !empty($row['descript'])){
                                    $descript = $row['descript'];
                                    echo "<p style='text-align: justify;'>".$descript."</p>";
                                }else{
                                    echo "<p>No Author Description</p>";
                                }
                                $sql2 = "SELECT * FROM follow WHERE uid = '$uid' AND followed = '$uid1'";
                                $result2 = $conn->query($sql2);
                                $num2 = mysqli_num_rows($result2);
                                echo "<br>";
                                if($num2 == 0){
                                    echo '<a onclick="loadDoc()" id="as'.$uid1.'" class="bton center-block" style="width: 150px;"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/></a>';
                                }else{
                                    echo '<a onclick="loadDoc()" id="as'.$uid1.'" class="bton center-block" style="width: 150px;"><img src="images/done.png" style="width: 20px; height: 20px; margin-right: 5px;"/></a>';
                                }
                            ?>
                        </div>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <br><br><br>
                            <div style="border-left: solid; border-left-width: 2px; border-color: #9E9E9E; ">
                            <?php
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
                                $num = $row['followercount'];
                                if(!isset($num)){
                                    $num = 0;
                                }
                                if($num > 1000){
                                    $num = $num/1000;
                                    $num = round($num,1);
                                    $num = $num."k";
                                }
                                $num1 = $row['totalreads'];
                                if(!isset($num1)){
                                    $num1 = 0;
                                }
                                if($num1 > 1000){
                                    $num1 = $num1/1000;
                                    $num1 = round($num1,1);
                                    $num1 = $num1."k";
                                }
                                if(isset($row['emp']) && !empty($row['emp'])){
                                    echo "<div class='row'>";
                                        echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                        echo "</div>";
                                        echo "<div class='col-sm-1 col-lg-1 col-md-1'>";
                                            echo "<img src='images/emp.png' style='width: 20px; height: 20px; align: middle; margin-top: 6px;' class='center-block'>";
                                        echo "</div>";
                                        echo "<div class='col-sm-9 col-lg-9 col-md-9'>";
                                            echo "<p>".$row['emp']."</p>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-1 col-lg-1 col-md-1'>";
                                        echo "<img src='images/pop.png' style='width: 20px; height: 20px; align: middle; margin-top: 6px;' class='center-block'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-9 col-lg-9 col-md-9'>";
                                        echo "<p>".$popularitypoints." Points</p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-1 col-lg-1 col-md-1'>";
                                        echo "<img src='images/follower.png' style='width: 20px; height: 20px; align: middle; margin-top: 6px;' class='center-block'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-9 col-lg-9 col-md-9'>";
                                        echo "<p><span id='folcount'>".$num."</span> Followers</p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-1 col-lg-1 col-md-1'>";
                                        echo "<img src='images/reads.png' style='width: 20px; height: 20px; align: middle; margin-top: 6px;' class='center-block'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-9 col-lg-9 col-md-9'>";
                                        echo "<p>".$num1." Reads</p>";
                                    echo "</div>";
                                echo "</div>";
                            ?>
                            </div>
                        </div>
                        <br><br><br><br><br><br>
                    </div>
                    <br>
                    <div class="row" style="position: relative; bottom: 0; min-height: 10px; background-color: #EEEEEE; left: 15px; width: 100%;">
                        <div class="col-sm-3 col-md-3 col-lg-3" style="cursor: pointer;" onclick="loadStories()">
                            <h4 style="text-align: center; color: #009AFF;" id="stro"><img src = "images/prostoryactive.png" style="width: 15px; height: 15px; margin-right: 3px;" id="stro1"> Stories </h4>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3" style="border-left: solid; border-width: 2px; border-color: #939393; cursor: pointer;" onclick="loadBooks()">
                            <h4 style="text-align: center; color: #757575;" id="bk"><img src = "images/probook.png" style="width: 15px; height: 15px; margin-right: 3px;" id="bk1"> Books </h4>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3" style="border-left: solid; border-width: 2px; border-color: #939393;">
                            <h4 style="text-align: center; color: #757575;" id="lb"><img src = "images/prolibrary.png" style="width: 15px; height: 15px; margin-right: 3px;" id="lb1"> Library </h4>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3" style="border-left: solid; border-width: 2px; border-color: #939393;">
                            <h4 style="text-align: center; color: #757575;"><img src = "images/promessage.png" style="width: 15px; height: 15px; margin-right: 3px;"> Message </h4>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="stoplace" id="stoplace">

                </div>
            </div>
            <br><br>
        </div>
        <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
    </body>
</html>