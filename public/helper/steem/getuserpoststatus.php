<?php require '../../includes/config.php';
	$sql = $conn->query("SELECT * FROM userstatus where username = '".$_POST['author']."'");
	if ($sql->num_rows > 0) {
	while($row=$result->fetch_assoc()){$strReturn['setstatus']=$row['status'];$strReturn['status']='OK';}
	} else {$strReturn['status'] = 'error';}
  	echo json_encode($strReturn);die;
?>