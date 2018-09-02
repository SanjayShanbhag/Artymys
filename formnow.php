<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<html>
  <head>
    <title> Artymys </title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <meta name="theme-color" content="#1A237E">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
      <script src="javascript/ninja-slider.js" type="text/javascript"></script>
    <script type="text/javascript">
    function validate(){
      var a = document.getElementById('first').value;
      var b = document.getElementById('last').value;
      var c = document.getElementById('email').value;
      var d = document.getElementById('uid').value;
      var e = document.getElementById('pwd').value;
      if(a.length===0 || b.length===0 || c.length===0 || d.length===0 || e.length===0){
        alert("Enter all the required details.")
        return false;
      }else{
        return true;
      }
    }
  </script>
  <style type="text/css">
    .logbox{
            background: rgba(0, 0, 0, 0.6);
            vertical-align: middle;
            border-radius: 10px;
        }
        .backBuffer{
            width: 100%;
            height: 100%;
    background-image: url('images/ab.jpg');
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    position: fixed; 
    bottom: 0px;

}
  </style>
</head>

<body>
<div class="container-fluid backBuffer">

          <div class="container">
          <br><br><br><br>
  <div class="row">
  <div class="col-sm-3 col-lg-3 col-md-3">
  </div>
  <div class="col-sm-7 col-md-7 col-lg-7">   
          <div class="logbox">   
        <br><h2 style="text-align: center; color: #FFCA28"><img src="images/lo2.png" style="width: 50px; height: 35px; position: relative; top: -5px;"/>RTYMYS SIGNUP</h2><br>
        
  <form class="form-horizontal" action="fnsu.php" method="POST" onsubmit="return validate(this)" enctype="multipart/formdata">
    <div class="form-group">
      <label class="control-label col-sm-2" style="color: #FFCA28; margin-left: 50px;">First Name:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="first" id="first" placeholder="Enter First Name">
      </div>
    </div>
    <div class="form-group">
      <br><label class="control-label col-sm-2" style="color: #FFCA28; margin-left: 50px;">Last Name:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="last" id="last" placeholder="Enter Last Name">
      </div>
    </div>
    <div class="form-group">
      <br><label class="control-label col-sm-2" style="color: #FFCA28; margin-left: 50px;">User Id:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="uid" id="uid" placeholder="Enter User ID">
      </div>
    </div>
    <div class="form-group">
      <br><label class="control-label col-sm-2" for="email" style="color: #FFCA28; margin-left: 50px;">Email:</label>
      <div class="col-sm-7">
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
      </div>
    </div>
    <div class="form-group">
      <br><label class="control-label col-sm-2" for="pwd" style="color: #FFCA28; margin-left: 50px;">Password:</label>
      <div class="col-sm-7">          
        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password"><br>
      </div>
    </div>
   
        
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-8">
        <button type="submit" class="btn btn-default center-block" name="submit" onClick="return validate();">Submit</button>
      </div>
    </div>
  </form>
  
  <br>
  <br>
  </div>
  </div>
  </div>
 </div> 
</div>
</body>
</html>
