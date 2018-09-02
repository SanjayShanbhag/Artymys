<?php
	session_start();
	include 'databh.php';
	$uid = $_SESSION['uid'];
	$id = $_GET['id'];
	$go = $_GET['go'];
	$sql = "SELECT * FROM gfollow WHERE uid = '$uid' AND followedid = '$id'";
	$result = $conn->query($sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		$sql = "DELETE FROM gfollow WHERE uid = '$uid' AND followedid = '$id'";
		$result = $conn->query($sql);
		$sql = "SELECT followercount FROM gtype1 WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc(); 
		$followercount = $row['followercount'];
		$followercount = $followercount - 1;
		$sql = "UPDATE gtype1 SET followercount = '$followercount' WHERE id = '$id'";
		$result = $conn->query($sql);
	}else{
		$sql = "INSERT INTO gfollow (uid, followedid) VALUES('$uid', '$id')";
		$result = $conn->query($sql);
		$sql = "SELECT followercount FROM gtype1 WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(isset($row['followercount']) && !empty($row['followercount'])){
			$followercount = 1;
			$sql = "UPDATE gtype1 SET followercount = '$followercount' WHERE id = '$id'";
			$result = $conn->query($sql);
		}else{
			$followercount = $row['followercount'];
			$followercount = $followercount + 1;
			$sql = "UPDATE gtype1 SET followercount = '$followercount' WHERE id = '$id'";
			$result = $conn->query($sql);
		}
	}
	if(isset($go)){
		header("location: flw.php");
	}else{
		header("location: op.php");
	}
?>