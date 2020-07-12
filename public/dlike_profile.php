<?php 
if (isset($_GET['user'])) 
{
	$prof_user = $_GET['user'];
} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
include('template/header5.php');
//check pro status


    $sql_T = "SELECT * FROM prousers where username='$prof_user'";
    $result_T = $conn->query($sql_T);
    if ($result_T && $result_T->num_rows > 0) 
    {
    	$profile_user = 'PRO';
    } else {$profile_user = 'Non-PRO';}
?>
</div><!-- sub-header -->
<?
    $sql_U = $conn->query("SELECT * FROM dlikeaccounts where username='$prof_user'");
    if ($sql_U && $sql_U->num_rows > 0) 
    {
    	$row_U = $sql_U->fetch_assoc();
        $dlikeuser = $row_U['username'];
    	$dlike_user = $dlikeuser;
    } else {$dlike_user = 'non';}

    echo $dlike_user;
?>