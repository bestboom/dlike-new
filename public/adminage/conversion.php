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
					<th scope="col" class="cent_me wid_2">ID</th>
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
						$type = $row_T["type"];
						$id = $row_T["id"];
						?>
						<tr>
							<td class="exp-user cent_me wid_2">
								<span class="con_id"><?php echo $row_T["id"]; ?></span>
							</td>
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
							<td class="exp-amt cent_me wid_2 bot_con_sec">
								<?php if($type == '0'){ ?>
								<!--<span class="conv_id"><?php $id; ?></span>
								<button type="button" class="btn btn-danger app_con">Pay</button>-->
								<p><input type="button" class="btn btn-primary app_con" value="<?php echo $id; ?>"/></p>
								<? } else {} ?>
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
<?php include('../template/footer.php'); ?>
<script type="text/javascript">
$('.app_con').click(function() {
	let conv_id = $(this).val();
	console.log(conv_id);
	let convert_url = '../helper/converter.php';
    var data_eth = {action : 'pay_con',conv_id: conv_id};
    $.ajax({
        type: "POST",
        url: convert_url,
        data: data_eth,
        success: function(data) {
            try {
                var response = JSON.parse(data)
                if (response.error == true) {
                    toastr['error'](response.message);
                } else {
                    toastr['success'](response.message);
                    setTimeout(function(){
                        window.location.href = "https://dlike.io/";
                    }, 500);
                }
            } catch (err) {
                toastr.error('Sorry. Server response is malformed');
            }
        }
    });
});
</script>