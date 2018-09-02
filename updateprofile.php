<?php
    session_start();
    include 'databh.php';
    if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
        $uid = $_SESSION['uid'];
        $sql = "SELECT dp,penName FROM blogsignup WHERE uid = '$uid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $dp = $row['dp'];
        $pn = $row['penName'];
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
                #popupclose {
                    float: right;
                    padding: 10px;
                    cursor: pointer;
                }
                #popup1 {
                    display: none;
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    background: #F5F5F5;
                    width: 500px;
                    height: 400px;
                    margin-left: -250px; /*Half the value of width to center div*/
                    margin-top: -250px; /*Half the value of height to center div*/
                    z-index: 200;
                    border-radius: 5px;
                }
                #popupclose1 {
                    float: right;
                    padding: 10px;
                    cursor: pointer;
                }
                #popup2 {
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
                #popup3 {
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
                #popupclose2 {
                    float: right;
                    padding: 10px;
                    cursor: pointer;
                }
                #popupclose3 {
                    float: right;
                    padding: 10px;
                    cursor: pointer;
                }
                .popupcontent {
                    padding: 10px;
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
                    var message = $("#emp");
                    var val1 = 1;
                    var url = "profilesave.php";
                    $.post(url,{emp: message.val(), val: val1}, function(data){
                        $('.resudiv').append(data);
                    });
                }
                function loadDoc1(){
                    var message = $("#descript");
                    var val1 = 2;
                    var url = "profilesave.php";
                    $.post(url,{descript: message.val(), val: val1}, function(data){
                        $('.resudiv1').append(data);
                    });
                }
                function loadDoc3(){
                    var message = $("#pwd1");
                    var message1 = $("#pwd2");
                    var message2 = $("#pwd3");
                    var url = "chngpasd.php";
                    $.post(url,{pwd1: message.val(), pwd2: message1.val(), pwd3: message2.val()}, function(data){
                        $('.resudiv2').append(data);
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
            <div class="container" style="min-height: 100%;">
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
                        
                        <h3 style="color: #636363; text-align: center;"> Profile Picture </h3>
                        <br>
                        <?php
                            $sql = "SELECT * FROM blogsignup WHERE uid = '$uid'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if(isset($row['dp']) && !empty($row['dp'])){
                                $dp = $row['dp'];
                                echo "<img src='".$dp."' style='width: 150px; height: 150px;' class='center-block'/>";
                            }else{
                                echo "<img src='images/alternate.png' style='width: 150px; height: 150px;' class='center-block'/>";
                            }
                        ?>
                        <br>
                        <div style="text-align: center;">
                            <a id="dpupdate" style="cursor: pointer; text-decoration: none;"><img src="images/edit.png" style="width: 20px; height: 20px; margin-right: 5px;"/>Update</a>
                        </div>
                        <hr style="border-width: 3px;">
                        <div class="row">
                            <div class="col-sm-5 col-lg-5 col-md-5">
                               <h3 style="color: #636363; text-align: center;"> Employment </h3>
                               <?php
                                    if(isset($row['emp']) && !empty($row['emp'])){
                                        $emp = $row['emp'];
                                        echo "<p style='text-align: justify;'>".$emp."</p>";
                                    }else{
                                        echo "<p style='text-align: center;'>No Employment Record Added</p>";
                                    }
                               ?> 
                               <div style="text-align: center;">
                                    <a style="cursor: pointer; text-decoration: none;" id="empupdate"><img src="images/edit.png" style="width: 20px; height: 20px; margin-right: 5px;"/>Update</a>
                                </div>
                            </div>
                            <div class='col-sm-1 col-lg-1 col-md-1'>
                            </div>
                            <div class="col-sm-6 col-lg-6 col-md-6">
                                <h3 style="color: #636363; text-align: center;"> Description </h3>
                                <?php
                                    if(isset($row['descript']) && !empty($row['descript'])){
                                        $descript = $row['descript'];
                                        echo "<p style='text-align: justify;'>".$descript."</p>";
                                    }else{
                                        echo "<p style='text-align: center;'>No Employment Record Added</p>";
                                    }
                               ?>
                               <div style="text-align: center;">
                                    <a style="cursor: pointer; text-decoration: none;" id="desupdate"><img src="images/edit.png" style="width: 20px; height: 20px; margin-right: 5px;"/>Edit</a>
                                </div>
                            </div>
                        </div>
                        <hr style="border-width: 3px;">
                        <div style="text-align: center;">
                            <a id="cpbutton" style="cursor: pointer; text-decoration: none;"> <img src="images/edit.png" style="width: 20px; height: 20px; margin-right: 5px;"/>Change Password</a>
                        </div>
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
                        <a onclick="loadDoc3()" class="btn btn-default">Change Password.</a>
                        <br>
                        <div id="resudiv2" class="resudiv2"></div>
                </div>
            </div>
            <div id="popup1">
                <div class="popupcontrols">
                    <span id="popupclose1">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Edit Employment</h1><br>
                    <img src="images/settings.png" style="height: 100px; width: 100px;" class="center-block"/><br>
                    <?php
                        if(isset($row['emp']) && !empty($row['emp'])){
                            echo "<input type='text' class='form-control' id='emp' placeholder='Employement' value='".$emp."' />";            
                        }else{
                            echo '<input type="text" class="form-control" id="emp" placeholder="Employement" />';
                        }
                    ?>
                        <br>
                        <div style="text-align: center;">
                            <a onclick="loadDoc()" class="btn btn-default">Update</a>
                        </div>
                        <div id="resudiv" class="resudiv"></div>
                </div>
            </div>
            <div id="popup2">
                <div class="popupcontrols">
                    <span id="popupclose2">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Edit Description</h1><br>
                    <img src="images/settings.png" style="height: 100px; width: 100px;" class="center-block"/><br>
                    <?php
                        if(isset($row['descript']) && !empty($row['descript'])){
                            echo "<textarea class='form-control' id='descript' style='resize: none; overflow: auto;' rows='9'>".$descript."</textarea>";            
                        }else{
                            echo '<textarea class="form-control" id="descript" placeholder="Describe Yourself." style="resize: none; overflow: auto;" rows="9" ></textarea>';
                        }
                    ?>
                        <br>
                        <div style="text-align: center;">
                            <a onclick="loadDoc1()" class="btn btn-default">Update</a>
                        </div>
                        <div id="resudiv1" class="resudiv1"></div>
                </div>
            </div>
            <div id="popup3">
                <div class="popupcontrols">
                    <span id="popupclose3">X</span>
                </div>
                <div class="popupcontent">
                    <h1 style="text-align: center;">Update Profile Picture</h1><br>
                    <?php
                        $sql1 = "SELECT dp FROM blogsignup WHERE uid = '$uid'";
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
                var closePopup1 = document.getElementById("popupclose1");
                var closePopup2 = document.getElementById("popupclose2");
                var closePopup3 = document.getElementById("popupclose3");
                var overlay = document.getElementById("overlay");
                var popup = document.getElementById("popup");
                var popup1 = document.getElementById("popup1");
                var popup2 = document.getElementById("popup2");
                var popup3 = document.getElementById("popup3");
                var button = document.getElementById("cpbutton");
                var button1 = document.getElementById("empupdate");
                var button2 = document.getElementById("desupdate");
                var button3 = document.getElementById("dpupdate");

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
                closePopup3.onclick = function() {
                    overlay.style.display = 'none';
                    popup3.style.display = 'none';
                };
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
                button3.onclick = function() {
                    overlay.style.display = 'block';
                    popup3.style.display = 'block';
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