<?php
$whiteListIp = array('95.138.185.73','54.251.162.52','5.79.21.*');	// ips for yutalent.com and yutalent.co.uk
/* get parent domain name dynamically */
$wuDomain = '';
$domainName = $_SERVER['SERVER_NAME'];
if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domainName, $resultDomainName)) {
	$wuDomain = 'www.'.$resultDomainName['domain'];
}
$wuDomain=((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $wuDomain;
define('WU_DOMAIN', $wuDomain);
define('TEST_SMTP_MAIL_BODY',"Hi {name}<br/><br/>This is the test email to check smtp setting connection and it is working fine.<br/><br/>Thanks");
define('TEST_SMTP_CONNCTION',"Test SMTP connection");
define('DEFAULT_SUBJECT',"Your application to our role {adverTitle}");
define('DEFAULT_MAIL_CONTENT',"Dear {firstname|ifempty|Candidate}<br/><br/>Thankyou for applying for our role. Unfortunately you have not been successful in your application.<br/>We wish you all the best in your search.<br/><br/>Kind regards.");
define('WU_ID', 'AF52-90A93042B-7A6F1B89C-C6D202471-4DCCC');
define('WU_SECRET', 'PUEJZK1MAHBOJA0RSHGKNCSS5WLVZJXPD4O5EIHG');