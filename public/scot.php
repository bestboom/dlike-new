<?php

$post_url = "http://scot-api.steem-engine.com/@tophash/alibaba-set-for-big-challenge-as-flamboyant-chairman-ma-departs";
$response = file_get_contents($post_url);
$result = json_decode($response);

echo $pending_amount = $result->DLIKER->pending_token;
echo '<br/>';
echo $precision = $result->DLIKER->precision;
echo '<br/>';
echo $pending_payout = number_format((float) $pending_amount, $precision, '.', ''); ;
echo '<br/>';
echo $cashout_time = $result->DLIKER->cashout_time;

include('template/footer.php');
?>

<script type="text/javascript">
	let cashout_time = '<?=($cashout_time)?>';
	console.log(cashout_time);
	let time_remian = moment.utc(cashout_time + "Z", 'YYYY-MM-DD  h:mm:ss').fromNow();
	console.log(time_remian);
</script>