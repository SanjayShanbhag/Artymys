<?php
	session_start();
	include 'databh.php';
	

	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid1 = $_SESSION['uid'];
    	$sql= "DELETE FROM blogsignup WHERE uid = '$uid1'";
		$result = $conn->query($sql);
 	}
  	else{
  		$message = "Please Log In";
  		echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnowlogin.php';
	</script>";
  		$result = false;
  	}
	if($result===true){
		$message = "Record deleted successfully";
		echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnow.php';
	</script>";
	session_destroy();
	}else{
		echo "Some Error". $conn->error;
	}
?>