<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
		exit();
	}
	$uid = $_SESSION['uid'];
	$id = $_POST['id'];
	$complain = mysqli_real_escape_string($conn, trim($_POST['complain']));
	echo $id;
	echo $complain;
	$sql = "SELECT id FROM report WHERE uid = '$uid' AND contentid = '$id'";
	$result = $conn->query($sql);
	$num = mysqli_num_rows($result);
	if($num > 0){
		header('Location: readspecific.php?id='.$id);
		exit();
	}
	$sql = "INSERT INTO report(uid,contentid,reason) VALUES('$uid', '$id', '$complain')";
	$result = $conn->query($sql);
	header('Location: rsucces.php?id='.$id);
		exit();
?>