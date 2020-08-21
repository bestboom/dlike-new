<?php include('head.php'); ?>
<div class="container" style="    margin: 20px auto;">
  <h2>Featured Posts</h2>
  <div id="show_results"></div>

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
					<input type="hidden" id="pf_status" />
					
					<p id="labelid"></p>

					<p><input type="button" id="savefeaturedpoststatus" class="btn btn-primary" value="Save it"/></p>
						
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
<style>table.dataTable thead th{    border-bottom: 1px solid #dee2e6;}.dataTables_length{display:none !important;}.dataTables_wrapper .dataTables_filter input{    display: block;width: auto;padding: .375rem .75rem;font-size: 1rem;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}table.dataTable.no-footer{    border-bottom: 1px solid #dee2e6;}</style>
<script>

	function openfpost_popup(self){
		var permlink = $(self).data('permlink');
	var author = $(self).data('author');
	var category = $(self).data('category');
	var imgurl = $(self).data('imgurl');
	var title = $(self).data('title');
	var status = $(self).data('status');

	$("#pf_username").val(author);
	$("#pf_permlink").val(permlink);
	$("#pf_category").val(category);
	$("#pf_imgurl").val(imgurl);
	$("#pf_title").val(title);
	$("#pf_status").val(status);
	
	var setmsg = "What would you make this post featured?";
	if(status !== null && status !== undefined){
	    setmsg = "What would you remove this post from featured?";
	}
	
	$("#labelid").html(setmsg);

	$("#featuredPostStatusModal").modal('show');
    }

    
$(document).ready(function(){
	var savefeaturedpoststatus=$('#savefeaturedpoststatus');

	savefeaturedpoststatus.click(function(){

	    var p_username = $("#pf_username").val();
	    var p_permlink = $("#pf_permlink").val();
	    var p_category = $("#pf_category").val();
	    var p_imgurl = $("#pf_imgurl").val();
	    var p_title = $("#pf_title").val();
	    var p_status = $("#pf_status").val();

	    $.ajax({
		    type: "POST",
		    url: '/helper/featuredpoststatus.php',
		    data:{'img_link':p_imgurl,'title':p_title,'p_username':p_username,'p_permlink':p_permlink,'p_category':p_category},
		    dataType: 'json',
		    success: function(response) {
			if(response.status == "OK") {
			    toastr.success(response.message);
			    $('#featuredPostStatusModal').modal('hide');
			    var setlabel = "Add";
			    
			    var insertid = response.insertid;
			    if(insertid !== null && insertid !== undefined){
				var setlabel = "Remove";
			    }
			    $("#fpost_"+p_username).text(setlabel);
			    $("#fpost_"+p_username).data('status',insertid);
				
			}
			else {
			    $('#featuredPostStatusModal').modal('hide');
			    toastr.error(response.message);
			    return false;
			}
		    },
		    error: function() {
			$('#featuredPostStatusModal').modal('hide');
			 toastr.error('Error occured');
			    return false;
		    }
	    });
	});
	

	$.ajax({
		type: "POST",
		url: '/helper/getadmindata.php',
		data:{'data':'fposts'},
		dataType: 'json',
		success: function(response) {
			if(response.status == "OK") {
				var result_data = response.html_data;
				var result_html = ' <table class="table table-bordered" id="fpost_table"><thead><tr><th>Title</th><th>Username</th><th>Category</th><th>Permlink</th><th>Action</th></tr></thead><tbody >';
				for(i=0;i<result_data.length;i++){

					var action_var = "Add";
	
					var fid = result_data[i]['fid'];
					if(fid !== null && fid !== undefined){
					    action_var = "Remove";
					}
			    
					
					
					result_html += '<tr><td>'+result_data[i]['title']+'</td><td>'+result_data[i]['username']+'</td><td>'+result_data[i]['category']+'</td><td>'+result_data[i]['permlink']+'</td><td><a href="javascript:"  id="fpost_'+result_data[i]['username']+'" onclick="return openfpost_popup(this)" class="btn btn-small btn-primary" data-author="'+result_data[i]['username']+'" data-imgurl="'+result_data[i]['imgurl']+'" data-title="'+result_data[i]['title']+'" data-category="'+result_data[i]['category']+'" data-permlink="'+result_data[i]['permlink']+'" data-status="'+fid+'" >'+action_var+'</a></td></tr>';
				}

				result_html += '</tbody></table>';
				$("#show_results").html(result_html);
				$('#fpost_table').DataTable({language: { search: '', searchPlaceholder: "Search..." }});
			}
		}
	});
});
</script>

