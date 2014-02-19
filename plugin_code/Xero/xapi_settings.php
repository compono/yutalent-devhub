<?php 

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array('js/xapi_settings.js');
$additional_css = array();

require_once(dirname(__FILE__) . '/views/header.php'); 

if($_REQUEST['xero_consumer_key'] != '') $_POST['xero_consumer_key'] = $_REQUEST['xero_consumer_key'];
if($_REQUEST['xero_consumer_secret'] != '') $_POST['xero_consumer_secret'] = $_REQUEST['xero_consumer_secret'];

// if user has posted submit the form 
if(isset($_POST['xero_consumer_key']) or isset($_POST['xero_consumer_secret']))	{
	$init = init_app($_POST['xero_consumer_key'], $_POST['xero_consumer_secret']);
} 

/* Form for get xero key from user*/
require_once(dirname(__FILE__) . '/views/keyForm.php');

require_once(dirname(__FILE__) . '/views/footer.php'); 