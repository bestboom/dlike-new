<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
	require '../includes/config.php';

	if($_COOKIE['username'] != 'dlike') {
		$data['status'] = 'no';	
		$data['message'] = 'only admin can pay.';	
		echo json_encode($data);die;
	}


if(count($_POST['senderobj']['names']) > 0 && count($_POST['senderobj']['tokens']) > 0){
	foreach($_POST['senderobj']['names'] as $key_pair=>$names) {
		$username = $names;
		$amount = $_POST['senderobj']['tokens'][$key_pair];
		if(isset($_POST['senderobj']['reason'])){
			$reason = $_POST['senderobj']['reason'][$key_pair];
		}
		else {
			$reason = "delegation";	
		}
		
		if($username != "" && $amount != "") {
			$sqlm = "INSERT INTO transactions (username, amount, reason)
			VALUES ('".$username."', '".$amount."', '".$reason."')";
			if (mysqli_query($conn, $sqlm)) {
				$checkWallet = "SELECT username, amount FROM wallet WHERE username = '$username'";
				$result = mysqli_query($conn, $checkWallet);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$old_amount = $row['amount'];
						$updateWallet = "UPDATE wallet SET amount = '$old_amount' + '$amount' WHERE username = '$username'";
						$updateWalletQuery = $conn->query($updateWallet);
						if ($updateWalletQuery === TRUE) {} 
					}
				}
				else {
					$addWallet = "INSERT INTO wallet (username, amount)	VALUES ('".$username."', '".$amount."')";
					$addWalletQuery = $conn->query($addWallet);
				}
			}
		}
	}
	$data['status'] = 'yes';	
	$data['message'] = 'Added Successfully!';	
	echo json_encode($data);die;
}
?>
