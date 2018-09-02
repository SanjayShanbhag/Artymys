<?php
	session_start();
	include 'databh.php';


  if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
	   echo "<script>
        window.location.href = 'formnowlogin.php'
        </script>";
  }
	$sql = "SELECT * FROM bookdetails";
	$result = $conn->query($sql);

	$arrayContent = array();

	$index = 0;

	while($row = $result->fetch_assoc()){
     $arrayContent[$index] = $row;
     $index++;
}
$id=$_GET['id'];
  $uid = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Artymys - Read Book </title>
    <link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
      <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
      <style type="text/css">
        p{
          font-family: 'Pangolin', cursive;
        }
      </style>
      <style type="text/css">
        p{
          color: #808080;
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
                xhttp.open("GET", "applaud.php?id="+<?php echo $id;?>, true);
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
                xhttp.open("GET", "censure.php?id="+<?php echo $id;?>, true);
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
                    <a class="navbar-brand" href="index.php">Artymys</a>
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
                                    <ul class="dropdown-menu" style="background-color: #1A237E;">
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
          <div class="container-fluid backBuffer">
          
          <div class="container">
  <h2>Read Articles</h2>
  <div class="row">
  
  <div class="col-sm-9 col-md-9 col-lg-9">
  <?php
  
  $sql="SELECT * FROM bookdetails WHERE id='$id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if(!mysqli_num_rows($result) > 0){
    echo "<script type='text/javascript'> 
    window.location.href='pnf.php'
    </script>";
  }
  echo "<br><br><h2 style='color:#FF3D00'>".$row['title']."</h2><br>";
  echo "<h5 style='text-align: right; color: #1A237E'> Authored By - ".$row['uid']."</h5><br>";
  echo "<p style='color: #000000;'>Date Added: ".$row['dateadd']."</p><br><br>";
  echo nl2br("<p style='color:#616161; line-height: 30px; font-size: 15px;'>".$row['descript']."</p><br><br>");
  echo nl2br("<p style='color:#616161; line-height: 30px; font-size: 15px;'>".$row['book']."</p><br><br>");
  echo "<a style='color: #1A237E;' href='readspecific.php?id=".$row['id']."'> Read More By - ".$row['uid']."</a>";
  echo "<br><br>";
  $applauds = $row['applaud'];
  $censures = $row['censure'];
  ?>
 <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-3">
    
    <?php
  if(is_null($applauds)){
          echo "<p style='text-align: center' id='appo'>No Applauds Yet.</p>";
        }else{
            echo "<p style='color: #808080; text-align: center' id='count'>".$applauds."  Applauds</p>";
        }
        $sql = "SELECT * FROM likes WHERE contentid = '$id' AND uid = '$uid'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        $sql = "SELECT * FROM dislikes WHERE contentid = '$id' AND uid = '$uid'";
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
          echo "<p style='text-align: center'>No Censures Yet.</p>";
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
        <h4>Leave a Review: </h4><br>
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <form action="submitbreview.php" method="POST">
                                <?php
                                    echo "<input type='hidden' name='id' id='id' value='".$id."'>";
                                ?>          
                                <TEXTAREA  class="tinymce" name="review" id="review"></TEXTAREA><br>
                                <button type="submit" class="btn btn-default">Post</button><br><br>
                            </form>
                        </div>
                        
                        <?php
                            $counter = 0;
                            $sql = "SELECT * FROM breview WHERE contentid = '$id'";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                $counter++;
                            }
                            if($counter>0){
                              echo "<br><h3> Reviews: </h3><br>";
                            $counter1 = 0;
                            $sql = "SELECT * FROM breview WHERE contentid = '$id' ORDER BY id ASC";
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
  <div class="col-sm-3 col-md-3 col-lg-3">
  <br><br>
    <h3 style="color: #000000; text-align: center;"> Popular Titles </h3><br><br>
    <div align="center">
    <?php
      $counter1 = 0;
      $sql = "SELECT * FROM bookdetails";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc()){
        echo "<a style='color: #E64A19;' href='readspecificbook.php?id=".$row['id']."'>".$row['title']."</a>";
        echo "<br><br><br>";
        $counter1++;
            }
      ?>
      </div>
  </div>
  </div>
</div>
</div>
<div class="container-fluid" style="background-color: #1A237E;">
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