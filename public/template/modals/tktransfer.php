<div class="modal-body ">
	<div class="transfer-respond">
		<h4 style="padding-bottom: 20px;font-weight: 600;">Transfer DLIKE Tokens</h4>
		<div id="tsf-msg"></div>
		<form action="" id="tsf_sub" method="POST">
			<div class="row line">
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<div class="input-group-text mb-deck"> To</div>
							</div>
							<input type="text" class="form-control reciever" name="reciever" value="" />
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control send_amt" name="send_amt" min="0" value="" />
							<div class="input-group-append">
								<div class="input-group-text mb-deck"> DLIKE</div>
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
							<input type="text" class="form-control" name="memo">
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="user_bal" id="user_bal" value="<? echo $dlike_bal; ?>" />
						<input type="hidden" name="user_name" id="user_name" value="<? echo $user_wallet; ?>" />
						<label><b>Balance: </b><?php echo (number_format($rowIt['amount'])); ?> DLIKE</label>
					</div>
				</div>
			</div>
			<center><button type="submit" class="btn btn-default tsf_btn">Transfer</button></center>
		</form>
	</div>

</div>