<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$id = $_GET['id'];
		$rate = $_GET['rate'];
		$sql = "SELECT * FROM arating WHERE uid = '$uid' AND contentid = '$id'";
		$result = $conn->query($sql);
		$num = mysqli_num_rows($result);
		if($num == 0){
			$sql = "INSERT INTO arating(uid, contentid, rating) VALUES('$uid', '$id', '$rate')";
			$result = $conn->query($sql);
		}else{
			$sql = "UPDATE arating SET rating = '$rate' WHERE uid = '$uid' AND contentid = '$id'";
			$result = $conn->query($sql);
		}
		$sql2 = "SELECT rating FROM arating WHERE contentid = '$id'";
        $result2 = $conn->query($sql2);
        $num2 = mysqli_num_rows($result2);
        $torate = 0;
        while($row2 = $result2->fetch_assoc()){
            $torate = $torate + $row2['rating'];
        }
        if($torate != 0){
            $torate = $torate/$num2;
            $sql = "UPDATE blogdata2 SET rating = '$torate' WHERE id='$id'";
            $result = $conn->query($sql);
            echo "<p><img src='images/rated.png' style='width: 20px; height:20px; vertical-align: text-bottom;'/>      ".$torate."/5    -   (".$num2." Ratings)</p>";
        }
	}else{
		header('location: formnowlogin.php');
	}
?>