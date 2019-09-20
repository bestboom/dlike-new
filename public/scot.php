
<?php
include('template/header5.php');
?>
<form action="">
    <textarea name="data"></textarea>
    <button type="submit">check</button>
</form>
<?
$check_data = stripslashes(Trim($_POST['data']));

$search_keyword = str_replace("�", "'", $check_data);
$search_keyword = '"'.$search_keyword.'"';

$googleDomains = array('google.com', 'google.ad', 'google.ae', 'google.com.af', 'google.com.ag', 'google.com.ai', 'google.al', 'google.am', 'google.co.ao', 'google.com.ar', 'google.as', 'google.at', 'google.com.au', 'google.az', 'google.ba', 'google.com.bd', 'google.be', 'google.bf', 'google.bg', 'google.com.bh', 'google.bi', 'google.bj', 'google.com.bn', 'google.com.bo', 'google.com.br', 'google.bs', 'google.bt', 'google.co.bw', 'google.by', 'google.com.bz', 'google.ca', 'google.cd', 'google.cf', 'google.cg', 'google.ch', 'google.ci', 'google.co.ck', 'google.cl', 'google.cm', 'google.cn', 'google.com.co', 'google.co.cr', 'google.com.cu', 'google.cv', 'google.com.cy', 'google.cz', 'google.de', 'google.dj', 'google.dk', 'google.dm', 'google.com.do', 'google.dz', 'google.com.ec', 'google.ee', 'google.com.eg', 'google.es', 'google.com.et', 'google.fi', 'google.com.fj', 'google.fm', 'google.fr', 'google.ga', 'google.ge', 'google.gg', 'google.com.gh', 'google.com.gi', 'google.gl', 'google.gm', 'google.gp', 'google.gr', 'google.com.gt', 'google.gy', 'google.com.hk', 'google.hn', 'google.hr', 'google.ht', 'google.hu', 'google.co.id', 'google.ie', 'google.co.il', 'google.im', 'google.co.in', 'google.iq', 'google.is', 'google.it', 'google.je', 'google.com.jm', 'google.jo', 'google.co.jp', 'google.co.ke', 'google.com.kh', 'google.ki', 'google.kg', 'google.co.kr', 'google.com.kw', 'google.kz', 'google.la', 'google.com.lb', 'google.li', 'google.lk', 'google.co.ls', 'google.lt', 'google.lu', 'google.lv', 'google.com.ly', 'google.co.ma', 'google.md', 'google.me', 'google.mg', 'google.mk', 'google.ml', 'google.com.mm', 'google.mn', 'google.ms', 'google.com.mt', 'google.mu', 'google.mv', 'google.mw', 'google.com.mx', 'google.com.my', 'google.co.mz', 'google.com.na', 'google.com.nf', 'google.com.ng', 'google.com.ni', 'google.ne', 'google.nl', 'google.no', 'google.com.np', 'google.nr', 'google.nu', 'google.co.nz', 'google.com.om', 'google.com.pa', 'google.com.pe', 'google.com.pg', 'google.com.ph', 'google.com.pk', 'google.pl', 'google.pn', 'google.com.pr', 'google.ps', 'google.pt', 'google.com.py', 'google.com.qa', 'google.ro', 'google.ru', 'google.rw', 'google.com.sa', 'google.com.sb', 'google.sc', 'google.se', 'google.com.sg', 'google.sh', 'google.si', 'google.sk', 'google.com.sl', 'google.sn', 'google.so', 'google.sm', 'google.sr', 'google.st', 'google.com.sv', 'google.td', 'google.tg', 'google.co.th', 'google.com.tj', 'google.tk', 'google.tl', 'google.tm', 'google.tn', 'google.to', 'google.com.tr', 'google.tt', 'google.com.tw', 'google.co.tz', 'google.com.ua', 'google.co.ug', 'google.co.uk', 'google.com.uy', 'google.co.uz', 'google.com.vc', 'google.co.ve', 'google.vg', 'google.co.vi', 'google.com.vn', 'google.vu', 'google.ws', 'google.rs', 'google.co.za', 'google.co.zm', 'google.co.zw', 'google.cat');

$random_domain =array_rand($googleDomains,1);
$googleDomain = $googleDomains[$random_domain];
        
$googleUrl = 'https://www.' . $googleDomain . '/search?hl=en&q=' . urlencode($search_keyword);
$pageData = curlGET_Text($googleUrl);
        
    if(str_contains($pageData,'No results found for')){
            //No Match Found
        die('content is unique');
    }else{
            //Matched
        die('duplicate');   
    }



/*
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
/*
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
*/
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

 //$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});


	//let cashout_time = '<?=($cashout_time)?>';
	//console.log(cashout_time);
	//let time_remian = moment.utc(cashout_time + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
	//console.log(time_remian);

</script>