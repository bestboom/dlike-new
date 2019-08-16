<?php include('./../includes/config.php');
  $user = $_POST["user"];
  $value = $_POST["value"];
  $sql = "UPDATE prousers SET total_points = '$value'  where username = '$user'";
  $result = $conn->query($sql);
  $conn->close();
?>
