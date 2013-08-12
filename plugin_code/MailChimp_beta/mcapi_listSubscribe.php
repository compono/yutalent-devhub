<?php

/*
	to subscribe user detail in a prticular mailchimp list
*/

if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['mailchimpKey']) && isset($_REQUEST['mailchimpListId']))
{
	$name = explode(' ',$_REQUEST['name']);
	$userDetail = array(
						'FNAME'=>$name[0],
						'LNAME'=>$name[1],
						'EMAIL'=>$_REQUEST['email'],
					);
	$apikey = $_REQUEST['mailchimpKey'];
	$mailchimpListId = $_REQUEST['mailchimpListId'];
	require_once('libraries/MaichimpConnect.php');
	$mailchimpConnect = new MailchimpConnect($apikey);
	$mailchimpConnect->subscribeUserDetail($userDetail,$mailchimpListId);
}