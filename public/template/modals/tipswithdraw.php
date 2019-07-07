<div class="modal-body ">
	<div class="transfer-respond">
		<h4 style="padding-bottom: 20px;font-weight: 600;text-align: center;">Withdraw</h4>
		<p class="base-color" style="padding: 0px;margin-bottom:0px;font-weight: 600;text-align: center;">
			Balance: <?php echo $tip_bal; ?> USDT
		</p>
		<?php
			if($tip_bal < $min_tip_withdraw;)
			{
				echo '<li>Minimum Withdraw is <?php echo $min_tip_withdraw; ?> USDT</li>
					<li>You must add ETH address to withdraw</li>
					<li>Withdrawls are processed daily</li>';
			}
			else
			{
				echo 'show form';
			}
		?>
		

	</div>

</div>