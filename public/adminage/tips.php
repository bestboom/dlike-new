<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql_C = "SELECT sum(tip1) as total_tip,count(*) as total FROM TipTop";
$result_C = $conn->query($sql_C);
$row_C = $result_C->fetch_assoc();
?>
<div class="container">
	<ul class="download-options-list">
		<li>
			<div class="btn apps-download-btn signup-btn">
				<div class="btn-content" style="text-align: center;">
					<span>Total Tips</span>
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
	<div class="row" style="margin: 30px;">
		<table class="table coin-list table-hover" style="border: 1px solid #eee;">
			<thead>
				<tr style="text-align: center;">
					<th scope="col" class="cent_me wid_2">Tip BY</th>
					<th scope="col" class="cent_me wid_2">To</th>
					<th scope="col" class="cent_me wid_2">For</th>
					<th scope="col" class="cent_me wid_2">Amount</th>
					<th scope="col" class="cent_me wid_2">Time</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$sql_T = "SELECT * FROM TipTop ORDER BY tip_time DESC LIMIT 100";
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
								<?php echo '<a href="/post/@'.$row_T["receiver"].'/'.$row_T["permlink"].'" target="_blank">'.$row_T["permlink"].'</a>'; ?>
							</td>
							<td class="exp-amt cent_me wid_2">
								<?php echo $row_T["tip1"]; ?>
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
	</div>
</div>
<?php include('../template/footer2.php'); ?>