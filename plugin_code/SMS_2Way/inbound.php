<?php

header_status(200);

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

require_once('/home/developers_sandbox/SMS_2Way_config.php');
require_once('./config.inc.php');
require_once('./libraries/nexmoAPI/NexmoInbound.php');
require_once('./libraries/wu-api/wu-api.php');

$msg = new NexmoInbound();
$WU_API = new WU_API();
$WU_API->setAccountId($accountId);

$contactId = $WU_API->sendMessageToWU('storage/get', array('key' => 'mobile_'.$msg->from));

if (isset($contactId))
    $contactId = $contact[0];
else die('Contact ID not found');

$note = $WU_API->sendMessageToWU('notes/add', array(
    'contact_id' => $contactId,
    'received' => 'true',
    'type' => 'plugin_sms',
    'subject' => 'Inbound SMS',
    'message' => $msg->text
    ));

$timeline = $WU_API->sendMessageToWU('timeline/add', array(
    'contact_id' => $contactId,
    'type'=> 'plugin_sms',
    'interview_title' => "SMS sent"
    ));

print_r($note.'::'.$timeline.'::');
print_r(error_get_last());

//TODO: add notes
//TODO: add timeline


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