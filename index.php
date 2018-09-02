<?php
	session_start();
	include 'databh.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Artymys</title>
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
    	html, body {
            height: 100%;
            margin: 0;
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
        .main1{
        	background-color: #1C2B33;
        	min-height: 100%;
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
    		$(".loader").fadeOut("slow");
		})
	</script>
		<body>
			<div class="loader"></div>
			<div class="container">
			<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #212121; border: none;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-left" href="index.php"><img src="images/s.png" style="height: 35px; width: 120px; margin-top: 13px;"></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse" style="margin: 5px;">
          					<ul class="nav navbar-nav navbar-right">
            					<li style="border: solid; border-color: #FAFAFA; border-width: 1px; border-radius: 3px;"><a href="index.php">Sign Up</a></li>
            					<li style="margin-left: 21px;"><a href="addnovel.php">Login</a></li>
            				</ul>
                    </div>
                </div>
            </nav>
           </div>
			<div class='container-fluid main1'>
				<div class="container">
					<br><br><br><br><br><br>
					<h1 style="text-align: center; color: #FAFAFA;"> Put Pen to Paper Now!</h1>
					<br><br>
					<div class="row" style="background-image: url('images/loginpic1.jpeg'); background-repeat: no-repeat;">
						<div class="col-sm-6 col-lg-6 col-md-6" style="background: rgba(0, 0, 0, 0.6);">
							<br><br><br><br><br><br>
							<p style="color: #FAFAFA;">Artymys is platform where you'll find stories that you just can't put down. </p>
						</div>
						<div class="col-md-6 col-lg-6 col-sm-6">
							hello
						</div>
					</div>
				</div>
			</div>
		</body>
	</head>
</html>
