<div class="modal-body ">
	<div class="transfer-respond">
		<h4 style="padding-bottom: 20px;font-weight: 600;">Transfer DLIKE Tokens</h4>
		<form action="#">
			<div class="row line">
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<div class="input-group-text mb-deck"> To</div>
							</div>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="input-group mb-3">
							<input type="number" class="form-control" min="0">
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
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="form-group">
								<label class="custom-control-label" for="customCheck5">Balance: <?php echo (number_format($rowIt['amount'])); ?> DLIKE</label>
					</div>
				</div>
			</div>
			<center><button class="btn btn-default">Transfer</button></center>
		</form>
	</div>

</div>