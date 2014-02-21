<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array('js/xconnect_contact_buttons.js');
$additional_css = array();

require_once(dirname(__FILE__) . '/views/header.php'); 
if (!$_REQUEST['xero_contact_id']) {
	require_once(dirname(__FILE__) . '/views/connectContact.php'); 
} else {
	echo '<div id="content">Contact connected</div>';
}
require_once(dirname(__FILE__) . '/views/footer.php'); 
