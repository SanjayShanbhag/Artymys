<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
	}
	$uid = $_SESSION['uid'];
	$content = mysqli_real_escape_string($conn, trim($_POST['content']));
	$sql = "INSERT INTO wyri(uid, content) VALUES('$uid', '$content')";
	$result = $conn->query($sql);
	header('Location: feed.php');
?>