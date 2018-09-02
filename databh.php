<?php
	$conn = mysqli_connect("localhost", "root", "", "experiment");
	if(!$conn){
		die("Connection Failed ". mysqli_connect_error());
	}
?>