<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql_C = "SELECT sum(tip1) as total_tip,count(*) as total FROM TokWithdraw where paid=0";
$result_C = $conn->query($sql_C);
$row_C = $result_C->fetch_assoc();
?>
<div class="container">
	<ul class="download-options-list">
		<li>
			<div class="btn apps-download-btn signup-btn">
				<div class="btn-content" style="text-align: center;">
					<span>Total Users</span>
					<p><? echo $row_C['total']; ?></p>
				</div>
			</div>
		</li>
		<li>
			<div class="btn apps-download-btn googleplay-btn">
				<div class="btn-content" style="text-align: center;">
					<span>Amount To Pay</span>
					<p><? echo number_format($row_C['total_tip'],3); ?></p>
				</div>
			</div>
		</li>
	</li>
</ul>
</div>
<div>
	<div class="row" style="margin: 40px;">
		<table class="table coin-list table-hover" style="border: 1px solid #eee;">
			<thead>
				<tr style="text-align: center;">
					<th scope="col" class="cent_me wid_2">User</th>
					<th scope="col" class="cent_me wid_2">Amount</th>
					<th scope="col" class="cent_me wid_2">Token</th>
					<th scope="col" class="cent_me wid_2">Address</th>
					<th scope="col" class="cent_me wid_2">Status</th>
					<th scope="col" class="cent_me wid_2">Time</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql_T = "SELECT * FROM TokWithdraw ORDER BY with_time DESC LIMIT 100";
				$result_T = $conn->query($sql_T);
				$with_time = strtotime($row_T["with_time"]); 
				if ($result_T && $result_T->num_rows > 0) {
					while ($row_T = $result_T->fetch_assoc()) { 
						?>
						<tr>
							<td class="exp-user cent_me wid_2">
								<span><?php echo $row_T["username"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["tip1"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["token"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["eth_addr"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["paid"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<?php echo time_ago($with_time); ?>
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