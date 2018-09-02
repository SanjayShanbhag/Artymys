<?php
  session_start();
  include 'databh.php';

  $id = $_GET['id'];
  $uid = $_SESSION['uid'];
  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

    $sql = "SELECT * FROM alikes WHERE uid = '$uid' AND contentid = '$id'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        $sql = "SELECT * FROM adislikes WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
        $num1 = mysqli_num_rows($result);
        if($num1 == 0){
            $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $applauds = $row['applaud'];
    
 
            if(is_null($applauds)){
                $upapplaud = 1;
                $sql = "UPDATE blogdata2 SET applaud = '$upapplaud' WHERE id = '$id'";
                $result = $conn->query($sql);
        
            }else{
                $applauds1 = $applauds+1;
                $sql = "UPDATE blogdata2 SET applaud = '$applauds1'  WHERE id = '$id'";
                $result = $conn->query($sql);
            }
            $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $writeuser = $row['uid'];

            $sql = "SELECT * FROM blogsignup WHERE uid = '$writeuser'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $userapplauds = $row['applaudsuser'];
            if(is_null($userapplauds)){
                $upapplaud = 1;
                $sql = "UPDATE blogsignup SET applaudsuser = '$upapplaud' WHERE uid = '$writeuser'";
                $result = $conn->query($sql);
        
            }else{
                $applauds1 = $userapplauds+1;
                $sql = "UPDATE blogsignup SET applaudsuser = '$applauds1'  WHERE uid = '$writeuser'";
                $result = $conn->query($sql);
            }
            $sql1 = "INSERT INTO alikes(contentid,uid) VALUES('$id','$uid')";
            $result1 = $conn->query($sql1);
            $sql = "SELECT applaud FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $appl = $row['applaud'];
            $sn = array($appl." Applauds", "<img src='images/applauded.png' style='width:30px; height: 30px;' class='center-block'/>");
            echo json_encode($sn);
        }else{
            $sql = "SELECT applaud FROM blogdata2 WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $appl = $row['applaud'];
            $sn = array($appl." Applauds", "<img src='images/applaud1.png' style='width:30px; height: 30px;' class='center-block'/>");
            echo json_encode($sn);
        }
        $tye = 9;
        $sql = "INSERT INTO notifs(uid,nto,tye,info) VALUES('$uid', '$writeuser', '$tye', '$id')";
        $result = $conn->query($sql);
    }else{
        $sql = "SELECT * FROM blogdata2 WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $applauds = $row['applaud'];
        $writeuser = $row['uid'];
        $sql = "DELETE FROM alikes WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
 
        $applauds1 = $applauds-1;
        $sql = "UPDATE blogdata2 SET applaud = '$applauds1'  WHERE id = '$id'";
        $result = $conn->query($sql);

        $sql = "SELECT * FROM blogsignup WHERE uid = '$writeuser'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $applauds = $row['applaudsuser'];

        $applauds1 = $applauds-1;
        $sql = "UPDATE blogsignup SET applaudsuser = '$applauds1' WHERE uid = '$writeuser'";
        $result = $conn->query($sql);
        $sql = "SELECT applaud FROM blogdata2 WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $appl = $row['applaud'];
        $sn = array($appl." Applauds", "<img src='images/applaud1.png' style='width:30px; height: 30px;' class='center-block'/>");
        echo json_encode($sn);
        $tye = 9;
        $sql = "SELECT seenstats FROM notifs WHERE uid = '$uid' AND tye = '$tye' AND info = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $seenstats = $row['seenstats'];
        if($seenstats == 1){
            $sql = "DELETE FROM notifs WHERE uid = '$uid' AND tye = '$tye' AND info = '$id'";
            $result = $conn->query($sql);
        }
    }
}else{
    $message = "Please Log In";
      echo "<script type ='text/javascript'>
    alert('$message');
    window.location.href='formnowlogin.php';
  </script>";
      $result = false;
}
  