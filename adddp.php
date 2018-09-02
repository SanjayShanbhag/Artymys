<?php
	session_start();
	include 'databh.php';
	if(isset($_FILES['file'])){
		$file = $_FILES['file'];
	

		$id = $_SESSION['uid'];
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
				$file_destination = 'uploads/' . $file_name_new;
				
				if(move_uploaded_file($file_tmp, $file_destination)){
					$sql = "UPDATE blogsignup SET dp = '$file_destination' WHERE uid = '$id'";
					$result = $conn->query($sql);
					echo "<script>
					window.location.href = 'profile.php'</script>";
				}
			}
		}else{
			header('Location: profile.php');
		}
	}