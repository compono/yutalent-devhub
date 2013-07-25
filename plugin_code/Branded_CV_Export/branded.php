<?php
$scriptUrl = ((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?'https':'http') . '://' . $_SERVER['HTTP_HOST'].'/'.$_SERVER['PHP_SELF'];
require_once 'config.inc.php';
require_once 'libraries/wu-api/wu-api.php';
$WU_API = new WU_API();
// this is optional, but if you use query parameters in your script,
// then better to set it right, as oauth server will return additional parameters into script
// and then redirect uri will differ from the url which requested access token
$WU_API->setRedirectUri($scriptUrl);
$error = $WU_API->getParam('error');	// get error parmeter 
if(!is_null($error))			// if error paramter is exist
{
	?>
	<link rel="stylesheet" type="text/css" href="branded.css" />
	<?php
	$error = $error == 0 ? 'Ask your account owner to complete the company profile' : 'Please <a href="'.WU_DOMAIN.'/c/accounts/profile">click here</a> to complete the company profile';
	echo '<div class="errorConatiner">
		<div class="error">Your company profile inside your account is not yet complete... </div>
		<div class="error">we need this to create the branded PDF.</div>
		<div class="error">'.$error.'</div>
	</div>';
}