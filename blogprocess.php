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
     $tagarray = 0;
     while($row = $result->fetch_assoc()){
        $genreids = $row['id'];
        if(isset($_POST[$genreids])){
            $tags = $tags.$_POST[$genreids]." ";
            $tag1[$tagarray] = $_POST[$genreids];
            $tagarray = $tagarray+1;
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
			if(isset($_POST['message']) && !empty($_POST['message'])){
				$message = mysqli_real_escape_string($conn, trim($_POST['message']));
				if(in_array($file_ext, $allowed)){
					if($file_error === 0){
						$file_name_new = uniqid('', true) . '.' . $file_ext;
						$file_destination = 'articles/' . $file_name_new;
				
						if(move_uploaded_file($file_tmp, $file_destination)){
							$sql = "INSERT INTO blogdata2(uid,title,content,articleImage,messtoread,tags) VALUES('$id', '$title', '$post', '$file_destination', '$message', '$tags')";
							$result = $conn->query($sql);
							$_SESSION['result'] = $result;
						}
					}
				}else{
					$sql = "INSERT INTO blogdata2(uid,title,content,messtoread,tags) VALUES('$id', '$title', '$post', '$message', '$tags')";
					$result = $conn->query($sql);
					$_SESSION['result'] = $result;
				}
			}else{
				if(in_array($file_ext, $allowed)){
					if($file_error === 0){
						$file_name_new = uniqid('', true) . '.' . $file_ext;
						$file_destination = 'articles/' . $file_name_new;
				
						if(move_uploaded_file($file_tmp, $file_destination)){
							$sql = "INSERT INTO blogdata2(uid,title,content,articleImage,tags) VALUES('$id', '$title', '$post', '$file_destination', '$tags')";
							$result = $conn->query($sql);
							$_SESSION['result'] = $result;
						}
					}
				}else{
					$sql = "INSERT INTO blogdata2(uid,title,content,tags) VALUES('$id', '$title', '$post', '$tags')";
					$result = $conn->query($sql);
					$_SESSION['result'] = $result;
				}
			}
			$uid = $_SESSION['uid'];
			$sql = "SELECT id FROM blogdata2 WHERE uid = '$uid' ORDER BY id DESC LIMIT 1";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$id = $row['id'];

			$id1 = "A ".$id;
			$sql1 = "SELECT * FROM follow WHERE followed = '$uid'";
			$result1 = $conn->query($sql1);
			while($row1 = $result1->fetch_assoc()){
				$uid1 = $row1['uid'];
				$tye = 1;
				$sql2 = "INSERT INTO stories(uid, contentid, sto, tye) VALUES('$uid', '$id1', '$uid1', '$tye')";
				$result2 = $conn->query($sql2);
			}
			$numarray = sizeof($tagarray);
		for($i=0;$i<$numarray;$i++){
			$tag = $tag1[$i];
			$sql = "SELECT * FROM gfollow WHERE followedid = '$tag'";
			$result = $conn->query($sql);
			$id1 = "A ".$id." ".$tag;
			$id2 = "A ".$id;
			$tye = 4;
			$uid = $_SESSION['uid'];
			while($row = $result->fetch_assoc()){
				$uidg = $row['uid'];
				$sql1 = "SELECT * FROM stories WHERE sto = '$uidg' AND contentid = '$id2'";
				$result1 = $conn->query($sql1);
				$num1 = mysqli_num_rows($result1);
				$sql1 = "SELECT * FROM stories WHERE sto = '$uidg' AND contentid = '$id1'";
				$result1 = $conn->query($sql1);
				$num2 = mysqli_num_rows($result1);
				if($num1 != 1 && $num2 != 1){
					$sql2 = "INSERT INTO stories(uid, contentid, sto, tye) VALUES('$uid', '$id1', '$uidg', '$tye')";
					$result2 = $conn->query($sql2);
				} 
			}
		}
			echo "<script type ='text/javascript'>
								window.location.href='readcontent.php';
								</script>";
		}

	}else{
		$message = "Please Log In";
  		echo "<script type ='text/javascript'>
		alert('$message');
		window.location.href='formnowlogin.php';
	</script>";
  		$result = false;
	}

