<?php
/*
Plugin to check the mobilen number validation.
*/

//including required files
// require_once('../config.inc.php');
// require_once('/home/developers_sandbox/SMS_2Way_config.php');
// require_once(SITE_URL.DEV.'libraries/textmagicAPI/TextMagicAPI.php');
// 
require_once('../libraries/nexmoAPI/NexmoAccount.php');
require_once('../libraries/nexmoAPI/NexmoMessage.php');
require_once('../libraries/nexmoAPI/NexmoReceipt.php');

$mob_no = $_GET['mob'];
$phones = array($mob_no);

//calling api creating an object
// $api = new TextMagicAPI(array(
// 			"username" => U_NAME,
// 			"password" => U_PASS, 
// 		));
$return = "";
// try {
//     $results = $api->checkNumber($phones);
//     foreach($results as $number => $info) {
//         $price = $info['price'];
//         $country = $info['country'];
// 	}
// } catch (WrongPhoneFormatException $e) {
//     $return = "Invalid mobile number format.";
// } catch (TooManyItemsException $e) {
//     $return = "Service temporarily unavailable.";
// } catch (AuthenticationException $e) {
//     $return = "Service temporarily unavailable.";
// } catch (IPAddressException $e) {
//     $return = "Service temporarily unavailable.";
// } catch (RequestsLimitExceededException $e) {
//     $return = "Service temporarily unavailable.";
// } catch (DisabledAccountException $e) {
//     $return = "Service temporarily unavailable.";
// } catch (Exception $e) {
//     $return = "Sorry, we don't support 2 way SMS to this country.";
// 	//echo "Catched Exception '".__CLASS__ ."' with message '".$e->getMessage()."' in ".$e->getFile().":".$e->getLine();
// }
echo $return;
?>