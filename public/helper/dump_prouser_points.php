<?php include('./../includes/config.php');
  $sql = "SELECT total_points from prousers";
  $result = $conn->query($sql);
  $output = $result->fetch_all();
  var_dump($result);
  $conn->close();
?>
