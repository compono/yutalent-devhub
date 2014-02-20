<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array('js/xconnect_contact_popup.js');
$additional_css = array();

require_once(dirname(__FILE__) . '/views/header.php'); 

if ($_REQUEST['xero_contact_id']) {
	echo "<p>This contact already have a connection.</p>";
} else {
	$init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
	if ($init['success']) {
		$response = $XeroOAuth->request('GET', $XeroOAuth->url('Contacts', 'core'), array());
		$contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
		$contacts_select = array();
		foreach ($contacts->Contacts[0]->Contact as $contact) {
			$contacts_select[(string) $contact->ContactID] = (string) $contact->Name;
		}

		require_once(dirname(__FILE__) . '/views/selectContact.php'); 
	} else {
		echo "<p>Please check Xero plugin settings.</p>";
	}
}

require_once(dirname(__FILE__) . '/views/footer.php'); 

