<?php

$post_url = "http://scot-api.steem-engine.com/@tophash/alibaba-set-for-big-challenge-as-flamboyant-chairman-ma-departs";
$response = file_get_contents($post_url);
$result = json_decode($response);

var_dump($result->DLIKER['pending_token']);

?>