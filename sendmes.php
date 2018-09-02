<?php
	require 'databh.php';
	session_start();
	$message = $_POST['message'];
	$from = $_SESSION['uid'];
	$to = $_POST['to'];
	$status = 1;
	$sql = "INSERT INTO message1(fr,to1,messag,seenstat) VALUES('$from', '$to', '$message', '$status')";
	$result = $conn->query($sql);
	$curr = date("Y-m-d H:i:s");
	echo "<div class='row'><div align='right' class='messagesDiv'><h4>".$message."</h4><p>".$curr."</p></div></div>";
                                             
                    
                                    
