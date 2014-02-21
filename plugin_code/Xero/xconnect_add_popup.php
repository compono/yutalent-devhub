<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/xapp_init.php');

$additional_js = array('js/xconnect_add_popup.js');
$additional_css = array();

require_once(dirname(__FILE__) . '/views/header.php'); 

if (!$_REQUEST['yu_contact_id']) {
	echo '<p>No contact id provided</p>.';
} else {
	if ($_REQUEST['xero_contact_id']) {
		echo "<p>This contact already have a connection.</p>";
	} else {
		$init = init_app($_REQUEST['xero_consumer_key'], $_REQUEST['xero_consumer_secret']);
		if ($init['success']) {
			if (isset($_REQUEST['contact']) or !$_REQUEST['contact']['name']) {
				$contact = $_REQUEST['contact'];

				$contact_xml = 
				"<Contacts>
					<Contact>";

				if (isset($contact['name']) and $contact['name']) {
					$contact_xml .= "<Name>{$contact['name']}</Name>";
				}
				if (isset($contact['email']) and $contact['email']) {
					$contact_xml .= "<EmailAddress>{$contact['email']}</EmailAddress>";
				}

				if ((isset($contact['phone']['profile']['normal']) and $contact['phone']['profile']['normal']) or
					(isset($contact['phone']['profile']['mobile']) and $contact['phone']['profile']['mobile'])) {
					$contact_xml .= "<Phones>";
					if (isset($contact['phone']['profile']['normal']) and $contact['phone']['profile']['normal']) {
						$contact_xml .= "<Phone>";
							$contact_xml .= "<PhoneType>DEFAULT</PhoneType>";
							$contact_xml .= "<PhoneNumber>{$contact['phone']['profile']['normal']}</PhoneNumber>";
							$contact_xml .= "<PhoneAreaCode></PhoneAreaCode>";
							$contact_xml .= "<PhoneCountryCode></PhoneCountryCode>";
						$contact_xml .= "</Phone>";
					}
					if (isset($contact['phone']['profile']['mobile']) and $contact['phone']['profile']['mobile']) {
						$contact_xml .= "<Phone>";
							$contact_xml .= "<PhoneType>MOBILE</PhoneType>";
							$contact_xml .= "<PhoneNumber>{$contact['phone']['profile']['mobile']}</PhoneNumber>";
							$contact_xml .= "<PhoneAreaCode></PhoneAreaCode>";
							$contact_xml .= "<PhoneCountryCode></PhoneCountryCode>";
						$contact_xml .= "</Phone>";
					}
					$contact_xml .= "</Phones>";
				}

				$contact_xml .= 
					"</Contact>
				</Contacts>";

				$response = $XeroOAuth->request('PUT', $XeroOAuth->url('Contacts', 'core'), array(), $contact_xml);
				if ($XeroOAuth->response['code'] == 200) {
					$contact = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
					$xero_contact_id = $contact->Contacts->Contact->ContactID;
					require_once(dirname(__FILE__) . '/views/addContact.php'); 
					
				} elseif ($XeroOAuth->response['code'] == 400) {
					echo "<p>Looks like we already have a contact with such a name on Xero. Please try to connect contact.</p>";
				} else {
					echo '<p>Something went wrong: ' . $XeroOAuth->response['code'] . ' ' . $XeroOAuth->response['response'] . '</p>';
				}
			} else {
				echo '<p>Contact data not received. Please try again.</p>';
			}
		} else {
			echo "<p>Please check Xero plugin settings.</p>";
		}
	}
}

require_once(dirname(__FILE__) . '/views/footer.php'); 