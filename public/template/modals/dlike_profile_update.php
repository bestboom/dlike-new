<div class="modal-body "><div class="transfer-respond">
		<h4>Update Profile</h4>
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend"><div class="input-group-text mb-deck"> Name</div></div>
						<input type="text" class="form-control" name="profile_name" id="profile_name" value="<?php echo $account_name; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text mb-deck"> Profile picture url</div>
						</div>
						<input type="text" class="form-control" name="profile_img" id="profile_img" placeholder="Enter url of image" value="<?php echo $user_pro_img; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text mb-deck"> Cover image url</div>
						</div>
						<input type="text" class="form-control" key="cover_image" name="cover_img" id="cover_img" value="<?php echo $profile_banner; ?>" placeholder="Enter url for image">
					</div>
				</div>
			</div>
		</div>
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text mb-deck"> Location</div>
						</div>
						<input type="text" class="form-control" name="profile_location" id="profile_location" value="<?php echo $account_location; ?>" />
					</div>
				</div>
			</div>
		</div>									
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend"><div class="input-group-text mb-deck"> Website</div></div>
						<input type="text" class="form-control" name="profile_website" id="profile_website" value="<?php echo $account_web; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row line">
			<div class="col-md-12">
				<div class="form-group">
					<div class="input-group mb-3">
						<div class="input-group-prepend"><div class="input-group-text mb-deck"> About</div></div>
						<input type="text" class="form-control" name="profile_about" id="profile_about" value="<?php echo $account_about; ?>" />
					</div>
				</div>
			</div>
		</div>			
		<center><button type="button" class="btn btn-default prof_edit_btn">UPDATE</button></center>
</div></div>