<div class="modal-body ">
	<div class="transfer-respond">
		<h4 style="padding-bottom: 20px;font-weight: 600;text-align: center;">Withdraw</h4>
		<p class="base-color" style="padding: 0px;margin-bottom:0px;font-weight: 600;text-align: center;">
			Balance: <?php echo $tip_bal; ?> USDT
		</p>
		<?php
			if($tip_bal < $min_tip_withdraw)
			{
				echo '<li>Minimum Withdraw is '.$min_tip_withdraw.' USDT</li>
					<li>You must add ETH address to withdraw</li>
					<li>Withdrawls are processed daily</li>';
			}
			else
			{
				echo '<div id="tok-msg"></div>
					<div style="padding: 40px 5px;padding-bottom:15px;">
					<form action="" class="" method="POST" id="tok_out">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<div class="input-group-text mb-deck"> Amount</div>
								</div>
								<input type="hidden" name="tok_type" value="1" />
								<input type="hidden" name="tok_eth" value="'.$user_eth.'" />
								<input type="hidden" name="tok_user" value="'.$user_wallet.'" />
								<input type="number" class="form-control" name="tok_amt" id="tok_field" value="" />&nbsp;
								<button type="submit" class="btn btn-primary tk_out_btn">WITHDRAW</button>	
							</div>
						</div>
					</form>
					</div>';
				echo '<p style="padding-right:10px;font-weight:600;">* All withdrawls are processed within 24 hours.</p>';	
			}
		?>
	</div>
</div>