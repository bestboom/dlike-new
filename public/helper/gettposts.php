<?php
ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    	require '../includes/config.php';

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

if(isset($_POST['tagname']) && $_POST['tagname'] != "") {
	
	  
    	$sql = "SELECT postid FROM posttags where tagname = '".$_POST['tagname']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$postid = $row['postid'];
		}
		$sql1 = "SELECT * FROM steemposts where id IN (".$postid.")";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				
				$select_meta = "SELECT tagname FROM posttags WHERE FIND_IN_SET(".$row1['id'].", `postid`)";
				$result2 = $conn->query($select_meta);
				if ($result2->num_rows > 0) {
					$meta_array = '';
					$counter = 0;
					while($row2 = $result2->fetch_assoc()) {
						if (strpos($row2['tagname'], 'dlike') === false) {
							$meta_array .= '<a href="/tags/';
							$meta_array .= trim($row2['tagname']);
							$meta_array .= '" style="color: #1652f0;">#';
							$meta_array .= trim($row2['tagname']);
							$meta_array .= '</a>';
							if(($counter+1)<($result2->num_rows)) {
								$meta_array .= ',';
							}
							
						}
						++$counter;
					}
				}
				
				$json_metadata = json_decode($row1['json_metadata'],true);
				
				
				$data['username'] = $row1['username'];
				$data['created_at'] = time_elapsed_string($row1['created_at']);
				$data['category'] = $json_metadata['category'];
				$data['permlink'] = $row1['permlink'];
				$data['thumbnail'] = $json_metadata['image'];
				$data['metatags'] = $meta_array;
				$data['title'] = $row1['title'];
				$data['exturl'] = $json_metadata['url'];
				
				$strReturn['data_row'][] = $data;
			}
			$strReturn['status'] = 'OK';
		}
		
		
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
}
?>
