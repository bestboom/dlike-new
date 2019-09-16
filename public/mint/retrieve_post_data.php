<?php include('./../includes/config.php');
  $activePost = $_POST["permlink"];
  if(isset($_POST["permlink"])) {
  $sql2 = "SELECT SUM(totalviews) AS views FROM TotalPostViews where permlink = '$activePost'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();
  $my_views = $row2['views'];
// likes check
  $sql3 = "SELECT SUM(likes) AS total_likes FROM PostsLikes where permlink = '$activePost'";
  $result3 = $conn->query($sql3);
  $row3 = $result3->fetch_assoc();
  $my_likes = $row3['total_likes'];
  $output = array('permlink' => $activePost, 'views' => $my_views, 'likes' => $my_likes);
  echo(json_encode($output));
  $conn->close(); 
} else {
  die("No input");
}
?>
