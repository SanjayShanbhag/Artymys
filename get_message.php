<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
	}
	$uid = $_SESSION['uid'];
	$to = $_GET['to'];
	$stat = 1;
	$sql = "SELECT * FROM message1 WHERE fr = '$to' AND to1 = '$uid' AND seenstat = '$stat'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$message = $row['messag'];
		$date1 = $row['date1'];
		$idmes = $row['id'];
		$stat1 = 0;
		echo "<div class='row'><div align='left' class='messagesDiv1'><h4>".$message."</h4><p>".$date1."</p></div></div>";
		$sql1 = "UPDATE message1 SET seenstat = '$stat1' WHERE id = '$idmes'";
		$result1 = $conn->query($sql1); 
	}
?>