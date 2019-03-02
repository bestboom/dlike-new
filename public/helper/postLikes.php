 <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require '../includes/config.php';
	$testQuery = 'ALTER TABLE PostsLikes ADD COLUMN lastUpdatedDate VARCHAR(255);'
	$result = $conn->query($testQuery);
	
	$strReturn = [];
	if(!isset($_GET['author']) || !isset($_GET['permlink'])) {
		$strReturn['status'] = 'Failed';
		$strReturn['reason'] = 'Required parameters not passed';
	} else {
		$strReturn['status'] = 'OK';
		$author = isset($_GET["author"]) ? $_GET["author"] : "";
		$author = stripslashes( $author );
		
		$permlink = isset($_GET["permlink"]) ? $_GET["permlink"] : "";
		$permlink = stripslashes( $permlink );
		
		$sql = "SELECT * FROM PostsLikes WHERE author = '$author' AND permlink = '$permlink' LIMIT 1";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				var_dump($row);
				$strReturn['likes'] = $row['likes'];
			}
		} else {
			$strReturn['likes'] = 0;
		}
	}
	
	echo json_encode($strReturn);
?>
