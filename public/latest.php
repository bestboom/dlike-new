<?php include('template/header.php'); ?>
</div>  
<div class="latest-post-section">
        <div class="container">  
<?php
$sql1 = "SELECT json_metadata,username,permlink,title FROM steemposts ORDER BY id DESC LIMIT 48";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) {
			$json_metadata = json_decode($row1['json_metadata'],true);

				$imgsrc = $json_metadata['image'];
				echo $title = "<img src='".$imgsrc."' style='width:50px;height:50px;padding-right:15px;padding-bottom:5px;border-radius:7px;'>".$row1['title']."<br>";
				$category = $json_metadata['category'];
				
				$username = $row1['username']."<br>";
				$permlink = $row1['permlink'];
		}
	}
?>	
</div></div>
<?php include('template/footer.php'); ?>