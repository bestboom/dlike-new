<?php
include('template/header5.php');
$link = 'alibaba-set-for-big-challenge-as-flamboyant-chairman-ma-departs';
$user = '@tophash';

echo $scot_url = "https://scot-api.steem-engine.com/$user/$link";
$sct_response = file_get_contents($scot_url);
$sct_result = json_decode($sct_response, TRUE);
echo '<br/>';
$og_title = $sct_result['DLIKER']['title'];
/*
echo '<br/>';
//echo $meta_data = $sct_result->DLIKER->json_metadata;
echo '<br/>';
//echo $body = json_decode($meta_data['community']);
echo '<br/>';
//$og_description = $sct_result->DLIKER->desc;
//print_r($og_description);
echo '<br/>';
$og_description = explode("\n\n#####\n\n",$sct_result['DLIKER']['desc']);
$og_description = $og_description[1];
$og_description = implode(' ', array_slice(explode(' ', $og_description), 0, 23));
//function removeTags($str) {  
//    $str = preg_replace("#<(.*)/(.*)>#iUs", "", $str);
//    return $str;
//}
echo '<br/>';
$og_description = removeTags($og_description);
echo '<br/>';
echo $pending_amount = ($sct_result->DLIKER->pending_token)/1000;
echo '<br/>';
echo $precision = $sct_result->DLIKER->precision;
echo '<br/>';
echo $pending_payout = number_format((float) $pending_amount, $precision, '.', '');
echo '<br/>';
echo $cashout_time = $sct_result->DLIKER->cashout_time;
*/
?>
<div class="modal fade" id="dlikem_maket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
        	<div class="modal-body ">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
        		<div class="transfer-respond" style="padding: 10px 10px;">
        			<h2 style="font-size: 28px;font-weight: 600;padding-bottom: 30px;padding-top: 20px;">Buy DLIKEM Tokens</h4>
        			<p style="font-weight: 500;margin-bottom: 0px;padding: 0px;">
        				Buy DLIKEM tokens to stake, earn DLIEKR tokens reward.
        				40 miners get rewarded every hour!
        			</p><br>
        			<center>
        			<button class="btn btn-danger" style="padding: 12px 25px;font-weight: 600;font-size: 18px;">Limited Tokens For Sale</button>
        			<p style="padding-top: 7px;">Sale is live on <a href="https://steem-engine.com/?p=market&t=DLIKEM" target="_blank"><b>STEEM Engine Market</b></a></p>
        			</center>
        		</div>
        	</div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <span id="similar" class="vtme"  style="padding-top: 200px;" data-popover="true" data-html="true" data-content="<ul>' + vote_info + '</ul>">heeeeeeeeeeeeeeeeeee</span>
<p id='container'>
<button class='btn btn-primary btn-large' data-popover="true" data-html=true data-content="<a href='http://www.wojt.eu' target='blank' >click me, I'll try not to disappear</a>">hover here</button>
</p>
<?
include('template/footer.php');
?>

<script type="text/javascript">
	//$(window).on('load',function(){
    //    $('#dlikem_maket').modal('show');
    //});


$.getJSON('https://scot-api.steem-engine.com/@habibabiba/singapore-grand-prix-plan-in-place-to-cope-with-poor-air-quality', function(data) {
					vote_info = "";
					var voterList = data.DLIKER.active_votes;
    				console.log(voterList);

    				let netshare = data.DLIKER.vote_rshares;
    				console.log(netshare);

    				let pending_payout = (data.DLIKER.pending_token)/1000;
    				console.log(pending_payout);

    				for (let v = 0; v < voterList.length; v++) {
    					if(voterList[v].weight>0){
                            let vote_amt = ((voterList[v].rshares / netshare) * pending_payout);
                            console.log(vote_amt);
                            let votePercent = ((voterList[v].percent / 10000) * 100);
                            votePercent = parseInt(votePercent);
                            console.log(votePercent);
                            let voter = voterList[v].voter;
                            console.log(voter);

                        	vote_info += ('<li><span><a> @' + voter + '</a></span>&nbsp;<span>(' + votePercent + '%)</span>&nbsp;&nbsp;<i>$' + vote_amt + '</i></li>');
                            if (j == 16) {
                                let moreV = voterList.length - 15;
                                vote_info += "... and " + moreV + " more votes.";
                                break;
                            }    
                        }    
                    }        
    				//$('#se_token' + $post.permlink + $post.author).html(pending_token);
				});	

$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});


	//let cashout_time = '<?=($cashout_time)?>';
	//console.log(cashout_time);
	//let time_remian = moment.utc(cashout_time + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
	//console.log(time_remian);

</script>