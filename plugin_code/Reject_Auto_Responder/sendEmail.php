<?php
require_once('config.inc.php');
if(!in_array($_SERVER['REMOTE_ADDR'],$whiteListIp) && !(isset($_REQUEST['testConnection'])))	// check ip exist if not is it called for test connection
{	
	// ip ip not exist then search the ip parent
	$remoteIp = explode('.',$_SERVER['REMOTE_ADDR']);
	$remoteIp[3] = '*';
	$remoteIp = implode(',',$remoteIp);
	if(!in_array($remoteIp,$whiteListIp))		die('no access');
}
extract($_REQUEST);
if(!empty($fromEmail) && !empty($fromName) && !empty($hostServer) && !empty($userName) && !empty($password) && !empty($port))
{	// to required value exist or not
	require_once('libraries/email.php');	
	if(isset($testConnection))
	{
		$toEmail = $fromEmail;
		$body = str_replace('{name}',ucwords($name),TEST_SMTP_MAIL_BODY);
		$subject = TEST_SMTP_CONNCTION;
	}	
	$sendEmail = new SmtpMail($userName,$password,$toEmail,$fromEmail,$fromName,$subject,$body,$hostServer,$port,$smtpNumber);
	$sendEmail->sendEmail();
}