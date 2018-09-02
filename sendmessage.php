<?php
  include 'databh.php';
  session_start();
  $to = $_GET['to'];
  $uid = $_SESSION['uid'];
  $sql = "SELECT * FROM blogsignup WHERE uid='".$to."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
  <head>

    <title><?php echo $row['uid']." - Send Message"?></title>
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
}
.messagesDiv1 p{
    float: left;
    clear: left;
    color: #EDE7F6;
}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
function loadDoc(){
    var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("success").innerHTML = this.responseText;

                    }
                }
                xhttp.open("GET", "getmes.php?to="+<?php echo $to;?>, true);
                xhttp.send();
}
setInterval(loadDoc, 5000);
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
                      <li><a href="#">Contact</a></li>
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
          
          <div class="container-fluid" style="background-color: #FAFAFA">
            <div class="container">
            <br><br><br>
                <h2>Send Message</h2><br><br>
                            <div class="row">
                                <div class="col-sm-1 col-lg-1 col-lg-1">
                                    <?php
                                        if(isset($row['dp'])){
                                        echo "<img class='center-block' style='width: 50px; height: 50px; border-radius:50px;' src='".$row['dp']."'>";
                                    }else{
                                        echo "<img class='center-block' style='width: 50px; height: 50px; border-radius: 50px;' src='uploads/alternate1.png'";
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-1 col-lg-1 col-md-1">
                                    <?php
                                    echo "<h4 style='text-align: center;'>".$row['uid']."</h4>";
                                    ?>
                                </div>
                            </div><br><br>
                            <?php
                                $uid = $_SESSION['uid'];
                                $sql = "SELECT * FROM message1 WHERE to1 = '$uid' AND fr = '$to' OR fr = '$uid' AND to1 = '$to' ORDER BY id ASC";
                                $result = $conn->query($sql);
                                if(mysqli_num_rows($result) > 0){
                            ?>
                            <div class="row">
                                <div class="col-sm-10 col-lg-10 col-md-10">
                                    <?php
                                        
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
                                        }

                                    ?>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="row">
                <div class="col-sm-12 col-lg-12 col-md-12">
                    <?php
                    echo "<form method='POST' action='sendmes.php?to=".$to."'>";   
                    ?>       
                        <br><br>
                        <TEXTAREA name="message" id="message" class="center-block"></TEXTAREA><br>
                        <input type="submit" class="btn btn-default center-block" value="Send">
                    </form>
                </div>
            </div>
            <p id="success"></p>
          </div><br><br><br><br><br>
          </div>
          <div class="container-fluid footer" style="background-color: #1A237E; margin-bottom: 0px;">
            <div class="container">
                <div class="row">
                    <br>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <p style="color: #FFFFFF; "> Artymys.com</p>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <p style="color: #FFFFFF; text-align: right;">&copyArtymys Inc. 2016-2017</p>
                    </div>
                </div>
            </div>
        </div>
