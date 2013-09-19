<?php
/* get parent domain name dynamically */
$wuDomain = '';
$domainName = $_SERVER['SERVER_NAME'];
if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domainName, $resultDomainName)) {
	$wuDomain = 'www.'.$resultDomainName['domain'];
}
define("wuDomain",$wuDomain);
define('HTTP_SSL','https');
define('TEST_SMTP_MAIL_BODY',"Hi {name}<br/><br/>This is the test email to check smtp setting connection and it is working fine.<br/><br/>Thanks");
define('TEST_SMTP_CONNCTION',"Test SMTP connection");
define('DEFAULT_SUBJECT',"Your application to our role {adverTitle}");
define('DEFAULT_MAIL_CONTENT',"Dear {firstname|ifempty|Candidate}<br/><br/>Thankyou for applying for our role. Unfortunately you have not been successful in your application.<br/>We wish you all the best in your search.<br/><br/>Kind regards.");
