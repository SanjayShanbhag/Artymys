<?php
  session_start();
  include 'databh.php';


  if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){

  $id = $_SESSION['uid'];
  $title = mysqli_real_escape_string($conn, trim($_POST['title']));
  $content = $_POST['content'];
  $post = mysqli_real_escape_string($conn, trim($_POST['content']));
  
  $sql = "SELECT id FROM gtype1 ORDER BY id ASC";
     $result = $conn->query($sql);
     $tags = "";
     while($row = $result->fetch_assoc()){
        $genreids = $row['id'];
        if(isset($_POST[$genreids])){
            $tags = $tags.$_POST[$genreids]." ";
        }
     }


  if(!empty($_FILES)){
            $file = $_FILES['file'];
            //File Properties
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            //Working out the file extension.
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            $allowed = array('jpg', 'png', 'bmp');

            if(in_array($file_ext, $allowed)){
                if($file_error === 0){
                    $file_name_new = uniqid('', true) . '.' . $file_ext;
                    $file_destination = 'articles/' . $file_name_new;
                
                    if(move_uploaded_file($file_tmp, $file_destination)){
                        $sql = "INSERT INTO bookdetails(uid,title,descript,articleImage,tags) VALUES('$id', '$title', '$post', '$file_destination', '$tags')";
                        $result = $conn->query($sql);
                        $_SESSION['result'] = $result;
                        echo "<script type ='text/javascript'>
                        window.location.href='readcontent.php';
                        </script>";
                    }
                }
            }else{
                $sql = "INSERT INTO bookdetails(uid,title,descript,tags) VALUES('$id', '$title', '$post', '$tags')";
            $result = $conn->query($sql);
            $_SESSION['result'] = $result;
            echo "<script type ='text/javascript'>
                window.location.href='readcontent.php';
                </script>";
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
