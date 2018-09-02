<?php
	session_start();
	include 'databh.php';
	
	$sql = "SELECT * FROM blogdata2";
	$result = $conn->query($sql);

	$arrayContent = array();

	$index = 0;

	while($row = $result->fetch_assoc()){
     $arrayContent[$index] = $row;
     $index++;
}


$rows = mysqli_num_rows($result);
//Total row count.


//Number of results we want displayed per page.
$page_rows = 21;
//Last page, page number.
$last = ceil($rows/$page_rows);
//Making sure that last page cannot be less than one.
if($last < 1){
    $last = 1;
}
//Establish pagenum variable;
$pagenum = 1;
//Get paenum variable from the URL if it exists.
if(isset($_GET['pn'])){
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
//Making sure the pagenum isn't below one.
if($pagenum < 1){
    $pagenum = 1;
}else if($pagenum > $last){
    $pagenum = $last;
}
//This sets the limit.
$limit =  'LIMIT ' .($pagenum-1) * $page_rows .',' .$page_rows;
//Establish the pagination controls.
$paginationCtrls = '';
//If there is more than one page worth of results.
if($last != 1){
    if($pagenum > 1){
        $previous = $pagenum - 1;
        $paginationCtrls .= '<a href = "'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
        //Clickable links that should appear on the left.
        for($i = $pagenum - 4; $i < $pagenum; $i++){
            if($i > 0){
                $paginationCtrls .='<a href = "'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
            }
        }
    }
    $paginationCtrls .= ''.$pagenum.' &nbsp; ';
    for($i = $pagenum+1; $i<= $last; $i++){
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
        if($i > $pagenum+4){
            break;
        }
    }
    if($pagenum != $last){
        $next = $pagenum+1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a>';
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title> Artymys </title>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
		<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="CSS/custom_content.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<meta name="theme-color" content="#1A237E">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 	 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	 	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
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
.item {
    position:relative;
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    top:40px;
    left: 17px;
    padding:5px 10px;
    z-index: 2;
   
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
    <div class="container-fluid" style=" background-color: #FAFAFA;">
        <div class="container">
        <br><br><br><br><br>
  <h2>Read Articles</h2>

 <div class="row">

    <div class="col-sm-12 col-lg-12 col-md-12">
        <?php
        $counter1 = 0;
        $sql = "SELECT * FROM blogdata2 ORDER BY id DESC ".$limit;
        $result = $conn->query($sql);



        
            $counter=0;
        ?>
        <br><br>
        <div class="row">
            <?php
            while($counter<3){
                while($row = $result->fetch_assoc()){
            ?>
            <div class="col-sm-4 col-md-4 col-lg-4">
                <?php
                echo "<div class='custo center-block' onclick='location.href=\"readspecific.php?id=".$row['id']."\"' style='background-color: #FFFFFF; width: 80%; min-height: 400px; box-shadow: 4px 4px 4px #EDE7F6; cursor: pointer;'>";
                ?>
                    <?php
                        echo "<h4 style='color: #E64A19; text-align: center; margin-top: 50px;'>".$row['title']."</h4><br>";
                        if(isset($row['articleImage'])){
                            echo "<img src='".$row['articleImage']."' style='width: 100%; height: 150px;'>";
                        }else{
                            echo"<img src='images/alternate.png' style='width: 100%; height: 150px; opacity: 0.85'>";
                        }
                        $sql2 = "SELECT * FROM blogsignup WHERE uid='".$row['uid']."'";
                        $result2 = $conn->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        if($row2['verified'] == 1){
                                $check1 = 1;
                            }else{
                                $check1 = 0;
                            }
                            if($check1 == 1){
                                ?>
                            <div class="item">
                            
                                <span class="notify-badge"><img src="images/verified1.png" style="width: 15px; height: 15px;"></span>
                                <?php
                    
                                if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px; z-index: 1;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }
                            
                            ?>
                            </div>
                            <?php
                        }else{
                            if(isset($row2['dp'])){
                                    echo"<img src='".$row2['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }else{
                                    echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; top: 10px;'>";
                                }
                        }
                                echo "<h5 style='text-align: right; color: #E64A19; display: inline; position: relative; left: 15px; top: 10px;'>".$row['uid']."</h5>";
                                echo "<div class='row'>";
                                    echo "<hr style='width: 100px; border-width: 2px; border-color: #1A237E; border-radius: 10px;'>";
                                    echo "<div class='col-sm-6 col-md-6 col-lg-6'>";
                                        echo "<img src='images/applaud1.png' style='width: 20px; height: 20px;' class='center-block'>";
                                        if(isset($row['applaud'])){
                                            echo "<p style='text-align: center;'>".$row['applaud']." Applauds</p>";
                                        }else{
                                            echo "<p style='text-align: center;'> No Applauds Yet </p>";
                                        }
                                    echo "</div>";
                                    echo "<div class='col-sm-6 col-md-6 col-lg-6'>";
                                        echo "<img src='images/censure1.png' style='width: 20px; height: 20px;' class='center-block'>";
                                        if(isset($row['censure'])){
                                            echo "<p style='text-align: center;'>".$row['censure']." Censures</p>";
                                        }else{
                                            echo "<p style='text-align: center;'> No Censures Yet </p>";
                                        }
                                    echo "</div>";
                                echo "</div>";
                    ?>
                </div>
            </div>
            <?php
                $counter1++;
                }
            ?>

        </div>
        <?php
                echo "<br>";
               $counter++; 
                }
            ?>

    


    </div>
    <div class="container">
        <br><br> <div id="pagination_controls"><?php echo $paginationCtrls;?></div><br><br><br>
    </div>
</div>
  
  
  </div>
  </div></div>
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
        </div>

</body>
</html>