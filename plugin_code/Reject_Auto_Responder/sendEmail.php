<?php 
extract($_REQUEST);
if(!empty($fromEmail) && !empty($fromName) && !empty($hostServer) && !empty($userName) && !empty($password) && !empty($port))
{	// to required value exist or not
	require_once('libraries/email.php');	
	if(isset($testConnection))
	{
		$toEmail = $fromEmail;
		$testConnection = true;
		$body = 'testEmail';
	}	
	$sendEmail = new SmtpMail($userName,$password,$toEmail,$fromEmail,$fromName,$subject,$body,$hostServer,$port,$smtpNumber,$testConnection);
	$sendEmail->sendEmail();
}