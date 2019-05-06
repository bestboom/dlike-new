<?php include('head.php'); ?>
<div class="container">
  <h2>Bordered Table</h2>
  <p>The .table-bordered class adds borders to a table:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Username</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="show_results">
		
      
    </tbody>
  </table>
</div>
<?php include('../template/footer.php'); ?>
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
					if(result_data[i]['status'] == "0"){
						action_var = "Blacklisted";
					}
					else if(result_data[i]['status'] == "1"){
						action_var = "Greenlisted";
					}
					else if(result_data[i]['status'] == "2"){
						action_var = "Whitelisted";
					}
					else if(result_data[i]['status'] == "3"){
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

