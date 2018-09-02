<?php
  session_start();
  include 'databh.php';

  $bid = $_GET['bid'];
  $ch = $_GET['ch'];
  $uid = $_SESSION['uid'];
  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
        $sql = "SELECT * FROM dislikes WHERE uid = '$uid' AND contentid = '$bid' AND chno = '$ch'";
        $result = $conn->query($sql);
        $num = mysqli_num_rows($result);
        if($num == 0){
            $sql = "SELECT * FROM likes WHERE uid = '$uid' AND contentid = '$bid' AND chno = '$ch'";
            $result = $conn->query($sql);
            $num1 = mysqli_num_rows($result);
            if($num1 == 0){
                $sql = "SELECT * FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
                 $result = $conn->query($sql);
                 $row = $result->fetch_assoc();
                 $censures = $row['censure'];
                 if(is_null($censures)){
               $upcensure = 1;
               $sql = "UPDATE bookchaps SET censure = '$upcensure' WHERE bookid = '$bid' AND chapno = '$ch'";
               $result = $conn->query($sql);
             }else{
               $censures1 = $censures+1;
                     $sql = "UPDATE bookchaps SET censure = '$censures1' WHERE bookid = '$bid' AND chapno = '$ch'";
                     $result = $conn->query($sql);
                 }
                 $sql = "SELECT * FROM bookdetails WHERE id = '$bid'";
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
                $sql1 = "INSERT INTO dislikes(contentid,uid,chno) VALUES('$bid','$uid','$ch')";
                $result1 = $conn->query($sql1);
                $sql = "SELECT censure FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['censure'];
                $sn = array($cens." Censures", "<img src='images/censured.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }else{
                $sql = "SELECT censure FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $cens = $row['censure'];
                $sn = array($cens." Censures", "<img src='images/censure1.png' style='width:30px; height: 30px;' class='center-block'/>");
                echo json_encode($sn);
            }
        }else{
            $sql = "SELECT * FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $censures = $row['censure'];
            $sql = "SELECT * FROM bookdetails WHERE id = '$bid'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
            $writeuser = $row['uid'];
            $sql = "DELETE FROM dislikes WHERE uid = '$uid' AND contentid = '$bid' AND chno = '$ch'";
            $result = $conn->query($sql);

            $censures1 = $censures-1;
            $sql = "UPDATE bookchaps SET censure = '$censures1' WHERE bookid = '$bid' AND chapno = '$ch'";
            $result = $conn->query($sql);

            $sql = "SELECT * FROM blogsignup WHERE uid = '$writeuser'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            $censures = $row['censuresuser'];

            $censures1 = $censures-1;
            $sql = "UPDATE blogsignup SET censuresuser = '$censures1' WHERE uid = '$writeuser'";
            $result = $conn->query($sql);
            $sql = "SELECT censure FROM bookchaps WHERE bookid = '$bid' AND chapno = '$ch'";
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