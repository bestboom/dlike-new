<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

if (isset($_POST["tipauthor"]) && isset($_POST["tippermlink"])){	
	$receiver =  $_POST['tipauthor'];	
	$sender =  $_COOKIE['username'];	
	$permlink =  $_POST['tippermlink'];
	$tip1 = '0.002';
	$tip2 = '0.0015';
	$sender_amount = '0.003';


	$checktip = "SELECT * FROM TipTop where permlink = '$permlink' and receiver = '$receiver' and sender = '$sender'";
	$resulttip = $conn->query($checktip);

	if ($resulttip->num_rows > 0) 
	{
		$resulttip = mysqli_query($conn, $checktip);
		$rowtip = $resulttip->fetch_assoc();
		$tiptime = $rowtip['tip_time'];	
		echo '<div class="alert alert-danger">You Have already tip this post</div>';
	} 
	else 
	{

		$verifytime = "SELECT TimeStampDiff(SECOND,tip_time,Now()) AS lasttime FROM TipTop where sender = '$sender' order by tip_time DESC limit 1";
		$resulttime = $conn->query($verifytime);
		$rowtime = $resulttime->fetch_assoc();
		$lasttip = $rowtime['lasttime'];
				
				if(!$lasttip || $lasttip < 300) 
				{
					echo '<div class="alert alert-danger">There seems some issue</div>';
					echo '<script>return false;</script>'; 
				} 
			

			
				$sqlm = "INSERT INTO TipTop (sender, receiver, permlink, tip1, userip, tip_time)
					VALUES ('".$sender."', '".$receiver."', '".$permlink."', '".$tip1."', '".$ip."', now())";

					if (mysqli_query($conn, $sqlm)) 
					{
						$sqls = "SELECT * FROM TipsWallet where username='$sender'"; 
						$result_s = $conn->query($sqls);

						if($result_s->num_rows > 0) {
							echo 'user exist';
							$row_s = $result_s->fetch_assoc();	
							$sender_bal = $row_s['tip1'];
							$updat_u = "UPDATE TipsWallet SET tip1 = '$sender_bal' + '$sender_amount' WHERE username = '$sender'";
								$updateSenderQuery = $conn->query($updat_u);
								if ($updateSenderQuery === TRUE) {}
						}
						else
						{
							echo 'user not exist';
							$sqlsender = "INSERT INTO TipsWallet (`username`, `tip1`)
								VALUES ('".$sender."', '".$sender_amount."')";
								$addSendertip = $conn->query($sqlsender);
						}

						$sqlR = "SELECT * FROM TipsWallet where username='$receiver'"; 
						$result_R = $conn->query($sqlR);

						if($result_R->num_rows > 0) {
							$row_R = $result_R->fetch_assoc();	
							$receiver_bal = $row_R['tip1'];
							$updat_R = "UPDATE TipsWallet SET tip1 = '$receiver_bal' + '$tip1' WHERE username = '$receiver'";
								$updatereceiverQuery = $conn->query($updat_R);
								if ($updatereceiverQuery === TRUE) {}
						}
						else
						{
							$sql_R = "INSERT INTO TipsWallet (username, tip1)
								VALUES ('".$receiver."', '".$tip1."')";
							mysqli_query($conn, $sql_R);	
						}

						echo '<div class="alert alert-success">Tip is Successful</div>';
						echo '<script>$(".btn-tip").attr("disabled","disabled"); document.getElementById("tipsubmit").reset(); setTimeout(function(){location.reload();}, 1000);</script>';
					} 
					else 
					{
						echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
					}	
	}
	
}	
?>