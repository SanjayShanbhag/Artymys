<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$id = $_GET['id'];
		$uid = $_SESSION['uid'];
		$sql = "SELECT library FROM blogsignup WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(isset($row['library']) && !empty($row['library'])){
			$list = $row['library'];
            $listarr = explode(" ", $list);
            $num14 = count($listarr);
            $flag = 1;
            for($j=0; $j<$num14; $j++){
                if($listarr[$j] == $id){
                    $flag = 0;
                    $ar = $j;
                }
            }
            if($flag == 1){
				$list = $list." ".$id;
				$sql = "UPDATE blogsignup SET library = '$list' WHERE uid = '$uid'";
				$result = $conn->query($sql);
				echo "<a onclick='loadDoc1(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/prolibraryactive.png' style='width:30px; height:20px;' class='center-block'/></a>";
			}else{
				$list1 = "";
				for($j=0; $j<$num14; $j++){
					if($j!=$ar){
						$list1 = $list1." ".$listarr[$j];
					}
				}
				$sql = "UPDATE blogsignup SET library = '$list1' WHERE uid = '$uid'";
				$result = $conn->query($sql); 
				echo "<a onclick='loadDoc1(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/prolibrary.png' style='width:30px; height:20px;' class='center-block'/></a>";
			}
		}else{
			$sql = "UPDATE blogsignup SET library = '$id' WHERE uid = '$uid'";
			$result = $conn->query($sql); 
			echo "<a onclick='loadDoc1(".$id.")' id='a".$id."' style='cursor: pointer;'><img src='images/prolibraryactive.png' style='width:30px; height:20px;' class='center-block'/></a>";
		}
		
	}else{
		header('loaction: formnowlogin.php');
	}
?>