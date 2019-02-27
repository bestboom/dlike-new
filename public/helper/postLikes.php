 <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require '../includes/config.php';

    $sql = "SELECT * FROM PostsLikes LIMIT 10";
    $result = $conn->query($sql);
    var_dump($result);
?>
