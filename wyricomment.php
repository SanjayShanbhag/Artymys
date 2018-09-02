<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
		exit();
	}
	$uid = $_SESSION['uid'];
	$id = $_POST['id'];
	$sql = "SELECT uid FROM wyri WHERE id = '$id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$uid1 = $row['uid'];
	$comment = mysqli_real_escape_string($conn, trim($_POST['review']));
	$sql = "INSERT INTO wyricomment (uid, comment1, contentid) VALUES('$uid', '$comment', '$id')";
	$result = $conn->query($sql);
	$tye = 5;
	$sql = "INSERT INTO notifs (uid,nto,tye,info) VALUES('$uid', '$uid1', '$tye', '$id')";
	$result = $conn->query($sql);
	header('Location: wyris.php?id='.$id);
?>