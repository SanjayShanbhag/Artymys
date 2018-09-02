<?php
	session_start();
	include 'databh.php';

	$first = $_POST["first"];
	$last = $_POST["last"];
	$uid = $_POST["uid"];
	$eml = $_POST["email"];
	$pwd = $_POST["pwd"];

	if(isset($uid)){
		$sql = "SELECT * FROM blogsignup where uid='$uid'";
		$result = $conn->query($sql);


		$row = $result->fetch_assoc();

		if($row >=1){
			$message = "User Name Already Exists.";
			echo "<script type ='text/javascript'>
			alert('$message');
			window.location.href='formnow.php';
			</script>";
		}

		else{
				$hash = password_hash($pwd, PASSWORD_BCRYPT);
				$sql = "INSERT INTO blogsignup(firname, lasname, eml, uid, pwd) VALUES('$first', '$last', '$eml', '$uid', '$hash')";
				$result = $conn->query($sql);
				header("Location: formnowlogin.php");
				}
			}
		
	
?>