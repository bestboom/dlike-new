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


	$checktip = "SELECT * FROM TipTop where permlink = '$permlink' and receiver = '$receiver' and sender = '$sender'";
	$resulttip = $conn->query($checktip);
	if ($resulttip->num_rows > 0) {
		$resulttip = mysqli_query($conn, $checktip);
		$rowtip = $resulttip->fetch_assoc();
		$tiptime = $rowtip['tip_time'];	
		echo '<div class="alert alert-danger">You Have already tip this post</div>';
	} else {

		$verifytime = "SELECT TimeStampDiff(SECOND,tip_time,Now()) AS lasttime FROM TipTop where sender = '$sender' order by tip_time DESC limit 1";
		$resulttime = $conn->query($verifytime);
		$rowtime = $resulttime->fetch_assoc();
		if ($resulttime->num_rows  >= 0) 
		{
			echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
			echo '<script>$(".tipthnk").hide(); $(".tipratio").show();</script>';
		} 
		else
		{		
			$lasttip = $rowtime['lasttime']; 
			if($lasttip < 300) 
			{
				echo '<div class="alert alert-danger">There seems some issue</div>';
				echo '<script>setTimeout(function(){location.reload();}, 1000);</script>'; 
			} 
			else 
			{
				$sqlm = "INSERT INTO TipTop (sender, receiver, permlink, tip1, userip, tip_time)
				VALUES ('".$sender."', '".$receiver."', '".$permlink."', '".$tip1."', '".$ip."', now())";
				
				if (mysqli_query($conn, $sqlm)) 
				{	

					echo '<div class="alert alert-success">Tip is Successful</div>';
					echo '<script>$(".btn-tip").attr("disabled","disabled"); document.getElementById("tipsubmit").reset(); setTimeout(function(){location.reload();}, 1000);</script>';
				} 
				else 
				{
					echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
				}

			}
		}	
	}
	
}	
?>