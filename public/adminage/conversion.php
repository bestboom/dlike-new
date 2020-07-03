<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<div>
	<div class="row" style="margin: 30px;">
		<table class="table coin-list table-hover" style="border: 1px solid #eee;">
			<thead>
				<tr>
					<th scope="col" class="cent_me wid_2">Username</th>
					<th scope="col" class="cent_me wid_2">Amount</th>
					<th scope="col" class="cent_me wid_2">ETH Add</th>
					<th scope="col" class="cent_me wid_2">Reason</th>
					<th scope="col" class="cent_me wid_2">Type</th>
					<th scope="col" class="cent_me wid_2">Time</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql_T = "SELECT * FROM convert_dlike where status='0' ORDER BY req_on DESC";
				$result_T = $conn->query($sql_T);

				if ($result_T && $result_T->num_rows > 0) {
					while ($row_T = $result_T->fetch_assoc()) {
						$start_time = strtotime($row_T["req_on"]); 
						?>
						<tr>
							<td class="exp-user cent_me wid_2">
								<span><?php echo $row_T["steem_username"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["amount"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["eth_add"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["earned_by"]; ?></span>
							</td>

							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["type"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<?php echo time_ago($start_time); ?>
							</td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php include('../template/footer2.php'); ?>