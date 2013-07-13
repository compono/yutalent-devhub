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
        $price = $info['price'];
        $country = $info['country'];
    }

} catch (WrongPhoneFormatException $e) {
    $return = "invalid";
} catch (TooManyItemsException $e) {
    $return = "invalid";
} catch (AuthenticationException $e) {
    $return = "invalid";
} catch (IPAddressException $e) {
    $return = "invalid";
} catch (RequestsLimitExceededException $e) {
    $return = "invalid";
} catch (DisabledAccountException $e) {
    $return = "invalid";
} catch (Exception $e) {
    $return = "invalid";
	//echo "Catched Exception '".__CLASS__ ."' with message '".$e->getMessage()."' in ".$e->getFile().":".$e->getLine();
}

echo $return;



?>