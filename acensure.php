<?php
	session_start();
	include 'databh.php';

	$id = $_GET['id'];
	$uid = $_SESSION['uid'];
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
        $sql = "SELECT * FROM adislikes WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 0){
            $sql = "SELECT * FROM alikes WHERE uid = '$uid' AND contentid = '$id'";
            $result = $conn->query($sql);
            $num1 = mysqli_num_rows($result);
            if($num1 == 0){
                $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
  	             $result = $conn->query($sql);
  	             $row = $result->fetch_assoc();
  	             $censures = $row['censure'];
  	             if(is_null($censures)){
  			       $upcensure = 1;
  			       $sql = "UPDATE blogdata2 SET censure = '$upcensure' WHERE id = '$id'";
  			       $result = $conn->query($sql);
  			     }else{
  			       $censures1 = $censures+1;
  	                 $sql = "UPDATE blogdata2 SET censure = '$censures1'  WHERE id = '$id'";
  	                 $result = $conn->query($sql);
  	             }
                 $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $writeuser = $row['uid'];

                $sql = "SELECT * FROM blogsignup WHERE uid = '$writeuser'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $usercensures = $row['censuresuser'];
    
 
                if(is_null($usercensures)){
                    $upcensures = 1;
                    $sql = "UPDATE blogsignup SET censuresuser = '$upcensures' WHERE uid = '$writeuser'";
                    $result = $conn->query($sql);
        
                }else{
                    $censures1 = $usercensures + 1;
                    $sql = "UPDATE blogsignup SET censuresuser = '$censures1'  WHERE uid = '$writeuser'";
                    $result = $conn->query($sql);
                }
                $sql1 = "INSERT INTO adislikes(contentid,uid) VALUES('$id','$uid')";
                $result1 = $conn->query($sql1);
                $sql = "SELECT censure FROM blogdata2 WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['censure'];
                $sn = array($cens." Censures", "<img src='images/censured.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }else{
                $sql = "SELECT censure FROM blogdata2 WHERE id = '$id'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['censure'];
                $sn = array($cens." Censures", "<img src='images/censure1.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }
        }else{
            $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $censures = $row['censure'];
            $writeuser = $row['uid'];
            $sql = "DELETE FROM adislikes WHERE uid = '$uid' AND contentid = '$id'";
            $result = $conn->query($sql);

            $censures1 = $censures-1;
            $sql = "UPDATE blogdata2 SET censure = '$censures1'  WHERE id = '$id'";
            $result = $conn->query($sql);

            $sql = "SELECT * FROM blogsignup WHERE uid = '$writeuser'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $censures = $row['censuresuser'];

            $censures1 = $censures-1;
            $sql = "UPDATE blogsignup SET censuresuser = '$censures1' WHERE uid = '$writeuser'";
            $result = $conn->query($sql);
            $sql = "SELECT censure FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $cens = $row['censure'];
            $sn = array($cens." Censures", "<img src='images/censure1.png' style='width:30px; height: 30px;' class='center-block'/>");
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