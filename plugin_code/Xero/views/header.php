<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo HTTP_SSL.'://'.wuDomain.'/static/styles/plugin/plugin.css';?>" rel="stylesheet" />
	<link href="css/xero.css" rel="stylesheet" />
	<?php 
	if (isset($additional_css) and is_array($additional_css) and $additional_css) {
		foreach ($additional_css as $css) {
			echo '<link href="' . $css . '" rel="stylesheet" />';
		}
	}
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>var wuDomain ='<?php echo wuDomain; ?>';</script>
	<script type="text/javascript" src="js/xero.js"></script>
	<?php 
	if (isset($additional_js) and is_array($additional_js) and $additional_js) {
		foreach ($additional_js as $js) {
			echo '<script type="text/javascript" src="'.$js.'"></script>';
		}
	}
	?>
</head>
<body>
<form id="settings_form" method="post">
	<input type="hidden" name="signed_request" id="signed_request" value="<?php echo $_REQUEST['signed_request']; ?>" />
	<input type="hidden" name="xero_consumer_key" id="xero_consumer_key" value="<?php echo $_GET['xero_consumer_key']; ?>" />
	<input type="hidden" name="xero_consumer_secret" id="xero_consumer_secret" value="<?php echo $_GET['xero_consumer_secret']; ?>" />
	<input type="hidden" name="yu_contact_id" id="yu_contact_id" value="<?php echo $_REQUEST['yu_contact_id']; ?>" />
</form>