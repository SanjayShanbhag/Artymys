<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$to = $_GET['to'];
		$val = 1;
		$sql = "SELECT * FROM message1 WHERE to1 = '$uid' AND fr = '$to' AND seenstat = '$val' ORDER BY id DESC LIMIT 1";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$message = $row['messag'];
		echo "Sanjay";
	}
?>