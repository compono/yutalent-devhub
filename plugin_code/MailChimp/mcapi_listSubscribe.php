<?php

/*
	to subscribe user detail in a prticular mailchimp list
*/

//if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['mailchimpKey']) && isset($_REQUEST['mailchimpListId']))
{
	$name = explode(' ',$_REQUEST['name']);
	$userDetail = array(
						'FNAME'=>$name[0],
						'LNAME'=>$name[1],
						'EMAIL'=>$_REQUEST['email'],
					);
	$apiKey = $_REQUEST['mailchimpKey'];
	$mailchimpListId = $_REQUEST['mailchimpListId'];
	print_r($userDetail);
	//require_once('libraries/MaichimpConnect.php');
	//$mailchimpConnect = new MailchimpConnect($apikey);
	print_r($userDetail);
	echo $mailchimpListId.'<br/>'.$apikey;
	//$mailchimpConnect->subscribeUserDetail($userDetail,$mailchimpListId);
}