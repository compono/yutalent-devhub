<?php

/*
	to subscribe user detail in a prticular mailchimp list
*/
if(!count($_REQUEST))
{
	$_REQUEST = array (
	'mailchimpListId' => 'c219854d56',
	'mailchimpKey' => 'f50e7564c010bcdaf3753900e50f2ec7-us7',
	'name' => 'John Right',
	'email' => 'saurav@anylinuxwork.com'
	);
}

print_r($_REQUEST);

if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['mailchimpKey']) && isset($_REQUEST['mailchimpListId']))
{
	
	$name = explode(' ',$_REQUEST['name']);
	$userDetail = array(
						'FNAME'=>$name[0],
						'LNAME'=>$name[1],
						'EMAIL'=>$_REQUEST['email'],
					);
	$apiKey = $_REQUEST['mailchimpKey'];
	$mailchimpListId = $_REQUEST['mailchimpListId'];
	$mailchimpConnect = new MailchimpConnect($apikey);
	print_r($userDetail);
	$mailchimpConnect->subscribeUserDetail($userDetail,$mailchimpListId);
}