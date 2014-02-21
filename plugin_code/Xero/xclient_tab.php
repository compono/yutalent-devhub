<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array();

require_once(dirname(__FILE__) . '/views/header.php'); 
if ($_REQUEST['xero_contact_id']) {

} else {
	echo '<div class="content">This contact not connected with Xero contact. Please use Xero sidebar on the right to connect contact.</div>';
}
require_once(dirname(__FILE__) . '/views/footer.php'); 

