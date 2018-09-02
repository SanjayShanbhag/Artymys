<?php
	session_start();
	include 'databh.php';
    if(isset($_SESSION['uid'])){
       $id=$_GET['id'];
    $uid = $_SESSION['uid'];
    $sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $dp = $row['dp'];
        $val1 = 1;
        $sql = "SELECT id FROM notifs WHERE seenstats = '$val1' AND nto = '$uid'";
        $result = $conn->query($sql);
        $notno = mysqli_num_rows($result);
    $sql = "SELECT * FROM articlereads WHERE contentid = '$id' AND uid = '$uid'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        $sql = "INSERT INTO articlereads(uid,contentid) VALUES('$uid', '$id')";
        $result = $conn->query($sql);
        $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $totalreads = $row['totalreads'];
        if(!isset($totalreads)){
            $totalreads = 1;
        }else{
            $totalreads = $totalreads + 1;
        }
        $sql = "UPDATE blogdata2 SET totalreads = '$totalreads' WHERE id = '$id'";
        $result = $conn->query($sql);
        $sql="SELECT * FROM blogdata2 WHERE id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $writer = $row['uid'];
        $sql = "SELECT * FROM blogsignup WHERE uid = '$writer'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $readcount = $row['totalreads'];
        if(!isset($readcount)){
            $readcount = 1;
        }else{
            $readcount = $readcount + 1;
        }
        $sql = "UPDATE blogsignup SET totalreads = '$readcount' WHERE uid = '$writer'";
        $result = $conn->query($sql);
    }
        $sql="SELECT * FROM blogdata2 WHERE id='$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); 
        if(isset($row['messtoread']) && !empty($row['messtoread'])){
            $messtoread = $row['messtoread'];
        }
    }else{
        echo "<script type ='text/javascript'>
                window.location.href='formnowlogin.php';
                </script>";
    }
	
?>
<!DOCTYPE html>
<html>
  <head>
    <title> <?php echo $row['title']; ?> - Artymys</title>
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
        #popup,#popup1,#popup2 {
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
            overflow: scroll;
        }
        #popupclose,#popupclose1,#popupclose2 {
            float: right;
            padding: 10px;
            cursor: pointer;
        }
        .popupcontent {
            padding: 10px;
        }
        .notihead{
            background-color: #4A148C;
            padding: 3px;
            box-shadow: 0px 4px 4px #636363;
        }
        #popup::-webkit-scrollbar { 
            display: none; 
        }
        #popup1::-webkit-scrollbar { 
            display: none; 
        }
        #popup2::-webkit-scrollbar { 
            display: none; 
        }
        .item {
    position:relative;
    padding-top:0px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    top:65px;
    left: 67px;
    padding:5px 10px;
    z-index: 2;
   
}

.item1 {
    position:relative;
    padding-top:0px;
    display:inline-block;
}
.notify-badge1{
    position: absolute;
    top:12px;
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
<script type="text/javascript">
    function loadDoc(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var foo = JSON.parse(xhttp.responseText);
                        document.getElementById("count").innerHTML = foo[0];
                        document.getElementById("like").innerHTML = foo[1];

                    }
                }
                xhttp.open("GET", "aapplaud.php?id="+<?php echo $id;?>, true);
                xhttp.send();
            }
            function loadDoc1(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var foo = JSON.parse(xhttp.responseText);
                        document.getElementById("ulike").innerHTML = foo[1];
                        document.getElementById("ucount").innerHTML = foo[0];
                    }
                }
                xhttp.open("GET", "acensure.php?id="+<?php echo $id;?>, true);
                xhttp.send();
            }
            function rateDoc1(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        document.getElementById("star1").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star2").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star3").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star4").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star5").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("ratings").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "articlerate.php?id="+<?php echo $id;?>+"&rate=1", true);
                xhttp.send();
            }
            function rateDoc2(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        document.getElementById("star1").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star2").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star3").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star4").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star5").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("ratings").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "articlerate.php?id="+<?php echo $id;?>+"&rate=2", true);
                xhttp.send();
            }
            function rateDoc3(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        document.getElementById("star1").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star2").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star3").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star4").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star5").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("ratings").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "articlerate.php?id="+<?php echo $id;?>+"&rate=3", true);
                xhttp.send();
            }
            function rateDoc4(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        document.getElementById("star1").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star2").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star3").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star4").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star5").innerHTML = '<img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("ratings").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "articlerate.php?id="+<?php echo $id;?>+"&rate=4", true);
                xhttp.send();
            }
            function rateDoc5(){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        
                        document.getElementById("star1").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star2").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star3").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star4").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("star5").innerHTML = '<img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" />';
                        document.getElementById("ratings").innerHTML = this.responseText;
                    }
                }
                xhttp.open("GET", "articlerate.php?id="+<?php echo $id;?>+"&rate=5", true);
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
        <br><br><br><br>
          <div class="container-fluid">
            <div class="container">
            
                <div class="row">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="feedside" style="position: fixed; overflow-y: auto;">
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
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <?php
                            
                            if(!mysqli_num_rows($result) > 0){
                                echo "<script type='text/javascript'> 
                                window.location.href='pnf.php'
                                </script>";
                            }
                            echo "<h2 style='color:#FF3D00'>".$row['title']."</h2><br>";
                            if(isset($row['articleImage'])){
                                echo "<img src='".$row['articleImage']."' style='width: 100%; height: 350px;'>";
                            }
                            echo "<p style='color: #808080;' class='left'>".$row['totalreads']." Reads</p>";
                            echo "<p style='text-align: right; color: #1A237E;' class='right'> Authored By - <a href='userprofile.php?user=".$row['uid']."' style='color: #1A237E;' >".$row['uid']."</a></p><br>";
                            
                            ?>
                            <div style="clear: both;"></div>
                            <?php
                                $sql2 = "SELECT rating FROM arating WHERE contentid = '$id'";
                                $result2 = $conn->query($sql2);
                                $num2 = mysqli_num_rows($result2);
                                $torate = 0;
                                while($row2 = $result2->fetch_assoc()){
                                    $torate = $torate + $row2['rating'];
                                }
                                if($torate != 0){
                                    $torate = $torate/$num2;
                                    echo "<span id='ratings'><p><img src='images/rated.png' style='width: 20px; height:20px; vertical-align: text-bottom;'/>      ".$torate."/5    -   (".$num2." Ratings)</p></span>";
                                }else{
                                   echo "<span id='ratings'></span>"; 
                                }
                            ?>
                            
                            <br>
                            <?php
                            echo nl2br("<p style='color:#616161; line-height: 35px; font-size: 17px;'>".$row['content']."</p>");
                        
                            $applauds = $row['applaud'];
                            $censures = $row['censure'];
                            $writer = $row['uid'];

  ?>
  

  <div class="row">
  <hr style="width: 70px; border-width: 5px; border-color: #156530; border-radius: 5px;">
  <br>
    <div class="col-sm-3 col-md-3 col-lg-3">
    
    <?php
  if(is_null($applauds)){
          echo "<a id='applaudbtn' style='text-decoration: none; cursor: pointer;'><p style='text-align: center' id='count'>No Applauds Yet.</p></a>";
        }else{
            echo "<a id='applaudbtn' style='text-decoration: none; cursor: pointer;'><p style='color: #808080; text-align: center;' id='count'>".$applauds."  Applauds</p></a>";
        }
        $sql = "SELECT * FROM alikes WHERE contentid = '$id' AND uid = '$uid'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        $sql = "SELECT * FROM adislikes WHERE contentid = '$id' AND uid = '$uid'";
        $result = $conn->query($sql);
        $num1 = mysqli_num_rows($result);
        if($num == 0){
                echo "<a onclick='loadDoc()' id='like' style='cursor: pointer;'><img src='images/applaud1.png' style='width:30px; height: 30px;' class='center-block'/></a>";
        }else{
            echo "<a onclick='loadDoc()' id='like' style='cursor: pointer;'><img src='images/applauded.png' style='width:30px; height: 30px;' class='center-block'/></a>";
        }
?>
  </div>

  <div class="col-sm-3 col-md-3 col-lg-3 centre-block">
  <?php
        if(is_null($censures)){
          echo "<a id='censurebtn' style='text-decoration: none; cursor: pointer;'><p style='text-align: center' id='ucount'>No Censures Yet.</p></a>";
        }else{
            echo "<a id='censurebtn' style='text-decoration: none; cursor: pointer;'><p style='color: #808080; text-align: center' id='ucount'>".$censures."  Censures</p></a>";
        }
        if($num1 == 0){
                echo "<a onclick='loadDoc1()' id='ulike' style='cursor: pointer;'><img src='images/censure1.png' style='width:30px; height: 30px;' class='center-block'/></a>";
        }else{
            echo "<a onclick='loadDoc1()' id='ulike' style='cursor: pointer;'><img src='images/censured.png' style='width:30px; height: 30px;' class='center-block'/></a>";
        }
 ?>

 </div>
 </div>
 <br>
 

 <div class="row">
    <hr>
    <div class="col-sm-9 col-lg-9 col-md-9">
    <h4> Your Rating: </h4>
        <?php 
            $sql = "SELECT rating FROM arating WHERE uid = '$uid' AND contentid = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $num = mysqli_num_rows($result);
            if($num == 1){
                $rate = $row['rating'];
                $check = 1;
                while($check <= $rate){
                    echo '<a onclick="rateDoc'.$check.'()" id="star'.$check.'"><img src="images/rated.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" /></a>';
                        $check = $check + 1;
                }
                while($check <= 5){
                    echo '<a onclick="rateDoc'.$check.'()" id="star'.$check.'"><img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" /></a>';
                        $check = $check + 1;
                }
            }else{
         ?>
        <a onclick="rateDoc1()" id="star1"><img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5" /></a>
        <a onclick="rateDoc2()" id="star2"><img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5"/></a>
        <a onclick="rateDoc3()" id="star3"><img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5"/></a>
        <a onclick="rateDoc4()" id="star4"><img src="images/rate.png" style="float: left; width: 20px; height: 20px; cursor: pointer;" hspace="5"/></a>
        <a onclick="rateDoc5()" id="star5"><img src="images/rate.png" style="width: 20px; height: 20px; cursor: pointer;" hspace="5"/></a>
        <?php
            }
        ?>
    </div>
    </div>
    <br>
    
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 col-md-6">
                            <form>
                                <?php
                                  $sql = "SELECT * FROM share WHERE uid = '$uid' AND contentid = '$id'";
                                  $result = $conn->query($sql);
                                  $num = mysqli_num_rows($result);
                                  if($num > 0){
                                    echo "<a class='btn btn-default' id='sharebtn'><img src='images/shared.png' style='width: 20px; height:20px;' title='Shared'>  Shared</a>";
                                  }else{
                                    echo "<a class='btn btn-default' id='sharebtn'><img src='images/share.png' style='width: 20px; height:20px;' title='Share'>  Share</a>";
                                }
                                ?>
                            </form>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                            <form>
                                <?php
                                  $sql = "SELECT * FROM report WHERE uid = '$uid' AND contentid = '$id'";
                                  $result = $conn->query($sql);
                                  $num = mysqli_num_rows($result);
                                  if($num > 0){
                                    echo "<a href='#' class='btn btn-default'><img src='images/report.png' style='width: 20px; height:20px;' title='Reported'>  Reported</a>";
                                  }else{
                                    echo "<a href='report.php?id=".$id."' class='btn btn-default'><img src='images/report.png' style='width: 20px; height:20px;' title='Report'>  Report</a>";
                                }
                                ?>
                            </form>
                            </div>
                        </div>
    <hr>
    <div class="row">
        <div class="col-sm-3 col-lg-3 col-md-3">
            <?php
                $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writer'";
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
                            echo"<img src='".$row12['dp']."' class='center-block' style='height: 100px; width: 100px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                        }else{
                            echo "<img src='uploads/alternate2.png' style='height: 100px; width: 100px; border-radius: 50px; position: relative; left: 10px;'>";
                        }
            ?>
                    </div>
            <?php
                        }else{
                            if(isset($row12['dp'])){
                                echo"<img src='".$row12['dp']."' style='height: 100px; width: 100px; border-radius: 50px; position: relative; left: 10px;'>";
                            }else{
                                echo "<img src='uploads/alternate2.png' style='height: 100px; width: 100px; border-radius: 50px; position: relative; left: 10px;'>";
                            }
                        }
            ?>
        </div>
        <div class="col-md-9 col-sm-9 col-lg-9">
            <h3><?php echo $writer; ?></h3>
            <?php
                if(isset($messtoread)){
                    echo "<div class='cent'>";
                        echo "<br>";
                        echo '<img src = "images/readmessage.png" style="width: 20px; height: 20px; display: inline; align: middle;">';
                        echo "<h4 style='display: inline; margin-left: 10px; color: #808080;'> ".$messtoread."</h4>";
                    echo "</div>";
                }
                $sql4 = "SELECT * FROM blogsignup WHERE uid = '$writer'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                            $applauds = $row4['applaudsuser'];
                            $censures = $row4['censuresuser'];
                            $followers = $row4['followercount'];
                            $reads = $row4['totalreads'];
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
                            echo "<div class='cent'>";
                                    echo "<br>";
                                    echo '<img src = "images/pop.png" style="width: 20px; height: 20px; display: inline; align: middle;">';
                                    echo "<h4 style='display: inline; margin-left: 10px; color: #808080;'> Popularity Stats: ".$popularitypoints."</h4>";
                            echo "</div>";
                            $num = $row4['followercount'];
                            if(!isset($num)){
                                $num = 0;
                            }
                            if($num > 1000){
                                $num = $num/1000;
                                $num = round($num,1);
                                $num = $num."k";
                            }
                            echo "<div class='cent'>";
                                    echo "<br>";
                                    echo '<img src = "images/follower.png" style="width: 20px; height: 20px; display: inline; align: middle;">';
                            if($num == 1){
                                echo "<h4 style='margin-left: 10px; display: inline; color: #808080;'> ".$num." Follower </h4>";
                            }else{
                                echo "<h4 style='margin-left: 10px; display: inline; color: #808080;'> ".$num." Followers </h4>";
                            }
                            echo "</div>";
            ?>
        </div>
 </div>

 <hr>
                            
            
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <form action="submitreview.php" method="POST">
                                <h4>Review: </h4><br>
                                <?php
                                    echo "<input type='hidden' name='id' id='id' value='".$id."'>";
                                ?>          
                                <TEXTAREA  name="review" id="review" style="width: 100%; height: 200px; resize: none; box-shadow: inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3), inset 0px -1px 1px 1px rgba(0, 0, 0, 0.2); outline: none;" Placeholder="Leave a review."></TEXTAREA><br><br>
                                <button type="submit" class="btn btn-default">Post</button><br><br>
                            </form>
                        </div>
                        <hr>
                        <h4>Reviews:</h4>
                        <br>
                        <?php
                            $counter = 0;
                            $sql = "SELECT * FROM review WHERE contentid = '$id'";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                $counter++;
                            }
                            if($counter>0){
                            $counter1 = 0;
                            $sql = "SELECT * FROM review WHERE contentid = '$id' ORDER BY id ASC";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                        ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                    <?php
                                        $id1 = $row['uid'];
                                        $sql1 = "SELECT * FROM blogsignup WHERE uid = '$id1'";
                                        $result1 = $conn->query($sql1);
                                        $row1 = $result1->fetch_assoc();
                                        $dp1 = $row1['dp'];
                                    ?>
                                <div class="row" style="background-color: #EDE7F6;">
                                    <div class="col-lg-1 col-sm-1 col-md-1">
                                        <?php
                                            if(!empty($dp1)){
                                                echo "<img src='".$dp1."' style='width: 30px; height: 30px;'><br>";
                                            }else{
                                                echo "<img src='uploads/alternate1.png' style='width:30px; height: 30px;'><br>";
                                            }
                                        ?>
                                    </div>
                                    <div class="col-lg-11 col-sm-11 col-md-11">
                                        <?php
                                            echo "<p style='color: #000000;'>".$row['uid']."</p>";
                                            echo "<p>".$row['comment1']."</p>";
                                            $counter1++;
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php
                            }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div id="overlay"></div>
            <div id="popup">
                <div class="notihead">
                    <div class="popupcontrols">
                        <span id="popupclose">X</span>
                    </div>
                    <h2 style="text-align: center; color: #EEEEEE;">Share With Followers</h2>
                </div>
                <br>
                    <div class="popupcontent">
                        
                        <img src="images/share.png" style="width: 50px; height: 50px;" class="center-block"><br>
                        <?php
                            $sql1 = "SELECT * FROM share WHERE uid = '$uid' AND contentid = '$id'";
                            $result1 = $conn->query($sql1);
                            $num = mysqli_num_rows($result1);
                            if($num == 0){
                                $sql = "SELECT title FROM blogdata2 WHERE id = '$id'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $title = $row['title'];
                                echo "<h4> Share: ".$title."</h4>";
                        ?>      <p>Say something about the content that you are about to share!</p>
                                 <form action="share.php" method="POST">
                                    <textarea cols="50" rows="7" style="resize: none;" class="center-block" name="message" id = "message" placeholder="Your Message!"></textarea>
                                    <br>
                                    <input type="submit" name="submit" value="Share" class="btn btn-default center-block"/>
                                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                </form> 
                            <?php
                            }
                            else{
                                echo "<h4 style='text-align: center;'>You have already shared this content.</h4>";
                            }
                        ?>  
                    </div>
            </div>
            <div id="popup1">
                <div class="notihead">
                    <div class="popupcontrols">
                        <span id="popupclose1">X</span>
                    </div>
                    <h2 style="text-align: center; color: #EEEEEE;">Censures</h2>
                </div>
                <br>
                    <div class="popupcontent">
                        
                        <?php
                            $sql1 = "SELECT * FROM adislikes WHERE contentid = '$id'";
                            $result1 = $conn->query($sql1);
                            $num1 = mysqli_num_rows($result1);
                            if($num1 == 0){
                                echo "<h4 style = 'text-align: center-block;'> No Censures Yet.</h4>";
                            }
                            while($row1 = $result1->fetch_assoc()){
                                $uidg = $row1['uid'];
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                        $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$uidg'";
                                        $result12 = $conn->query($sql12);
                                        $row12 = $result12->fetch_assoc();
                                        if($row12['verified'] == 1){
                                            $check1 = 1;
                                        }else{
                                            $check1 = 0;
                                        }
                                        if($check1 == 1){
                                            echo "<div class='item1'>";
                                            echo "<span class='notify-badge1'><img src='images/verified1.png' style='width: 15px; height: 15px;'></span>";
                                            if(isset($row12['dp'])){
                                                echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                            }else{
                                                echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }
                                            echo "</div>";
                                        }else{
                                            if(isset($row12['dp'])){
                                                echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }else{
                                                echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }
                                        }
                                    echo "</div>";
                                    echo "<div class='col-sm-7 col-lg-7 col-md-7'>";
                                        echo "<p>".$uidg."</p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<hr>";
                            }
                        ?>  
                    </div>
            </div>
            <div id="popup2">
                <div class="notihead">
                    <div class="popupcontrols">
                        <span id="popupclose2">X</span>
                    </div>
                    <h2 style="text-align: center; color: #EEEEEE;">Applauds</h2>
                </div>
                <br>
                    <div class="popupcontent">
                        
                        <?php
                            $sql1 = "SELECT * FROM alikes WHERE contentid = '$id'";
                            $result1 = $conn->query($sql1);
                            $num1 = mysqli_num_rows($result1);
                            if($num1 == 0){
                                echo "<h4 style = 'text-align: center-block;'> No Applauds Yet.</h4>";
                            }
                            while($row1 = $result1->fetch_assoc()){
                                $uidg = $row1['uid'];
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                                        $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$uidg'";
                                        $result12 = $conn->query($sql12);
                                        $row12 = $result12->fetch_assoc();
                                        if($row12['verified'] == 1){
                                            $check1 = 1;
                                        }else{
                                            $check1 = 0;
                                        }
                                        if($check1 == 1){
                                            echo "<div class='item1'>";
                                            echo "<span class='notify-badge1'><img src='images/verified1.png' style='width: 15px; height: 15px;'></span>";
                                            if(isset($row12['dp'])){
                                                echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                            }else{
                                                echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }
                                            echo "</div>";
                                        }else{
                                            if(isset($row12['dp'])){
                                                echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }else{
                                                echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                            }
                                        }
                                    echo "</div>";
                                    echo "<div class='col-sm-7 col-lg-7 col-md-7'>";
                                        echo "<p>".$uidg."</p>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<hr style='margin-top: 5px;'>";
                            }
                        ?> 
                    </div>
            </div>
            <script type="text/javascript">
                // Initialize Variables
                var closePopup = document.getElementById("popupclose");
                var overlay = document.getElementById("overlay");
                var popup = document.getElementById("popup");
                var button = document.getElementById("sharebtn");
                var button1 = document.getElementById("censurebtn");
                var button2 = document.getElementById("applaudbtn");
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