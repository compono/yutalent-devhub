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
		
try {

    $results = $api->checkNumber($phones);

    foreach($results as $number => $info) {
        echo $price = $info['price'];
        echo $country = $info['country'];
    }

} catch (WrongPhoneFormatException $e) {
    $return = "1";
} catch (TooManyItemsException $e) {
    $return = "2";
} catch (AuthenticationException $e) {
    $return = "3";
} catch (IPAddressException $e) {
    $return = "4";
} catch (RequestsLimitExceededException $e) {
    $return = "5";
} catch (DisabledAccountException $e) {
    $return = "6";
} catch (Exception $e) {
    $return = "7";
	//echo "Catched Exception '".__CLASS__ ."' with message '".$e->getMessage()."' in ".$e->getFile().":".$e->getLine();
}

echo $return;



?>