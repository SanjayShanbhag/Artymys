<?php
	session_start();
	include 'databh.php';


	if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
 
  	$id = $_SESSION['uid'];
  	$sql = "SELECT * FROM bookdetails WHERE id = '$id'";
  	$result = $conn->query($sql);
  	$row = $result->fetch_assoc();
  	$content = $row['book'];
  	$title = mysqli_real_escape_string($conn, trim($_POST['title']));
  	$cont = mysqli_real_escape_string($conn, trim($_POST['content']));
  	 $title.= '\n'. $cont;
 
  		if(is_null($content)){
  			$sql = "UPDATE bookdetails SET book = '$title' WHERE id = '$id'";
  			$result = $conn->query($sql);
  		}else{
  	 $sql = "UPDATE bookdetails SET book = CONCAT_WS('\n' ,book, '$title') WHERE id = '$id'";
  	 $result = $conn->query($sql);
	}
  
  $_SESSION['result'] = $result;
   $message = "BooK Updated successfully.";
      echo "<script type ='text/javascript'>
    alert('$message');
    window.location.href='readcontent.php';
  </script>";

  }else{
    $message = "Please Log In";
      echo "<script type ='text/javascript'>
    alert('$message');
    window.location.href='formnowlogin.php';
  </script>";
      $result = false;
  }
