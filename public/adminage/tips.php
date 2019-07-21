<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<table class="table coin-list table-hover">
	<thead>
		<tr style="text-align: center;">
			<th scope="col" class="cent_me wid_2">Tip</th>
			<th scope="col" class="cent_me wid_2">Amount</th>
			<th scope="col" class="cent_me wid_2">For</th>
			<th scope="col" class="cent_me wid_2">By</th>
			<th scope="col" class="cent_me wid_2">Time</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql_T = "SELECT * FROM TipTop ORDER BY tip_time";
		$result_T = $conn->query($sql_T);

		if ($result_T && $result_T->num_rows > 0) {
			while ($row_T = $result_T->fetch_assoc()) {
				$tip_time = strtotime($row_T["tip_time"]); 
				?>
				<tr>
					<td class="exp-user cent_me wid_2">
						<span><?php echo $row_T["sender"]; ?></span>
					</td>
					<td class="exp-amt cent_me wid_2">
						<span><?php echo $row_T["receiver"]; ?></span>
					</td>
					<td class="exp-amt cent_me wid_2">
						<?php echo $row_T["permlink"]; ?>
					</td>
					<td class="exp-amt cent_me wid_2">
						<?php echo time_ago($tip_time); ?>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</tbody>
</table>

<?php include('template/footer3.php'); ?>