<?php
	session_start();
	include 'databh.php';
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
		$uid = $_SESSION['uid'];
		$bid = $_GET['bid'];
		$sql = "SELECT uid FROM bookdetails WHERE id = '$bid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if(!$row['uid'] == $uid){
			header("location: logout.php");
		}
		else{
			$title = mysqli_real_escape_string($conn, trim($_POST['title']));
  	        $cont = mysqli_real_escape_string($conn, trim($_POST['content']));
  	        $descript = mysqli_real_escape_string($conn, trim($_POST['descript']));
  	        $date1 = date("l jS \of F Y h:i:s A");
  			$date1 = $date1." GMT";
  			if(isset($_GET['ch'])){
  				$chno = $_GET['ch'];
  				$sql = "UPDATE bookchaps SET title = '$title', content = '$cont', descript = '$descript' WHERE bookid = '$bid' AND chapno ='$chno'";
  				$result = $conn->query($sql);
            $sql1 = "SELECT subscribed,uid FROM bookdetails WHERE id='$bid'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            if(isset($row1['subscribed']) && !empty($row1['subscribed'])){
                $list = $row1['subscribed'];
                $listarr = explode(" ", $list);
                $num14 = count($listarr);
                $uid2 = $row1['uid'];
                for($j=0; $j<$num14; $j++){
                    $idn = $listarr[$j];
                    $sql2 = "SELECT uid FROM blogsignup WHERE id = '$idn'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $uid1 = $row2['uid'];
                    $tye = 4;
                    $sql = "INSERT INTO notifs(uid,nto,tye,info) VALUES('$uid2', '$uid1', '$tye', '$bid')";
                    $result = $conn->query($sql);
                }
                

            }
  			}else{
  			$sql = "SELECT id FROM bookchaps WHERE bookid = '$bid'";
  			$result = $conn->query($sql);
  			$num = mysqli_num_rows($result);
  			$chapno = $num + 1;
  	        $sql = "INSERT INTO bookchaps(bookid, title, descript, content, chapno) VALUES('$bid', '$title', '$descript', '$cont', '$chapno')";
  	        $result = $conn->query($sql);
            $sql1 = "SELECT subscribed,uid FROM bookdetails WHERE id='$bid'";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            if(isset($row1['subscribed']) && !empty($row1['subscribed'])){
                $list = $row1['subscribed'];
                $listarr = explode(" ", $list);
                $num14 = count($listarr);
                $uid2 = $row1['uid'];
                for($j=0; $j<$num14; $j++){
                    $idn = $listarr[$j];
                    $sql2 = "SELECT uid FROM blogsignup WHERE id = '$idn'";
                    $result2 = $conn->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $uid1 = $row2['uid'];
                    $tye = 3;
                    $sql = "INSERT INTO notifs(uid,nto,tye,info) VALUES('$uid2', '$uid1', '$tye', '$bid')";
                    $result = $conn->query($sql);
                }
                

            } 
            $uid = $_SESSION['uid'];

            $id1 = "B ".$bid." ".$chapno;
            $sql1 = "SELECT * FROM follow WHERE followed = '$uid'";
            $result1 = $conn->query($sql1);
            while($row1 = $result1->fetch_assoc()){
                $uid1 = $row1['uid'];
                $tye = 2;
                $sql2 = "INSERT INTO stories(uid, contentid, sto, tye) VALUES('$uid', '$id1', '$uid1', '$tye')";
                $result2 = $conn->query($sql2);
            }
  	    }
  	        header("location: booklist.php");
		}
	}else{
    header('location: formnowlogin.php');
  }
?>