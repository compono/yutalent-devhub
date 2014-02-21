<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array();
$additional_css = array('css/invoices.css');

require_once(dirname(__FILE__) . '/views/header.php'); 
if ($_REQUEST['xero_contact_id']) {
	$init = $init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
	if ($init['success']) { 
		$response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('where' => 'Contact.ContactID = Guid("'.$_REQUEST['xero_contact_id'].'")'));
		if ($XeroOAuth->response['code'] == 200) {
			$invoices = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
			$invoices_arr = $invoices->Invoices;
			
			require_once(dirname(__FILE__) . '/views/invoices.php'); 
		} else {
			echo '<p>Something went wrong: ' . $XeroOAuth->response['code'] . ' ' . $XeroOAuth->response['response'] . '</p>';
		}
	} else {
		echo "<p>Please check Xero plugin settings for the API keys.</p>";
	}
} else {
	echo '<div class="content">This contact not connected with Xero contact. Please use Xero sidebar on the right to connect contact.</div>';
}
require_once(dirname(__FILE__) . '/views/footer.php'); 

