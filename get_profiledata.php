<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) && empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
		exit();
	}
	$uid = $_SESSION['uid'];
	$tye = $_GET['tye'];
	if(isset($_GET['uid1'])){
		$uid = $_GET['uid1'];
	}
	if($tye == 1){
		$sql = "SELECT * FROM blogdata2 WHERE uid = '$uid' ORDER BY dateadd DESC";
		$result = $conn->query($sql);
		$flag = 0;
		$numresults = mysqli_num_rows($result);
		if($numresults == 0){
			echo "<h4 style='color: #636363; text-align: center;'><img src='images/feederror.png' style='width: 20px; height: 20px; margin-right: 5px;'> There are no stories by this user.</h4>";
		}
		while($row = $result->fetch_assoc()){
			$title = $row['title'];
			$applauds = $row['applaud'];
			$descript = $row['messtoread'];
			$image = $row['articleImage'];
			$id = $row['id'];
			$reads = $row['totalreads'];
			$rating = $row['rating'];
			if($flag == 3){
				$flag = 0;
			}
			if($flag == 0){
				echo "<div class='row'>";
			}
			echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
				echo "<div class='center-block card'>";
					echo "<br>";
					echo "<div style='text-align:center;'>";
						echo "<a href='readspecific.php?id=".$id."' style='color: #636363; text-decoration: none; font-size: 25px; text-align: center;'>".$title."</a>";
					echo "</div>";
					echo "<br>";
					if(isset($image) && !empty($image)){
						echo "<img src='".$image."' style='width: 80%; height: 300px;' class='center-block'>";
					}else{
						echo "<img src='images/coverart.png' style='width: 80%; height: 300px;' class='center-block'>";
					}
					echo "<br>";
					echo "<div class='row'>";
						echo "<div class='col-sm-1 col-md-1 col-lg-1'>";
						echo "</div>";
						echo "<div class='col-sm-3 col-md-3 col-lg-3'>";
							echo "<p style='text-align: center;'>".$applauds."<img src='images/applaud3.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-4 col-md-4 col-lg-4'>";
							echo "<p style='text-align: center;'>".$reads."<img src='images/reads1.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-3 col-md-3 col-lg-3'>";
							echo "<p style='text-align: center;'>".$rating."<img src='images/rate1.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-1 col-md-1 col-lg-1'>";
						echo "</div>";
					echo "</div>";
					if ((strlen($descript) > 300) && (strlen($descript) > 1)) { 
                		$whitespaceposition = strpos($descript," ",295); 
                		$descript = substr($descript, 0, $whitespaceposition);
                		$descript = $descript."...";
            		}
            		echo "<p style='margin-left: 5px; margin-right: 5px;'>".$descript."</p>";
            		$flag = $flag + 1;
            	echo "</div>";
            echo "</div>";
            if($flag == 3){
            	echo "</div>";
            	echo "<br>";
            }
		}
	}
	if($tye == 2){
		$sql = "SELECT * FROM bookdetails WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$numresults = mysqli_num_rows($result);
		if($numresults == 0){
			echo "<h4 style='color: #636363; text-align: center;'><img src='images/feederror.png' style='width: 20px; height: 20px; margin-right: 5px;'> There are no books by this user.</h4>";
		}
		$flag = 0;
		while($row = $result->fetch_assoc()){
			$id = $row['id'];
			$title = $row['title'];
			$descript = $row['descript'];
			$image = $row['articleImage'];
			$sql1 = "SELECT readcount,applaud,rating FROM bookchaps WHERE bookid = '$id'";
			$result1 = $conn->query($sql1);
			$readCount = 0;
			$applaudcount = 0;
			$count = 0;
			$rating = 0;
			while($row1 = $result1->fetch_assoc()){
				$readCount = $readCount + $row1['readcount'];
				$applaudcount = $applaudcount + $row1['applaud'];
				if($row1['rating'] != 0){
					$rating = $rating + $row1['rating'];
					$count = $count + 1;
				}
			}
			if($count != 0){
				$rating = $rating / $count;
			}
			if($flag == 3){
				$flag = 0;
			}
			if($flag == 0){
				echo "<div class='row'>";
			}
			echo "<div class='col-lg-4 col-md-4 col-sm-4'>";
				echo "<div class='center-block card'>";
					echo "<br>";
					echo "<div style='text-align:center;'>";
						echo "<a href='selectchaper.php?bid=".$id."' style='color: #636363; text-decoration: none; font-size: 25px; text-align: center;'>".$title."</a>";
					echo "</div>";
					echo "<br>";
					if(isset($image) && !empty($image)){
						echo "<img src='".$image."' style='width: 80%; height: 300px;' class='center-block'>";
					}else{
						echo "<img src='images/coverart.png' style='width: 80%; height: 300px;' class='center-block'>";
					}
					echo "<br>";
					echo "<div class='row'>";
						echo "<div class='col-sm-1 col-md-1 col-lg-1'>";
						echo "</div>";
						echo "<div class='col-sm-3 col-md-3 col-lg-3'>";
							echo "<p style='text-align: center;'>".$applaudcount."<img src='images/applaud3.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-4 col-md-4 col-lg-4'>";
							echo "<p style='text-align: center;'>".$readCount."<img src='images/reads1.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-3 col-md-3 col-lg-3'>";
							echo "<p style='text-align: center;'>".$rating."<img src='images/rate1.png' style='margin-left: 5px; height: 20px; width: 20px;'></p>";
						echo "</div>";
						echo "<div class='col-sm-1 col-md-1 col-lg-1'>";
						echo "</div>";
					echo "</div>";
					if ((strlen($descript) > 300) && (strlen($descript) > 1)) { 
                		$whitespaceposition = strpos($descript," ",295); 
                		$descript = substr($descript, 0, $whitespaceposition);
                		$descript = $descript."...";
            		}
            		echo "<p style='margin-left: 5px; margin-right: 5px;'>".$descript."</p>";
					$flag = $flag + 1;
				echo "</div>";
			echo "</div>";
			if($flag == 3){
				echo "</div>";
				echo "<br>";
			}
		}
	}
?>