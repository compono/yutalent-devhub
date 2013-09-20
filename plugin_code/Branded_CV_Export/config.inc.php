<?php
$wuDomain = '';
$domainName = $_SERVER['SERVER_NAME'];
if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domainName, $resultDomainName)) {
	$wuDomain = 'www.'.$resultDomainName['domain'];
}
define("wuDomain",$wuDomain);
define('WU_ID', '354D-CB106FD58-C294AA40E-8DABC56C0-F7A39');
define('WU_SECRET', 'Y8GRUWG15DBHWUIKKUZS9VTADXWP8LRXJXDKLMDG');
