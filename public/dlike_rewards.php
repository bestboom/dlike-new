<?php  include('template/header7.php'); ?>

</div>



<?php
$sql1 =  $conn->query("SELECT * FROM dlike_daily_rewards where DATE(update_time) = CURDATE()");

if ($sql1 && $sql1->num_rows > 0) 
{ 
    $row1 = $sql1->fetch_assoc();
    $yesterday_points = $row1["yesterday_upvotes"];
} else {
    $yesterday_points = 0;
}

echo $yesterday_points;

?>