<?php include('head.php'); ?>
<div class="container">
  <h2>Users</h2>
  <div id="show_results">
 
  </div>

  <div class="modal fade" id="userPostStatusModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-body text-center">
			<input type="hidden" id="pu_username" />
		
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

<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>

	function openuser_popup(self){
		var author = $(self).data('author');
		var status = $(self).data('status');
		
		$("#pu_username").val(author);
		$("#userstatus_select").val(status);
		$("#userPostStatusModal").modal('show');
    }

    
$(document).ready(function(){

	$('#user_table').DataTable({
		//"ajax": {
			//"url": "data.json",
			//"type": "POST",
			//"data": function ( d ) {
				//d.data = 'users';
			//},
			//"dataSrc": function ( json ) {
			  //for ( var i=0, ien=json.length ; i<ien ; i++ ) {
				//json[i][0] = '<a href="/message/'+json[i][0]+'>View message</a>';
			  //}
			  //return json;
			//}
		  //}
	});
	
	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'users'},
		dataType: 'json',
		success: function(response) {
			if(response.status == "OK") {
				var result_data = response.html_data;
				var result_html = ' <table class="table table-bordered" id="user_table"><thead><tr><th>Username</th><th>Status</th><th>Action</th></tr></thead><tbody >';
				for(i=0;i<result_data.length;i++){
					var set_status = "";
					var action_var = "Add";
					if(result_data[i]['status'] == 0){
						action_var = "Edit";
					}
					else if(result_data[i]['status'] == 1){
						action_var = "Edit";
					}
					else if(result_data[i]['status'] == 2){
						action_var = "Edit";
					}
					else if(result_data[i]['status'] == 3){
						action_var = "Edit";
					}
					
					
					
					result_html += '<tr><td>'+result_data[i]['username']+'</td><td>'+result_data[i]['status']+'</td><td><a href="javascript:" onclick="return openuser_popup(this)" class="btn btn-small btn-primary" data-author="'+result_data[i]['username']+'" data-status="'+result_data[i]['status']+'" >'+action_var+'</a></td></tr>';
				}

				result_html += "</tbody></table><script>$('#user_table').DataTable({});</script>";
				$("#show_results").html(result_html);
			}
		}
	});
});
</script>

