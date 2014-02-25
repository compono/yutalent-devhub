<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array('js/xconnect_contact_buttons.js');
$additional_css = array();

require_once(dirname(__FILE__) . '/views/header.php'); 
if (!$_REQUEST['xero_contact_id']) {
	require_once(dirname(__FILE__) . '/views/connectContact.php'); 
} else {
	$init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
	if ($init['success']) {
		$xero_contact_name = get_contact_name_by_id($_REQUEST['xero_contact_id']);
		echo '<div id="content">Contact connected to '.$xero_contact_name.'</div>';
	}
}
require_once(dirname(__FILE__) . '/views/footer.php'); 
