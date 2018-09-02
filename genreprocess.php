<?php
  session_start();
  include 'databh.php';


  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

  $id = $_SESSION['uid'];
  $title = mysqli_real_escape_string($conn, trim($_POST['title']));
  $content = $_POST['content'];
  $post = mysqli_real_escape_string($conn, trim($_POST['content']));
   
  


                $sql = "INSERT INTO gtype1(gen,de) VALUES('$title', '$post')";
            $result = $conn->query($sql);
            $_SESSION['result'] = $result;
            echo "<script type ='text/javascript'>
                window.location.href='addgenre.php';
                </script>";
    }else{
        $message = "Please Log In";
        echo "<script type ='text/javascript'>
        alert('$message');
        window.location.href='formnowlogin.php';
    </script>";
        $result = false;
    }
