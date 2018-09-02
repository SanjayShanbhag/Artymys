<?php
	session_start();
	include 'databh.php';
	if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
		header('Location: formnowlogin.php');
		exit();
	}
	$uid = $_SESSION['uid'];
	$id = $_POST['id'];
	if(empty($_POST['story']) || empty($_POST['title'])){
		echo "<p style='text-align: center; color: #FF2C00;'>The Title or the content cannot be empty</p>";
	}else{
		$sql = "SELECT title,messtoread,content FROM blogdata2 WHERE id = '$id'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$orgtitle = $row['title'];
		$orgcontent = $row['content'];
		$orgmessage = $row['messtoread'];
		$story = mysqli_real_escape_string($conn, trim($_POST['story']));
		$title = mysqli_real_escape_string($conn, trim($_POST['title']));
		$message = mysqli_real_escape_string($conn, trim($_POST['message']));
		$sql = "UPDATE blogdata2 SET title = '$title' WHERE id = '$id'";
  		$result = $conn->query($sql);
  		$sql = "UPDATE blogdata2 SET content = '$story' WHERE id = '$id'";
  		$result = $conn->query($sql);
		$sql = "UPDATE blogdata2 SET messtoread = '$message' WHERE id = '$id'";
		$result = $conn->query($sql); 
		$orgcontent = mysqli_real_escape_string($conn, trim($orgcontent));
		$titlecmp = strcmp($title, $orgtitle);
		$contentcmp = strcmp($story, $orgcontent);
		$messagecmp = strcmp($message, $orgmessage);
		if($titlecmp!=0 || $contentcmp!=0 || $messagecmp!=0){
			echo "<p style='text-align: center; color: #10E025;'>The changes have been updated successfully.</p>";
		}else{
			echo "<p style='text-align: center; color: #10E025;'>We have encountered no changes in the original and the updated story.</p>";
		}
	}
?>