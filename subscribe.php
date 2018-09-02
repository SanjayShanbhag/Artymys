<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$id = $_GET['id'];
		$tye = 1;
		$sql = "SELECT id FROM blogsignup WHERE uid = '$uid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$uidn = $row['id'];
		$sql = "SELECT subscribed FROM bookdetails WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(isset($row['subscribed']) && !empty($row['subscribed'])){
			$list = $row['subscribed'];
			$listarr = explode(" ", $list);
            $num14 = count($listarr);
            $flag = 1;
            for($j=0; $j<$num14; $j++){
                if($listarr[$j] == $uidn){
                    $flag = 0;
                    $ar = $j;
                }
            }
            if($flag == 1){
				$list = $list." ".$uidn;
				$sql = "UPDATE bookdetails SET subscribed = '$list' WHERE id = '$id'";
				$result = $conn->query($sql);
				$sql1 = "SELECT uid FROM bookdetails WHERE id='$id'";
				$result1 = $conn->query($sql1);
				$row1 = $result1->fetch_assoc();
				$to = $row1['uid'];
				$sql = "INSERT INTO notifs(uid,tye,info,nto) VALUE('$uid', '$tye', '$id', '$to')";
				$result = $conn->query($sql);
				echo "<a onclick='loadDoc()' style='cursor: pointer;' class='btn btn-default'>Subscribed</a>";
			}else{
				$list1 = "";
				for($j=0; $j<$num14; $j++){
					if($j!=$ar){
						$list1 = $list1 + $listarr[$j];
					}
				}
				$sql = "UPDATE bookdetails SET subscribed = '$list1' WHERE id = '$id'";
				$result = $conn->query($sql); 
				$tye = 2;
				$sql1 = "SELECT uid FROM bookdetails WHERE id='$id'";
				$result1 = $conn->query($sql1);
				$row1 = $result1->fetch_assoc();
				$to = $row1['uid'];
				$sql = "INSERT INTO notifs(uid,tye,info,nto) VALUE('$uid', '$tye', '$id', '$to')";
				$result = $conn->query($sql);
				echo "<a onclick='loadDoc()' style='cursor: pointer;' class='btn btn-default'>Subscribe</a>";
			}
		}else{
			$sql = "UPDATE bookdetails SET subscribed = '$uidn' WHERE id = '$id'";
			$result = $conn->query($sql); 
			$sql1 = "SELECT uid FROM bookdetails WHERE id='$id'";
			$result1 = $conn->query($sql1);
			$row1 = $result1->fetch_assoc();
			$to = $row1['uid'];
			$sql = "INSERT INTO notifs(uid,tye,info,nto) VALUE('$uid', '$tye', '$id', '$to')";
			$result = $conn->query($sql);
			echo "<a onclick='loadDoc()' style='cursor: pointer;' class='btn btn-default'>Subscribed</a>";
		}
		
	}else{
		header('loaction: formnowlogin.php');
	}
?>