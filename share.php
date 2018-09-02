<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && isset($_POST['id']) && !empty($_POST['id'])){
		$uid = $_SESSION['uid'];
		$id = $_POST['id'];
		$message = $_POST['message'];
		$sql = "SELECT * FROM share WHERE uid = '$uid' AND contentid = '$id'";
		$result = $conn->query($sql);
		$num = mysqli_num_rows($result);
		if($num == 0){
			$sql = "INSERT INTO share(uid, contentid, message) VALUES('$uid', '$id', '$message')";
			$result = $conn->query($sql);
		}
		$sql = "SELECT uid FROM blogdata2 WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$writer = $row['uid'];
		if($writer != $uid){
			$tye = 10;
			$sql = "INSERT INTO notifs(uid,nto,tye,info) VALUES('$uid', '$writer', '$tye', '$id')";
			$result = $conn->query($sql);
		}
		$sql1 = "SELECT id FROM share WHERE uid = '$uid' ORDER BY id DESC LIMIT 1";
		$result1 = $conn->query($sql1);
		$row1 = $result1->fetch_assoc();
		$shareid = $row1['id'];
		$actualid = "A ".$id." ".$shareid;
		$tye = 3;
		$sql = "SELECT uid FROM follow WHERE followed = '$uid'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$uidg = $row['uid'];
			if($uidg != $uid){
				
				$sql1 = "INSERT INTO stories(uid, contentid, sto, tye) VALUES('$uid', '$actualid', '$uidg', '$tye')";
				$result1 = $conn->query($sql1);
			}
		}
		echo "<script type ='text/javascript'>
    		window.location.href='readspecific.php?id=".$id."';
    	</script>";	
	}
	
?>