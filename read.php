<?php
	session_start();
	include 'databh.php';
	
	$sql = "SELECT * FROM blogdata2";
	$result = $conn->query($sql);

	$arrayContent = array();

	$index = 0;

	while($row = $result->fetch_assoc()){
     $arrayContent[$index] = $row;
     $index++;
}
	echo $arrayContent[0]['uid1'];
	echo "<script type=text/javascript>
	window.location.href='actualread.php';
	</script>";

?>
