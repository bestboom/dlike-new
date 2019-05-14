<?php

require '../../../vendor/autoload.php';


exit; // not active

use Plivo\RestClient;

define('PLIVO_AUTH_ID', '');
define('PLIVO_AUTH_TOKEN', '');
define('PLIVO_SOURCE_NUMBER', '');

$_REQUEST['phone_number'] = PLIVO_SOURCE_NUMBER;

$Client = new RestClient(PLIVO_AUTH_ID, PLIVO_AUTH_TOKEN);

if (!isset($_REQUEST['phone_number'])) {
    exit;
}

$message_created = $Client->messages->create(
    PLIVO_SOURCE_NUMBER,
    [$_REQUEST['phone_number']],
    'Hello, world!'
);
