<?php
	include 'databh.php';
	session_start();

	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$review = $_POST['review'];
		$ch = $_POST['chno'];

		$review = mysqli_real_escape_string($conn, trim($_POST['review']));

		$contid = $_POST['id'];

		$sql = "INSERT INTO breview (uid, comment1, contentid, chno) VALUES('$uid', '$review', '$contid', '$ch')";

		$result = $conn->query($sql);
		echo "<script type ='text/javascript'>
		window.location.href='readchap.php?bid=".$contid."&ch=".$ch."';
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