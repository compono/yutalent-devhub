<?php
// call config and mailchimp files to grab the list
require_once 'MCAPI.class.php';
require_once 'config.inc.php';
class MailchimpConnect
{
	private $api;
	private $apikey;
	
	function MailchimpConnect($apikey)
	{
		$this->api = new MCAPI($apikey);
		$this->apikey = $apikey;
	}
	
	
	// to get mailchimp list according to api key
	function getMailchimpList()
	{
        $api = $this->api;
        $retval = $api->lists();
		$error = false;
        if ($api->errorCode)	// if any error return by mailchimp
        {
            $mailChimpList = '<div class="mailchimpError"><div class="error-text">Unable to load lists!'.$api->errorMessage.'</div></div>';
			$error = true;
			unset($api);
        }
        else 	// prepare the mailchimp list and assign it to js's mailChimpList variable
        {
            $mailChimpList = '<option value="" webId="" class="bronze-info">No list selected..</option>';
			foreach ($retval['data'] as $list)
            {
                $mailChimpList.= '<option '.$selected.' value="'.$list['id'].'" webId = "'.$list['web_id'].'">'.$list['name'].'</option>';
            }
        }
		return array('list'=>$mailChimpList,'error'=>$error);
	}
	
	// to get subscribe user detail in a mailchimp list
	function subscribeUserDetail($userDeatail,$mailchimpListId)
	{
		$this->api->listSubscribe($mailchimpListId, $userDeatail['EMAIL'], $userDeatail,'html',false );
	}
}