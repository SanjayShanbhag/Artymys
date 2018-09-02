<?php
	session_start();
	include 'databh.php';

	$id = $_GET['id'];
	$uid = $_SESSION['uid'];
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
        $sql = "SELECT * FROM wyrino WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 0){
            $sql = "SELECT * FROM wyriyes WHERE uid = '$uid' AND contentid = '$id'";
            $result = $conn->query($sql);
            $num1 = mysqli_num_rows($result);
            if($num1 == 0){
                $sql = "SELECT * FROM wyri WHERE id = '$id'";
  	             $result = $conn->query($sql);
  	             $row = $result->fetch_assoc();
  	             $censures = $row['no1'];
  	             if(is_null($censures)){
  			       $upcensure = 1;
  			       $sql = "UPDATE wyri SET no1 = '$upcensure' WHERE id = '$id'";
  			       $result = $conn->query($sql);
  			     }else{
  			       $censures1 = $censures+1;
  	                 $sql = "UPDATE wyri SET no1 = '$censures1'  WHERE id = '$id'";
  	                 $result = $conn->query($sql);
  	             }
                 
                $sql1 = "INSERT INTO wyrino(contentid,uid) VALUES('$id','$uid')";
                $result1 = $conn->query($sql1);
                $sql = "SELECT no1,yes1 FROM wyri WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['no1'];
                $yes = $row['yes1'];
                $num = $cens + $yes;
                $sn = array($num." Reactions", "<img src='images/no1.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }else{
                $sql = "SELECT no1,yes1 FROM wyri WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['no1'];
                $yes = $row['yes1'];
                $num = $cens + $yes;
                $sn = array($num." Reactions", "<img src='images/no2.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }
        }else{
            $sql = "SELECT * FROM wyri WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $censures = $row['no1'];
            $writeuser = $row['uid'];
            $sql = "DELETE FROM wyrino WHERE uid = '$uid' AND contentid = '$id'";
            $result = $conn->query($sql);

            $censures1 = $censures-1;
            $sql = "UPDATE wyri SET no1 = '$censures1'  WHERE id = '$id'";
            $result = $conn->query($sql);

            
            $sql = "SELECT no1,yes1 FROM wyri WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $cens = $row['no1'];
            $yes = $row['yes1'];
            $num = $cens + $yes;
            $sn = array($num." Reactions", "<img src='images/no2.png' style='width:30px; height: 30px;' class='center-block'/>");
            echo json_encode($sn);
        }
 
  
  }else{
    $message = "Please Log In";
      echo "<script type ='text/javascript'>
    alert('$message');
    window.location.href='formnowlogin.php';
  </script>";
      $result = false;
  }