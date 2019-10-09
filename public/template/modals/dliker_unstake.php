<div class="modal-body ">
	<div class="transfer-respond">
		<h4>UNSTAKE DLIKER Tokens</h4>
		<center>
		<div class="alert alert-danger" id="unstake-msg" style="display: none;"></div>
		<form action="" id="unstake_sub" method="POST">
			<div class="row line">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" name="dliker_bal" id="dliker_unstake" value="<? echo $balance_stake; ?>" />
						<label><b>Balance: </b><?php echo $balance_stake; ?> DLIKER</label>
					</div>
				</div>
			</div>			
			<div class="row line">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control" id="unstake_amt" value="" placeholder="0.000" />
							<div class="input-group-append">
								<div class="input-group-text mb-deck"> DLIKER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<center><button type="button" class="btn btn-default unstake_btn">UNSTAKE DLIKER</button></center>
		</form>
		</center>
	</div>
</div>