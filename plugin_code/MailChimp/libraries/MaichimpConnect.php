<?php
// call config and mailchimp files to grab the list
require_once 'MCAPI.class.php';
require_once 'config.inc.php';
class MailchimpConnect
{
	function apiConnect($apikey)
	{
        $api = new MCAPI($apikey);
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
}