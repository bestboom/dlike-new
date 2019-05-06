<?php include('head.php'); ?>
<div class="container">
  <h2>Users</h2>
  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="show_results"></tbody>
  </table>

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
</div>
<?php include('../template/footer2.php'); ?>
<script>
$(document).ready(function(){

	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'users'},
		dataType: 'json',
		success: function(response) {
			if(response.status == "OK") {
				var result_data = response.html_data;
				var result_html = '';
				for(i=0;i<result_data.length;i++){
					var set_status = "";
					var action_var = "";
					if(result_data[i]['status'] == 0){
						action_var = "Blacklisted";
					}
					else if(result_data[i]['status'] == 1){
						action_var = "Greenlisted";
					}
					else if(result_data[i]['status'] == 2){
						action_var = "Whitelisted";
					}
					else if(result_data[i]['status'] == 3){
						action_var = "Pro";
					}
					
					
					
					result_html += '<tr><td>'+result_data[i]['username']+'</td><td>'+result_data[i]['status']+'</td><td><a href="return openmodel(this)" class="btn btn-small btn-primary" data-username="'+result_data[i]['username']+'" data-status="'+result_data[i]['status']+'" >'+action_var+'</a></td></tr>';
				}
				$("#show_results").html(result_html);
			}
		}
	});
});
</script>

