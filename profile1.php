<?php
	session_start();
    include 'databh.php';
    if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
        echo "<script>
        window.location.href='formnowlogin.php';
        </script>";
    }
    $id = $_SESSION['uid'];
    $sql1 = "SELECT * FROM blogsignup WHERE uid = '$id'";
  $result1 = $conn->query($sql1);
  $row1 = $result1->fetch_assoc();
  $dp = $row1['dp'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $id;?> - Artymys</title>
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
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background:#ccc;
}
.featuredImage { 
   position: relative; 
   width: 100%; /* for IE 6 */
}
h2 { 
   position: absolute; 
   top: 150px; 
   left: 0; 
   width: 100%; 
}
h2 span { 
   color: white; 
   font: bold 24px/45px Helvetica, Sans-Serif; 
   letter-spacing: -1px;  
   background: rgb(0, 0, 0); /* fallback color */
   background: rgba(0, 0, 0, 0.7);
   padding: 10px; 
}

        #overlay {
            display: none;
            position: absolute;
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
            height: 500px;
            margin-left: -250px; /*Half the value of width to center div*/
            margin-top: -250px; /*Half the value of height to center div*/
            z-index: 200;
            border-radius: 5px;
        }
        #popup1 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            background: #F5F5F5;
            width: 500px;
            min-height: 500px;
            margin-left: -250px; /*Half the value of width to center div*/
            margin-top: -250px; /*Half the value of height to center div*/
            z-index: 200;
            border-radius: 5px;
        }
        #popup2 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            background: #F5F5F5;
            width: 500px;
            min-height: 300px;
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
        #popupclose1 {
            float: right;
            padding: 10px;
            cursor: pointer;
        }
        #popupclose2 {
            float: right;
            padding: 10px;
            cursor: pointer;
        }
        .popupcontent {
            padding: 10px;
        }
        #cpbutton {
            cursor: pointer;
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
                        document.getElementById("resudiv").innerHTML = xhttp.responseText;
                    }
                }
                var pd1 = document.getElementById("pwd1").value;
                var pd2 = document.getElementById("pwd2").value;
                var pd3 = document.getElementById("pwd3").value;
                xhttp.open("GET", "chngpasd.php?pwd1="+pd1+"&pwd2="+pd2+"&pwd3="+pd3, true);
                xhttp.send();
            }
            function loadDoc1(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("resudiv1").innerHTML = xhttp.responseText;
                    }
                }
                var em = document.getElementById("emp").value;
                var des = document.getElementById("descript").value;
                xhttp.open("GET", "profilesave.php?emp="+em+"&descript="+des, true);
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
            <div class="container-fluid">
                <div class="container">
                    <br><br><br>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <?php
                                echo "<br>";
                                $sql = "SELECT * FROM blogsignup WHERE uid = '$id'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                if($row['verified'] == 1){
                                    $check1 = 1;
                                }else{
                                    $check1 = 0;
                                }
                                $dp1 = $row['dp'];
                                echo "<h1 style='text-align: center;'>".$id."</h1><br>";
                                if(!empty($dp1)){
                                    echo "<img src='".$dp1."' style='width: 150px; height: 150px;' class='center-block'><br>";
                                }else{
                                    echo "<img src='uploads/alternate1.png' style='width:150px; height: 150px;' class='center-block'><br>";
                                }
                                if($check1 == 1){
                                ?>
                                <div class="cent" style="text-align: center;">
                                <img src = "images/verified1.png" style="width: 20px; height: 20px; display: inline; align: middle;" class="center-block">
                                <h4 style="display: inline; color: #808080;">Verified </h4>
                                </div>
                                <?php
                            }
                                $applauds = $row['applaudsuser'];
                                $censures = $row['censuresuser'];
                                $popularitypoints = $applauds/5;
                                $censures1 = $censures/3;
                                $popularitypoints = $popularitypoints - $censures1;
                                $popularitypoints = round($popularitypoints, 2);
                                echo "<h4 style='text-align: center; color: #808080;'> Popularity Stats: ".$popularitypoints."</h4>";
                                $sql = "SELECT * FROM blogsignup WHERE uid = '$id'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $num = $row['followercount'];
                                if(!isset($num)){
                                    $num = 0;
                                }
                                if($num > 1000){
                                    $num = $num/1000;
                                    $num = round($num,1);
                                    $num = $num."k";
                                }
                                if($num == 1){
                                    echo "<h4 style='text-align: center; color: #808080;'>".$num." Follower </h4>";
                                }else{
                                    echo "<h4 style='text-align: center; color: #808080;'>".$num." Followers </h4>";
                                }
                                echo "<hr style='border-color: #1A237E; border-width: 3px; width: 200px;'>";
                            ?>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 col-md-6">
                                    <button class="btn btn-default center-block" id="upbutton">Update Profile</button>
                                </div>
                                <div class="col-sm-6 col-lg-6 col-md-6">
                                    <button class="btn btn-default center-block" id="cpbutton">Change Password</button>
                                </div>
                            </div>
                            <div style="text-align: center">
                            <br>
                            <?php
                                $sql2 = "SELECT featured FROM blogsignup WHERE uid='$id'";
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                if(isset($row2['featured']) && !empty($row2['featured'])){
                                    echo "<a href='cfeatured.php' style='text-decoration: none;'>Change Featured Content</a>";
                                }else{
                                    echo "<a href='cfeatured.php' style='text-decoration: none;'>Add Featured Content</a>";
                                }
                                $sql2 = "SELECT * FROM wyri WHERE uid = '$id'";
                                $result2 = $conn->query($sql2);
                                $row2 = $result2->fetch_assoc();
                                $num2 = mysqli_num_rows($result2);
                                if($num2 > 0){
                                    echo "<br><br><a href='wyrisu.php' style='text-decoration: none;'>View WYRI results </a>";
                                }
                            ?>
                            <br><br>
                            <a style="text-decoration: none; cursor: pointer;" id="dpbutton">Change Profile Picture</a>
                            </div>
                        </div>
                        <div class="col-sm-8 col-lg-8 col-md-8">
                            <?php
                                $sql = "SELECT featured FROM blogsignup WHERE uid = '$id'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                if(isset($row['featured']) && !empty($row['featured'])){
                                    $data1 = $row['featured'];
                                    $listarr = explode(" ",$data1);
                                    $cid = $listarr[1];
                                    if($listarr[0] == "A"){
                                        $sql2 = "SELECT * FROM blogdata2 WHERE id = '$cid'";
                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc();
                                        $point = 1;
                                    }else{
                                        $sql2 = "SELECT * FROM bookdetails WHERE id = '$cid'";
                                        $result2 = $conn->query($sql2);
                                        $row2 = $result2->fetch_assoc();
                                        $point = 2;
                                    }
                                    if(isset($row2['articleImage']) && !empty($row2['articleImage'])){
                                        echo "<br><br>";
                                        $imgs = $row2['articleImage'];
                                        $tite = $row2['title'];
                                        if($point == 1){
                                            echo "<a href='readspecific.php?id=".$cid."'>";
                                        }else{
                                            echo "<a href='selectchapter.php?id=".$cid."'>";
                                        }
                                        ?>
                                        <div class='featuredImage'>
                                         <?php   
                                            echo "<img src='$imgs' style='width: 100%; height: 250px;'/>";
                                            echo "<h2><span>".$tite."</span></h2>";
                                        ?>

                                        </div>
                                        <?php
                                        echo "</a>";
                                    }
                                    else{
                                       echo "<br><br>"; 
                                       $tite = $row2['title'];
                                        if($point == 1){
                                            echo "<a href='readspecific.php?id=".$cid."'>";
                                        }else{
                                            echo "<a href='selectchapter.php?id=".$cid."'>";
                                        }
                                        ?>
                                        <div class='featuredImage'>
                                         <?php   
                                            echo "<img src='images/Alternate.png' style='width: 100%; height: 250px;'/>";
                                            echo "<h2><span>".$tite."</span></h2>";
                                        ?>

                                        </div>
                                        <?php
                                        echo "</a>";
                                    }
                                }
                                echo "<br>";
                                echo "<br>";
                                $sql = "SELECT * FROM blogdata2 WHERE uid = '$id'";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<a href='readspecific.php?id=".$row['id']."' style='color: #000000;'>".$row['title']." </a><br>";
                                    $body = $row['content'];
                                    if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                                        $whitespaceposition = strpos($body," ",295); 
                                        $body = substr($body, 0, $whitespaceposition);
                                    }
                                    echo "<p>".$body." ...</p>";
                                    echo "<div class='row'>";
                                        echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                                            $applauds = $row['applaud'];
                                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px;' class='center-block'>";
                                            if(!isset($row['applaud'])){
                                                echo "<p style='text-align: center;'>No Applauds Yet</p>";
                                            }else{
                                                echo "<p style='text-align: center;'>".$applauds." Applauds</p>";
                                            }
                                        echo "</div>";
                                        echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                                            $censures = $row['censure'];
                                            echo "<img src='images/censure.png' style='width: 20px; height: 20px;' class='center-block'>";
                                            if(!isset($row['censure'])){
                                                echo "<p style='text-align: center;'>No Censures Yet</p>";
                                            }else{
                                                echo "<p style='text-align: center;'>".$censures." Censures</p>";
                                            }
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<hr style='border-width: 3px;'>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="overlay"></div>
            <div id="popup">
                <div class="popupcontrols">
                    <span id="popupclose">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Change Password</h1><br>
                    <img src="images/password.png" style="height: 100px; width: 100px;" class="center-block"/><br>
                        <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="Enter password"><br>
                        <input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Enter New password"><br>
                        <input type="password" class="form-control" name="pwd3" id="pwd3" placeholder="Re-Enter New password"><br>
                        <a onclick="loadDoc()" class="btn btn-default">Change Password.</a>
                        <br>
                        <div id="resudiv"></div>
                </div>
            </div>
            <div id="popup1">
                <div class="popupcontrols">
                    <span id="popupclose1">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Update Profile</h1><br>
                    <img src="images/profile.png" style="height: 100px; width: 150px;" class="center-block"/><br>
                    <?php
                        $sql = "SELECT emp, descript FROM blogsignup WHERE uid = '$id'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        if(isset($row['emp'])){
                            $emp = $row['emp'];
                            $check = 1;
                        }else{
                            $check = 0;
                        }
                        if(isset($row['descript'])){
                            $descript = $row['descript'];
                            $check1 = 1;
                        }else{
                            $check1 = 0;
                        }
                    ?>
                    <h4> Add Employment: </h4>
                    <?php
                        if($check == 1){
                            echo "<input type='text' class='form-control' id='emp' placeholder='Employement' value='".$emp."' />";
                        }else{
                            echo '<input type="text" class="form-control" id="emp" placeholder="Employement" />';
                        }
                    ?>
                    <br>
                    <h4> Add Something About You: </h4>
                    <?php
                        if($check1 == 1){
                            echo "<textarea class='form-control' id='descript'>".$descript."</textarea>";
                        }else{
                            echo '<textarea class="form-control" id="descript" placeholder="Describe Yourself."></textarea>';
                        }
                    ?>
                    <br>
                    <a onclick="loadDoc1()" class="btn btn-default">Update.</a>
                    <br>
                    <div id="resudiv1"></div>
                </div>
            </div>
            <div id="popup2">
                <div class="popupcontrols">
                    <span id="popupclose2">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Update Profile Picture</h1><br>
                    <?php
                        $sql1 = "SELECT dp FROM blogsignup WHERE uid = '$id'";
                        $result1 = $conn->query($sql1);
                        $row1 = $result1->fetch_assoc();
                        if(isset($row1['dp'])){
                            $dp1 = $row1['dp'];
                            echo "<img src='".$dp1."' style='height: 150px; width: 150px;' class='center-block'/>";
                        }else{
                            echo "<img src='uploads/alternate2.png' style='height: 100px; width: 100px;' class='center-block'/>";
                        }
                    ?>
                    <br><br>
                        <form method="POST" action="adddp.php" enctype="multipart/form-data">
                            <input type="file" name="file" class="center-block">
                            <br>
                            <input type="submit" value="Upload" class="btn btn-default center-block">
                        </form>
                </div>
            </div>
            <script type="text/javascript">
                // Initialize Variables
                var closePopup = document.getElementById("popupclose");
                var overlay = document.getElementById("overlay");
                var popup = document.getElementById("popup");
                var button = document.getElementById("cpbutton");
                var button1 = document.getElementById("upbutton");
                var button2 = document.getElementById("dpbutton");
                var closePopup1 = document.getElementById("popupclose1");
                var closePopup2 = document.getElementById("popupclose2");
                // Close Popup Event
                closePopup.onclick = function() {
                    overlay.style.display = 'none';
                    popup.style.display = 'none';
                };
                closePopup1.onclick = function() {
                    overlay.style.display = 'none';
                    popup1.style.display = 'none';
                };
                closePopup2.onclick = function() {
                    overlay.style.display = 'none';
                    popup2.style.display = 'none';
                };
                // Show Overlay and Popup
                button.onclick = function() {
                    overlay.style.display = 'block';
                    popup.style.display = 'block';
                }
                button1.onclick = function() {
                    overlay.style.display = 'block';
                    popup1.style.display = 'block';
                }
                button2.onclick = function() {
                    overlay.style.display = 'block';
                    popup2.style.display = 'block';
                }
            </script>
            <div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
        </body>
    </html>