<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	  
    $sql = "SELECT tagname, count(*) FROM posttags WHERE updated_at > DATE_SUB( NOW(), INTERVAL 24 HOUR) Group by tagname order by count(*) DESC Limit 15";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$html = '<a class="nav-item nav-link active" id="public-chat-tab" data-toggle="tab" href="#publicChat" role="tab" aria-controls="public" aria-expanded="true" style="font-weight: 900;background-color: #F0F0F1;">Trending now ></a>';
		$trending_html = '';
		$counter = 0; 
		while($row = $result->fetch_assoc()) {
			if (strpos($row['tagname'], 'dlike') === false && strpos($row['tagname'], ' ') === false) {
				//$html .= '<div class="colxs-1"><a href="/tags/'.$row['tagname'].'">'.$row['tagname'].'</a></div>';
				
				$trending_html .= '<a class="nav-item nav-link" href="/tags/'.$row['tagname'].'" role="tab" data-toggle="tab">'.strtoupper($row['tagname']).'&nbsp;<button type="button" class="close closeBtn" aria-label="Close"><span aria-hidden="true"></span></button></a>';
				++$counter;
			}
			
		}
		$strReturn['status'] = 'OK';
		$strReturn['html'] .= $trending_html;
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
?>
