<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	  
    	$sql = "SELECT * FROM posttags WHERE updated_at > DATE_SUB( NOW(), INTERVAL 24 HOUR) order by tagcount DESC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$html = '<div class="colxs-1 trendingword">Trending Now ></div>';
		$counter = 0; 
		while($row = $result->fetch_assoc()) {
			if (strpos($row['tagname'], 'dlike') === false && $counter < 10) {
				$html .= '<div class="colxs-1"><a href="/tags/'.$row['tagname'].'">'.$row['tagname'].'</a></div>';
				++$counter;
			}
			
		}
		$strReturn['status'] = 'OK';
		$strReturn['html'] .= $html;
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
?>
