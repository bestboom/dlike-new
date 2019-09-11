<?php
$link = 'alibaba-set-for-big-challenge-as-flamboyant-chairman-ma-departs';
$user = '@tophash';

echo $scot_url = "https://scot-api.steem-engine.com/$user/$link";
$sct_response = file_get_contents($scot_url);
$sct_result = json_decode($sct_response);
echo '<br/>';
echo $meta_data = json_decode($sct_result->DLIKER->json_metadata);
echo '<br/>';
echo $pending_amount = ($sct_result->DLIKER->pending_token)/1000;
echo '<br/>';
echo $precision = $sct_result->DLIKER->precision;
echo '<br/>';
echo $pending_payout = number_format((float) $pending_amount, $precision, '.', '');
echo '<br/>';
echo $cashout_time = $sct_result->DLIKER->cashout_time;

include('template/footer.php');
?>

<script type="text/javascript">
	let cashout_time = '<?=($cashout_time)?>';
	console.log(cashout_time);
	let time_remian = moment.utc(cashout_time + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
	console.log(time_remian);
</script>