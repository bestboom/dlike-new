<div class="modal-body ">
	<div class="transfer-respond">
		<h4>Stake DLIKER Tokens</h4>
		<div class="alert alert-danger" id="stake-msg"></div>
		<form action="" id="syake_sub" method="POST">
			<center>	
			<div class="row line">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" name="dliker_bal" id="dliker_bal" value="<? echo $my_balance; ?>" />
						<label><b>Balance: </b><?php echo $my_balance; ?> DLIKER</label>
					</div>
				</div>
			</div>	
			</center>		
			<div class="row line">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control" id="stake_amt" value="" placeholder="0.000" />
							<div class="input-group-append">
								<div class="input-group-text mb-deck"> DLIKER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<center><button type="button" class="btn btn-default stake_btn">STAKE DLIKER</button></center>
		</form>
	</div>
</div>