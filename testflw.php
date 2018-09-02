<?php
    session_start();
    if(!($_SESSION['uid']) && empty($_SESSION['uid'])){
        echo "<script type ='text/javascript'>
                window.location.href='formnowlogin.php';
                </script>";
    }
    include 'databh.php';
    $uid = $_SESSION['uid'];
    $sql = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $dp = $row['dp'];
?>
<html>
  <head>
    <title> Profile Update - <?php echo $uid?> </title>
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
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    top:42px;
    left: 35px;
    padding:5px 10px;
    z-index: 2;
   
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
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
</script>
<script type="text/javascript">
    function loadDoc(a){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("as"+a).innerHTML = this.responseText;

                    }
                }
                xhttp.open("GET", "testgfollow.php?id="+a, true);
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
                                </li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </nav>
        </div>
        <div class="container">
        <br><br><br><br>
            <?php
                    $check = 1;
                    $sql = "SELECT * FROM gtype1";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        if($check % 4 == 0){
                            echo "<div class='row'>";
                        }
                        echo "<div class='col-sm-3 col-md-3 col-lg-3'>";
                            echo "<div class='cover'>";
                                echo "<h4 style='color: #636363; text-align: center;'>".$row['gen']."</h4>";
                                echo "<img src='".$row['imga']."' style='width: 90%; height: 150px;' class='center-block'/><br>";
                                $id1 = $row['id'];
                                $sql2 = "SELECT * FROM gfollow WHERE uid = '$uid' AND followedid = '$id1'";
                                $result2 = $conn->query($sql2);
                                $num = mysqli_num_rows($result2);
                              if($num > 0){
                                   echo '<a onclick="loadDoc('.$id1.')" id="as'.$id1.'" class="btn btn-default center-block"><img src="images/done.png" style="width: 20px; height: 20px; margin-right: 5px;"/></a>';
                                }
                                else{
                                    echo '<a onclick="loadDoc('.$id1.')" id="as'.$id1.'" class="btn btn-default center-block"><img src="images/follow.png" style="width: 20px; height: 20px; margin-right: 5px;"/></a>';
                                }
                                echo "<span id='abc'>";
                                echo "</span>";
                            echo "</div><br>";
                        echo "</div>";
                        if($check % 4 == 0){
                            echo "</div>";
                        }
                    }
                ?>
        </div>