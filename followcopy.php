<?php
  include 'databh.php';
  session_start();
  $whom = mysqli_real_escape_String($conn, trim($_GET['user']));
  $uid  = $_SESSION['uid'];
  $time1 = date('H:i d-m-yy');
  $sql = "SELECT * FROM follow WHERE uid = '$uid' AND followed = '$whom'";
    $result = $conn->query($sql);
    $num = mysqli_num_rows($result);
    if($num > 0){
       $sql = "DELETE FROM follow WHERE uid = '$uid' AND followed = '$whom'";
       $result = $conn->query($sql);
       $sql = "SELECT * FROM blogsignup WHERE uid = '$whom'";
       $result = $conn->query($sql);
       $row = $result->fetch_assoc();
       $followercount = $row['followercount'];
       $followercount = $followercount - 1;
       $sql = "UPDATE blogsignup SET followercount = '$followercount' WHERE uid = '$whom'";
       $result = $conn->query($sql);
       $sql = "SELECT followercount FROM blogsignup WHERE uid = '$uid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $appl = $row['followercount'];
       $sn = array("<img src='images/follower.png' style='width: 10px; height: 10px;'/>    ".$appl." Followers", "<img src='images/follow.png' style='width: 15px; height:15px;'>    Follow", $whom);
            echo json_encode($sn);
    }else{
  $sql = "INSERT INTO follow(uid, followed, time1) VALUES('$uid', '$whom', '$time1')";
  $result = $conn->query($sql);
  $sql = "SELECT * FROM blogsignup WHERE uid = '$whom'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $followercount = $row['followercount'];
    if(!isset($followercount)){
      $followercount = 1;
    }else{
      $followercount = $followercount + 1;
    }
    $sql = "UPDATE blogsignup SET followercount = '$followercount' WHERE uid = '$whom'";
    $result = $conn->query($sql);
    $sql = "SELECT followercount FROM blogsignup WHERE uid = '$uid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $appl = $row['followercount'];
       $sn = array("<img src='images/follower.png' style='width: 10px; height: 10px;'/>    ".$appl." Followers", "<img src='images/following.png' style='width: 15px; height:15px;'>    Follow", $whom);
            echo json_encode($sn);
  }
  
?>