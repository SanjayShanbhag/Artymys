<?php
	session_start();
    include 'databh.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Artymys - Add Book </title>
		<link rel="stylesheet" type="text/css" href="CSS/style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<meta name="theme-color" content="#1A237E">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	 	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
 	 	<link href="CSS/ninja-slider.css" rel="stylesheet" type="text/css" />
    	<script src="javascript/ninja-slider.js" type="text/javascript"></script>
        <style type="text/css">
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
        color:#FF3D00;
    }
    #search input[type=text]{width:430px !important;}
    .left{
    float: left;
}
.right{
    float: right;
}
.footer{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background:#ccc;
}

        </style>
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
                                echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><img src='images/Alternate.png' style='width: 20px; height: 20px; border-radius: 50px; margin-right: 10px;'/>" .$_SESSION['uid']."<span class='caret'></span></a>";
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
  
  <h2>Add Content</h2>
  <h2> Add Book </h2><br><br>
  <form class="form-horizontal" action="addnovelprocess.php" method="POST" enctype="multipart/form-data" id="myform" name="myform">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Add Book Title:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="title" placeholder="Enter Book Title">
      </div>
    </div>
    <div class="form-group">
        <br>
        <label class="control-label col-sm-2" for="email">Add Book Image:</label>
        <div class="col-sm-10">
            <input type="file" name="file">
        </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Add Book Description:</label>
      <div class="col-sm-10">          
        <TEXTAREA name="content" placeholder="Book Description Goes Here" cols="128" rows="10"></TEXTAREA>
      </div>
    </div>

    <div class="col-sm-2 col-lg-2 col-md-2">
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <div id="tags">

        </div>
    </div>
    <br>
    <br><label class="control-label col-sm-2" for="pwd">Add Tags:</label>
    <div class="col-sm-10 col-lg-10 col-md-10">

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
    </div>
    <br><br>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <BR>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  </div>
<div class="container-fluid footer" style="background-color: #1565C0; margin-bottom: 0px;">
            <div class="container">
                        <p style="color: #FFFFFF; " class="left"> Artymys.com</p>
                        <p style="color: #FFFFFF; text-align: right;" class="right">&copyArtymys Inc. 2016-2017</p>
            </div>
        </div>
</body>
</html>