<?php
$conn = mysqli_connect("localhost", "root", "", "experiment");
          $image = mysqli_real_escape_string($conn, $_FILES['image']['tmp_name']);
          $name = mysqli_real_escape_string($conn, $_FILES['image']['name']);
          $image = file_get_contents($image);
          $image = base64_encode($image);
          $sql = "INSERT INTO exp1(nam, image) VALUES('$name', '$image')";
          $result = $conn->query($sql);
          header("Location: formnowlogin.php");
      