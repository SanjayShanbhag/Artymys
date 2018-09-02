<?php
    session_start();
    if(!($_SESSION['uid']) && empty($_SESSION['uid'])){
        echo "<script type ='text/javascript'>
                window.location.href='formnowlogin.php';
                </script>";
    }
    include 'databh.php';
    $uid = $_SESSION['uid'];
    $id = $_GET['id'];
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
            document.getElementById("subs").innerHTML = this.responseText;

        }
    }
    xhttp.open("GET", "subscribe.php?id="+<?php echo $id;?>, true);
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
                $sql = "SELECT uid, title FROM bookdetails WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<h1 style='color: #FF3D00;'>".$row['title']."</h1>";
            ?>
            <h3 style="color: #636363;"> Select the chapter that you want to read!</h3>
            <?php
                            $sql = "SELECT * FROM bookchaps WHERE bookid='$id'";
                            $result = $conn->query($sql);
                            $num = mysqli_num_rows($result);
                            $chap = 1;
                            while($row = $result->fetch_assoc()){
                                echo "<div class='row'>";
                                    echo "<div class='col-sm-6 col-md-6 col-lg-6'>";
                                        $bid = $row['bookid'];
                                        echo "<br><br><h4> Chapter: ".$row['chapno']." </p>";
                                        $title = $row['title'];
                                        $chapno = $row['chapno'];
                                        echo "<a href='readchap.php?bid=".$bid."&ch=".$chapno."'>".$title."</a>";
                                        echo "<p>".$row['descript']."</p>";
                                        $chap = $chap +1;
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-md-2 col-lg-2'>";
                                        if(!isset($row['readcount']) || $row['readcount'] == 0){
                                            echo "<br><br><p style='text-align: center;'> No Reads yet.</p>";
                                        }else{
                                            echo "<br><br><p style='text-align: center;'>".$row['readcount']." Reads</p>";
                                        }
                                        echo "<img src='images/reads.png' style='width: 30px; height: 30px;' class='center-block'/>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-md-2 col-lg-2'>";
                                        if(!isset($row['applaud']) || $row['applaud'] == 0){
                                            echo "<br><br><p style='text-align: center;'> No Applauds yet.</p>";
                                        }else{
                                            echo "<br><br><p style='text-align: center;'>".$row['applaud']." Applauds</p>";
                                        }
                                        echo "<img src='images/applaud1.png' style='width: 30px; height: 30px;' class='center-block'/>";
                                    echo "</div>";
                                    echo "<div class='col-sm-2 col-md-2 col-lg-2'>";
                                        if(!isset($row['censure']) || $row['censure'] == 0){
                                            echo "<br><br><p style='text-align: center;'> No Censures yet.</p>";
                                        }else{
                                            echo "<br><br><p style='text-align: center;'>".$row['censure']." Censures</p>";
                                        }
                                        echo "<img src='images/censure.png' style='width: 30px; height: 30px;' class='center-block'/>";
                                    echo "</div>";
                                echo "</div>";
                            }
                            if($num == 0){
                                echo "<br><h4> The author hasn't uploaded any chapters yet. You can come back later. </h4>";
                            }
            ?>
            <br>
            <?php
                $sql = "SELECT id FROM blogsignup WHERE uid = '$uid'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $uidn = $row['id'];
                $sql14 = "SELECT subscribed FROM bookdetails WHERE id = '$id'";
                $result14 = $conn->query($sql14);
                $row14 = $result14->fetch_assoc();
                $list = $row14['subscribed'];
                $listarr = explode(" ", $list);
                $num14 = count($listarr);
                $flag = 1;
                for($j=0; $j<$num14; $j++){
                    if($listarr[$j] == $uidn){
                        $flag = 0;
                    }
                }
                if($flag == 1){
            ?>
           <span id="subs"> <a onclick="loadDoc()" style="cursor: pointer;" class="btn btn-default"> Subscribe </a></span>
           <?php
                }else{
            ?>
            <span id="subs"> <a onclick="loadDoc()" style="cursor: pointer;" class="btn btn-default"> Subscribed </a></span>
            <?php
                }
           ?>
        </div>