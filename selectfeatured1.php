<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: login.php');
		exit;
	}
	$uid = $_SESSION['uid'];
	$id = $_GET['id'];
	$da = "B ".$id;
	$sql = "UPDATE blogsignup SET featured = '$da' WHERE uid = '$uid'";
	$result = $conn->query($sql);
	header('Location: profile.php');
?>