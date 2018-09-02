<?php
    session_start();
    include 'databh.php';
    if(!($_SESSION['uid']) && empty($_SESSION['uid'])){
        echo "<script type ='text/javascript'>
                window.location.href='formnowlogin.php';
                </script>";
    }else{
    $uid = $_SESSION['uid'];
    $bid = $_GET['bid'];
    $ch = $_GET['ch']; 
    $sql = "SELECT * FROM chapreads WHERE uid = '$uid' AND bid = '$bid' AND chapno = '$ch'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    $sql1 = "SELECT title FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch_assoc();
    $sql2 = "SELECT title FROM bookdetails WHERE id = '$bid'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    if($num == 0){
        $sql = "INSERT INTO chapreads(uid, bid, chapno) VALUES('$uid', '$bid', '$ch')";
        $result = $conn->query($sql);
        $sql = "SELECT readcount FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['readcount'];
        if(!isset($row['readcount'])){
            $count = 1;
        }else{
            $count = $count + 1;
        }
        $sql = "UPDATE bookchaps SET readcount = '$count' WHERE bookid = '$bid' AND chapno = '$ch'";
        $result = $conn->query($sql);
        $sql = "SELECT uid FROM bookdetails WHERE id = '$bid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $writer = $row['uid'];
        $sql = "SELECT totalreads FROM blogsignup WHERE uid = '$writer'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['totalreads'];
        if(!isset($count)){
            $count = 1;
        }else{
            $count = $count + 1;
        }
        $sql = "UPDATE blogsignup SET totalreads = '$count' WHERE uid = '$writer'";
        $result = $conn->query($sql);
    }
    }
   
?>
<html>
  <head>
    <title><?php echo $row2['title'];?> : <?php echo $row1['title'];?> - Artymys</title>
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
       .newpa p{
          font-family: 'Montserrat', sans-serif;
          font-size: 15px;
          color: #616161;
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
.cover{
    background-color: #FFFFFF;
    box-shadow: 2px 2px 2px 2px #EDE7F6;
}
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
                xhttp.open("GET", "applaud.php?bid="+<?php echo $bid;?>+"&ch="+<?php echo $ch?>, true);
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
                xhttp.open("GET", "censure.php?bid="+<?php echo $bid;?>+"&ch="+<?php echo $ch;?>, true);
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
                xhttp.open("GET", "chapterate.php?id="+<?php echo $bid;?>+"&rate=1&chap="+<?php echo $ch;?>, true);
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
                xhttp.open("GET", "chapterate.php?id="+<?php echo $bid;?>+"&rate=2&chap="+<?php echo $ch;?>, true);
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
                xhttp.open("GET", "chapterate.php?id="+<?php echo $bid;?>+"&rate=3&chap="+<?php echo $ch;?>, true);
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
                xhttp.open("GET", "chapterate.php?id="+<?php echo $bid;?>+"&rate=4&chap="+<?php echo $ch;?>, true);
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
                xhttp.open("GET", "chapterate.php?id="+<?php echo $bid;?>+"&rate=5&chap="+<?php echo $ch;?>, true);
                xhttp.send();
            }

</script>

</head>
<body>
<div class="loader"></div>
<div class="container">
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #1A237E; border: none;">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="height: 35px;"></a>
                    
                </div>
                
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="addnovel.php">Add Book</a></li>
                      <li><a href="readcontent.php">Read Content</a></li>
                      <li><a href="addcontent.php">Add Content</a></li>
                      <?php
                      if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
                                echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>" .$_SESSION['uid']."<span class='caret'></span></a>";
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
        <div class="container">
            <br><br><br><br>
            <?php
                $sql = "SELECT * FROM bookchaps WHERE bookid = '$bid' AND chapno='$ch'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $sql1 = "SELECT uid, title FROM bookdetails WHERE id = '$bid'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $writ = $row1['uid'];
                $sql2 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writ'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                echo "<h1 style='color: #FF3D00;'>".$row1['title']."</h1>";
                echo "<p>Written By: </p>";
                if($row2['verified'] == 1){
                                $check1 = 1;
                            }else{
                                $check1 = 0;
                            }
                            if($check1 == 1){
                                ?>
                            <div class="item">
                            
                                <span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                <?php
                    
                                if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                }
                            
                            ?>
                            </div>
                            <?php
                        }else{
                            if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                                }
                        }
                
                echo "<a href='userprofile.php?user=".$row1['uid']."' style= 'color: #636363; display: inline; margin-left: 20px;'>".$row1['uid']."</a>";
                echo "<br><br>";
                echo "<p><img src='images/reads.png' style='width: 20px; height: 20px;'/>                ".$row['readcount']." Reads</p>";
                                $sql2 = "SELECT rating FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
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
                echo "<hr>";
                echo "<div class='row'>";
                echo "<div class='col-sm-9 col-lg-9 col-md-9'>";
                    echo "<br> <h3 style='text-align: center;'>Chapter ".$ch.": ".$row['title']."</h3>";
                    echo "<br><span class='newpa'><p>".$row['content']."</p></span><br>";

                    echo "<hr>";
                    $applauds = $row['applaud'];
                    $censures = $row['censure'];
                ?>
                    <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-3">
    
                    <?php
                        if(is_null($applauds)){
                            echo "<p style='text-align: center' id='count'>No Applauds Yet.</p>";
                        }else{
                            echo "<p style='color: #808080; text-align: center' id='count'>".$applauds."  Applauds</p>";
                        }
                        $sql = "SELECT * FROM likes WHERE contentid = '$bid' AND chno = '$ch' AND uid = '$uid'";
                        $result = $conn->query($sql);
                        $num = mysqli_num_rows($result);
                        $sql = "SELECT * FROM dislikes WHERE contentid = '$bid' AND chno = '$ch' AND uid = '$uid'";
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
                            echo "<p style='text-align: center' id='ucount'>No Censures Yet.</p>";
                        }else{
                            echo "<p style='color: #808080; text-align: center' id='ucount'>".$censures."  Censures</p>";
                        }
                        if($num1 == 0){
                            echo "<a onclick='loadDoc1()' id='ulike' style='cursor: pointer;'><img src='images/censure1.png' style='width:30px; height: 30px;' class='center-block'/></a>";
                        }else{
                            echo "<a onclick='loadDoc1()' id='ulike' style='cursor: pointer;'><img src='images/censured.png' style='width:30px; height: 30px;' class='center-block'/></a>";
                        }
                    ?>

                </div>
                </div>
                <?php
            echo "</div>";
                echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                    $sql = "SELECT title, bookid, chapno FROM bookchaps WHERE bookid = '$bid' ORDER BY chapno ASC";
                    $result = $conn->query($sql);
                    $num = mysqli_num_rows($result);
                    if($num > 0){
                        echo "<h4> Other Chapters of the title: </h4>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<br><br><a href=readchap.php?bid=".$bid."&ch=".$row['chapno'].">Chapter No. ".$row['chapno'].": ".$row['title']."</a>";
                        }
                    }
                echo "</div>";
                echo "</div>";
            ?>
            <br>



             <div class="row">
    <hr>
    <div class="col-sm-9 col-lg-9 col-md-9">
    <h4> Your Rating: </h4>
        <?php 
            $sql = "SELECT rate FROM bookrate WHERE uid = '$uid' AND contentid = '$bid' AND chapid = '$ch'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $num = mysqli_num_rows($result);
            if($num == 1){
                $rate = $row['rate'];
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
    <hr>


            <br><br><h4>Leave a Review: </h4><br>
                        <div class="col-sm-9 col-lg-9 col-md-9">
                            <form action="submitbreview.php" method="POST">
                                <?php
                                    echo "<input type='hidden' name='id' id='id' value='".$bid."'>";
                                    echo "<input type='hidden' name='chno' id='chno' value='".$ch."'>";
                                ?>          
                                <TEXTAREA  class="tinymce" name="review" id="review"></TEXTAREA><br>
                                <button type="submit" class="btn btn-default">Post</button><br><br>
                            </form>
                        </div>
                        
                        <?php
                            $counter = 0;
                            $sql = "SELECT * FROM breview WHERE contentid = '$bid' AND chno = '$ch'";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                $counter++;
                            }
                            if($counter>0){
                              
                            $counter1 = 0;
                            $sql = "SELECT * FROM breview WHERE contentid = '$bid' AND chno = '$ch' ORDER BY id ASC";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                        ?>
                        <div class="row">
                            <div class="col-lg-9 col-md-9 col-sm-9">
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
    <br>
        <div class="container-fluid" style="background-color: #1A237E;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
    </body>
</html>
