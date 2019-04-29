<?php include('head.php'); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container">
  <h2>&nbsp;</h2>

  <input type="hidden" id="amount_data" />
  <input type="hidden" id="amount_total_check" />
  <input type="hidden" id="total_data" />
  
  <input type="text" class="form-control col-sm-12" id="steemid" placeholder="Paste a STEEMIT ID without @ (and Press Enter) e.g. dlike" name="steemid">
  <div id="show_results">
  </div>

<h2>&nbsp;</h2>


<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Pay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="payme">Confirm Pay</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div>
</div>



   
</div>

<script>
    
$(document).ready(function(){

    $('#steemid').keypress(function (e) {
      if (e.which == 13) {

          $.ajax({
            type: 'POST',
            url: 'delegation-curl.php',
            dataType: 'json',
            data: {'steemid': $('#steemid').val()},
            success: function(data) {
              
              
              $('#show_results').html(data.html);
              $('#total_amount').html(data.amount_total);

              

              var total_data = data.total_data;
              var amount_array = data.amount_data;
              var total_amount_show = parseFloat(data.amount_total_check);

              $('#amount_data').val(data.amount_data);
              $('#amount_total_check').val(data.amount_total_check);
              $('#total_data').val(data.total_data);
              
              
              for(i=0;i<total_data;i++){
                var row_amount = parseFloat(amount_array[i]);
                var showpencetage = (parseInt(100)*row_amount)/total_amount_show;
                var rowpencetage = showpencetage.toFixed(2);
                $("#row_percentage_"+i).html(rowpencetage+"%");
                
              }

              
            }
          });
      }
    });


    
});

function pay_now(){
    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
    })
    .on('click', '#payme', function(e) {
        var myamount_total_data = $('#total_data').val();


        var namesarray = [];
        var amountarray = [];
        var pencentagearray = [];
        var tokensarray = [];
        var steemsarray = [];
        var sbdarray = [];
        
        for(i=0;i<myamount_total_data;i++){
            if($('tr#row_'+i).length){
                namesarray.push($('#row_name_'+i).html());
                amountarray.push($('#row_data_'+i).val());
                pencentagearray.push($('#row_percentage_'+i).html());
                tokensarray.push($('#row_token_'+i).html());
                steemsarray.push($('#row_steem_'+i).html());
                sbdarray.push($('#row_sbd_'+i).html()); 
            }
        }

        var obj = {};
        obj['names'] = namesarray;
        obj['amount'] = amountarray;
        obj['percentage'] = pencentagearray;
        obj['tokens'] = tokensarray;
        obj['steem'] = steemsarray;
        obj['sbd'] = sbdarray;
 

        $.ajax({
            type: 'POST',
            url: 'delegation-tkad.php',
            dataType: 'json',
            data: {'senderobj': obj},
            success: function(data) {
                if(data.status == "no") {
                  alert(data.message);
                  window.location.replace("https://dlike.io","_self");
                }
                else {
                    alert(data.message);
                }
            }
          });
    });
}

function callinputedit(thisvar,id){
    var myamount_data_array = $('#amount_data').val().split(",");
    var myamount_amounttotal_check = parseFloat($('#amount_total_check').val());
    var myamount_total_data = $('#total_data').val();

    
    var total_token = $("#token_input_total").val().trim();
    var steem_token = $("#steem_input_total").val().trim();
    var sbd_token = $("#sbd_input_total").val().trim();


    var myamount_amount_total_check = parseFloat((myamount_amounttotal_check)-parseFloat(myamount_data_array[id])).toFixed(2);

  
    var myamount_amount_total_check = parseFloat(myamount_amount_total_check) + parseFloat(thisvar.value);


    

   
    
    myamount_data_array = myamount_data_array.map(function(item) { return item == (myamount_data_array[id]) ? thisvar.value : item; });


    $('#amount_data').val(myamount_data_array.toString());
    console.log(myamount_data_array);

    
    $('#total_amount').html(myamount_amount_total_check);
    $('#amount_total_check').val(myamount_amount_total_check);

    for(i=0;i<myamount_total_data;i++){
        
        var row_amount = parseFloat(myamount_data_array[i]);
        var showpencetage = (parseInt(100)*row_amount)/myamount_amount_total_check;
        var rowpencetage = showpencetage.toFixed(2);
        $("#row_percentage_"+i).html(rowpencetage+"%");


        if(!isNaN(total_token) && total_token != ""){
            var tokenvalue = parseFloat(total_token);
            var tokenrow = (parseFloat(rowpencetage)*tokenvalue)/100;
            $("#row_token_"+i).html(tokenrow.toFixed(2));
        }
        if(!isNaN(steem_token) && steem_token != ""){
            var steemvalue = parseFloat(steem_token);
            var steemrow = (parseFloat(rowpencetage)*steemvalue)/100;
            $("#row_steem_"+i).html(steemrow.toFixed(2));
        }
        if(!isNaN(sbd_token) && sbd_token != ""){
            var sbdvalue = parseFloat(sbd_token);
            var sbdrow = (parseFloat(rowpencetage)*sbdvalue)/100;
            $("#row_sbd_"+i).html(sbdrow.toFixed(2));
        }
    }
    
}

function removerow(id){

    var myamount_data_array = $('#amount_data').val().split(",");
    var myamount_amounttotal_check = parseFloat($('#amount_total_check').val());
    var myamount_total_data = $('#total_data').val();

    
    var total_token = $("#token_input_total").val().trim();
    var steem_token = $("#steem_input_total").val().trim();
    var sbd_token = $("#sbd_input_total").val().trim();

    //console.log(myamount_data_array);
    var myamount_amount_total_check = ((myamount_amounttotal_check)-parseFloat(myamount_data_array[id])).toFixed(2);
    $('#total_amount').html(myamount_amount_total_check);
    $('#amount_total_check').val(myamount_amount_total_check);

    for(i=0;i<myamount_total_data;i++){
        
        var row_amount = parseFloat(myamount_data_array[i]);
        var showpencetage = (parseInt(100)*row_amount)/myamount_amount_total_check;
        var rowpencetage = showpencetage.toFixed(2);
        $("#row_percentage_"+i).html(rowpencetage+"%");


        if(!isNaN(total_token) && total_token != ""){
            var tokenvalue = parseFloat(total_token);
            var tokenrow = (parseFloat(rowpencetage)*tokenvalue)/100;
            $("#row_token_"+i).html(tokenrow.toFixed(2));
        }
        if(!isNaN(steem_token) && steem_token != ""){
            var steemvalue = parseFloat(steem_token);
            var steemrow = (parseFloat(rowpencetage)*steemvalue)/100;
            $("#row_steem_"+i).html(steemrow.toFixed(2));
        }
        if(!isNaN(sbd_token) && sbd_token != ""){
            var sbdvalue = parseFloat(sbd_token);
            var sbdrow = (parseFloat(rowpencetage)*sbdvalue)/100;
            $("#row_sbd_"+i).html(sbdrow.toFixed(2));
        }
    }
    
    $("#row_"+id).remove();
}
function callonefunction(thisvalue,type){
    var myamount_data_array = $('#amount_data').val().split(",");
    var myamount_amount_total_check = parseFloat($('#amount_total_check').val());
    var myamount_total_data = $('#total_data').val();

    var total_token = $("#token_input_total").val().trim();
    var steem_token = $("#steem_input_total").val().trim();
    var sbd_token = $("#sbd_input_total").val().trim();

        
    for(i=0;i<myamount_total_data;i++){
        var row_amount = parseFloat(myamount_data_array[i]);
        var showpencetage = (parseInt(100)*row_amount)/myamount_amount_total_check;
        var rowpencetage = showpencetage.toFixed(2);
        


        if(!isNaN(total_token) && total_token != ""){
            var tokenvalue = parseFloat(total_token);
            var tokenrow = (parseFloat(rowpencetage)*tokenvalue)/100;
            $("#row_token_"+i).html(tokenrow.toFixed(2));
        }
        if(!isNaN(steem_token) && steem_token != ""){
            var steemvalue = parseFloat(steem_token);
            var steemrow = (parseFloat(rowpencetage)*steemvalue)/100;
            $("#row_steem_"+i).html(steemrow.toFixed(2));
        }
        if(!isNaN(sbd_token) && sbd_token != ""){
            var sbdvalue = parseFloat(sbd_token);
            var sbdrow = (parseFloat(rowpencetage)*sbdvalue)/100;
            $("#row_sbd_"+i).html(sbdrow.toFixed(2));
        }
    }
}
  
</script>



<?php include('../template/footer.php'); ?>
