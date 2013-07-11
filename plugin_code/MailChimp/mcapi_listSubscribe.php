<?php

/*
	to subscribe user detail in a prticular mailchimp list
*/

//require_once('file:///D|/GIT-PUREHOME/jul-2013/10-jul/libraries/MaichimpConnect.php');
if(count($_REQUEST))
{
	$_REQUEST = array (
	'mailchimpListId' => 'c219854d56',
	'mailchimpKey' => 'f50e7564c010bcdaf3753900e50f2ec7-us7',
	'name' => 'John Right',
	'email' => 'saurav@anylinuxwork.com'
	);
}

if($_REQUEST['name']  && $_REQUEST['email'] && $_REQUEST['mailchimpKey'] && $_REQUEST['mailchimpListId'])
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
	$mailchimpConnect->subscribeUserDetail($userDetail,$mailchimpListId);
}