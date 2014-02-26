<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$init = init_app($_COOKIE['xero_consumer_key'], $_COOKIE['xero_consumer_secret']);
if (!isset($_REQUEST['invoice_id']) or !$_REQUEST['invoice_id']) {
	echo '<p>Not enough params.</p>';
	die();
}
$invoice_id = $_REQUEST['invoice_id'];
if ($init['success']) {
	//xero can generate pdf for us :-P
	$response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices/'.$invoice_id, 'core'), array(), "", 'pdf');
	if ($XeroOAuth->response['code'] == 200) {
		header('Content-type: application/pdf');
		$invoice = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
		echo $invoice;
	} else {
		echo '<p>Something went wrong: ' . $XeroOAuth->response['code'] . ' ' . $XeroOAuth->response['response'] . '</p>';
	}
} else {
	echo '<p>Please check your Xero settings.</p>';
}