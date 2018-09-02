<?php
    include 'databh.php';
    session_start();
    $whom = mysqli_real_escape_String($conn, trim($_GET['user']));
    $sql = "SELECT uid FROM blogsignup WHERE id = '$whom'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $whom = $row['uid'];
    $uid  = $_SESSION['uid'];
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
       $tye = 6;
       $in = 0;
       $sql = "INSERT INTO notifs (uid,nto,tye,info) VALUES('$uid','$whom','$tye','$in')";
       $result = $conn->query($sql);
       $sql = "DELETE FROM stories WHERE uid = '$whom' AND sto = '$uid'";
       $result = $conn->query($sql);
       $sn = array($followercount."", "<img src='images/follow.png' style='width:20px; height: 20px;' class='center-block'/>");
            echo json_encode($sn);
    }else{
    $sql = "INSERT INTO follow(uid, followed) VALUES('$uid', '$whom')";
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
    $tye = 7;
    $in = 0;
    $sql = "INSERT INTO notifs (uid,nto,tye,info) VALUES('$uid','$whom','$tye','$in')";
    $result = $conn->query($sql);
    $sql = "SELECT * FROM blogdata2 WHERE uid = '$whom'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $contentid = $row['id'];
        $tye = 1;
        $contentid = "A ".$contentid;
        $date1 = $row['dateadd'];
        $sql1 = "INSERT INTO stories(uid,contentid,sto,tye,date1) VALUES('$whom', '$contentid', '$uid', '$tye', '$date1')";
        $result1 = $conn->query($sql1);
    }
    $sn = array($followercount."", "<img src='images/done.png' style='width:20px; height: 20px;' class='center-block'/>");
            echo json_encode($sn);
    }
?>










