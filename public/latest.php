<?php include('includes/config.php'); 
$sql1 = "SELECT * FROM latestnews ORDER BY id DESC LIMIT 48";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) {

				echo $title = $row1['title']."<br>";
				
				
				
		}
	}
?>