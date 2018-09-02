<?php
	session_start();
	include 'databh.php';
	$uid = $_SESSION['uid'];
	$val = $_POST['val'];
	if($val == 1){
		$emp = $_POST['emp'];
		if(!empty($_POST['emp']) && isset($_POST['emp'])){
			$sql = "UPDATE blogsignup SET emp = '$emp' WHERE uid = '$uid'";
			$result = $conn->query($sql);
			echo "<p style='color: #00C853; text-align: center;'>Your employment details has been updated.</p>";
		}else{
			echo "<p style='color: #E65100; text-align: center;'>You haven't entered any details!</p>";
		}
	}else if($val == 2){
		$descript = $_POST['descript'];
		if(!empty($_POST['descript']) && isset($_POST['descript'])){
			$sql = "UPDATE blogsignup SET descript = '$descript' WHERE uid = '$uid'";
			$result = $conn->query($sql);
			echo "<p style='color: #00C853; text-align: center;'>Your description has been updated.</p>";
		}else{
			echo "<p style='color: #E65100; text-align: center;'>You haven't entered any details!</p>";
		}
	}
?>