<?php
  session_start();
  include 'databh.php';
  $id = $_GET['id'];
  $uid = $_SESSION['uid'];
  $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $body = $row['content'];
    if ((strlen($body) > 400) && (strlen($body) > 1)) { 
    $whitespaceposition = strpos($body," ",395); 
    $body = substr($body, 0, $whitespaceposition); 
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Share - <?php echo $row['title']; ?> - Artymys</title>
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
.shareClass{
    background-color: #FFFFFF;
    box-shadow: 7px 7px 5px #888888; 
    border-radius: 15px;
}
textarea{
    width: 100%;
    height: 100px;
}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
})
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
                <div class="row">
                    <div class="col-sm-9 col-lg-9 col-md-9">
                        <h2>Share <?php echo $row['title']; ?></h2>
                        <br><br>

                        <div class="shareClass">
                        


                        <?php
                            if(isset($row['articleImage'])){

                                echo "<img src='".$row['articleImage']."' style='width: 95%; height: 200px;' class='center-block'>";
                            }
                            echo "<h5 style='text-align: center;'>".$body."  . . .</h5>";
                        ?>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <h4> 
                                <TEXTAREA  name="content" id="content" placeholder="Say Something About It.."></TEXTAREA>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
