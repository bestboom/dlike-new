<?php include('./../includes/config.php');
  $user = $_POST["user"];
  $sql = "SELECT total_points FROM prousers";
  $result = $conn->query($sql2);
  $row = $result->fetch_all();
  var_dump($row);
  $my_views = $row2['views'];
?>
