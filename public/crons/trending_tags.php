<?php
require '../includes/config.php';
$sql_C = $conn->query("SELECT count(*), tag from dlike_tags group by tag Having count(*) >1 order by count(*) DESC LIMIT 12");

$row_C = $sql_C->fetch_assoc() or die($conn->error);
$tag_name = $row_C["tag"]; 
$tag_count = $row_C["count"]; 

$sql_T = $conn->query("DELETE FROM dlike_trending_tags");

$sql_data = $conn->query("INSERT INTO dlike_trending_tags (tag, count) VALUES ('".$tag_name."', '".$tag_count."');
?>