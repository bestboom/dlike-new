<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

		if (isset($_POST["eth_add"]) && isset($_POST["eth_user"]))
		{

			$eth_add = $_POST["eth_add"];
			$user = $_POST["eth_user"];

			function isAddress($address) {
			    if (!preg_match('/^(0x)?[0-9a-f]{40}$/i',$address)) {
			        // check if it has the basic requirements of an address
			        return false;
			    } elseif (!preg_match('/^(0x)?[0-9a-f]{40}$/',$address) || preg_match('/^(0x)?[0-9A-F]{40}$/',$address)) {
			        // If it's all small caps or all all caps, return true
			        return true;
			    } else {
			        // Otherwise check each case
			        return isChecksumAddress($address);
			    }
			}
			function isChecksumAddress($address) {
			    // Check each case
			    $address = str_replace('0x','',$address);
			    $addressHash = hash('sha3',strtolower($address));
			    $addressArray=str_split($address);
			    $addressHashArray=str_split($addressHash);

			    for($i = 0; $i < 40; $i++ ) {
			        // the nth letter should be uppercase if the nth digit of casemap is 1
			        if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) || (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])) {
			            return false;
			        }
			    }
			    return true;
			}

			$checkaddr = isAddress($eth_add);

			if($checkaddr === true)
				{ 
					$sqlu = "SELECT * FROM wallet where username='$user'"; 
						$resultu = $conn->query($sqlu);
						$rowU = $resultu->fetch_assoc();	
						$user_eth = $rowU['eth'];

						if($user_eth == '') 
						{	
							$updateWallet = "UPDATE wallet SET eth = '$eth_add' WHERE username = '$user'";
							$updateWalletQuery = $conn->query($updateWallet);
							if ($updateWalletQuery === TRUE) 
							{
								echo '<div class="alert alert-success">Address Added Successfully</div>';
								echo '<script>$(".eth_add").attr("disabled","disabled"); document.getElementById("eth_sub").reset(); setTimeout(function(){location.reload();},2000);</script>';
							}
						} 
						else 
						{
							echo '<div class="alert alert-danger">Address Already Exists</div>';
						}
					
				} 
				else 
				{ 
					echo '<div class="alert alert-danger">Address is not valid</div>';
				}

			
		} 
	else 
	{
		echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
	}

?>