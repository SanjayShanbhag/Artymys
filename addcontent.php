<?php
	session_start();
    include 'databh.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Artymys </title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<meta name="theme-color" content="#1A237E">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	 	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="javascript/wysiwyg.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
 	 	<link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
    	<script src="javascript/ninja-slider.js" type="text/javascript"></script>
        <style type="text/css">
            .styled-select {
                background: url(http://i62.tinypic.com/15xvbd5.png) no-repeat 96% 0;
                height: 29px;
                overflow: hidden;
                width: 240px;
            }

            .styled-select select {
                 background: transparent;
                border: none;
                font-size: 14px;
                height: 29px;
                padding: 5px; /* If you add too much padding here, the options won't show in IE */
                width: 268px;
            }
            .rounded {
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
            }
            .blue    
            { 
                background-color: #FFCDD2; 
            }
            #tags{
                margin-left: 50px;
                background-color: #C5CAE9;
                display: inline-block;
                border: none;
                border-radius: 5px;
                color: #636363;
                margin-right: 40px;
            }
        </style>
        <script type="text/javascript">
            function loadDoc(){
                var e = document.getElementById("tagopt");
                var tag = e.options[e.selectedIndex].value;
                var x = document.createElement("INPUT");
                x.setAttribute("type","hidden");
                x.setAttribute("value",tag);
                x.setAttribute("id",tag);
                x.setAttribute("name",tag);
                var parent = document.getElementById('myform');
                parent.appendChild(x);

                var tag = e.options[e.selectedIndex].text;
        var el_span = document.createElement('span');
        el_span.setAttribute('style', 'margin-right: 15px; border-right: solid; border-right-color: #FFFFFF; border-right-width: 7px;');
        var parent = document.getElementById('tags');
        parent.appendChild(el_span);

                var x = document.createTextNode(tag);
            el_span.appendChild(x);

            }
        </script>
    </head>
<body>

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
          					<a class="navbar-brand" href="#">Artymys</a>
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
                <br><br><br><br>
                <div class="container">
  <h2>Add Post: </h2><br><br>
  
  <form class="form-horizontal" name="myform" id="myform" action="blogprocess.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <h4>Add Title:</h4><br>
      <div class="col-sm-12 col-lg-12 col-md-12">
        <input type="text" class="form-control" name="title" placeholder="Enter Content Title">
      </div>
    </div>
    <div class="form-group">
        <br><br>
        <input type="file" name="file">
    </div>
    <div class="form-group">
        <br>
      <h4>Add Content:</h4><br>
      
      <div class="col-sm-12 col-lg-12 col-md-12">          
        <TEXTAREA  class="tinymce" name="content" id="content"></TEXTAREA>
       </div>
    </div>
    <div id="tags">

    </div>
    <br><h4>Add Tags: </h4>
    <div class="styled-select blue rounded">
        <select id="tagopt">
                <?php
                    $sql = "SELECT gen,id FROM gtype1 ORDER BY id ASC";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                        echo "<option value=".$row['id'].">".$row['gen']."</option>";
                    }
                ?>
        </select>

    </div>
    <br>
    <a onclick="loadDoc()" class="btn btn-default">Add</a>
    <br><br>
    <div class="form-group">
        <br>
      <h4>Message to the readers, if any:</h4><br>
      
      <div class="col-sm-6 col-lg-6 col-md-6">          
        <TEXTAREA  name="message" id="message" style="width: 100%; height: 200px; resize: none; box-shadow: inset 0px 1px 2px 1px rgba(0, 0, 0, 0.3), inset 0px -1px 1px 1px rgba(0, 0, 0, 0.2); outline: none;" Placeholder="Less than 150 characters." maxlength="150"></TEXTAREA>
       </div>
    </div>
    <br><br>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"> Submit</button>
      </div>
    </div>
  </form>

  </div>

</body>
</html>
	