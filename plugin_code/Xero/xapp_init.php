<?php

require_once(dirname(__FILE__) . '/config.inc.php'); 
require_once(dirname(__FILE__) . '/libraries/XeroOAuth.php');

$XeroOAuth = null;

function init_app($xero_consumer_key, $xero_consumer_secret) {
	global $XeroOAuth;

	$result = array(
		'success' => false,
		'error' => 'Initialization error',
		'organisation_name' => ''
	);

	if ($xero_consumer_key and $xero_consumer_secret) {
		$signatures = array(
			'consumer_key' => $xero_consumer_key,
			'shared_secret' => $xero_consumer_secret,
			// API versions
			'core_version' => '2.0',
			'payroll_version' => '1.0',

			'application_type' => XERO_APP_TYPE,
			'oauth_callback' => XERO_OAUTH_CALLBACK,
			'user_agent' => XERO_USERAGENT
		);

		if (XERO_APP_TYPE == "Private" || XERO_APP_TYPE == "Partner") {
			$signatures['rsa_private_key'] = XERO_RSA_PRIVATE_KEY_PATH;
			$signatures['rsa_public_key'] = XERO_RSA_PUBLIC_KEY_PATH;
		}

		$XeroOAuth = new XeroOAuth($signatures);

		$initialCheck = $XeroOAuth->diagnostics();
		$checkErrors = count($initialCheck);
		if ($checkErrors > 0) {
			$result['error'] = '';
			foreach ($initialCheck as $check) {
				$result['error'] .= $check . PHP_EOL;
			}
		} else {
			$XeroOAuth->config['access_token'] = $xero_consumer_key;
			$XeroOAuth->config['access_token_secret'] = $xero_consumer_secret;

			//trying to get organisation name
			$response = $XeroOAuth->request('GET', $XeroOAuth->url('Organisation', 'core'), array('page' => 0));
			//success!
			if ($XeroOAuth->response['code'] == 200) {
				$organisation = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);

				$result = array(
					'success' => true,
					'error' => null,
					'organisation_name' => $organisation->Organisations[0]->Organisation->Name
				);
			//not so good...
			} elseif ($XeroOAuth->response['code'] == 401) {
				$result = array(
					'success' => false,
					'error' => 'Incorrect API keys',
					'organisation_name' => ''
				);
			//something is wrong...
			} else {
				$result = array(
					'success' => false,
					'error' => $XeroOAuth->response['code'] . ' ' . $XeroOAuth->response['response'],
					'organisation_name' => ''
				);
			}
		}
	} else {
		$result = array(
			'success' => false,
			'error' => 'Missing Consumer Key or Consumer Secret',
			'organisation_name' => ''
		);
	}

	return $result;
}

function get_contact_name_by_id($xero_contact_id) {
	global $XeroOAuth;

	$result = false;

	$response = $XeroOAuth->request('GET', $XeroOAuth->url('Contacts', 'core'), array('where' => 'ContactID = Guid("'.$xero_contact_id.'")'));
	if ($XeroOAuth->response['code'] == 200) {
		$contact = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
		
		if (isset($contact->Contacts->Contact->Name) and $contact->Contacts->Contact->Name) {
			$result = $contact->Contacts->Contact->Name;
		}
		$result = (string) $result;
	}

	return $result;
}