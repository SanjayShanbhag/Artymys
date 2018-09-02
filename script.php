<?php
	include 'databh.php';
	session_start();
	$uid = $_SESSION['uid'];
	if(isset($_GET['offset']) && isset($_GET['limit'])){
		$offset = $_GET['offset'];
		$limit = $_GET['limit'];
		$sql = "SELECT * FROM stories WHERE sto = '$uid' ORDER BY score DESC LIMIT ".$limit." OFFSET ".$offset;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$tye = $row['tye'];
			$contentid = $row['contentid'];
            if($tye == 1){
                $contentidarr = explode(" ", $contentid);
                $contentid1 = $contentidarr[1];
                $sql4 = "SELECT * FROM blogdata2 WHERE id = '$contentid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $title = $row4['title'];
                $body = $row4['content']; 
			$flag1 = 0;
			if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                $whitespaceposition = strpos($body," ",295); 
                $body = substr($body, 0, $whitespaceposition);
                $flag1 = 1;
            }
            if($flag1 == 1){
            	$body = $body."...";
            }
            $image  = $row4['articleImage'];
            $writer = $row4['uid'];
            $applaud = $row4['applaud'];
            $censure = $row4['censure'];
            $reads = $row4['totalreads'];
            $date1 = $row4['dateadd'];
            $id = $row4['id'];
			echo "<div class='feedcard'>";
				echo "<br>";
				echo "<a href='readspecific.php?id=".$row4['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' rel='noopener norefferer'>".$row4['title']."</a>";
        		echo "<br><br>";
        		if(isset($row4['articleImage']) && !empty($row4['articleImage'])){
        			echo "<img src='".$row4['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
        			echo "<br>";
        		}
        		$sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writer'";
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
                    echo "<p style='display: inline; margin-left: 20px;'>".$writer."</p>";
                    echo "<br>";
					echo "<p>".$body."</p>";
					echo "<div class='row'>";
                        echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['applaud']."</p>";
                   		echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                          	echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['censure']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             echo "<p style='display: inline;'>".$row4['totalreads']."</p>";
                        echo "</div>";
                        echo "<div class='col-md-2 col-sm-2 col-lg-2'>";
                        echo "</div>";
                        echo "<div class='class='col-sm-3 col-lg-3 col-md-3'>";
                            $sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                            $result14 = $conn->query($sql14);
                            $row14 = $result14->fetch_assoc();
                            $list = $row14['articlelaterlist'];
                            $listarr = explode(" ", $list);
                            $num14 = count($listarr);
                            $flag = 1;
                            for($j=0; $j<$num14; $j++){
                                if($listarr[$j] == $id){
                                    $flag = 0;
                                }
                            }
                            if($flag == 1){
                             	echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            }else{
                                echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addedlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            } 
                        echo "</div>";
                    echo "</div>";
                    echo "<br>";
				echo "</div><br>";
            }
            if($tye == 2){
                $contentidarr = explode(" ", $contentid);
                $bookid1 = $contentidarr[1];
                $chapid1 = $contentidarr[2];
                $sql2 = "SELECT * FROM bookdetails WHERE id = '$bookid1'";
                $result2 = $conn->query($sql2);
                $row2 = $result2->fetch_assoc();
                echo "<div class='feedcard'>";
                echo "<br>";
                echo "<a href='selectchapter.php?id=".$row2['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;'>".$row2['title']."</a>";
                echo "<br>";
                if(isset($row2['articleImage']) && !empty($row2['articleImage'])){
                    echo "<img src='".$row2['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
                    echo "<br>";
                }
                $writ = $row2['uid'];
                $id = $row2['id'];
                $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writ'";
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
                echo "<p style='display: inline; margin-left: 20px;'>".$writ."</p>";
                echo "<br>";
                $sql4 = "SELECT * FROM bookchaps WHERE bookid = '$bookid1' AND chapno = '$chapid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $body = $row4['content'];
                $flag1 = 0;
                if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                    $whitespaceposition = strpos($body," ",295); 
                    $body = substr($body, 0, $whitespaceposition);
                    $flag1 = 1;
                }
                if($flag1 == 1){
                    $body = $body."...";
                }
                echo "<p>".$body."</p>";
                echo "<div class='row'>";
                    echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['applaud']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                            echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['censure']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             echo "<p style='display: inline;'>".$row4['readcount']."</p>";
                        echo "</div>";
                echo "</div>";
                echo "<br>";
                echo "</div>";
                echo "<br>";
            }
            if($tye == 3){
                $contentidarr = explode(" ", $contentid);
                $contentid1 = $contentidarr[1];
                $tagid1 = $contentidarr[2];
                $sql4 = "SELECT message,uid FROM share WHERE id = '$tagid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $message = $row4['message'];
                $sharer = $row4['uid'];
                $sql4 = "SELECT * FROM blogdata2 WHERE id = '$contentid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $title = $row4['title'];
                $body = $row4['content']; 
                $flag1 = 0;
                if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                    $whitespaceposition = strpos($body," ",295); 
                    $body = substr($body, 0, $whitespaceposition);
                    $flag1 = 1;
                }
                if($flag1 == 1){
                    $body = $body."...";
                }
                $image  = $row4['articleImage'];
                $writer = $row4['uid'];
                $applaud = $row4['applaud'];
                $censure = $row4['censure'];
                $reads = $row4['totalreads'];
                $date1 = $row4['dateadd'];
                $id = $row4['id'];
                echo "<div class='feedcard'>";
                echo "<br>";
                    $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$sharer'";
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
                    echo "<p style='display: inline; margin-left: 20px;'>".$sharer." shared this story.</p>";
                    echo "<br>";
                    echo "<p style='margin-left: 50px;'>".$message."</p>";
                    echo "<hr style='margin-bottom: 7px; margin-top: 3px;'>";
                    echo "<a href='readspecific.php?id=".$row4['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' rel='noopener norefferer'>".$row4['title']."</a>";
                echo "<br>";
                if(isset($row4['articleImage']) && !empty($row4['articleImage'])){
                    echo "<img src='".$row4['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
                    echo "<br>";
                }
                $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writer'";
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
                    echo "<p style='display: inline; margin-left: 20px;'>".$writer."</p>";
                    echo "<br>";
                    echo "<p>".$body."</p>";
                    echo "<div class='row'>";
                        echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['applaud']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                            echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['censure']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             echo "<p style='display: inline;'>".$row4['totalreads']."</p>";
                        echo "</div>";
                        echo "<div class='col-md-2 col-sm-2 col-lg-2'>";
                        echo "</div>";
                        echo "<div class='class='col-sm-3 col-lg-3 col-md-3'>";
                            $sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                            $result14 = $conn->query($sql14);
                            $row14 = $result14->fetch_assoc();
                            $list = $row14['articlelaterlist'];
                            $listarr = explode(" ", $list);
                            $num14 = count($listarr);
                            $flag = 1;
                            for($j=0; $j<$num14; $j++){
                                if($listarr[$j] == $id){
                                    $flag = 0;
                                }
                            }
                            if($flag == 1){
                                echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            }else{
                                echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addedlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            } 
                        echo "</div>";
                    echo "</div>";
                    echo "<br>";
                echo "</div><br>";
            }
            if($tye == 4){
                $contentidarr = explode(" ", $contentid);
                $contentid1 = $contentidarr[1];
                $tagid1 = $contentidarr[2];
                $sql4 = "SELECT gen FROM gtype1 WHERE id = '$tagid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $tagname = $row4['gen'];
                $sql4 = "SELECT * FROM blogdata2 WHERE id = '$contentid1'";
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();
                $title = $row4['title'];
                $body = $row4['content']; 
            $flag1 = 0;
            if ((strlen($body) > 300) && (strlen($body) > 1)) { 
                $whitespaceposition = strpos($body," ",295); 
                $body = substr($body, 0, $whitespaceposition);
                $flag1 = 1;
            }
            if($flag1 == 1){
                $body = $body."...";
            }
            $image  = $row4['articleImage'];
            $writer = $row4['uid'];
            $applaud = $row4['applaud'];
            $censure = $row4['censure'];
            $reads = $row4['totalreads'];
            $date1 = $row4['dateadd'];
            $id = $row4['id'];
            echo "<div class='feedcard'>";
                echo "<h5 style='margin-left: 10px; color: #B0BEC5;'><img src='images/genre.png' style = 'width: 15px; height: 15px;'/>  ".$tagname."</h5>";
                echo "<hr style='margin-bottom: 7px; margin-top: 3px;'>";
                echo "<a href='readspecific.php?id=".$row4['id']."' style='font-size: 20px; color: #000000; margin-left: 10px;' target='_blank' rel='noopener norefferer'>".$row4['title']."</a>";
                echo "<br>";
                if(isset($row4['articleImage']) && !empty($row4['articleImage'])){
                    echo "<img src='".$row4['articleImage']."' style='height: 200px; width: 100%; margin-bottom: 10px; margin-top: 10px;'/>";
                    echo "<br>";
                }
                $sql12 = "SELECT dp, verified FROM blogsignup WHERE uid = '$writer'";
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
                    echo "<p style='display: inline; margin-left: 20px;'>".$writer."</p>";
                    echo "<br>";
                    echo "<p>".$body."</p>";
                    echo "<div class='row'>";
                        echo "<div class='col-sm-1 col-lg-1 col-md-1'></div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/applaud1.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['applaud']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='border-right: solid; border-left: solid; border-left-color: #F6F6F6; border-left-width: 2px; border-right-color: #F6F6F6; border-right-width: 2px; text-align: center;'>";
                            echo "<img src='images/censure.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                            echo "<p style='display: inline;'>".$row4['censure']."</p>";
                        echo "</div>";
                        echo "<div class='col-sm-2 col-lg-2 col-md-2' style='text-align: center;'>";
                            echo "<img src='images/reads.png' style='width: 20px; height: 20px; display: inline;' class='center-block'/>";
                             echo "<p style='display: inline;'>".$row4['totalreads']."</p>";
                        echo "</div>";
                        echo "<div class='col-md-2 col-sm-2 col-lg-2'>";
                        echo "</div>";
                        echo "<div class='class='col-sm-3 col-lg-3 col-md-3'>";
                            $sql14 = "SELECT articlelaterlist FROM blogsignup WHERE uid = '$uid'";
                            $result14 = $conn->query($sql14);
                            $row14 = $result14->fetch_assoc();
                            $list = $row14['articlelaterlist'];
                            $listarr = explode(" ", $list);
                            $num14 = count($listarr);
                            $flag = 1;
                            for($j=0; $j<$num14; $j++){
                                if($listarr[$j] == $id){
                                    $flag = 0;
                                }
                            }
                            if($flag == 1){
                                echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            }else{
                                echo "<span id='readl".$id."'><a onclick='loadDoc(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/addedlater.png' style='width:20px; height:25px;' class='center-block'/></a></span>";
                            } 
                        echo "</div>";
                    echo "</div>";
                    echo "<br>";
                echo "</div><br>";
            }
		}
	}
?>