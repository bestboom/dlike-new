<div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content mybody">
            <?php include('template/modals/recomend.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="upvotefail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-custom modalStatus" role="document">
        <div class="modal-content modal-custom">
        	<?php include('template/modals/upvotefail.php'); ?>
        </div>
    </div>
</div>

<div class="modal" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <?php include('template/modals/postmodal.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="upvoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content mybody">
            <?php include('template/modals/upvotemodal.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="PostStatusModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
				<div class="modal-body text-center">
					<input type="hidden" id="p_username" />
					<input type="hidden" id="p_permlink" />
					<input type="hidden" id="p_category" />
					<p>What would you think about this post?</p>
					<select class="form-control" id="status_select">
					<option value="">Please select</option>
					<option value="Rejected">Rejected</option>
					<option value="Low Level">Low Level</option>
					<option value="High Level">High Level</option>
					</select>
					<br>
					<p><input type="button" id="savepoststatus" class="btn btn-primary" value="Save it"/></p>
						
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		      </div>
		      
		    </div>
		  </div>


		  <div class="modal fade" id="userPostStatusModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
				<div class="modal-body text-center">
					<input type="hidden" id="pu_username" />
					<input type="hidden" id="pu_permlink" />
					<input type="hidden" id="pu_category" />
					<p>User Status</p>
					<select class="form-control" id="userstatus_select">
						<option value="">Please select</option>
						<option value="0">Blacklisted</option>
						<option value="1">Greenlisted</option>
						<option value="2">Whitelisted</option>
						<option value="3">Pro</option>
					</select>
					<br>
					<p><input type="button" id="saveuserpoststatus" class="btn btn-primary" value="Save it"/></p>
						
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		      </div>
		      
		    </div>
		  </div>

		  <div class="modal fade" id="featuredPostStatusModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
				<div class="modal-body text-center">
					<input type="hidden" id="pf_username" />
					<input type="hidden" id="pf_permlink" />
					<input type="hidden" id="pf_category" />
					<input type="hidden" id="pf_imgurl" />
					<input type="hidden" id="pf_title" />
					
					<p>What would you make this post featured?</p>

					<p><input type="button" id="savefeaturedpoststatus" class="btn btn-primary" value="Save it"/></p>
						
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		      </div>
		      
		    </div>
		  </div>
		


<div class="modal fade" id="categoryStatusModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
				<div class="modal-body text-center">
					
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		      </div>
		      
		    </div>
		  </div>

