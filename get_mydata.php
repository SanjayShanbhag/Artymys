<?php
	include 'databh.php';
	session_start();
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
	}
	$uid = $_SESSION['uid'];
	if(isset($_GET['tye']) && !empty($_GET['tye'])){
		$tye = $_GET['tye'];
		echo "<br>";
		if($tye == 1){
			$sql = "SELECT * FROM blogdata2 WHERE uid = '$uid' ORDER BY dateadd DESC";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$title = $row['title'];
				$id = $row['id'];
				$body = $row['content'];
				$flag1 = 0;
				if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                	$whitespaceposition = strpos($body," ",295); 
                	$body = substr($body, 0, $whitespaceposition);
                	$flag1 = 1;
            	}
            	if($flag1 == 1){
            		$body = $body."...";
            	}
            	$image  = $row['articleImage'];
            	$applaud = $row['applaud'];
            	$censure = $row['censure'];
            	$reads = $row['totalreads'];
            	$date1 = $row['dateadd'];
            	echo "<div class='feedcard'>";
				echo "<br>";
				echo "<a href='readspecific.php?id=".$row['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' px;='noopener norefferer'>".$row['title']."</a>";
        		echo "<br><br>";
        		if(isset($row['articleImage']) && !empty($row['articleImage'])){
        			echo "<img src='".$row['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
        			echo "<br>";
        		}
        		$sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$uid'";
                $result12 = $conn->query($sql12);
                $row12 = $result12->fetch_assoc();
        		if($row12['verified'] == 1){
                   	$check1 = 1;
                }else{
                    $check1 = 0;
                }
                if($check1 == 1){
                     echo "<div class='item'>";
                     	echo "<span class='notify-badge'><img src='images/verified1.png' style='width: 15px; height: 15px;'></span>";
                     	if(isset($row12['dp'])){
                            echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                        }else{
                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                        }
                    echo "</div>";
                }else{
                    if(isset($row12['dp'])){
                            echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                    }else{
                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                    }
                }
                    echo "<p style='display: inline; margin-left: 20px;'>".$uid."</p>";
                    echo "<br>";
					echo "<p>".$body."</p>";
					echo "<div class='row'>";
                        echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row['applaud']."</p>";
                   		echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                          	echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row['censure']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             echo "<p style='display: inline;'>".$row['totalreads']."</p>";
                        echo "</div>";
                    echo "</div>";
                    echo "<br>";
                    echo "<div class='row'>";
                    	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                    	echo "</div>";
                    	echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                    		echo "<a href='editstory.php?id=".$id."' class='btn btn-default center-block'>Edit</a>";
                    	echo "</div>";
                    	echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                    		echo "<a onclick='loadPopup(".$id.")' class='btn btn-default center-block'>Delete</a>";
                    	echo "</div>";
                    echo "</div>";
                    echo "<br>";
                    echo "</div>";
                    echo "<br>";
				echo "</div>";
			}
		}
		if($tye == 2){
			$sql = "SELECT * FROM bookdetails WHERE uid = '$uid' ORDER BY id DESC";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$id = $row['id'];
				$uid = $row['uid'];
				$title = $row['title'];
				$descript = $row['descript'];
				$flag1 = 0;
				if ((strlen($descript) > 300) && (strlen($descript) > 1)) { 
                	$whitespaceposition = strpos($descript," ",295); 
                	$descript = substr($descript, 0, $whitespaceposition);
                	$flag1 = 1;
            	}
            	if($flag1 == 1){
            		$descript = $descript."...";
            	}
            	$dateadd = $row['dateadd'];
            	echo "<div class='feedcard'>";
				echo "<br>";
				echo "<a href='selectchapter.php?id=".$row['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' rel='noopener norefferer'>".$row['title']."</a>";
        		echo "<br><br>";
        		if(isset($row['articleImage']) && !empty($row['articleImage'])){
        			echo "<img src='".$row['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
        			echo "<br>";
        		}
        		$sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$uid'";
                $result12 = $conn->query($sql12);
                $row12 = $result12->fetch_assoc();
        		if($row12['verified'] == 1){
                   	$check1 = 1;
                }else{
                    $check1 = 0;
                }
                if($check1 == 1){
                     echo "<div class='item'>";
                     	echo "<span class='notify-badge'><img src='images/verified1.png' style='width: 15px; height: 15px;'></span>";
                     	if(isset($row12['dp'])){
                            echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px; z-index: 1;'>";
                        }else{
                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                        }
                    echo "</div>";
                }else{
                    if(isset($row12['dp'])){
                            echo"<img src='".$row12['dp']."' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                    }else{
                            echo "<img src='uploads/alternate2.png' style='height: 30px; width: 30px; border-radius: 50px; position: relative; left: 10px;'>";
                    }
                }
                    echo "<p style='display: inline; margin-left: 20px;'>".$uid."</p>";
                    echo "<br>";
					echo "<p>".$descript."</p>";
					echo "<br>";
					echo "<div class='row'>";
                    	echo "<div class='col-sm-3 col-lg-3 col-md-3'>";
                    	echo "</div>";
                    	echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                    		echo "<a class='btn btn-default center-block'>Edit</a>";
                    	echo "</div>";
                    	echo "<div class='col-sm-2 col-lg-2 col-md-2'>";
                    		echo "<a class='btn btn-default center-block'>Delete</a>";
                    	echo "</div>";
                    echo "</div>";
                    echo "<br>";
                    echo "</div>";
                    echo "<br>";
				echo "</div><br>";
			}
		}
	}
?>