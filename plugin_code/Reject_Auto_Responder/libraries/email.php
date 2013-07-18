<?php
require('class.phpmailer.php');
class SmtpMail
{
	var $userName;
	var $password;
	var $toEmail;
	var $fromEmail;
	var $fromName;
	var $subject;
	var $body;
	var $host;
	var $port;
	var $SMTPSecure;
	var $testAutentication;
	function SmtpMail($userName,$password,$toEmail,$fromEmail,$fromName,$subject,$body,$host,$port,$SMTPSecure,$testAutentication=false)
	{
		$this->userName 			= $userName;
		$this->password 			= $password; 
		$this->toEmail 				= $toEmail;
		$this->fromEmail 			= $fromEmail; 
		$this->fromName 			= $fromName;
		$this->subject 				= $subject; 
		$this->body 				= $body;
		$this->host 				= $host;
		$this->port 				= $port;
		$this->SMTPSecure 			= $SMTPSecure;
		$this->testAutentication 	= $testAutentication;
	}
	
	function  sendEmail()
	{
		global $error;
		$mail = new PHPMailer();  	// create a new object
		$mail->IsSMTP(); 			// enable SMTP
		$mail->SMTPDebug = 0;  		// debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true;  	// authentication enabled
		$mail->SMTPSecure = $this->port; 	// secure transfer enabled REQUIRED for GMail
		$mail->Host = $this->host;		//plus.smtp.mail.yahoo.com";
		$mail->Port = $this->SMTPSecure;	//465;
		$mail->Username = $this->userName;
		$mail->ssl=1;
		$mail->debug=1;       //0 here in production
		$mail->html_debug=1; //same  
		$mail->Password =  $this->password;
		$mail->SetFrom($this->fromEmail, $this->fromName);
		$mail->Subject = $this->subject;
		$mail->Body = $this->body;
		$mail->IsHTML(true);      
		$mail->AddAddress($this->toEmail);
		$mail->testAutentication 	= $this->testAutentication;
		if(!$mail->Send()) 		return $mail->ErrorInfo; 
		else 					echo 1;
	}	
}