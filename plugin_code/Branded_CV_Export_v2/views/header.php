<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="<?php echo HTTP_SSL.'://'.WU_DOMAIN.'/static/styles/plugin/plugin.css';?>" rel="stylesheet" />
	<link href="css/branded.css" rel="stylesheet" />
	<?php 
	if (isset($additional_css) and is_array($additional_css) and $additional_css) {
		foreach ($additional_css as $css) {
			echo '<link href="' . $css . '" rel="stylesheet" />';
		}
	}
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>var wuDomain ='<?php echo WU_DOMAIN; ?>';</script>
	<script type="text/javascript" src="js/branded.js"></script>
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
</form>