<?php
if(!empty($_POST['steemid'])) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://helloacm.com/api/steemit/delegators/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "id=".$_POST['steemid']."&hash=a31bf2a391414e73720723c1bde0e9b8");
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$data = json_decode($result,true);

$html = '<table class="table table-bordered"><tbody><tr id="row_main_pay"><td colspan="8" align="right"><input type="button" class="btn btn-primary" onclick="return pay_now()" value="Pay"/></td></tr><tr id="row_main"><td>&nbsp;</td><td id="total_amount"></td><td id="total_percentage">100%</td><td id="token_amount"><input type="text" class="form-control" onkeyup="return callonefunction(this,\'token\')" id="token_input_total"/></td><td id="steem_amount"><input type="text" class="form-control"  onkeyup="return callonefunction(this,\'steem\')" id="steem_input_total"/></td><td id="sbd_amount"><input type="text" class="form-control"  onkeyup="return callonefunction(this,\'sbd\')" id="sbd_input_total"/></td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><th>Name</th><th>Amount</th><th>Percentage</th><th>tokens</th><th>Steem</th><th>sbd</th><th>date</th><th>Action</th></tr>';
foreach($data as $key=>$result_data) {
	$amount = round($result_data['sp'],2);
	$amount_total += round($result_data['sp'],2);
$html .= '<tr id="row_'.$key.'"><td id="row_name_'.$key.'">'.$result_data['delegator'].'</td><td><input type="text" onkeyup="return callinputedit(this,\''.$key.'\')" class="form-control" value="'.$amount.'" id="row_data_'.$key.'" /></td><td id="row_percentage_'.$key.'"></td><td id="row_token_'.$key.'"></td><td id="row_steem_'.$key.'"></td><td id="row_sbd_'.$key.'"></td><td>'.date("Y-m-d",strtotime($result_data['time'])).'</td><td><a href="javascript:" onclick="return removerow(\''.$key.'\')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>';

	$show_data[] = round($result_data['sp'],2);
}
$html .= '</tbody></table>';

$s_data['html'] = $html;
$s_data['amount_total'] = $amount_total;
$s_data['total_data'] = count($data);
$s_data['amount_data'] = $show_data;
$s_data['amount_total_check'] = $amount_total;

echo json_encode($s_data);die;
}
?>


