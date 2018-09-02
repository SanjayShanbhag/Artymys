<?php
  session_start();
  include 'databh.php';

  $id = $_GET['id'];
  $uid = $_SESSION['uid'];
  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

    $sql = "SELECT * FROM wyriyes WHERE uid = '$uid' AND contentid = '$id'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if($num == 0){
        $sql = "SELECT * FROM wyrino WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
        $num1 = mysqli_num_rows($result);
        if($num1 == 0){
            $sql = "SELECT * FROM wyri WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $applauds = $row['yes1'];
    
 
            if(is_null($applauds)){
                $upapplaud = 1;
                $sql = "UPDATE wyri SET yes1 = '$upapplaud' WHERE id = '$id'";
                $result = $conn->query($sql);
        
            }else{
                $applauds1 = $applauds+1;
                $sql = "UPDATE wyri SET yes1 = '$applauds1'  WHERE id = '$id'";
                $result = $conn->query($sql);
            }
            $sql1 = "INSERT INTO wyriyes(contentid,uid) VALUES('$id','$uid')";
            $result1 = $conn->query($sql1);
            $sql = "SELECT yes1,no1 FROM wyri WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $appl = $row['yes1'];
            $cens = $row['no1'];
            $appl = $appl + $cens;
            $sn = array($appl." Reactions", "<img src='images/yes1.png' style='width:30px; height: 30px;' class='center-block'/>");
            echo json_encode($sn);
        }else{
            $sql = "SELECT yes1,no1 FROM wyri WHERE id = '$id'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $appl = $row['yes1'];
            $no = $row['no1'];
            $num3 = $appl + $no;
            $sn = array($num3." Reactions", "<img src='images/yes2.png' style='width:30px; height: 30px;' class='center-block'/>");
            echo json_encode($sn);
        }
    }else{
        $sql = "SELECT * FROM wyri WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $applauds = $row['yes1'];
        $writeuser = $row['uid'];
        $sql = "DELETE FROM wyriyes WHERE uid = '$uid' AND contentid = '$id'";
        $result = $conn->query($sql);
 
        $applauds1 = $applauds-1;
        $sql = "UPDATE wyri SET yes1 = '$applauds1'  WHERE id = '$id'";
        $result = $conn->query($sql);

        $sql = "SELECT yes1,no1 FROM wyri WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $appl = $row['yes1'];
        $no = $row['no1'];
        $num4 = $appl + $no;
        $sn = array($num4." Reactions", "<img src='images/yes2.png' style='width:30px; height: 30px;' class='center-block'/>");
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
  