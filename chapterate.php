<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$id = $_GET['id'];
		$chapid = $_GET['chap'];
		$rate = $_GET['rate'];
		$sql = "SELECT * FROM bookrate WHERE uid = '$uid' AND contentid = '$id' AND chapid = '$chapid'";
		$result = $conn->query($sql);
		$num = mysqli_num_rows($result);
		if($num == 0){
			$sql = "INSERT INTO bookrate(uid, contentid, rate, chapid) VALUES('$uid', '$id', '$rate', '$chapid')";
			$result = $conn->query($sql);
		}else{
			$sql = "UPDATE bookrate SET rate = '$rate' WHERE uid = '$uid' AND contentid = '$id' AND chapid = '$chapid'";
			$result = $conn->query($sql);
		}
		$sql2 = "SELECT rate FROM bookrate WHERE contentid = '$id' AND chapid = '$chapid'";
        $result2 = $conn->query($sql2);
        $num2 = mysqli_num_rows($result2);
        $torate = 0;
        while($row2 = $result2->fetch_assoc()){
            $torate = $torate + $row2['rate'];
        }
        if($torate != 0){
            $torate = $torate/$num2;
            $sql = "UPDATE bookchaps SET rating = '$torate' WHERE chapno='$chapid' AND bookid='$id'";
            $result = $conn->query($sql);
            echo "<p><img src='images/rated.png' style='width: 20px; height:20px; vertical-align: text-bottom;'/>      ".$torate."/5    -   (".$num2." Ratings)</p>";
        }
	}else{
		header('location: formnowlogin.php');
	}
?>