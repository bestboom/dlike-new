<div class="modal-body ">
	<div class="transfer-respond">
		<h4>Delegate DLIKER Tokens</h4>
		<div class="alert alert-danger" id="delegate-msg" style="display: none;"></div>
		<form id="delegate_sub">
			<center>	
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" name="dliker_stake_bal" id="dliker_staked_bal" value="<? echo $balance_stake; ?>" />
						<label><b>Staked Balance: </b><?php echo $balance_stake; ?> DLIKER</label>
					</div>
				</div>
			</div>
			</center>			
			<div class="row line">
				<div class="col-md-12" style="margin-bottom:15px;">
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<div class="input-group-text mb-deck"> @</div>
							</div>
							<input type="text" class="form-control reciever" id="delegate_to" value="" />
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control" id="delegate_amt" value="" placeholder="0.000" step="any" />
							<div class="input-group-append">
								<div class="input-group-text mb-deck"> DLIKER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<center><button type="button" class="btn btn-default delegate_btn">DELEGATE DLIKER</button></center>
		</form>
	</div>

</div>