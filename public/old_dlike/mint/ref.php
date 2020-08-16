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
    			echo '<br>';
			} else {
				echo $referrer = 'none';
				echo '<br>';
			}

			if($referrer == "dlike" || $referrer == "none"){ echo "dlike-bene=7.5"; }
			else{echo "dlike-bene=5";}

	?>
</div>
<?php include('template/footer.php'); ?>