<?php
	session_start();
	include 'databh.php';
	if(isset($_COOKIE['connected'])){
		echo "Yes!";
	}else{
		echo "Nope!";
	}
?>