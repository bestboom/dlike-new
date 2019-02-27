 <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require '../includes/config.php';

    $sql = "SELECT * FROM PostsLikes LIMIT 10";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            var_dump($row);
        }
    }
?>
