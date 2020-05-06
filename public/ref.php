<?php
include('template/header5.php');
$user = $_GET['user'];
?>
</div>
<div class="container">
	<?php echo $user; 
	$sql_T = "SELECT * FROM referrals where username = '$user'";
		$result_T = $conn->query($sql_T);

			if ($result_T && $result_T->num_rows > 0) 
			{ 
				$rows  = $result_T->fetch_assoc();
    			echo $referrer = $rows['refer_by'];
			} else {
				echo 'there is no referrer in this table';
			}


	?>
</div>

<?php include('template/footer.php'); ?>