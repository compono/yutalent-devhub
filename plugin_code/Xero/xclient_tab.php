<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');
require_once(dirname(__FILE__) . '/utils.php');

//invoice ajax data
if ($_POST['invoice']) {
	$result = array(
		'success' => false,
		'error' => 'Initialization error'
	);

	$init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
	if ($init['success']) {
		$invoice_xml = '<Invoice>';
		if ($_POST['invoice']['type']) {
			$invoice_xml .= '<Type>';
				$invoice_xml .= $_POST['invoice']['type'];
			$invoice_xml .= '</Type>';
		}
		if ($_POST['invoice']['status']) {
			$invoice_xml .= '<Status>';
				$invoice_xml .= $_POST['invoice']['status'];
			$invoice_xml .= '</Status>';
		}
		if ($_POST['invoice']['date']) {
			$invoice_xml .= '<Date>';
				$invoice_xml .= $_POST['invoice']['date'];
			$invoice_xml .= '</Date>';
		}
		if ($_POST['invoice']['due_date']) {
			$invoice_xml .= '<DueDate>';
				$invoice_xml .= $_POST['invoice']['due_date'];
			$invoice_xml .= '</DueDate>';
		}
		if ($_POST['invoice']['to_id']) {
			$invoice_xml .= '<Contact>';
				$invoice_xml .= '<ContactID>';
					$invoice_xml .= $_POST['invoice']['to_id'];
				$invoice_xml .= '</ContactID>';
			$invoice_xml .= '</Contact>';
		}
		if ($_POST['invoice']['account']) {
			$invoice_xml .= '<AccountCode>';
				$invoice_xml .= $_POST['invoice']['account'];
			$invoice_xml .= '</AccountCode>';
		}
		if (is_array($_POST['invoice']['item']) and $_POST['invoice']['item']) {
			$invoice_xml .= '<LineItems>';
				foreach ($_POST['invoice']['item'] as $line_item) {
					$invoice_xml .= '<LineItem>';
						if ($line_item['desc']) {
							$invoice_xml .= '<Description>';
								$invoice_xml .= $line_item['desc'];
							$invoice_xml .= '</Description>';
						}
						
						if ($line_item['qty']) {
							$invoice_xml .= '<Quantity>';
								$invoice_xml .= $line_item['qty'];
							$invoice_xml .= '</Quantity>';
						}
						if ($line_item['price']) {
							$invoice_xml .= '<UnitAmount>';
								$invoice_xml .= $line_item['price'];
							$invoice_xml .= '</UnitAmount>';
						}
						
					$invoice_xml .= '</LineItem>';
				}
			$invoice_xml .= '</LineItems>';
		}
		
		$invoice_xml .= '</Invoice>';
		$response = $XeroOAuth->request('PUT', $XeroOAuth->url('Invoices', 'core'), array(), $invoice_xml);
		if ($XeroOAuth->response['code'] == 200) {
			$result = array(
				'success' => true,
				'error' => null
			);
		} else {
			$error = $XeroOAuth->response['code'] . ' ' . $XeroOAuth->response['response'];

			$exception = simplexml_load_string($XeroOAuth->response['response']);
			if (isset($exception->Message)) {
				$error = (string) $exception->Message;
			}

			$result = array(
				'success' => false,
				'error' => $error
			);
		}
	}

	echo json_encode($result);
} else {
	$additional_js = array('js/jquery-ui-1.10.4.custom.min.js', 'js/xclient_tab.js');
	$additional_css = array('css/invoices.css', 'css/jquery-ui-1.10.4.custom.css');

	require_once(dirname(__FILE__) . '/views/header.php'); 

	if ($_REQUEST['xero_contact_id']) {
		$xero_contact_id = $_REQUEST['xero_contact_id'];
		$init = $init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
		if ($init['success']) { 
			$xero_contact_name = get_contact_name_by_id($xero_contact_id);
			if (!$xero_contact_name) {
				//looks like the contact was deleted in xero, so deleting the connection
				echo '<p>Looks like contact was deleted in xero. Unlinking contact.</p>';
				echo '<script type="text/javascript" src="js/xunlink_contact.js"></script>';
				die();
			}

			//invoices
			$response = $XeroOAuth->request('GET', $XeroOAuth->url('Invoices', 'core'), array('where' => 'Contact.ContactID = Guid("'.$xero_contact_id.'")'));
			if ($XeroOAuth->response['code'] == 200) {
				
				$invoices = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
				$invoices_arr = $invoices->Invoices;

				//accounts
				$response = $XeroOAuth->request('GET', $XeroOAuth->url('Accounts', 'core'), array());
				if ($XeroOAuth->response['code'] == 200) {
					$accounts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
				}
				
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
}