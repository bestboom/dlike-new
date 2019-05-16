<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
  require '../includes/config.php';
	
  if(isset($_POST['data']) && $_POST['data'] == "users"){
	$sql = "SELECT DISTINCT(sp.username) as author,ut.status FROM steemposts as sp left join userstatus as ut on ut.username=sp.username";
  }
  else if(isset($_POST['data']) && $_POST['data'] == "posts"){
	$sql = "SELECT sp.username as author,sp.title as title,ut.status,sp.json_metadata,sp.permlink FROM steemposts as sp left join poststatus as ut on ut.permlink=sp.permlink";
  }
  else if(isset($_POST['data']) && $_POST['data'] == "fposts"){
	$sql = "SELECT sp.username as author,sp.title as title,sp.json_metadata,sp.permlink,ut.id as fid FROM steemposts as sp left join featuredposts as ut on ut.permlink=sp.permlink";
  }
  else if(isset($_POST['data']) && $_POST['data'] == "events"){
	$sql = "SELECT * FROM events order by created_at DESC";
  }
  else if(isset($_POST['data']) && $_POST['data'] == "ads"){
	$sql = "SELECT * FROM ads order by created_at DESC";
  }
  	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if(isset($_POST['data']) && $_POST['data'] == "users"){
				$dataset['username'] = $row['author'];
				$dataset['status'] = $row['status'];
				$strReturn['html_data'][] = $dataset;
			}
			else if(isset($_POST['data']) && $_POST['data'] == "posts"){
				$json_metadata = json_decode($row['json_metadata'],true);
				$dataset['title'] = $row['title'];
				$dataset['username'] = $row['author'];
				$dataset['permlink'] = $row['permlink'];
				$dataset['category'] = $json_metadata['category'];
				$dataset['status'] = $row['status'];
				$strReturn['html_data'][] = $dataset;
			}
			else if(isset($_POST['data']) && $_POST['data'] == "fposts"){
				$json_metadata = json_decode($row['json_metadata'],true);
				$dataset['title'] = $row['title'];
				$dataset['username'] = $row['author'];
				$dataset['permlink'] = $row['permlink'];
				$dataset['category'] = $json_metadata['category'];
				$dataset['imgurl'] = $json_metadata['image'];
				$dataset['fid'] = $row['fid'];
				$strReturn['html_data'][] = $dataset;
			}
			else if(isset($_POST['data']) && $_POST['data'] == "events"){
				$dataset['id'] = $row['id'];
				$dataset['title'] = $row['title'];
				$dataset['image'] = $row['image'];
				$dataset['tags'] = $row['tags'];
				
				$strReturn['html_data'][] = $dataset;
			}
			else if(isset($_POST['data']) && $_POST['data'] == "ads"){
				$dataset['id'] = $row['id'];
				$dataset['title'] = $row['title'];
				$dataset['ad_html'] = $row['ad_html'];
				
				$strReturn['html_data'][] = $dataset;
			}
		}
		
		if(isset($_POST['data']) && $_POST['data'] == "events"){
			$s_sql = "SELECT * FROM `settings` where `type` = 'events'";
			$result_s = $conn->query($s_sql);

			if ($result_s->num_rows > 0) {
				while($row_s = $result_s->fetch_assoc()) {
					$strReturn['main_event_status'] = $row_s['options'];
				}
			}
			else {
				$strReturn['main_event_status'] = 'enable';	
			}
		}
		
		if(isset($_POST['data']) && $_POST['data'] == "ads"){
			$s_sql = "SELECT * FROM `settings` where `type` = 'ads'";
			$result_s = $conn->query($s_sql);
			if ($result_s->num_rows > 0) {
				while($row_s = $result_s->fetch_assoc()) {
					$strReturn['main_ad_status'] = $row_s['options'];
				}
			}
			else {
				$strReturn['main_ad_status'] = 'enable';	
			}
		}
		
		$strReturn['total'] = $result->num_rows;
    		$strReturn['status'] = 'OK';
	} else {
		$strReturn['total'] = 0;
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
?>
