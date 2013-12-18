<?php

//header_status(500);

if (!isset($_GET['accountId'])) 
{
    die("Account ID not found.");
}
else $accountId = $_GET['accountId'];

if (!isset($_GET['domain'])) 
{
    $domain = "https://www.yutalent.com";
}
else $domain = $_GET['domain'];

define('WU_DOMAIN', $domain);

require_once('./config.inc.php');
require_once('/home/developers_sandbox/SMS_2Way_config.php');
require_once('./libraries/nexmoAPI/NexmoInbound.php');
require_once('./libraries/wu-api/wu-api.php');

$msg = new NexmoInbound();
$WU_API = new WU_API();
$WU_API->setAccountId($accountId);

$contactId = $WU_API->sendMessageToWU('storage/get', array('key' => 'mobile_'.$msg->from));

print_r($contactId);
print_r(error_get_last());

//$contactId = $WU_API->sendMessageToWU('contacts/get', array('id' => 445)); //get contact by mobile number

//TODO: add notes
//TODO: add timeline

//header_status(200);


function header_status($statusCode)
{
    static $status_codes = null;

    if ($status_codes === null) {
        $status_codes = array (
            200 => 'OK',
            400 => 'Bad Request',
        );
    }

    if ($status_codes[$statusCode] !== null) {
        $status_string = $statusCode . ' ' . $status_codes[$statusCode];
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $status_string, true, $statusCode);
    }
}

?>