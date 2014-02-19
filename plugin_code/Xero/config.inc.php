<?php

define("wuDomain","www.yutalent.co.uk");
define('HTTP_SSL','https');

//we have private xero app
define('XERO_APP_TYPE', 'Private');

//this settings required for private and partner apps
define('XERO_RSA_PRIVATE_KEY_PATH', dirname(__FILE__) . '/../../../keys/privatekey.pem');
define('XERO_RSA_PUBLIC_KEY_PATH', dirname(__FILE__) . '/../../../keys/publickey.cer');

define('XERO_OAUTH_CALLBACK', 'oob');
define('XERO_USERAGENT', 'XeroOAuth-PHP Private App Test');
