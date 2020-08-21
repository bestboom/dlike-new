<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql_C = "SELECT count( DISTINCT(username) ) as total FROM referrals";
$result_C = $conn->query($sql_C);
$row_C = $result_C->fetch_assoc();
?>
<div class="container">
	<ul class="download-options-list">
		<li>
			<div class="btn apps-download-btn signup-btn">
				<div class="btn-content" style="text-align: center;">
					<span>Total Referrals</span>
					<p><? echo $row_C['total']; ?></p>
				</div>
			</div>
		</li>
	</li>
</ul>
</div>
<div>
	<div class="row" style="margin: 30px;">
		<table class="table coin-list table-hover" style="border: 1px solid #eee;">
			<thead style="text-align: center;">
				<tr>
					<th scope="col" class="cent_me wid_2">User</th>
					<th scope="col" class="cent_me wid_2">Referred By</th>
					<th scope="col" class="cent_me wid_2">Time</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				<?php 
				$sql_T = "SELECT * FROM referrals ORDER BY entry_time DESC";
				$result_T = $conn->query($sql_T);

				if ($result_T && $result_T->num_rows > 0) {
					while ($row_T = $result_T->fetch_assoc()) {
						$start_time = strtotime($row_T["entry_time"]); 
						?>
						<tr>
							<td class="exp-user cent_me wid_2">
								<span><?php echo $row_T["username"]; ?></span>
							</td>
							<td class="exp-amt cent_me wid_2">
								<span><?php echo $row_T["refer_by"]; ?></span>
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