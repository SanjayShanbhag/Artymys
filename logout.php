<?php 
session_start(); 
include 'databh.php';

if(isset($_COOKIE['connected']) && !empty($_COOKIE['connected'])){
	$token = $_COOKIE['connected'];
	$sql = "DELETE FROM user_tokens WHERE token = '$token'";
	$result = $conn->query($sql);
	setcookie("connected", "", time() - 3600);
}
session_destroy();
if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
	$message = "Successfully logged out.";
	echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnowlogin.php';
	</script>";
	die();
}else{
	$message = "Please Log In First.";
	echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnowlogin.php';
	</script>";
}
	?>
