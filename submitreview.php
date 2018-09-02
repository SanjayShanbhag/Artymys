<?php
	include 'databh.php';
	session_start();

	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$review = $_POST['review'];

		$review = mysqli_real_escape_string($conn, trim($_POST['review']));

		$contid = $_POST['id'];

		$sql = "INSERT INTO review (uid, comment1, contentid) VALUES('$uid', '$review', '$contid')";

		$result = $conn->query($sql);
		$sql = "SELECT uid FROM blogdata2 WHERE id = '$contid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$writer = $row['uid'];
		if($writer != $uid){
			$tye = 11;
			$sql = "INSERT INTO notifs(uid,nto,tye,info) VALUES('$uid', '$writer', '$tye', '$contid')";
			$result = $conn->query($sql);
		}
		echo "<script type ='text/javascript'>
		window.location.href='readspecific.php?id=".$contid."';
	</script>"; 

	}else{
		$message = "Please Log In";
  		echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnowlogin.php';
	</script>";
  		$result = false;
	}
?>