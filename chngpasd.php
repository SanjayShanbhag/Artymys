<?php
	session_start();
	include 'databh.php';
	$orgpwd = $_POST['pwd1'];
	$newpwd = $_POST['pwd2'];
	$rptpwd = $_POST['pwd3'];
	$uid = $_SESSION['uid'];
	$sql = "SELECT pwd FROM blogsignup WHERE uid = '$uid'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$pwd4 = $row['pwd'];
	if(password_verify($orgpwd,$pwd4)){
		if($newpwd === $rptpwd){
			$hash = password_hash($newpwd, PASSWORD_BCRYPT);
			$sql = "UPDATE blogsignup SET pwd = '$hash' WHERE uid = '$uid'";
			$result = $conn->query($sql);
			echo "<p style='color: #00C853; text-align: center;'>Your Password has been updated successfully.</p>";
		}else{
			echo "<p style='color: #E65100; text-align: center;'>Your Passwords don't match.</p>";
		}
	}else{
		echo "<p style='color: #E65100; text-align: center;'>The Original Password You Entered is Incorrect!</p>";
	}
?>