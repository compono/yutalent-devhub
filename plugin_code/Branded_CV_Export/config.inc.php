<?php
$wuDomain = '';
$domain_parts = explode('.', $_SERVER['HTTP_HOST']);
$domain_parts[0] = 'www';
$wuDomain = implode('.', $domain_parts);
$wuDomain=((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $wuDomain;

if (isset($_REQUEST['wuDomain']) && $_REQUEST['wuDomain']) {
	$wuDomain = $_REQUEST['wuDomain'];
}

define('WU_DOMAIN', $wuDomain);
define('WU_ID', '354D-CB106FD58-C294AA40E-8DABC56C0-F7A39');
define('WU_SECRET', 'Y8GRUWG15DBHWUIKKUZS9VTADXWP8LRXJXDKLMDG');
