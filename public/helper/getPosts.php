<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        require '../includes/config.php';
	
        $strReturn = [];
        $sql = "SELECT * FROM PostsLikes ORDER BY lastUpdatedDate DESC LIMIT 24";
        $result = $conn->query($sql);
        $strReturn['records'] = $result->num_rows;
        if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $strReturn[]['author'] = $row['author'];
                        $strReturn[]['permlink'] = $row['permlink'];
                        $strReturn[]['lastUpdatedDate'] = $row['lastUpdatedDate'];
                }
        }
	
	echo json_encode($strReturn);
?>
