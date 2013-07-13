<?php
require_once('../config.inc.php');
require_once('/home/developers_sandbox/SMS_2Way_config.php');
require_once(SITE_URL.DEV.'libraries/textmagicAPI/TextMagicAPI.php');

$mob_no = $_GET['mob'];
$phones = array($mob_no);

$api = new TextMagicAPI(array(
			"username" => U_NAME,
			"password" => U_PASS, 
		));
		
$results = $api->checkNumber($phones);			
print_r($results);



?>