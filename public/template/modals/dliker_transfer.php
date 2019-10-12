<div class="modal-body ">
	<div class="transfer-respond">
		<h4>Transfer DLIKER Tokens</h4>
		<div id="transfer-msg"></div>
		<form action="" id="tsf_sub" method="POST">
			<div class="row line">
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<div class="input-group-text mb-deck"> @</div>
							</div>
							<input type="text" class="form-control reciever"id="transfer_to" value="" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control" id="transfer_amt" value="" placeholder="0.000" step="any" />
							<div class="input-group-append">
								<div class="input-group-text mb-deck"> DLIKER</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row line">
				<div class="col-md-12">
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<div class="input-group-text mb-deck"> Memo</div>
							</div>
							<input type="text" class="form-control" id="trs_memo">
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" id="my_dliker_bal" value="<? echo $my_balance; ?>" />
						<label><b>Balance: </b><?php echo $my_balance; ?> DLIKER</label>
					</div>
				</div>
			</div>
			<center><button type="submit" class="btn btn-default transfer_btn">Transfer DLIKER</button></center>
		</form>
	</div>
</div>