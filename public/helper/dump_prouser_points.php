<?php include('./../includes/config.php');
  $sql = "SELECT total_points, username from prousers";
  $result = $conn->query($sql);
  $output = $result->fetch_all();
  highlight_string("<?php\n\$data =\n" . var_export($output, true) . ";\n?>");
  $conn->close();
?>
