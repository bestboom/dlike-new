<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';




?>
<!--
select count(*), tag from dlike_tags group by tag having count(*) >1 order by count(*) DESC;



https://stackoverflow.com/questions/26984409/bootstrap-pagination-using-php-mysql


$sqlm = "CREATE TABLE dlike_trending_tags  (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tag VARCHAR(255) NOT NULL,
count INT(16) NOT NULL
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlm = "CREATE TABLE dlike_airdrop_history  (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
to_user VARCHAR(255) NOT NULL,
amount FLOAT(12,2) NOT NULL,
reason VARCHAR(255) NOT NULL,
trx_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlm = "CREATE TABLE dlike_daily_rewards (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
today_upvotes INT(30) NOT NULL,
dlike_staking VARCHAR(255) NOT NULL,
dlike_dao VARCHAR(255) NOT NULL,
dlike_charity VARCHAR(255) NOT NULL,
dlike_team VARCHAR(255) NOT NULL,
dlike_foundation VARCHAR(255) NOT NULL,
dlike_airdrop VARCHAR(255) NOT NULL,
update_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlm = "CREATE TABLE dlike_staking_rewards (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(30) NOT NULL,
username VARCHAR(255) NOT NULL,
reward VARCHAR(255) NOT NULL
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlme = "CREATE TABLE dlike_staking_transactions (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(30) NOT NULL,
username VARCHAR(255) NOT NULL,
amount VARCHAR(255) NOT NULL,
tron_address VARCHAR(255) NOT NULL,
tron_trx VARCHAR(255) NOT NULL,
trx_time TIMESTAMP
)";

if ($conn->query($sqlme) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

TAy4cgiqoEDJdVYn8VKDzST598ta34F2Lh
var stakedAmount = await myContract.checkStake(user_address).call();



$sql_data = $conn->query("INSERT INTO dlike_staking (user_id, username, amount, tron_address, tron_trx) VALUES ('8', 'certseek', '1900', 'txytrdsds', 'abc244sd')");



$sqlm = "CREATE TABLE dlike_staking (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(30) NOT NULL,
username VARCHAR(255) NOT NULL,
amount VARCHAR(255) NOT NULL,
tron_address VARCHAR(255) NOT NULL,
tron_trx VARCHAR(255) NOT NULL,
trx_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sqlm = "CREATE TABLE dlike_daily_rewards (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
yesterday_upvotes INT(30) NOT NULL,
dlike_staking VARCHAR(255) NOT NULL,
dlike_dao VARCHAR(255) NOT NULL,
dlike_charity VARCHAR(255) NOT NULL,
dlike_team VARCHAR(255) NOT NULL,
dlike_foundation VARCHAR(255) NOT NULL,
dlike_airdrop VARCHAR(255) NOT NULL,
data_time TIMESTAMP,
update_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



//$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = SUBDATE(CURRENT_DATE(), 1)");



$sql = "ALTER TABLE dlikeaccounts ADD offchain_address VARCHAR(255) NOT NULL AFTER verified";
if ($conn->query($sql) === TRUE) {
    echo "new field added to dlikeaccounts table";
} else {
    echo "Error updating table: " . $conn->error;
}

$sql = "CREATE TABLE dlike_withdrawals (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(30) NOT NULL,
status INT(6) NOT NULL,
req_on TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table wallet created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlw = "DELETE FROM mylikes";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}


$sql = "ALTER TABLE mylikes ADD like_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP";
if ($conn->query($sql) === TRUE) {
    echo "new field added to mylikes table";
} else {
    echo "Error updating table: " . $conn->error;
}


$sqlm = "CREATE TABLE dlike_tags (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
tag VARCHAR(255) NOT NULL,
author VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
created_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table tags created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sqlm = "CREATE TABLE dlike_upvotes (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
curator VARCHAR(255) NOT NULL,
author VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
ip_addr VARCHAR(255) NOT NULL,
status INT(6) NOT NULL,
curation_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

233.33


$sql = "ALTER TABLE convert_dlike ADD type INT(6) NOT NULL AFTER status";
if ($conn->query($sql) === TRUE) {
    echo "new field added to convert_dlike table";
} else {
    echo "Error updating table: " . $conn->error;
}


$sqlm = "CREATE TABLE convert_dlike (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
steem_username VARCHAR(255) NOT NULL,
amount INT(11) NOT NULL,
eth_add VARCHAR(255) NOT NULL,
earned_by VARCHAR(255) NOT NULL,
status INT(6) NOT NULL,
req_on TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table convert_dlike created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE dlike_wallet (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table wallet created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sqlm = "CREATE TABLE dlike_transactions (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(30) NOT NULL,
reason VARCHAR(250),
trx_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlm = "CREATE TABLE dlikeposts (
id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
title VARCHAR(255) NOT NULL,
permlink VARCHAR(1000) NOT NULL,
ext_url VARCHAR(255) NOT NULL,
img_url VARCHAR(255) NOT NULL,
ctegory VARCHAR(255) NOT NULL,
description VARCHAR(1000) NOT NULL,
tags VARCHAR(255) NOT NULL,
created_at TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table dlikeposts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlw = "DELETE FROM dlikeaccounts";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}




$sqlm = "CREATE TABLE dlikepasswordreset (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
email VARCHAR(255) NOT NULL,
token VARCHAR(1000) NOT NULL,
reset_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table dlikepasswordreset created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sqlm = "CREATE TABLE dlikeaccounts (
id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(1000) NOT NULL,
refer_by VARCHAR(255) NOT NULL,
status INT(6) NOT NULL,
about VARCHAR(1000) NOT NULL,
profile_pic VARCHAR(255) NOT NULL,
profile_banner VARCHAR(255) NOT NULL,
location VARCHAR(255) NOT NULL,
website VARCHAR(255) NOT NULL,
full_name VARCHAR(255) NOT NULL,
loct_ip VARCHAR(255) NOT NULL,
verify_code VARCHAR(255) NOT NULL,
verified INT(6) NOT NULL,
created_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table dlikeaccounts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

/*
$sql = "ALTER TABLE wallet ADD loct_ip varchar(255) NOT NULL AFTER verified";
if ($conn->query($sql) === TRUE) {
    echo "new field added to wallet table";
} else {
    echo "Error updating table: " . $conn->error;
}

*/


ALTER TABLE dlike_staking_transactions MODIFY amount float(12,2);



https://tronscan.org/#/transaction/0441b729212cc8196949110b435f32608887097b0c827014d32dfa7845d89fff
    
$sql = "ALTER TABLE userposttemplates MODIFY content VARCHAR(100000)";
if ($conn->query($sql) === TRUE) {
    echo "Table varchar updated";
} else {
    echo "Error updating table: " . $conn->error;
}

$sqlm = "CREATE TABLE dlikeaccounts (
id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
refer_by VARCHAR(255) NOT NULL,
status INT(6) NOT NULL,
created_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table dlikeaccounts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id = 1152;
$sqlw = "DELETE FROM prousers WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}



$id = 2902;

$sqlw = "DELETE FROM staking WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id2 = 2892;

$sqlw = "DELETE FROM staking WHERE id = '$id2'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id3 = 2882;

$sqlw = "DELETE FROM staking WHERE id = '$id3'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id4 = 2872;

$sqlw = "DELETE FROM staking WHERE id = '$id4'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id5 = 2862;

$sqlw = "DELETE FROM staking WHERE id = '$id5'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id6 = 2852;

$sqlw = "DELETE FROM staking WHERE id = '$id6'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id7 = 2802;

$sqlw = "DELETE FROM staking WHERE id = '$id7'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id8 = 2792;

$sqlw = "DELETE FROM staking WHERE id = '$id8'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id9 = 2782;

$sqlw = "DELETE FROM staking WHERE id = '$id9'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id10 = 2772;

$sqlw = "DELETE FROM staking WHERE id = '$id10'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id11 = 2762;

$sqlw = "DELETE FROM staking WHERE id = '$id11'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id12 = 2752;

$sqlw = "DELETE FROM staking WHERE id = '$id12'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id13 = 2742;

$sqlw = "DELETE FROM staking WHERE id = '$id13'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id14 = 2722;

$sqlw = "DELETE FROM staking WHERE id = '$id14'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id15 = 2702;

$sqlw = "DELETE FROM staking WHERE id = '$id15'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id16 = 2692;

$sqlw = "DELETE FROM staking WHERE id = '$id16'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id17 = 4752;

$sqlw = "DELETE FROM staking WHERE id = '$id17'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id18 = 4632;

$sqlw = "DELETE FROM staking WHERE id = '$id18'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id19 = 4612;

$sqlw = "DELETE FROM staking WHERE id = '$id19'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id20 = 4532;

$sqlw = "DELETE FROM staking WHERE id = '$id20'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id21 = 4502;

$sqlw = "DELETE FROM staking WHERE id = '$id21'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}







$sqlw = "DELETE FROM `steemposts` 
  WHERE id NOT IN (
    SELECT * FROM (
      SELECT MAX(id) FROM steemposts 
        GROUP BY title
    ) as T
  )";

if ($conn->query($sqlw) === TRUE) {
    echo "Posts DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

-->
